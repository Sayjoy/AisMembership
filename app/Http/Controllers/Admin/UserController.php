<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Workgroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Password;
use Tariq86\CountryList\CountryList;
use App\Events\NewUserCreated;
use App\Exports\ExportUsers;
use App\Helpers\UploadImage;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', [
                    'users' => User::paginate(10),
                ]);

        /*
        if (Gate::denies('logged-in')){
            dd('no access allowed');
        }

        if (Gate::allows('is-admin')){b
            return view('admin.users.index', [
                'users' => User::paginate(10),
            ]);
        }
        */

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryList = new CountryList();
        $countries = $countryList->getList();
        return view('admin.users.create', [
            'roles'=>Role::all(),
            'workgroups' => Workgroup::all(),
            'countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $password = uniqid();
        $userData = $request->only('name', 'email', 'phone', 'country', 'roles');
        $userData['ip'] = "";
        $userData['password'] = $password;
        $userData['password_confirmation'] = $password;

        $newUser = new CreateNewUser();
        $user = $newUser->create($userData);

        Password::sendResetLink($request->only(['email']));

        $request->session()->flash('success', 'User created successfully');
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countryList = new CountryList();
        $countries = $countryList->getList();
        return view('admin.users.edit',
            [
                'roles'=>Role::all(),
                'user'=>User::find($id),
                'workgroups' => Workgroup::all(),
                'countries'=>$countries
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user){
            $request->session()->flash('error', 'User edit failed');
            return redirect(route('admin.users.index'));
        }

        if(!empty($request->picture)){
            $imageName = UploadImage::upload($request->file('picture'));
            $input = array_merge (
                $request->except(['_token', 'roles']),
                ["picture" => $imageName]);
        }
        else {
            $input = $request->except(['_token', 'roles', 'workgroup']);
        }

        $user->update($input);

        event(new NewUserCreated($user, $request->roles, $request->workgroup));

        $request->session()->flash('success', 'User updated successfully');
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        User::destroy($id);
        $request->session()->flash('success', 'You have deleted the User');
        return redirect(route('admin.users.index'));
    }

    public function export()
    {
        $users = User::all();
        $data = [["Name", "Email", "Phone Number", "Country", "Education", "Expertise", "Role", "Workgroup"]];
        foreach($users as $user)
        {
            $roles = "";
            foreach ($user->roles as $role){
                $roles.="$role->name, ";
            }

            $workgroups = "";
            foreach ($user->workgroups as $workgroup){
                $workgroups.="$workgroup->name, ";
            }


            $data[] = [$user->name,
                        $user->email,
                        $user->phone,
                        $user->country,
                        $user->highestEducation(),
                        $user->expertise,
                        $roles,
                        $workgroups
                    ];
        }
        $export = new ExportUsers($data);
        return Excel::download($export, 'users.xlsx');
    }
}

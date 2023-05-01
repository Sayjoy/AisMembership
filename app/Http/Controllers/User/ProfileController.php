<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Tariq86\CountryList\CountryList;
use App\Helpers\UploadImage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view ('user.profile', [
            'user' => User::findOrFail($id),
        ]);
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
        return view ('user.edit', [
            'user' => User::findOrFail($id),
            'countries'=>$countries,
            'roles'=>Role::all()
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
            $imageName = UploadImage::upload($request->file('picture'), $user->picture);

            $input = array_merge (
                $request->except(['_token', 'roles']),
                ["picture" => $imageName]);
        }
        else {
            $input = $request->except(['_token', 'roles']);
        }

        $user->update($input);

        $request->session()->flash('success', 'Profile updated successfully');
        return redirect(route('user.profile.show', $user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

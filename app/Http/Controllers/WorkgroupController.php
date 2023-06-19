<?php

namespace App\Http\Controllers;

use App\Models\Workgroup;
use App\Http\Requests\StoreworkgroupRequest;
use App\Http\Requests\UpdateworkgroupRequest;
use Illuminate\Http\Request;

class WorkgroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('workgroup.index',[
            'workgroups' => Workgroup::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('workgroup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreworkgroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreworkgroupRequest $request)
    {
        Workgroup::create($request->except('_token'));
        $request->session()->flash('success', 'Workgroup created successfully');

        return redirect(route('admin.workgroup.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\workgroup  $workgroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workgroup = Workgroup::findOrFail($id);
        return view('admin.users.index', [
            'users' => $workgroup->users()->paginate(10),
            'workgroup' => $workgroup,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\workgroup  $workgroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view ('workgroup.edit', ['workgroup' => Workgroup::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateworkgroupRequest  $request
     * @param  \App\Models\workgroup  $workgroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateworkgroupRequest $request, $id)
    {
        Workgroup::findOrFail($id)->update($request->except('_token'));

        return redirect(route('admin.workgroup.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\workgroup  $workgroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Workgroup::destroy($id);
        $request->session()->flash('success', 'You have deleted the Workgroup');
        return redirect(route('admin.workgroup.index'));
    }
}

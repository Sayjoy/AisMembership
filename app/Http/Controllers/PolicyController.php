<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\User;
use App\Http\Requests\StorepolicyRequest;
use App\Http\Requests\UpdatepolicyRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Events\NewPolicyIdeaSubmitted;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('policy.index', [
            'policies' => Policy::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('policy.ideas', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepolicyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepolicyRequest $request)
    {

        if ($request->user()){
            $user_id = $request->user()->id;
        }
        else{
            $user_id = Null;
        }

        $policy = Policy::create(array_merge(
                                    $request->except('categories'),
                                    ['user_id' => $user_id]
                                ));

        event(new NewPolicyIdeaSubmitted($policy, $request->categories));

        $request->session()->flash('success', 'Your policy idea has been submitted.
            You will be notified when your idea has been approved/disapproved for further discussion');

        return redirect(route('policy-ideas'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(policy $policy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepolicyRequest  $request
     * @param  \App\Models\policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepolicyRequest $request, policy $policy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Policy::destroy($id);
        $request->session()->flash('success', 'You have deleted the Policy');
        return redirect(route('policy.ideas.index'));
    }

    public function approval(Request $request)
    {
        $policy = Policy::findOrFail($request->id);
        if ($request->action){
            $action = True;
        } else {
            $action = False;
        }

        $policy->update([
            'approval' => $action,
            'comment' =>$request->comment,
            'approver_id' => $request->user()->id,
        ]);

        //$policy->approver()->associate($request->user());

        $request->session()->flash('success', 'Policy '.$request->submit.'d');
        return (redirect(route('policy.ideas.index')));
    }
}

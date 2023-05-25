<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\User;
use App\Http\Requests\StorepolicyRequest;
use App\Http\Requests\UpdatepolicyRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Events\NewPolicyIdeaSubmitted;
use App\Events\PolicyIdeaUpdated;
use App\Events\PolicyIdeaStatusUpdated;
use App\Events\PolicyPublishedStatus;
use App\Models\Discussion;
use Cookie;
use Carbon\Carbon;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($categoryId = Null)
    {
        if($categoryId)
        {
            $category = Category::findOrFail($categoryId);

            return view('policy.index', [
                'policies' => $category->policies()->paginate(10),
                'category' => $category
            ]);
        }
        else {
            return view('policy.index', [
                'policies' => Policy::paginate(10),
            ]);
        }
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
    public function show($id)
    {
        $policy = Policy::findOrFail($id);
        $categories = Category::all();

        if(!Cookie::get($policy->id)){
            Cookie::queue($policy->id, '1', 60);
            $policy->incrementPolicyViews();
        }

        return view('policy.show',[
            'policy' => $policy,
            'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('policy.edit',[
            'policy' => Policy::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepolicyRequest  $request
     * @param  \App\Models\policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepolicyRequest $request, $policy_id)
    {
        $policy = Policy::findOrFail($policy_id);
        $policy->update($request->except(['categories']));

        event(new PolicyIdeaUpdated($policy, $request->categories));

        $request->session()->flash('success', 'This policy idea has been updated');

        return redirect()->route ('policy.show', $policy->id);
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
            $p_id = 'P-'.date('ymd').$policy->id;
            $message = "<p>Congratulations! Your Policy idea has been approved for discussion with the policy id $p_id on the NNDCA forum</p>
            <p>Reason for approval: $request->comment</p>
            <p>Further actions are:
                <ul>
                    <li>Our moderators will review member comments and modify your idea accordingly until it becomes a full blown policy.</li>
                    <li>After this, the policy will be published to the public.</li>
                </ul>
            </p>";
        } else {
            $action = False;
            $p_id = Null;
            $message = "Our moderators have reviewed your idea submission and did not find it to comply with NNDCA's vision.
            We are sorry to decline your submission
            <p>Reason for declining: $request->comment</p>
            ";
        }

        $policy->update([
            'approval' => $action,
            'comment' =>$request->comment,
            'approved_at' => Carbon::now(),
            'approver_id' => $request->user()->id,
            'policy_id' => $p_id,
        ]);

        event(new PolicyIdeaStatusUpdated($policy, $message));

        $request->session()->flash('success', 'Policy '.$request->submit.'d');
        return (redirect(route('policy.ideas.index')));
    }

    public function publish($policy_id, Request $request)
    {
        $policy = Policy::findOrFail($policy_id);

        if ($policy->published_at)
        {
            //Already published, Unpublish post.
            $policy->update([
                'published_at' => Null,
                'publisher_id' => $request->user()->id,
                'view' => 0
            ]);
            $action = "unpublished";
            $message = "Your policy $policy->policy_id was unpublished and has been removed from public access.
            This may be due to a need to re-evaluate the policy. Kindly contact NNDCA admin for more information.";
        }
        else {
            //Publish post.
            $policy->update([
                'published_at' => Carbon::now(),
                'publisher_id' => $request->user()->id,
                'view' => 0
            ]);
            $action = "published";
            $message = "Congratulations, your policy, $policy->policy_id has been published.
            This means it is now available for public access. Checkout the published policy at
            ".url('policy-published/'.$policy->id);
        }

        event(new PolicyPublishedStatus($policy, $message));

        $request->session()->flash('success', 'Policy '.$action.' Succesful');
        return redirect()->route ('policy.show', $policy->id);
    }

    public function publishedPolicies($category_id=Null)
    {
        if($category_id)
        {
            $categoryId = $category_id;
            $category = Category::findOrFail($categoryId);
            $policiesQuery = $category->policies()->whereNotNull('published_at');
            $policies = $policiesQuery->paginate(10);

            return view('policy.published', [
                'policies' => $policies,
                'category' => $category
            ]);
        }
        else {
            return view('policy.published', [
                'policies' => Policy::whereNotNull('published_at')->paginate(10),
            ]);
        }

    }

    public function showPublished($id)
    {
        $policy = Policy::findOrFail($id);

        if(!Cookie::get($policy->id)){
            Cookie::queue($policy->id, '1', 60);
            $policy->incrementPolicyViews();
        }

        return view('policy.showPublished',[
            'policy' => $policy,
            'categories' => Category::all()
        ]);
    }
}

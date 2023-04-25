<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Policy;
use App\Models\Category;
use App\Http\Requests\StoreDiscussionRequest;
use App\Http\Requests\UpdateDiscussionRequest;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvedIdeas = Policy::where('approval', true)->whereNull('published_at')->paginate(10);
        $categories = Category::all();
        return view('policy.discussion', [
            'approvedIdeas' => $approvedIdeas,
            'categories' => $categories
        ]);
    }

    public function byCategory($category_id)
    {
        $category = Category::findOrFail($category_id);
        $approvedIdeas = $category->policies()
                                ->where('approval', true)
                                ->whereNull('published_at')
                                ->paginate(10);
        $categories = Category::all();
        return view('policy.discussion', [
            'approvedIdeas' => $approvedIdeas,
            'categories' => $categories,
            'category' =>$category
        ]);
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
     * @param  \App\Http\Requests\StoreDiscussionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscussionRequest $request)
    {
        Discussion::create(array_merge(
            $request->all(),
            ['user_id' => Auth::id()]
        ));

        $request->session()->flash('success', 'Reply successful');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscussionRequest  $request
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscussionRequest $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        //
    }
}

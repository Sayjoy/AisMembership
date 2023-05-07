<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Http\Requests\StorePollRequest;
use App\Http\Requests\UpdatePollRequest;
use App\Models\PollElement;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('poll.index', [
            'polls' => Poll::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('poll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePollRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePollRequest $request)
    {
        $poll = Poll::create([
            'name' => $request->name,
            'user_id' => $request->user()->id,
            //'status' => $request->status

        ]);

        if ($request->status)
        {
            $this->openPoll($poll->id);
        }

        return redirect(route ('poll.questions.create', [
            'poll_id' => $poll->id,
            'q_no' => $request->no]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show($poll_id)
    {
        return view('poll.show', [
            'poll' => Poll::findOrFail($poll_id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit($poll_id)
    {
        return view('poll.edit', [
            'poll' => Poll::findOrFail($poll_id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePollRequest  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePollRequest $request, $poll_id)
    {
        $poll = Poll::findOrFail($poll_id);
        $poll->update([
            'name' => $request->name,
            'user_id' => $request->user()->id,
        ]);

        if ($request->status)
        {
            $this->openPoll($poll_id);
        }

        return redirect(route ('poll.questions.edit', [
            'poll_id' => $poll->id,
            'q_no' => $request->no]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy($poll_id, Request $request)
    {
        $poll = Poll::findOrFail($poll_id);

        foreach($poll->questions as $question)
        {
            PollElement::destroy($question->id);
        }

        Poll::destroy($poll_id);

        $request->session()->flash('success', 'Poll successfully deleted');

        return redirect(route('poll.entity.index'));
    }

    public function openPoll($id)
    {
        Poll::where('id', $id)
        ->update(['status' => 1]);

        Poll::where('id', '!=', $id)
        ->update(['status' => Null]);
    }
}

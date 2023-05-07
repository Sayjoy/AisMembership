<?php

namespace App\Http\Controllers;

use App\Models\PollElement;
use App\Models\Poll;
use App\Http\Requests\StorePollElementRequest;
use App\Http\Requests\UpdatePollElementRequest;

class PollElementController extends Controller
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
    public function create($poll_id, $q_no)
    {
        $poll = Poll::findOrFail($poll_id);

        return view('poll.questions',[
            'q_no' => $q_no,
            'poll' => $poll
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePollElementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePollElementRequest $request)
    {
        $items = [];
        foreach ($request->questions as $question)
        {
            if ($question !=""){
                $items[] = [
                    'title' => $question,
                    'poll_id' => $request->poll_id,
                    'user_id' => $request->user()->id,
                ];
            }
        }

        PollElement::insert($items);

        return redirect(route('poll.entity.show', $request->poll_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollElement  $pollElement
     * @return \Illuminate\Http\Response
     */
    public function show(PollElement $pollElement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollElement  $pollElement
     * @return \Illuminate\Http\Response
     */
    public function edit($poll_id, $q_no="0")
    {
        $poll = Poll::findOrFail($poll_id);

        return view('poll.edit-questions',[
            'q_no' => $q_no,
            'poll' => $poll
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePollElementRequest  $request
     * @param  \App\Models\PollElement  $pollElement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePollElementRequest $request)
    {
        $items = [];
        //update old questions
        if (isset($request->ids))
        {
            $n = sizeof($request->ids);
            for($i=0; $i<$n; $i++)
            {
                PollElement::where('id', $request->ids[$i])
                        ->update(['title' => $request->old_questions[$i]]);
            }
        }

        //Insert new questions
        if ($request->filled("questions"))
        {
            foreach ($request->questions as $question)
            {
                if ($question !=""){
                    $items[] = [
                        'title' => $question,
                        'poll_id' => $request->poll_id,
                        'user_id' => $request->user()->id,
                    ];
                }
            }

            PollElement::insert($items);
        }

        return redirect(route('poll.entity.show', $request->poll_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollElement  $pollElement
     * @return \Illuminate\Http\Response
     */
    public function destroy(PollElement $pollElement)
    {
        //
    }
}

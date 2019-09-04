<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use App\Question;

class AnswersController extends Controller
{

    /** only dan except.
     * only hanya yang di auth
     * except itu yang tidak di auth
    */

    public function __construct()
    {
        $this->middleware('auth',['only' => ['store']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question,Request $request)
    {

        $question->answers()->create($request->validate([
            'body' => 'required'
        ]) + ['user_id' => \Auth::id()]);

        return back()->with('success', "Your anwer has been submitted successfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {

        $this->authorize('update', $answer);
        return view("answers._edit", compact('question', 'answer'));
        // return  response()->json($answer);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question, Answer $answer)
    {
        $this->authorize("update", $answer);
        $answer->update($request->validate([
            'body'  => 'required'
        ]));

        return redirect()->route('questions.show', $question->slug)->with("success", "Your question has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question,Answer $answer)
    {

        $this->authorize("delete", $answer);
        $answer->delete();

       return back()->with("success", "Your question has been delete");
    }


    public function myanswers()
    {
        $answers = auth()->user()->answers;
        $data = [];
        foreach($answers as $data_answers)
        {
            $get_answers = $data_answers;
            $data = $get_answers->question;
            $getQuestion[] = $data;
        };
        // return response()->json($getQuestion);
        return view("myanswer", compact('answers', 'getQuestion'));
    }
}

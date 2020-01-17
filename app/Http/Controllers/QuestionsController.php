<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

class QuestionsController extends Controller
{
    /** only dan except.
     * only hanya yang di auth
     * except itu yang tidak di auth
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // \DB::enableQueryLog();
        $questions =  Question::with('user')->latest()->paginate(10);
        return view('questions.index', compact('questions'))->render();
        // dd(\DB::getQuerylog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();

        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title', 'body'));
        return redirect()->route('questions.index')->with("success", "Your question has been submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('questions.show', compact('question'));
        // $question->increment('votes');
        /**
         * jadi kesimpulannya increment di  laravel saat ini adalah menambahkan views yang ada k
         * seperti view ++1
         */
        // $question->view = $question->view + 1;
        // $question->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $this->authorize("update", $question);
        return view("questions.edit", compact('question'));
        // return response()->json($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        $this->authorize("update", $question);
        $question->update($request->only('title', 'body'));

        return redirect('/questions')->with("success", "Your question has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->authorize("delete", $question);
        $question->delete();

        return redirect('/questions')->with("success", "Your question has been deleted.");
    }

    public function myquestion()
    {
        // $question = Question::all();

        // $questions = auth()->user()->questions->latest()->paginate(10);
        // return response()->json($questions);
        $questions =  Question::with('user')->where('user_id', auth()->user()->id)->latest()->paginate(10);
        // return view('questions.index', compact('questions'))

        return view('myquestion', compact('questions'))->render();
    }
}

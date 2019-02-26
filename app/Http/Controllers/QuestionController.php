<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Auth;
use App\Category;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && auth()->User()->actor == "admin") {
            $questions = Question::all();
            return view('questions.index')->with('questions', $questions);
        }else{
            return redirect('/questions')->with('fail', 'You must be admin!');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && auth()->User()->actor == "admin") {
            $categories = Category::all();
            return view('questions.create')->with('categories', $categories);
        }else{
            return view('/auth/login')->with('fail', 'You must be a Admin!');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question;
        $question->question = $request->input('question');
        $question->answer = $request->input('answer');
        $question->category_id = $request->input('category');
        $question->save();

        return redirect('/questions')->with('success', 'You have successfully created a question!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {   
        $categories = Category::all();
        if (Auth::check() && auth()->User()->actor == "admin") {
           
            return view('questions.edit')->with('question', $question)->with('categories', $categories);
        }else{
            return view('/auth/login')->with('fail', 'You must be a Admin!');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->validate($request, [
            'question' => 'required|unique:questions,question,'.$question->id,
            'answer' => 'required|unique:questions,answer,'.$question->id,
            'category_id' => 'unique:questions,category_id,'.$question->id
        ]);


        $question->question = $request->input('question');
        $question->answer = $request->input('answer');
        $question->category_id = $request->input('category');
        $question->save();

        return redirect('/questions')->with('success', 'Question was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if (Auth::check() && auth()->User()->actor == "admin") {
           
            $question->delete();
            return redirect('/questions')->with('success', 'Question was deleted!');
        }else{
            return view('/auth/login')->with('fail', 'You must be a Admin!');
        }
        
    }
}

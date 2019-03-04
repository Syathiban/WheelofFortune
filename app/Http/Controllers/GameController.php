<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Auth;
use App\Word;
use App\Question;
use App\Category;
use App\User;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = Auth::user()->email;
        $category = Category::has('words')->inRandomOrder()->first();
        $words = Word::where('category_id', $category->id)->pluck('name');
        $questions = Question::where('category_id', $category->id)->pluck('question');
        $answers = Question::where('category_id', $category->id)->pluck('answer');
        $balance = User::where('email', $email)->pluck('balance');
        if (Auth::check()) {
            return view('game', compact('words', 'category', 'questions', 'answers', 'balance'));
        }else{
            return redirect('/login')->with('fail', 'You must be logged in!');
        }
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
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}

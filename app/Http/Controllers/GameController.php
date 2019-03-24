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
        if (Auth::check()) {
            $email = Auth::user()->email;
            $category = Category::has('words')->inRandomOrder()->first();
            $words = Word::where('category_id', $category->id)->pluck('name');
            $questions = Question::where('category_id', $category->id)->pluck('question');
            
            if ($category == null || Category::has('words') == null || Category::has('questions') == null) {
                return redirect('/home')->with('fail', 'Under Maintenance! Database Empty.');
            }else{
                
            $correctAnswers = Question::where('category_id', $category->id)->pluck('correctAnswer');
            $wrongAnswers = Question::where('category_id', $category->id)->pluck('wrongAnswer');
            $balance = User::where('email', $email)->pluck('balance');
            $mostMoneyMade = User::where('email', $email)->pluck('mostMoneyMade');
            $roundsPlayed = User::where('email', $email)->pluck('roundsPlayed');
                return view('game', compact('words', 'category', 'questions', 'answers', 'balance', 'mostMoneyMade', 'roundsPlayed'));
            }
        }else{
            return redirect('/login')->with('fail', 'You must be logged in!');
        }
    }


    function changeCategory(){
            $allWords = Word::all();
            $email = Auth::user()->email;
            $newCategory = Category::inRandomOrder()->first();
            $questions = Question::where('category_id', $newCategory->id)->pluck('question');
            $correctAnswers = Question::where('category_id', $newCategory->id)->pluck('correctAnswer');
            $wrongAnswers = Question::where('category_id', $newCategory->id)->pluck('wrongAnswer');
            $words = Word::where('category_id', $newCategory->id)->pluck('name');
            $balance = User::where('email', $email)->pluck('balance');
            return response()->json(['words' => $words, 'newCategory' => $newCategory, 'questions' => $questions, 'correctAnswers' => $correctAnswers, 'balance' => $balance, 'allWords' => $allWords, 'wrongAnswers' => $wrongAnswers]);     
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
        $user = Auth::user();
        $bank = $request->input('bank');
        $highScore = $request->input('highScore');
        $rounds = $request->input('roundsPlayed');
        $user->roundsPlayed = $rounds;
        $user->balance = $bank;
        $user->mostMoneyMade = $highScore;
        $user->save();

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

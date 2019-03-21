<?php

namespace App\Http\Controllers;

use App\HighscoreList;
use Illuminate\Http\Request;
use App\User;
use Auth;
class HighscoreListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && auth()->User()->actor == "admin") {
            $users = User::all();
            return view('highscorelists.index')->with('users', $users);

        }else{
            return view('/auth/login')->with('fail', 'You must be a Admin!');
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
     * @param  \App\HighscoreList  $highscoreList
     * @return \Illuminate\Http\Response
     */
    public function show(HighscoreList $highscoreList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HighscoreList  $highscoreList
     * @return \Illuminate\Http\Response
     */
    public function edit(HighscoreList $highscoreList,$id)
    {
            $users = User::findOrFail($id);
        if (Auth::check() && auth()->User()->actor == "admin") {
           // $users = User::all();
             return view('highscorelists.edit')->with('users', $users);
        
        }else{
             return view('/auth/login')->with('fail', 'You must be a Admin!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HighscoreList  $highscoreList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $this->validate($request, [
            'name' => 'required|unique:user,name,'.$user->id,
            'mostMoneyMade' => 'user,mostMoneyMade,'.$user->id,
            'roundsPlayed' => 'user,roundsPlayed,'.$user->id,
        ]);


        $user->name = $request->input('name');
        $user->mostMoneyMade = $request->input('mostMoneyMade');
        $user->roundsPlayed = $request->input('roundsPlayed');
        $user->save();

        return redirect('/highscorlists')->with('success', 'Highscore List was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HighscoreList  $highscoreList
     * @return \Illuminate\Http\Response
     */
    public function destroy(HighscoreList $highscoreList, User $user, Request $request)
    {
        if (Auth::check() && auth()->User()->actor == "admin") {   
            $this->validate($request, [
                'mostMoneyMade' => 'user,mostMoneyMade,'.$user->id,
                'roundsPlayed' => 'user,roundsPlayed,'.$user->id,
            ]);
            
            $user->mostMoneyMade = $request->input(0);
            $user->roundsPlayed = $request->input(0);
            $user->save();

            return redirect('/highscorelists')->with('success', 'Highscore was deleted!');
       
        }else{
            return view('/auth/login')->with('fail', 'You must be a Admin!');
        }
    }
}

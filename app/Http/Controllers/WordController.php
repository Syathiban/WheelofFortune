<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Category;
use Auth;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    
    public function index()
    {
        if (Auth::check() && auth()->User()->actor == "admin") {
            $words = Word::all();
            return view('words.index')->with('words', $words);

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
        if (Auth::check() && auth()->User()->actor == "admin") {
           $categories = Category::all();
            return view('words.create')->with('categories', $categories);
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
        $word = new Word;
        $word->name = $request->input('name');
        $word->category_id = $request->input('category');
        $word->letters = $request->input('letters');
        $word->save();

        return redirect('/words')->with('success', 'You have successfully created a word!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {   
        $categories = Category::all();
        if (Auth::check() && auth()->User()->actor == "admin") {
             
             return view('words.edit')->with('word', $word)->with('categories', $categories);
        
        }else{
             return view('/auth/login')->with('fail', 'You must be a Admin!');
        }
           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        $this->validate($request, [
            'name' => 'required|unique:words,name,'.$word->id,
            'category_id' => 'unique:words,category_id,'.$word->id,
            'letters' => 'required|unique:words,letters,'.$word->id,
        ]);


        $word->name = $request->input('name');
        $word->category_id = $request->input('category');
        $word->letters = $request->input('letters');
        $word->save();

        return redirect('/words')->with('success', 'Word was updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        if (Auth::check() && auth()->User()->actor == "admin") {
           
            $word->delete();
            return redirect('/words')->with('success', 'Word was deleted!');
       
        }else{
            return view('/auth/login')->with('fail', 'You must be a Admin!');
        }
    }

}

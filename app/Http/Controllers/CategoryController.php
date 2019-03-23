<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;
use App\Word;
use App\Question;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && auth()->User()->actor == "admin") {
            $categories = Category::all();
            return view('categories.index')->with('categories', $categories);
        }else{
            return redirect('/categories')->with('fail', 'You must be admin!');
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
           
            return view('categories.create');
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
    public function store(Request $request, Category $category)
    {
        $categories = new Category;

        $this->validate($request, [
            'name' => 'required|alpha_num|unique:categories,name,'.$category->id,
        ]);

        $categories->name = $request->input('name');
        $categories->save();

        return redirect('/categories')->with('success', 'You have successfully created a category!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Auth::check() && auth()->User()->actor == "admin") {
           
            return view('categories.edit')->with('category', $category);
        }else{
            return view('/auth/login')->with('fail', 'You must be a Admin!');
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|alpha_num|unique:categories,name,'.$category->id,
        ]);


        $category->name = $request->input('name');
        $category->save();

        return redirect('/categories')->with('success', 'Category was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (Auth::check() && auth()->User()->actor == "admin") {
       
            $words = Word::where('category_id', $category->id)->get();
            foreach ($words as $word) {
                $word->category_id = null;
                $word->save();
            }

            $questions = Question::where('category_id', $category->id)->get();
            foreach ($questions as $question) {
                $question->category_id = null;
                $question->save();
            }
            
            $category->delete();

            return redirect('/categories')->with('success', 'Category was deleted!');
        }else{
            return view('/auth/login')->with('fail', 'You must be a Admin!');
        }
    }
}

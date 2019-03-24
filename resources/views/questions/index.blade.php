<!DOCTYPE html>
<html lang="en">
<head>
<title>Questions</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
@extends('layouts.app')

@section('content')

</head>
<body class="bod">
<div class="signupform">
	<div class="container">
		<div class="w3_info card">
			<div class="card-body">
                <h1 class="headAth">Questions</h1>
                                <a style="margin-bottom:8px; margin-right:8px;" class="btn btn-primary float-right" href="/questions/create"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>

                    <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">question</th>
                                <th scope="col">correct answer</th>
                                <th scope="col">wrong answer</th>
                                <th scope="col">category</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $question)
                                <tr>
                                    <th scope="row">{{$question->id}}</th>
                                    <th scope="row">{{$question->question}}</th>
                                    <th scope="row">{{$question->correctAnswer}}</th>
                                    <th scope="row">{{$question->wrongAnswer}}</th>
                                    @if($question->category_id != null)
                                  
                                    <th scope="row">{{$question->category->name}}</th>
                                    @else
                                    <th scope="row">-</th>
                                    @endif
                                    <th scope="row">
  
                                        <form method="POST" action="/questions/{{$question->id}}"> 
                                          @csrf
                                          <input type="hidden" name="_method" value="DELETE">
                                          <button style="margin-left:8px;" class="btn btn-danger float-right" type="submit">
                                                  Delete
                                          </button>
  
                                        </form>
  
                                    <a class="btn btn-warning float-right" href="/questions/{{$question->id}}/edit">Edit</a>
  
                                    </th>
                                </tr>
                                @endforeach
                              
                            </tbody>
                    </table>
			</div>
			
			<div class="clear"></div>
			</div>
			
        </div>

		<div class="footer">

			 <p>Glücksrad</p>
 		</div>
		 </div>
</body>
</html>
@endsection
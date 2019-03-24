<!DOCTYPE html>
<html lang="en">
<head>
<title>Words</title>
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
          <h1 class="headAth">Words</h1>
          <a style="margin-bottom:8px; margin-right:8px;" class="btn btn-primary float-right" href="/words/create"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>

                    <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($words as $word)
                              <tr>
                                  <th scope="row">{{$word->id}}</th>
                                  <th scope="row">{{$word->name}}</th>
                                  @if($word->category_id != null)
                                  
                                  <th scope="row">{{$word->category->name}}</th>
                                  @else
                                  <th scope="row">-</th>
                                  @endif
                                     
                                  <th scope="row">

                                      <form method="POST" action="/words/{{$word->id}}"> 
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button style="margin-left:8px;" class="btn btn-danger float-right" type="submit">
                                                Delete
                                        </button>
                                      </form>

                                  <a class="btn btn-warning float-right" href="/words/{{$word->id}}/edit">Edit</a>

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
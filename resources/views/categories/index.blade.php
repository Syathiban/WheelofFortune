<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE html>
<html lang="en">
<head>
<title>Categories</title>
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
                <h1 class="headAth">Categories</h1>
                <a style="margin-bottom:8px; margin-right:8px;" class="btn btn-primary float-right" href="/categories/create"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>

                    <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">category</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{$category->id}}</th>
                                    <th scope="row">{{$category->name}}</th>
                                       
                                    <th scope="row">
  
                                        <form method="POST" action="/categories/{{$category->id}}"> 
                                          @csrf
                                          <input type="hidden" class="float-right" name="_method" value="DELETE">
                                          <button style="margin-left:8px;" class="btn btn-danger float-right" type="submit">
                                                  Delete
                                          </button>
  
                                        </form>
  
                                    <a class="btn btn-warning float-right" href="/categories/{{$category->id}}/edit">Edit</a>
  
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
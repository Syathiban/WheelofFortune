<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
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
		
		<div class="agile_info">
			<div class="w3_info">
				<h2>Create Here</h2>
						<form action="{{ action('QuestionController@store') }}"  method="POST">
                        @csrf
						<div class="left margin">
							<label for="question">Question</label>
							<div class="input-group">
								<span><i class="fa fa-question" aria-hidden="true"></i></span>
								<input type="text" name="question" placeholder="Text" value="{{ old('question') }}" required=""> 
							</div>
						</div>
						<div class="left">
							<label for="answer">Answer</label>
							<div class="input-group">
								<span><i class="fa fa-comment" aria-hidden="true"></i></span>
								<input type="text" name="answer" placeholder="Text" value="{{ old('answer') }}" required=""> 
							</div>
						</div>
						<div class="left">
							<label for="category">Category</label>
							<select name="category" class="dropdown-toggle">
								<option value="" selected="selected">Category</option>
								@foreach ($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
								@endforeach
							</select>
						</div>
						
						<div class="clear"></div>
							<button onclick="myFunction()" class="buttn btn-Danger btn-Block" name="submit" value="submit" type="submit">Create Now <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button >                
					</form>
			</div>
			<div class="w3l_form">
				<div class="left_grid_info">
					<h3>Why Questions?</h3>
					<p> Nam eleifend velit eget dolor vestibulum ornare. Vestibulum est nulla, fermentum eget euismod et, tincidunt at dui. Nulla tellus nisl, semper id justo vel, rutrum finibus risus. Cras vel auctor odio.</p>
				</div>
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
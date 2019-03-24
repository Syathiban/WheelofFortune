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
						<div class="left margin">
							<label for="correctAnswer">correctAnswer</label>
							<div class="input-group">
								<span><i class="fa fa-comment" aria-hidden="true"></i></span>
								<input type="text" name="correctAnswer" placeholder="Text" value="{{ old('correctAnswer') }}" required=""> 
							</div>
						</div>
						<div class="left margin">
							<label for="wrongAnswer">wrongAnswer</label>
							<div class="input-group">
								<span><i class="fa fa-comment" aria-hidden="true"></i></span>
								<input type="text" name="wrongAnswer" placeholder="Text" value="{{ old('wrongAnswer') }}" required=""> 
							</div>
						</div>
						<div class="left margin">
							<label for="category">Category</label>
							<select name="category" style="margin-top: 7px; margin-bottom: 7px;" class="custom-select" required="">
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
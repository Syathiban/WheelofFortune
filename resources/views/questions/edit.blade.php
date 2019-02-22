<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
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
		
		<div class="agile_info">
			<div class="w3_info">
            <form class="form-group" method="POST" action="{{ action('QuestionController@update', $question) }}">
            @method('PUT')
            @csrf
            <label for="question">Word:</label>
            <div class="input-group"> 
            <input  name="question" type="text" value="{{$question->question}}" required=""><br>
            </div>
            <label for="answer">Category:</label>
            <div class="input-group">
            <input class="form-control" name="answer" type="text"value="{{$question->answer}}"><br>
            </div>
            <label for="category">Letters:</label>
            <div class="input-group">
            <input class="form-control" name="category" type="text"value="{{$question->category}}"><br>
            </div>
                <button type="submit" style="align-content: center;" class="buttn btn-Danger btn-Block">Save <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
            </form>
			</div>
			<div class="w3l_form">
				<div class="left_grid_info">
					<h3>Why Words?</h3>
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
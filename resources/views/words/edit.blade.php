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
            <form class="form-group" method="POST" action="{{ action('WordController@update', $word) }}">
            @method('PUT')
            @csrf
            <label for="word">Word:</label>
            <div class="input-group"> 
            <input  name="name" type="text" value="{{$word->name}}" required=""><br>
            </div>
            <label for="category">Category:</label>
            <div class="">
                <select  name="category" style="margin-top: 7px; margin-bottom: 7px;" class="custom-select">
                    <option value="">Category</option>
                    @foreach ($categories as $category)
                    @if($word->category_id != null && $category->id == $word->category->id)

                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else 
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
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
<!DOCTYPE html>
<html lang="en">
<head>
<title>Highscore List</title>
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
            <form class="form-group" method="POST" action="{{action('HighscoreListController@update',  ['id' => $users->id])}}">
            @method('PUT')
            @csrf
            <div class="">
            <label for="name">User:</label>
            <div class="input-group"> 
            <input  name="name" type="text" value="{{$users->name}}" required="" disabled="disabled"><br>
            </div>
            </div>
            <div class=" ">
            <label for="mostMoneyMade">Money per Session:</label>
            <div class="input-group">
            <input class="form-control" style="margin-top: 7px;" name="mostMoneyMade" type="text"value="{{$users->mostMoneyMade}}"><br>
            </div>
            </div>
            <div class="">
            <label for="roundsPlayed">Rounds played:</label>
            <div class="input-group">
            <input class="form-control" name="roundsPlayed" type="text"value="{{$users->roundsPlayed}}"><br>
            </div>
            </div>
            <div class=" ">
            <label for="updated_at">Date:</label>
            <div class="input-group">
            <input class="form-control" name="updated_at" type="text"value="{{$users->updated_at}}"><br>
            </div>
            </div>
            <div class="left margin">
                <button type="submit" style="align-content: center;" class="buttn btn-Danger btn-Block">Save <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
            </div>
            </form>
			</div>
			<div class="w3l_form">
				<div class="left_grid_info">
					<h3>Why Highscores?</h3>
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
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
		<div class="w3_info card">
			<div class="card-body">
          <h1 class="headAth">Highscores</h1>

                    <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Rank</th>
                                <th scope="col">Name</th>
                                <th scope="col">Money per Session</th>
                                <th scope="col">Played Rounds</th>
                                <th scope="col">Date</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $nr =1; ?> 
                              @foreach($users as $user)
                              <tr>
                                  <th scope="row">{{$nr++}}</th>
                                  <th scope="row">{{$user->name}}</th>
                                  <th scope="row">{{$user->mostMoneyMade}}</th>
                                  <th scope="row">{{$user->roundsPlayed}}</th>
                                  <th scope="row">{{$user->updated_at}}</th> 
                                  <th scope="row">

                                     <form action="{{ action('HighscoreListController@store') }}"  method="POST">
                                        @csrf
                                        <input type="hidden" name="mostMoneyMade" placeholder="Text" value="{{ old('mostMoneyMade') }}" required=""> 
                                        <input type="hidden" name="roundsPlayed" placeholder="Text" value="{{ old('roundsPlayed') }}" required=""> 
                                        <button onclick="myFunction()" class="btn btn-danger float-right" name="submit" value="submit" type="submit">Delete</button >
                                      </form>

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
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
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Money per Session</th>
                                <th scope="col">Played Rounds</th>
                                <th scope="col">Date</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($users as $user)
                              <tr>
                                  <th scope="row">{{$user->id}}</th>
                                  <th scope="row">{{$user->name}}</th>
                                  <th scope="row">{{$user->mostMoneyMade}}</th>
                                  <th scope="row">{{$user->roundsPlayed}}</th>
                                  <th scope="row">{{$user->updated_at}}</th> 
                                  <th scope="row">

                                      <form method="POST" action="/highscorelists/{{$user->id}}"> 
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button style="margin-left:8px;" class="btn btn-danger float-right" type="submit">
                                                Delete
                                        </button>
                                      </form>

                                  <a class="btn btn-warning float-right" href="/highscorelists/{{$user->id}}/edit">Edit</a>

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
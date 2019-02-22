
      <!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Game</title>
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
                <h1 class="headAth">Wheel of Fortune</h1>
                    <div class="" id="question"><h1 style="color: black;">?$</h1></div>
                    <div class="col-12 col-md-12" id="chart"></div>
                    </div>
                    <div>
                            <p id="end"></p>

                            <button class="btn btn-outline-primary float-right" onclick="initialize()">Generate word</button> 
                            <p id="word"></p>

                            <button class="btn btn-outline-primary" onclick="guess()">Guess letter or word</button> <p></p>
                            <div class="input-group">
                                <input type="text"  id="guess" placeholder="Your Guess" ></input>
                            </div>
                            <p></p>
                            <p id ="printed_word"></p>

                            <p>Guessed letters:</p>
                            <p id ="printed_guesses"></p>

                            <p>Guesses left:<div id="guesses"></div></p>
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
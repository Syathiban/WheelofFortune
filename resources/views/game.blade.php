
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
<script>
        
        var words = {!!$words!!};
        var questions = {!!$questions!!};
        var answers = {!!$answers!!};
        var randIndex = Math.floor(Math.random() * questions.length);
        var randQuestion = questions[randIndex];
        var randAnswers = answers[randIndex];
        var balance = {!!$balance!!};
        bank = balance;
        question = randQuestion;
        answer = randAnswers;
        console.log(words, questions, answers);
    

    function reset() {
        location.reload();
    }

   
    
</script>
</head>
<body class="bod">
<div class="signupform">
	<div class="container">
		<div class="w3_info card">
			<div class="card-body">
                <h1 class="headAth">Wheel of Fortune</h1>
                    <div class="" id="question"><h1 style="color: black;">?$</h1></div>
                    <div id="answerField" class="form-group">
                        <input type="text"  id="answer" placeholder="Your Answer" ></input>
                        <button  class="btn btn-primary float-right" onclick="checkAnswer()">Answer</button> 
                    </div>
                    <div id="betField" class="form-group">
                            <input type="text"  id="bet" placeholder="Your Bet" ></input>
                            <button  class="btn btn-primary float-right" onclick="bet()">Bet</button> 
                        </div>
                    <div class="container" style="float: right; position: relative; margin-right: 12px;" id="chart"></div>
                    </div>
                    <div>
                            <p id="end"></p>

                            <button style="margin-left:8px;" class="btn btn-primary float-right" onclick="initialize()">Generate word</button> 
                            <p id="word"></p>
                            <button  class="btn btn-warning float-right" onclick="reset()">Reset</button> 
                           
                            <button class="btn btn-primary" onclick="guess()">Guess letter or word</button> <p></p>
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
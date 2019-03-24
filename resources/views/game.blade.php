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
        var rounds = {!!$roundsPlayed!!};
        var balance = {!!$balance!!};
        var moneyMade = {!!$mostMoneyMade!!}
        roundsPlayed = rounds[0];
        highScore = moneyMade[0];
        bank = balance[0];
        console.log(words, bank);
    
</script>
</head>
<body class="bod">
<div class="signupform">
	<div class="container">
		<div class="w3_info card">
			<div class="card-body">
                <h1 class="headAth">Wheel of Fortune</h1>
                    <a id="bank"><h2 style="color: black;"></h2></a>
                    <a id="rounds"><h2 style="color: black;"></h2></a>
                    <a  class="float-right" id="question"><h2 style="color: black;">?$</h2></a>
                    
                    <div id="answerField" class="form-group">
                        <button  id="correct" style="margin-left: 4px;" class="answers btn btn-success float-right"><a id="correctAnswer">Answer</a></button> 
                        <button  id="wrong" class="answers btn btn-success float-right"><a id="wrongAnswer">Answer</a></button> 
                    </div>
                    <div id="betField" class="form-group">
                            <input type="text"  id="bet" placeholder="Your Bet"></input>
                            <button  class="btn btn-primary float-right" onClick="betMoney()">Bet</button> 
                    </div>
                    <div align="center" style="margin-left: 4%;" id="chart"></div>
                    </div>
                    <div>
                            <p id="end"></p>

                            <button style="margin-left:8px;" id="gen" class="btn btn-primary float-right" onClick="reset()">Next Round</button> 
                            <p id="word"></p>
                            <button  class="btn btn-danger float-right" onClick="forfeit()">Forfeit/Stop</button> 
                           
                            <button class="btn btn-primary" id="guessBtn" onClick="guess()">Guess letter or word</button> 
                            <div class="form-group">
                                <input type="text"  id="guess" placeholder="Your Guess" ></input>
                            </div>
                            
                            <p></p>
                            <p id ="printed_word"></p>
                            
                            <button  class="btn btn-warning float-right" id="vowel" onClick="buyVowels()">Buy Vowel</button> 
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
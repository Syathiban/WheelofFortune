$(document).ready(function () {
  $("#answerField").hide();
  $("#betField").hide();
  $("#question").hide();
  $('#guessBtn').attr("disabled", true);
  cashPerLetter = 0;
  vowelBought = false;
  tempBank = bank;
  category = "";
  categories = [];
  cashMade = 0;
  guessedWords = [];
  answeredQuestions = [];
  allWords = [];
  questions = [];
  words = [];
  round = 0;
  setTempBank();
  reset();
});

function forfeit() {
  saveData();
  location.reload();
}

function saveData() {
  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'POST',
    url: '/game/store',
    data: {
      bank: bank,
      highScore: highScore,
      roundsPlayed: roundsPlayed 
}
});
}

function reset() {
  
  disable = false;
  setTempBank();
  d3.select("#rounds h2")
      .text("Round: " + round);
    if (cashMade > highScore) {
        highScore = cashMade;
    } else {
    }
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      url: '/game',
      data: {
        request_item: 'words'
    }, 
    success:function(data){
    bank = data.balance;
    words = data.words;
    category = data.category;
    questions = data.questions;
    correctAnswers = data.correctAnswers;
    wrongAnswers = data.wrongAnswers;
    allWords = data.allWords;
    console.log(guessedWords.length + ' ' + allWords.length )
    if (allWords.length == guessedWords.length) {
      alert('You have played through all words! The game will be restarted.')
      location.reload();
    }
    initialize();
    }
    });

}

function setBalance() {
  d3.select("#bank h2")
      .text("Bank: " + bank + "$");
      //transfer balance to database....
}

function setTempBank() {
  d3.select("#bank h2")
      .text("Bank: " + tempBank + "$");
}

$(".answers").click(function() {
  id = this.id; 
  if (id == 'correct') {
    price = bet;
    d3.select("#question h2")
      .text("You answered correct!");
    disable = true;
  } else {
    price = 0;
    d3.select("#question h2")
      .text("You lost!");
  $('#wrong').css('background-color', 'red');
  }
  setTimeout(function() {
    $('#guessBtn').attr("disabled", false);
    $('answer').val('');
    $("#answerField").hide();
}, 2000);
  
});


function buyVowels() {
  if (bank < 1000) {
    alert("You hella poor dude!");
  } else {
    var receipt = bank - 1000;
    bank = receipt;
    vowelBought = true;
  }
  $('#vowel').attr("disabled", true);
}

function betMoney() {
  var betPlayer = $('#bet').val();
  if (betPlayer == "") {
    alert('Cannot be empty.');
  } else {
    
  var randIndex = Math.floor(Math.random() * questions.length);
  question = questions[randIndex];
  correctAnswer = correctAnswers[randIndex];
  wrongAnswer = wrongAnswers[randIndex];
  console.log(wrongAnswer);
  if (answeredQuestions.includes(question)) {
    betMoney();
  }

  
  if (bank > betPlayer) {
    alert('You hella poor dude!');
    bet = 0;
    d3.select("#question h2")
      .text(question);
    $("#question").show();
    $("#answerField").show();
    $("#betField").hide();
    $('#guessBtn').attr("disabled", false);
  } else {
    bet = betPlayer;
    d3.select("#question h2")
      .text(question);
    $("#question").show();
    $("#answerField").show();
    $("#betField").hide();
    $('#guessBtn').attr("disabled", false);
  }
  answeredQuestions.push(question);
  $('#correctAnswer').text(correctAnswer);
  $('#wrongAnswer').text(wrongAnswer);
}
}

var padding = { top: 20, right: 40, bottom: 0, left: 0 },
  w = 500 - padding.left - padding.right,
  h = 500 - padding.top - padding.bottom,
  r = Math.min(w, h) / 2,
  disable = false;
rotation = 0,
  oldrotation = 0,
  spinned = false;
picked = 10000,
  color = d3.scale.category20c();

var data = [
  { "label": "100", "value": 1 },
  { "label": "200", "value": 1 },
  { "label": "300", "value": 1 },
  { "label": "400", "value": 1 },
  { "label": "500", "value": 1 },
 { "label": "Risk", "value": 1 },
  { "label": "600", "value": 1 },
  { "label": "700", "value": 1 },
  { "label": "800", "value": 1 },
  { "label": "900", "value": 1 },
  { "label": "1000", "value": 1 },
  { "label": "Bankrupt", "value": 1 },
];

var svg = d3.select('#chart')
  .append("svg")
  .data([data])
  .attr("width", w + padding.left + padding.right)
  .attr("height", h + padding.top + padding.bottom);

var container = svg.append("g")
  .attr("class", "chartholder")
  .attr("transform", "translate(" + (w / 2 + padding.left) + "," + (h / 2 + padding.top) + ")");

var vis = container
  .append("g");

var pie = d3.layout.pie().sort(null).value(function (d) { return 1; });

var arc = d3.svg.arc().outerRadius(r);

var arcs = vis.selectAll("g.slice")
  .data(pie)
  .enter()
  .append("g")
  .attr("class", "slice");

arcs.append("path")
  .attr("fill", function (d, i) { return color(i); })
  .attr("d", function (d) { return arc(d); });

arcs.append("text").attr("transform", function (d) {
  d.innerRadius = 0;
  d.outerRadius = r;
  d.angle = (d.startAngle + d.endAngle) / 2;
  return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius - 10) + ")";
})
  .attr("text-anchor", "end")
  .text(function (d, i) {
    return data[i].label;
  });

container.on("click", spin);

function spin(d) {
  
  if (disable == false) {
    $("#bet").val('');
    $('#guess').val('');
    $('#guessBtn').attr("disabled", false);
    $("#question").hide();
    $("#answerField").hide();
    $("#betField").hide();
    spinned = true;

    var ps = 360 / data.length,
      pieslice = Math.round(1440 / data.length),
      rng = Math.floor((Math.random() * 1440) + 360);

    rotation = (Math.round(rng / ps) * ps);
    disable = true;
    picked = Math.round(data.length - (rotation % 360) / ps);
    picked = picked >= data.length ? (picked % data.length) : picked;

    rotation += 90 - Math.round(ps / 2);

    vis.transition()
      .duration(3000)
      .attrTween("transform", rotTween)
      .each("end", function () {
        switch (data[picked].label) {
          case "Bankrupt":
            d3.select("#question h2")
              .text("Ah unlucky mate! Site will be refreshed");
            bank = 0;
            oldrotation = rotation;
            roundsPlayed = roundsPlayed + 1;
            saveData();
            location.reload();
            break;
          case "Risk":
          if(answeredQuestions.length == questions.length) {
            alert('You played through all Questions! Game will be restarted.');
            location.reload();
          }
            d3.select("#question h2")
              .text("State your bet!");
            oldrotation = rotation;
            $('#guessBtn').attr("disabled", true);
            $("#betField").show();
            break;
          default:
            $("#question").show();
            d3.select("#question h2")
              .text(data[picked].label + "$");
            price = data[picked].label;
            oldrotation = rotation;
            $('#guessBtn').attr("disabled", false);
        }
      });
  }
  $('#vowel').attr("disabled", false);
  vowelBought = false;
}

svg.append("g")
  .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h / 2) + padding.top) + ")")
  .append("path")
  .attr("d", "M-" + (r * .15) + ",0L0," + (r * .05) + "L0,-" + (r * .05) + "Z")
  .style({ "fill": "black" });

container.append("circle")
  .attr("cx", 0)
  .attr("cy", 0)
  .attr("r", 10)
  .style({ "fill": "white", "cursor": "pointer" });

function rotTween(to) {
  var i = d3.interpolate(oldrotation % 360, rotation);
  return function (t) {
    return "rotate(" + i(t) + ")";
  };
}

function getRandomNumbers() {
  var array = new Uint16Array(1000);
  var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);

  if (window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function") {
    window.crypto.getRandomValues(array);
    console.log("works");
  } else {
    for (var i = 0; i < 1000; i++) {
      array[i] = Math.floor(Math.random() * 100000) + 1;
    }
  }
  return array;
}

var letters_guessed = [];
var guesses = 3;
var word = "";

function print_word() {
  var printed_word = ""
  for (var i = 0; i < word.length; i++) {
    if (word[i] == "-") {
      printed_word = printed_word.concat("- ");
    }
    var success = 0;
    for (var l = 0; l < letters_guessed.length; l++) {
      if (word[i] == letters_guessed[l]) {
        success = 1;
        printed_word = printed_word.concat(letters_guessed[l]);
        printed_word = printed_word.concat(" ");
      }
    }
    if (success == 0) {
      printed_word = printed_word.concat("_ ");
    }
  }
  document.getElementById("printed_word").innerHTML = printed_word
  guessedWords.push(word);
}

function print_guesses() {
  var print = []
  var item = ""
  for (var i = 0; i < letters_guessed.length; i++) {
    item = (" ".concat(letters_guessed[i]));
    print.push(item)
  }
  if (print != "") {
    $('#guessBtn').attr("disabled", true);
  }
  document.getElementById("printed_guesses").innerHTML = print;
}

function initialize() {
    
    var rand = words[Math.floor(Math.random() * words.length)];
    word = rand;
    
    $('#gen').attr("disabled", true);
      console.log(word);
    if (guessedWords.includes(word)) {
      reset();
    }else{

    
    
    guesses = 3;
    letters_guessed = [];
    document.getElementById("end").innerHTML = "";
    document.getElementById("word").innerHTML = "";
    document.getElementById("guesses").innerHTML = guesses;
    print_word();
    print_guesses();
  }
}

function guess() {
  var guess = document.getElementById("guess").value;
  document.getElementById("guess").value = "";

    if (spinned == true) {
      $('#guessBtn').attr("disabled", true);
      disable = false;
      if (word.length <= 1) {
        return;
      }
      if (guess.length != 1 && guess.length != word.length) {
        return;
      }
      if (guess == word) {
        //this has to be saved in the database
        alert('You won!' + " The word was: " + word);
        disable = true;
        round = round + 1;
        roundsPlayed = roundsPlayed + 1; 
        console.log(bank);
        cashMade = (word.length * price) + cashMade;
        if (bank == 0) {
          bank = (word.length * price);
        } else {
          bank = (word.length * price) + parseInt(bank);
        }
        
        setBalance();
        saveData();
        $('#gen').attr("disabled", false);
        return;
      }
      if (guess == "a" && vowelBought == false || guess == "e" && vowelBought == false || guess == "i" && vowelBought == false || guess == "o" && vowelBought == false || guess == "ä" && vowelBought == false || guess == "ö" || guess == "ü" && vowelBought == false) {
        console.log("You didn't buy a Vowel");
      } else {
        var regex = new RegExp(guess, 'gi');
        let results = [];
        while (regex.exec(word)) {
          results.push(regex.lastIndex);
        }
        cash = (results.length * price) + cashPerLetter;
        cashPerLetter = cash;
        tempBank = (results.length * price) + tempBank;
        console.log(cash);
        setTempBank();
        saveData();
        for (var x = 0; x < letters_guessed.length; x++) {
          if (guess == letters_guessed[x]) {
            return;
          }
        }
        var success = "false";
        for (var i = 0; i < word.length; i++) {
          if (word[i] == guess) {
            success = "true";
          }
        }
        if (success == "false") {
          guesses -= 1;
        }
        if (guess.length == 1) {
          letters_guessed.push(guess);
        }
        document.getElementById("guesses").innerHTML = guesses;
        print_word();
        print_guesses();
        var correct = 0;
        for (i = 0; i < word.length; i++) {
          for (x = 0; x < letters_guessed.length; x++) {
            if (word[i] == letters_guessed[x]) {
              correct++;
            }
          }
        }
        if (correct == word.length) {
          document.getElementById("end").innerHTML = "You won!";
          disable = true; 
          round = round + 1;
          //this has to be saved in the database
          alert('You won!' + " The word was: " + word);
          roundsPlayed = roundsPlayed + 1; 
          saveData();
          console.log(bank);
          cashMade = (word.length * price) + cashMade;
          if (bank == 0) {
            bank = (word.length * price);
          } else {
            bank = (word.length * price) + parseInt(bank);
          }
         // bank = (word.length * price) + bank;
          setBalance();
          $('#gen').attr("disabled", false);
          disable = false;
          return;
        }
        if (guesses <= 0) {
          document.getElementById("end").innerHTML = "You lost!";
          document.getElementById("word").innerHTML = word;
          disable = false;
        }
      }
    }
}


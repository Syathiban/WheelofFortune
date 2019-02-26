var padding = {top:20, right:40, bottom:0, left:0},
            w = 500 - padding.left - padding.right,
            h = 500 - padding.top  - padding.bottom,
            r = Math.min(w, h)/2,
            rotation = 0,
            oldrotation = 0,
            picked = 10000,
            color = d3.scale.category20c();

 

        var data = [
                    {"label":"100",  "value":1}, 
                    {"label":"200",  "value":1}, 
                    {"label":"300",  "value":1}, 
                    {"label":"400",  "value":1}, 
                    {"label":"500",  "value":1}, 
                    {"label":"600",  "value":1}, 
                    {"label":"700",  "value":1}, 
                    {"label":"800",  "value":1}, 
                    {"label":"900",  "value":1}, 
                    {"label":"1000", "value":1}, 

        ];


        var svg = d3.select('#chart')
            .append("svg")
            .data([data])
            .attr("width",  w + padding.left + padding.right)
            .attr("height", h + padding.top + padding.bottom);

        var container = svg.append("g")
            .attr("class", "chartholder")
            .attr("transform", "translate(" + (w/2 + padding.left) + "," + (h/2 + padding.top) + ")");

        var vis = container
            .append("g");
            
        var pie = d3.layout.pie().sort(null).value(function(d){return 1;});

       
        var arc = d3.svg.arc().outerRadius(r);

        
        var arcs = vis.selectAll("g.slice")
            .data(pie)
            .enter()
            .append("g")
            .attr("class", "slice");
            

        arcs.append("path")
            .attr("fill", function(d, i){ return color(i); })
            .attr("d", function (d) { return arc(d); });

       
        arcs.append("text").attr("transform", function(d){
                d.innerRadius = 0;
                d.outerRadius = r;
                d.angle = (d.startAngle + d.endAngle)/2;
                return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";
            })
            .attr("text-anchor", "end")
            .text( function(d, i) {
                return data[i].label;
            });

        container.on("click", spin);


        function spin(d){


            var  ps       = 360/data.length,
                 pieslice = Math.round(1440/data.length),
                 rng      = Math.floor((Math.random() * 1440) + 360);
                
            rotation = (Math.round(rng / ps) * ps);
            
            picked = Math.round(data.length - (rotation % 360)/ps);
            picked = picked >= data.length ? (picked % data.length) : picked;




            rotation += 90 - Math.round(ps/2);

            vis.transition()
                .duration(3000)
                .attrTween("transform", rotTween)
                .each("end", function(){

                   
                    d3.select("#question h1")
                        .text(data[picked].label + "$");

                    oldrotation = rotation;
                });
        }

        
        svg.append("g")
            .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")
            .append("path")
            .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")
            .style({"fill":"black"});

        
        container.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", 10)
            .style({"fill":"white","cursor":"pointer"});

        
        function rotTween(to) {
          var i = d3.interpolate(oldrotation % 360, rotation);
          return function(t) {
            return "rotate(" + i(t) + ")";
          };
        }
        
        
        function getRandomNumbers(){
            var array = new Uint16Array(1000);
            var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);

            if(window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function"){
                window.crypto.getRandomValues(array);
                console.log("works");
            } else {
                for(var i=0; i < 1000; i++){
                    array[i] = Math.floor(Math.random() * 100000) + 1;
                }
            }

            return array;
        }

        var words2 = ["potato", "specific", "tomorrow", "blank", "error", "whale", "wail", "weight", "legendary", "kingdom", "dumb", "hung", "trial", "smile", "fried", "keyboard", "crises", "people", "obscure", "esoteric", "variance", "stop", "strife", "technology", "things", "words", "meta", "melancholy", "building", "garden", "biology", "religion", "musket", "tyranny", "tilting", "photography", "bullet", "insanity", "magnanimous", "rectangle", "renown", "disintrest", "literal", "joking", "seeded", "puppeteer", "clarity", "warrior", "guardian", "traitor", "shield", "children", "strange", "pocket", "regal", "bullying", "trait", "sacred", "cracked", "lost", "friendship", "wheat", "jump", "crypt", "memento", "rogue", "zeal", "galaxy", "injury", "looking", "crabs", "credible"]; 
        

var letters_guessed = [];
var guesses = 7;
var word = "";

function print_word()  { 
  var printed_word = ""
  for (var i = 0; i < word.length; i++) { 
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
}

function print_guesses() {
  var print = []
  var item = ""
  for (var i = 0; i<letters_guessed.length; i++) { 
    item = (" ".concat(letters_guessed[i])); 
    print.push(item)
  }
  document.getElementById("printed_guesses").innerHTML = print; 
}

function initialize(words) {
  var rand = words[Math.floor(Math.random() * words.length)]; 
  word = rand;
  guesses = 7;
  letters_guessed = [];
  document.getElementById("end").innerHTML = "";
  document.getElementById("word").innerHTML = "";
  document.getElementById("guesses").innerHTML = guesses;
  
  print_word();
  print_guesses();
}

function guess() {
  if (word.length <= 1) { 
    return;
  }
  var guess = document.getElementById("guess").value; 
  document.getElementById("guess").value = ""; 
  if (guess.length != 1 && guess.length != word.length) { 
    return;
  }
  if (guess == word) { 
    alert('You won!' + " The word was: " + word);
    return;
  }
  for (var x = 0; x < letters_guessed.length; x++) { 
    if (guess == letters_guessed[x]) {
      return;
    }
  }
  var success = "false";
  for (var i = 0; i<word.length; i++) { 
    if (word[i] == guess) { 
      success = "true";
    }
  } 
  if (success == "false") { 
    guesses -= 1;
  }
  if (guess.length == 1)  {
    letters_guessed.push(guess);
  }
  document.getElementById("guesses").innerHTML = guesses; 
  print_word();
  print_guesses();
  var correct = 0;
  for (i = 0; i<word.length; i++) { 
    for (x = 0; x<letters_guessed.length; x++) { 
      if (word[i] == letters_guessed[x]) { 
        correct ++;
      }
    }
  }
  if (correct == word.length) { 
    document.getElementById("end").innerHTML = "You won!";
    document.getElementById("word").innerHTML = word;
    return;
  }
  if (guesses <= 0) { 
    document.getElementById("end").innerHTML = "You lost!";
    document.getElementById("word").innerHTML = word;
  }
}


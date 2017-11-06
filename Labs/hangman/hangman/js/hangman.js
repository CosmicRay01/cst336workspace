var selectedWord = "";
var selectedHint = "";
var board = "";
var remainingGuesses = 6;
var words = ["eel", "jellyfish", "whale", "octopus", "shark"];
var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                            
var randomInt = Math.floor(Math.random()* words.length);
selectedWord = words[randomInt];


function initBoard() {
    for (var letter in selectedWord) {
        board += "_";
    }
}


initBoard();
for (var letter of Board) {
    document.gtElementById("word").innerHTML += letter + " ";
}

function startGame() {
    pickWord();
    initBoard();
    updateBoard();
    createLetters();
}

$("#letterBtn").click( function(){ 
               // updateImage();
               
               var boxVal = $("#letterBox").val();
               alert(boxVal);
               
            } );
            
    
            function updateImage() {
                
                //document.getElementById("man").innerHTML = "<img src='img/stick_5.png' >";
                $("img").attr("src","img/stick_3.png");
            }
            
            function updateMan(){
                $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
            }

            
            startGame();
            
            function pickWord() {
                var randomInt = Math.floor( Math.random() * words.length );
                selectedWord = words[randomInt].toUpperCase();
                //console.log(selectedWord);
            }
            
            function updateBoard() {
                $("#word").empty();
                for (var letter of board) {
                    document.getElementById("word").innerHTML += letter + " ";
                }
            }
            
            function createLetters(){
                
                for (var letter of alphabet) {
                    
                    $("#letters").append("<button class='letter' id='"+letter+"'>" + letter + "</button>");
                }
                
            }
            
            
            function checkLetter(letter) {
                
                var positions = [];
                
                for (var i=0; i < selectedWord; i++) {
                    
                    if (letter == selectedWord[i]) {
                        
                        positions.push(i);
                        
                    }
                    
                }
                
                if (positions.length > 0) {
                    
                    updateWord(positions, letter);
                    if(!board.includes('_')){
                        endGame(true);
                    }
                    
                } else {
                    
                    remainingGuesses--;
                    updateMan();
                    //$("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png" );
                }
                
                if(remainingGuesses <= 0) {
                    endGame(false);
                }
                
                
            }
            
            function updateWord(positions, letter){
                for (var pos of positions) {
                    board = replaceAt(board, pos, letter);
                }
                updateBoard();
            }
            
            function replaceAt(str, index, value) {
                return str.substr(0, index) + value + str.substr(index, value.length);
            }
            
            function endGame(win){
                $("letters").hide();
                if(win){
                    $('#won').show();
                }
                else{
                    $('#lost').show();
                }
            }
            
            //events
            
            $("button").click( function(){ 
                //alert($(this).attr("id"));
                checkLetter( $(this).attr("id") );
                
            });
            
            $(".replayBtn").on("click", function(){
                location.reload();
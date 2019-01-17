<template>
    <div>
        <div class="dice">
            <img src="dice-2.png" alt="Dice" id="rollDice1" hidden="hidden">
            <img src="dice-2.png" alt="Dice" id="rollDice2" hidden="hidden">
        </div>
        <div class="left-side active" id="leftSide">
            <div class="player" id="player0">Player 0</div>
            <div class="score" id="score0">0</div>
            <div class="current">
                <div class="current-title">Current</div>
                <div class="current-score" id="current0">0</div>
            </div>
        </div>
        <div class="right-side" id="rightSide">
            <div class="player" id="player1">Player 1</div>
            <div class="score" id="score1">0</div>
            <div class="current">
                <div class="current-title">Current</div>
                <div class="current-score" id="current1">0</div>
            </div>
        </div>
        <button class="new" id="newGame" @click="newGame"><i class="ion-ios-plus-outline"></i>New game</button>
        <button class="roll" @click="rollDice"><i class="ion-ios-loop"></i>Roll dice</button>
        <button class="hold" @click="hold"><i class="ion-ios-download-outline"></i>Hold</button>
        <input type="text" placeholder="Score" class="score-box" id="score">
    </div>
</template>

<script>
export default {
    data() {
        return {
            player: 0,
            score: 0,
            oneDice: false,
            twoDice: false,
            numberOfSixes : 0
        }
    },
    methods: {
         newGame() {
            this.player = 0;
            document.getElementById("rollDice1").setAttribute("hidden", "hidden");
            document.getElementById("rollDice2").setAttribute("hidden", "hidden");
            this.score = document.getElementById("score").value;
            document.getElementById("current0").innerHTML = 0;    
            document.getElementById("current1").innerHTML = 0;    
            document.getElementById("score0").innerHTML = 0;    
            document.getElementById("score1").innerHTML = 0;    
            if(!parseInt(this.score)) {
                this.score = 100;
            }
            var person = prompt("Play with one dice or two?", "1");

            if (person == 1 || person == "") {
                this.oneDice = true;
                this.twoDice = false;
            } else {
                this.oneDice = false;
                this.twoDice = true;
            }
        },
        rollDice() {
            if(this.score) {
                if (document.getElementById("rollDice1").hasAttribute("hidden")) {
                    document.getElementById("rollDice1").removeAttribute("hidden");
                    if(this.twoDice) {
                        document.getElementById("rollDice2").removeAttribute("hidden");
                    }
                }
                var randomDice1 = eval((Math.floor(Math.random() * 6)) + 1);
                var randomDice2 = "";
                imageLocation = "dice-"+ randomDice1 +".png";
                document.getElementById("rollDice1").src = imageLocation;
                
                if(this.twoDice) {
                    randomDice2 = eval((Math.floor(Math.random() * 6)) + 1);
                    var imageLocation = "dice-"+ randomDice2 +".png";
                    document.getElementById("rollDice2").src = imageLocation;
                }
                this.updateCurrentScore(randomDice1, randomDice2);
            } else {
                alert("please set new game");
            }
        },
        updateCurrentScore(diceNumber1, diceNumber2) {
            var once = false;
            if(diceNumber1 == 6 || diceNumber2 == 6) {
                this.numberOfSixes++;
                if(this.numberOfSixes == 2) {
                    document.getElementById("current" + this.player).innerHTML = 0;    
                    document.getElementById("score" + this.player).innerHTML = 0;    
                    this.changePlayer();
                    once = true;
                }
            } else {
                this.numberOfSixes = 0;
            }

            if(!once) {
                if (parseInt(diceNumber1) == 1 || parseInt(diceNumber2) == 1) {
                    document.getElementById("current" + this.player).innerHTML = 0;    
                    this.changePlayer();
                } else {
                    document.getElementById("current" + this.player).innerHTML = parseInt(document.getElementById("current" + this.player).innerHTML) + parseInt(diceNumber1);
                    if(this.twoDice) {
                        document.getElementById("current" + this.player).innerHTML = parseInt(document.getElementById("current" + this.player).innerHTML) + parseInt(diceNumber2);
                    }
                }
            }
        },
        hold() {
            document.getElementById("score" + this.player).innerHTML = 
                parseInt(document.getElementById("score" + this.player).innerHTML) + 
                parseInt(document.getElementById("current" + this.player).innerHTML);
            var newScore = document.getElementById("score" + this.player).innerHTML;
            document.getElementById("current" + this.player).innerHTML = 0;    
            if (parseInt(newScore) >= parseInt(this.score)) {
                alert("player " + this.player + " win :)")
            }
            this.changePlayer();
        },
        changeBackground() {
            if (this.player == 0 ) {
                document.getElementById("leftSide").classList.add("active");
                document.getElementById("rightSide").classList.remove("active");
            } else {
                document.getElementById("rightSide").classList.add("active");
                document.getElementById("leftSide").classList.remove("active");
            }
        },
        changePlayer() {
            this.numberOfSixes = 0;
            if (this.player == 0) {
                this.player = 1;
            } else {
                this.player = 0;
            }
            this.changeBackground();
        }
    }
}
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-image: url('../static/back.jpg');
    background-size: cover;
    background-position: center;
    font-family: Lato;
    font-weight: 300;
    height: 100vh;
    color: #555;
}

button {
    position: absolute;
    width: 200px;
    left: 50%;
    transform: translateX(-50%);
    color: #555;
    background: none;
    border: none;
    font-family: Lato;
    font-size: 20px;
    text-transform: uppercase;
    cursor: pointer;
    font-weight: 300;
}

i {
    color: #EB4D4D;
    display: inline-block;
    margin-right: 15px;
    font-size: 32px;
    line-height: 1;
    vertical-align: text-top;
    margin-top: -4px;
    transition: margin 0.3s;
}

.container {
    width: 1000px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
    overflow: hidden;
}

.bordered {
    border: black;
    border-style: solid;
}

.left-side,
.right-side {
    width: 50%;
    float: left;
    height: 600px;
    padding: 100px;
}


.player {
    font-size: 40px;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 100;
    margin-top: 20px;
    margin-bottom: 10px;
    position: relative;
}

.score {
    text-align: center;
    font-size: 80px;
    font-weight: 100;
    color: #EB4D4D;
    margin-bottom: 130px;
}

.active { background-color: #f7f7f7; }
.active .player { font-weight: 300; }

.active .player::after {
    content: "\2022";
    font-size: 47px;
    position: absolute;
    color: #EB4D4D;
    top: -7px;
    right: 10px;
    
}

.current {
    background-color: #EB4D4D;
    color: #fff;
    width: 40%;
    margin: 0 auto;
    padding: 12px;
    text-align: center;
}

.current-title {
    text-transform: uppercase;
    margin-bottom: 10px;
    font-size: 12px;
    color: #222;
}

.current-score {
    font-size: 30px;
}

.dice{
    position: absolute;
    width: 100px;
    top: 25%;
    left: 50%;
    transform: translateX(-50%);
    color: #555;
    background: none;
    border: none;
    font-family: Lato;
    font-size: 20px;
    text-transform: uppercase;
    cursor: pointer;
    font-weight: 300;
    height: 100px;
}

.dice img {
    height: 100px;
}

.score-box {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    top: 520px;
    color: #555;
    font-size: 13px;
    text-align: center;
    padding: 8px;
    width: 100px;
    text-transform: uppercase;
    border-radius: 10%;
}

.score-box:focus { outline: none; }
.new { top: 45px;}
.roll { top: 403px;}
.hold { top: 467px;}

</style>

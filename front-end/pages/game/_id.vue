<template>
    <div>
        <v-container>
            <div class="dice">
                <img src="dice-2.png" alt="Dice" id="rollDice1" hidden="hidden">
                <img src="dice-2.png" alt="Dice" id="rollDice2" hidden="hidden">
            </div>
            <div class="left-side active" id="leftSide">
                <div class="player" id="player0">Player 0</div>
                <div class="score" id="score0">{{ user1_score }}</div>
                <div class="current">
                    <div class="current-title">Current</div>
                    <div class="current-score" id="current0">{{ user1_current_score }}</div>
                </div>
            </div>
            <div class="right-side" id="rightSide">
                <div class="player" id="player1">Player 1</div>
                <div class="score" id="score1">{{ user2_score }}</div>
                <div class="current">
                    <div class="current-title">Current</div>
                    <div class="current-score" id="current1">{{ user2_current_score }}</div>
                </div>
            </div>
            <button class="new" id="newGame" @click="newGame"><i class="ion-ios-plus-outline"></i>New game</button>
            <button class="roll" @click="rollDice"><i class="ion-ios-loop"></i>Roll dice</button>
            <button class="hold" @click="hold"><i class="ion-ios-download-outline"></i>Hold</button>
            <input type="text" placeholder="Score" class="score-box" id="score">
        </v-container>
    
        <v-comment>
            <div>
                <form>
                    <v-textarea
                    v-model="newComment"
                    :counter="10"
                    label="Write Your Comment"
                    data-vv-name="newComment"
                    required
                    ></v-textarea>
                    <v-btn @click="submit">Send</v-btn>
                    <v-btn @click="close">Close</v-btn>
                    <!-- <v-btn @click="clear">clear</v-btn> -->
                </form>


                <div v-for="comment in game.comments" style="margin: 10px">
                    <v-card
                        class="mx-auto"
                        color="#26c6da"
                        dark
                    >
                        <v-card-text class="headline font-weight-bold">
                        {{ comment.text}}
                        </v-card-text>

                        <v-card-actions>
                        <v-list-tile class="grow">
                            <v-list-tile-avatar color="grey darken-3">
                            <v-img
                                class="elevation-6"
                                src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                            ></v-img>
                            </v-list-tile-avatar>

                            <v-list-tile-content>
                            <v-list-tile-title>{{ comment.user.name }}</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        </v-card-actions>
                    </v-card>
                </div>
            </div>
        </v-comment>
    </div>
    
</template>


<script>
import Comment from '~/components/Comment.vue'
export default {
    async asyncData ({ app,store, params }) {
        let id = params.id.split("-")[0]
        let user = params.id.split("-")[1]        
        let game = (await app.$axios.get(`http://localhost:8000/api/game/${id}`)).data.result
        
        return {id, user, game}
    },
    data() {
        return {
            id: 0,
            user: 0,
            player: 0,
            score: 0,
            oneDice: false,
            twoDice: false,
            numberOfSixes : 0,
            newComment: '',
            game: {},
            stockData: null,
            user1_current_score: 0,
            user2_current_score: 0,
            user1_score: 0,
            user2_score: 0,
            
        }
    },
    components: {
        'v-comment': Comment
    },

    methods: {
         newGame() {
            this.player = 0;
            document.getElementById("rollDice1").setAttribute("hidden", "hidden");
            document.getElementById("rollDice2").setAttribute("hidden", "hidden");
            this.score = document.getElementById("score").value;
            this.user1_current_score = 0;    
            this.user2_current_score = 0;    
            this.user1_score = 0;    
            this.user2_score = 0;    
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
                var randomDice2 = 0;
                imageLocation = "/dice-"+ randomDice1 +".png";
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
                    if(this.player == 0) {
                        this.user1_current_score = 0
                        this.user1_score = 0
                    } else if(this.player == 1) {
                        this.user2_current_score = 0
                        this.user2_score = 0
                    }
                    this.changePlayer();
                    once = true;
                }
            } else {
                this.numberOfSixes = 0;
            }

            if(!once) {
                if (parseInt(diceNumber1) == 1 || parseInt(diceNumber2) == 1) {
                    if(this.player == 0) {
                        this.user1_current_score = 0
                    } else if(this.player == 1) {
                        this.user2_current_score = 0
                    }
                } else {
                    if(this.player == 0) {
                        this.user1_current_score = this.user1_current_score + diceNumber1
                    } else if(this.player == 1) {
                        this.user2_current_score = this.user2_current_score + diceNumber1
                    }                
                    if(this.twoDice) {
                        if(this.player == 0) {
                            this.user1_current_score = this.user1_current_score + diceNumber2
                        } else if(this.player == 1) {
                            this.user2_current_score = this.user2_current_score + diceNumber2
                        }
                    }
                }
            }
        },
        hold() {
            var newScore = 0
            if(this.player == 0) {
                this.user1_score = this.user1_score + this.user1_current_score
                newScore = this.user1_score
                this.user1_current_score = 0
            } else if(this.player == 1) {
                this.user2_score = this.user2_score + this.user2_current_score
                newScore = this.user2_score
                this.user2_current_score = 0
            }
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
            this.$axios.post(
                `http://localhost:8000/api/gamestatus/${this.id}`, {
                    turn: this.player, 
                    user1_current_score: this.user1_current_score,
                    user2_current_score: this.user1_current_score,
                    user1_score: this.user1_score,
                    user2_score: this.user2_score,
                }
            )

        },
        submit () {
            this.$axios.post(
                `http://localhost:8000/api/game/${this.id}/comment`, 
                {text: this.newComment, user: this.user}
            )
        },
        close () {
            document.getElementById("popup1").setAttribute("hidden", "hidden");
            this.newComment = ''
        },
        setupStream() {
            // Not a real URL, just using for demo purposes
            let es = new EventSource(`http://localhost:8000/api/gamestatus/${this.id}`);

            es.addEventListener('message', event => {
                // console.log("message")
                let data = JSON.parse(event.data);
                console.log(data)
                this.stockData = data.stockData;
            }, false);

            es.addEventListener('error', event => {
                if (event.readyState == EventSource.CLOSED) {
                    console.log('Event was closed');
                    console.log(EventSource);
                }
            }, false);
        }

    },
    created() {
        this.setupStream();
    },
}
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    /* background-image: url('../static/back.jpg'); */
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

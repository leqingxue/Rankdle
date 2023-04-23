<?php
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.centered{
	margin-left: auto; 
	margin-right: auto;
}
.centered-text{
	margin-left: auto; 
	margin-right: auto;
	width: fit-content;
}
.score-container{
	height: 3vw;
	margin: auto;
	max-height: 40px;
	max-width: 1700px;
	min-height: 20px;
	width: fit-content; 
	margin-top: 20px; 
	margin-bottom: 20px;
}
.score-star{
	color: gold; 
	height: 100%;
	margin: 0 clamp(10px,4vw,20px);
	width: auto; 
}
.val-ranks{
	width: fit-content;
	margin: auto; 
	transform: translateX(3.5em);
}
.rank-div{
	display: inline-block;
	cursor: pointer;
	height: 5em; 
	width: 5em;
	transition: all .3s; 
}
.rank-image{
	width:95%;
	max-width: 256px;
}
.selected-rank{
	background: radial-gradient(circle,#af9d67 10%,#af9d67 0,hsla(0,0%,100%,0) 75%);
	height: 7em !important;
	width: 7em !important;
}
.submit-rank{
	align-content: center;
    align-items: center;
    background-color: #455A64;
    border: 1px solid #9E9E9E;
    border-radius: min(1vw, .5rem);
    color: #FFFFFF;
    display: flex;
    flex-direction: row;
    font-family: Freeroad;
    font-size: clamp(.6rem,3vw,1.6rem);
    font-weight: 400;
    height: clamp(25px,7vw,50px);
    justify-content: center;
    margin: initial;
    outline: none;
    width: clamp(75px,18vw,180px);
	cursor: pointer;
}
.submit-rank:hover {
  color: rgba(255, 255, 255, 1);
  box-shadow: 0 0 20px 1px #FFFFFF;
}
.button-holder{
	width:fit-content;
	margin:auto;
}
.results-menu{
	height: max(400px, 20vw);
	width: max(400px, 20vw);
	background-color: #212121; 
	position:absolute;
	top: 10vw; 
	left: 40vw;
	box-shadow: 0 0 16px 3px #FFFFFF;
}
.alignleft {
	float: left;
	margin-left: max(5vw, 50px); 
}
.alignright {
	float: right;
	margin-right: max(5vw, 50px);
}
body{
	background-color: #212121;
}
</style>
</head>
<body>
<div id="title">
	<H1 class="centered-text" style="color:white;">RANKDLE</H1>
</div>
<div id="score" class="score-container">
	<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="score-star" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path></svg>
	<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="score-star" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path></svg>
	<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="score-star" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path></svg>
	<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="score-star" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path></svg>
	<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="score-star" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path></svg>
	<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="score-star" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path></svg>
</div>
<div id="video">
	<div id="video-wrapper" style="width:73.375em; height:41.25em;" class="centered">
		<iframe id="video-video" class="centered" style="width:73.375em; height:41.25em;" src="https://www.youtube.com/embed/-oEl5ItH3lI" title="Can you guess the rank? Valorant Rankdle #101.2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
	</div>
</div>
<div>
	<H1 id="clip_number" class="centered-text" style="color:white;">Clip 1</H1>
</div>
<div class="ranks val-ranks">
	<div id="iron-select" class="rank-div"><img src="images/Iron.png" class="rank-image"></div>
	<div id="bronze-select" class="rank-div"><img src="images/Bronze.png" class="rank-image"></div>
	<div id="silver-select" class="rank-div"><img src="images/Silver.png" class="rank-image"></div>
	<div id="gold-select" class="rank-div"><img src="images/Gold.png" class="rank-image"></div>
	<div id="platinum-select" class="rank-div"><img src="images/Platinum.png" class="rank-image"></div>
	<div id="diamond-select" class="rank-div"><img src="images/Diamond.png" class="rank-image"></div>
	<div id="ascendant-select" class="rank-div"><img src="images/Ascendant.png" class="rank-image"></div>
	<div id="immortal-select" class="rank-div"><img src="images/Immortal.png" class="rank-image"></div>
	<div id="radiant-select" class="rank-div"><img src="images/Radiant.png" class="rank-image"></div>
	<div id="empty-select" class="rank-div" style="height:7em; width:7em; cursor: auto;"><img src="images/Empty.png" class="rank-image"></div>
</div>
<br>
<br>
<div>
	<div id="buttons-holder" class="button-holder">
		<button id="prev_button" type="button" class="submit-rank" onclick="previous()" style="display:none;">Prev Clip</button>
		<button id="sub_button" type="button" class="submit-rank" onclick="submit()" style="display:inline-block;">Submit</button>
		<button id="clip_result_button" type="button" class="submit-rank" onclick="show_clip_result()" style="display:none;">Clip Result</button>
		<button id="next_button" type="button" class="submit-rank" onclick="next()" style="display:none;">Next Clip</button>
		<button id="final_button" type="button" class="submit-rank" onclick="openFinal()" style="display:none;">View Results</button>		
	</div>
</div>
<div id="results_menu" class="results-menu" style="display:none;">
	<H1 style="color:white; text-align: center;">Clip Result</H1>
	<div>
		<p class="alignleft" style="color:white; text-align:left;">Correct Rank</p>
		<p class="alignright" style="color:white; text-align:right;">Your Guess</p>
	</div>
	<div style="clear: both;"></div>
	<div>
		<div id="correct-select" class="rank-div alignleft"><img id="correct-select-img" src="images/Iron.png" class="rank-image"></div>
		<div id="your-guess-select" class="rank-div alignright"><img id="your-guess-select-img" src="images/Bronze.png" class="rank-image"></div>
	</div>
	<div style="clear: both;"></div>
	<p style="color:white; text-align:center;">Stars Earned</p>
	<div id="stars_earned" class="score-container">
	<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="score-star" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path></svg>
	<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="score-star" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path></svg>
	</div>
	<button id="next_clip_button" type="button" class="submit-rank" style="margin:auto;" onclick="nextClip()">Next Clip</button>
	<button id="close_button" type="button" class="submit-rank" style="margin:auto; display:none;" onclick="exit()">Close</button>
	<p id="tracker" style="color:white; text-align:center;">Tracker:</p>
</div>
<div id="final_results_menu" class="results-menu" style="display:none;">
	<H1 style="color:white; text-align: center;">Rankdle History Stats</H1>
	<p id="star_history" style="color:white;margin-left:20px">1 stars: 
	<br> 2 stars:
	<br> 3 stars:
	<br> 4 stars:
	<br> 5 stars:
	<br> 6 stars:
	</p>
	<button id="close_button_2" type="button" class="submit-rank" style="margin:auto; display:block;" onclick="exit2()">Close</button>
	<div>
        <div id="countdown" style="transform:translateX(45%); margin-top:20px;">
            <span id="hours" style="color:white;">00:</span>
            <span id="minutes" style="color:white;">00:</span>
            <span id="seconds" style="color:white;">00</span>
        </div>
    </div>
</div>
<button onclick="panic()" style="position:absolute;top:20px; left:20px;">IF BROKEN CLICK THIS</button>
<br>
<br>
<script>
// 9 means has not guessed 
var daily_code = "banana";
var previous_guess = [9,9,9];
var filled_star = '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="score-star" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path></svg>';
var empty_star = '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="score-star" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path></svg>';
var ranks_array = ["images/Iron.png","images/Bronze.png","images/Silver.png","images/Gold.png","images/Platinum.png","images/Diamond.png","images/Ascendant.png","images/Immortal.png","images/Radiant.png"];
//val ranks handle
var videos = ["https://www.youtube.com/embed/-oEl5ItH3lI","https://www.youtube.com/embed/UIwhQ6PC2sc","https://www.youtube.com/embed/Uv3iNQ9dTSs"];
var solution = [4,5,6];
var trackers = ["https://tracker.gg/valorant/match/2a8df00a-9123-4d2f-89b2-4b064255c1c8","https://tracker.gg/valorant/match/eca24d6d-7d92-4ddb-847c-f82ed4b9c4b8","https://tracker.gg/valorant/match/90981cbd-92ab-45e3-9026-691fde21e457"];
var current_video = 0;
var guess_one; 
var guess_two; 
var guess_three;
var stars_earned = 0;
var current_selected_rank = null;
const iron_select = document.getElementById("iron-select");
const bronze_select = document.getElementById("bronze-select");
const silver_select = document.getElementById("silver-select");
const gold_select = document.getElementById("gold-select");
const platinum_select = document.getElementById("platinum-select");
const diamond_select = document.getElementById("diamond-select");
const ascendant_select = document.getElementById("ascendant-select");
const immortal_select = document.getElementById("immortal-select");
const radiant_select = document.getElementById("radiant-select");
iron_select.val = 0;
bronze_select.val = 1;
silver_select.val = 2;
gold_select.val = 3;
platinum_select.val = 4;
diamond_select.val = 5;
ascendant_select.val = 6;
immortal_select.val = 7;
radiant_select.val = 8;
iron_select.addEventListener('click', selectRank);
bronze_select.addEventListener('click', selectRank);
silver_select.addEventListener('click', selectRank);
gold_select.addEventListener('click', selectRank);
platinum_select.addEventListener('click', selectRank);
diamond_select.addEventListener('click', selectRank);
ascendant_select.addEventListener('click', selectRank);
immortal_select.addEventListener('click', selectRank);
radiant_select.addEventListener('click', selectRank);
function selectRank(evt){
	//set current_selected_rank equal to integer value corresponding to rank
	current_selected_rank = evt.currentTarget.val;
	//remove all other select-glows
	iron_select.classList.remove("selected-rank");
	bronze_select.classList.remove("selected-rank");
	silver_select.classList.remove("selected-rank");
	gold_select.classList.remove("selected-rank");
	platinum_select.classList.remove("selected-rank");
	diamond_select.classList.remove("selected-rank");
	ascendant_select.classList.remove("selected-rank");
	immortal_select.classList.remove("selected-rank");
	radiant_select.classList.remove("selected-rank");
	//set select-glow
	evt.currentTarget.classList.add("selected-rank");
}
function submit(){
	console.log(current_selected_rank);
	if(current_selected_rank == null){
		//alert("Please select a rank");
		return;
	}
	if(current_video <= 2){
		if(current_selected_rank == solution[current_video]){
			//earn two stars
			//alert("TWO STAR");
			stars_earned += 2;
			//set stars in clip results 
			document.getElementById("stars_earned").innerHTML = filled_star + filled_star;
		}else if(current_selected_rank == solution[current_video]-1 || current_selected_rank == solution[current_video]+1){
			//earn one star
			//alert("ONE STAR");
			stars_earned += 1;
			document.getElementById("stars_earned").innerHTML = filled_star + empty_star;
		}else{
			//earn zero star
			//alert("ZERO STAR");
			stars_earned += 0;
			document.getElementById("stars_earned").innerHTML = empty_star + empty_star;
		}
		//setup buttons 
		document.getElementById("next_clip_button").style.display = "block";
		document.getElementById("close_button").style.display = "none";
		//set Correct Rank clip results
		document.getElementById("correct-select-img").src = ranks_array[solution[current_video]];
		//set Your Guess clip results
		document.getElementById("your-guess-select-img").src = ranks_array[current_selected_rank];
		//set the tracker 
		document.getElementById("tracker").innerHTML = 'Tracker: <a style="color:white;" target="_blank" href="'+trackers[current_video]+'">Tracker Link</a>';
		//save your guess in previous guess array 
		previous_guess[current_video] = current_selected_rank;
		//unset current selected rank 
		current_selected_rank = null;	
		//display results screen 
		document.getElementById("results_menu").style.display = "block";
		//remove all other select-glows
		iron_select.classList.remove("selected-rank");
		bronze_select.classList.remove("selected-rank");
		silver_select.classList.remove("selected-rank");
		gold_select.classList.remove("selected-rank");
		platinum_select.classList.remove("selected-rank");
		diamond_select.classList.remove("selected-rank");
		ascendant_select.classList.remove("selected-rank");
		immortal_select.classList.remove("selected-rank");
		radiant_select.classList.remove("selected-rank");
		if(current_video == 2){
			localStorage.setItem("daily", daily_code);
			localStorage.setItem("one", previous_guess[0]);
			localStorage.setItem("two", previous_guess[1]);
			localStorage.setItem("three", previous_guess[2]);
			localStorage.setItem("today_score", stars_earned);
			var star_history = localStorage.getItem(stars_earned);
			if(star_history == null){
				localStorage.setItem(stars_earned, 1);
			}else{
				star_history = parseInt(star_history);
				star_history += 1;
				localStorage.setItem(stars_earned, star_history);
			}
		}
	}else{
		//alert("No more videos today");
		iron_select.classList.remove("selected-rank");
		bronze_select.classList.remove("selected-rank");
		silver_select.classList.remove("selected-rank");
		gold_select.classList.remove("selected-rank");
		platinum_select.classList.remove("selected-rank");
		diamond_select.classList.remove("selected-rank");
		ascendant_select.classList.remove("selected-rank");
		immortal_select.classList.remove("selected-rank");
		radiant_select.classList.remove("selected-rank");
	}
	//alert("Submitted!");
}
function nextClip(){
	//remove results screen 
	document.getElementById("results_menu").style.display = "none";
	if(current_video == 2){
		//display final results button 
		document.getElementById("final_button").style.display = "inline-block";
		//enter the history
		var h_zero  = localStorage.getItem(0);
		var h_one  = localStorage.getItem(1);
		var h_two  = localStorage.getItem(2);
		var h_three  = localStorage.getItem(3);
		var h_four  = localStorage.getItem(4);
		var h_five  = localStorage.getItem(5);
		var h_six  = localStorage.getItem(6);
		document.getElementById("star_history").innerHTML = "0 stars: "+h_zero+"<br>1 stars: "+h_one+"<br> 2 stars: "+h_two+"<br> 3 stars: "+h_three+"<br> 4 stars: "+h_four+"<br> 5 stars: "+h_five+"<br> 6 stars: "+h_six+"";
		//display final results menu
		document.getElementById("final_results_menu").style.display = "block";
	}
	//update score 
	document.getElementById("score").innerHTML = ""; 
	for(var i=0; i<stars_earned; i++){
		document.getElementById("score").innerHTML += filled_star; 
	}
	for(var i=stars_earned; i<6; i++){
		document.getElementById("score").innerHTML += empty_star;
	}
	//move on to next video
	if(current_video<2){
		current_video++;
	}
	//remove buttons 
	document.getElementById("prev_button").style.display = "none";
	document.getElementById("next_button").style.display = "none";
	document.getElementById("sub_button").style.display = "inline-block"; 
	//display next clip and prev clip buttons depending
	if((previous_guess[0] != 9 && current_video == 1) || (previous_guess[1] != 9 && current_video == 2)|| (previous_guess[2] != 9 && current_video == 3)){
		document.getElementById("prev_button").style.display = "inline-block";
	}
	//display next clip buttons
	if((previous_guess[1] != 9 && current_video == 0) || (previous_guess[2] != 9 && current_video == 1)){
		document.getElementById("next_button").style.display = "inline-block";
	}
	//disable the submit button
	if((previous_guess[0] != 9 && current_video == 0) || (previous_guess[1] != 9 && current_video == 1) || (previous_guess[2] != 9 && current_video == 2)|| (previous_guess[2] != 9 && current_video == 3)){
		document.getElementById("sub_button").style.display = "none";
		document.getElementById("clip_result_button").style.display = "inline-block";
	}
	if(current_video <= 2){
		document.getElementById("video-video").src = videos[current_video];
		//change clip number 
		document.getElementById("clip_number").innerHTML = "Clip " + (current_video+1);
	}
}
function previous(){
	//move back to previous video
	if(current_video > 0){
		current_video--;
	}
	document.getElementById("video-video").src = videos[current_video];
	//remove buttons 
	document.getElementById("prev_button").style.display = "none";
	document.getElementById("next_button").style.display = "none";
	document.getElementById("sub_button").style.display = "inline-block"; 
	//display next clip and prev clip buttons depending
	if((previous_guess[0] != 9 && current_video == 1) || (previous_guess[1] != 9 && current_video == 2)){
		document.getElementById("prev_button").style.display = "inline-block";
	}
	//display next clip buttons
	if((previous_guess[0] != 9 && current_video == 0) || (previous_guess[1] != 9 && current_video == 1)){
		document.getElementById("next_button").style.display = "inline-block";
	}
	//disable the submit button
	if((previous_guess[0] != 9 && current_video == 0) || (previous_guess[1] != 9 && current_video == 1) || (previous_guess[2] != 9 && current_video == 2)){
		document.getElementById("sub_button").style.display = "none";
		document.getElementById("clip_result_button").style.display = "inline-block";
	}
}
function next(){
	//move forwards to next video
	if(current_video < 2){
		current_video++;
	}
	document.getElementById("video-video").src = videos[current_video];
	if(current_video == 2){
		document.getElementById("final_button").style.display="inline-block";
	}
	//remove buttons 
	document.getElementById("prev_button").style.display = "none";
	document.getElementById("next_button").style.display = "none";
	document.getElementById("sub_button").style.display = "inline-block"; 
	//display next clip and prev clip buttons depending
	if((previous_guess[0] != 9 && current_video == 1) || (previous_guess[1] != 9 && current_video == 2)){
		document.getElementById("prev_button").style.display = "inline-block";
	}
	//display next clip buttons
	if((previous_guess[0] != 9 && current_video == 0) || (previous_guess[1] != 9 && current_video == 1)){
		document.getElementById("next_button").style.display = "inline-block";
	}
	//disable the submit button
	if((previous_guess[0] != 9 && current_video == 0) || (previous_guess[1] != 9 && current_video == 1) || (previous_guess[2] != 9 && current_video == 2)){
		document.getElementById("sub_button").style.display = "none";
		document.getElementById("clip_result_button").style.display = "inline-block";
	}
}
function show_clip_result(){
	//var daily  = localStorage.getItem(2);
	//console.log("daily is " + daily);
	//edit the clip result screen 
	//set Correct Rank clip results
	document.getElementById("correct-select-img").src = ranks_array[solution[current_video]];
	//set Your Guess clip results
	document.getElementById("your-guess-select-img").src = ranks_array[previous_guess[current_video]];
	//generate the stars 
	if(solution[current_video] == previous_guess[current_video]){
		//two stars 
		document.getElementById("stars_earned").innerHTML = filled_star + filled_star;
	}else if(solution[current_video] == previous_guess[current_video] + 1 || solution[current_video] == previous_guess[current_video] - 1){
		//one star 
		document.getElementById("stars_earned").innerHTML = filled_star + empty_star;
	}else{
		document.getElementById("stars_earned").innerHTML = empty_star + empty_star;
	}
	document.getElementById("next_clip_button").style.display = "none";
	document.getElementById("close_button").style.display = "block";
	document.getElementById("results_menu").style.display = "block";
}
function exit(){
	document.getElementById("results_menu").style.display = "none";
}
function exit2(){
	document.getElementById("final_results_menu").style.display = "none";
}
function openFinal(){
	document.getElementById("final_results_menu").style.display = "block";
}
//countdown by chatgpt4
function initializeCountdown() {
    const endTime = new Date();
    endTime.setHours(endTime.getHours() + 24);
    endTime.setMinutes(0);
    endTime.setSeconds(0);
    endTime.setMilliseconds(0);
    return endTime;
}

function updateCountdown(endTime) {
    const currentTime = new Date();
    let timeDifference = endTime.getTime() - currentTime.getTime();

    if (timeDifference < 0) {
        endTime = initializeCountdown();
        timeDifference = endTime.getTime() - currentTime.getTime();
    }

    const hours = Math.floor(timeDifference / (1000 * 60 * 60));
    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

    document.getElementById("hours").textContent = hours.toString().padStart(2, "0");
    document.getElementById("minutes").textContent = minutes.toString().padStart(2, "0");
    document.getElementById("seconds").textContent = seconds.toString().padStart(2, "0");
}

const endTime = initializeCountdown();
setInterval(() => updateCountdown(endTime), 1000);

//window on load 
window.addEventListener("load", (event) => {
  console.log("page is fully loaded");
  var code = localStorage.getItem("daily");
  if(code == daily_code){
	  previous_guess[0] = localStorage.getItem("one");
	  previous_guess[1] = localStorage.getItem("two"); 
	  previous_guess[2] = localStorage.getItem("three"); 
	  document.getElementById("sub_button").style.display = "none";
	  document.getElementById("next_button").style.display = "inline-block";
	  document.getElementById("clip_result_button").style.display = "inline-block";
	  document.getElementById("final_button").style.display="inline-block";
	  //enter the history
	  var h_zero  = localStorage.getItem(0);
	  var h_one  = localStorage.getItem(1);
	  var h_two  = localStorage.getItem(2);
	  var h_three  = localStorage.getItem(3);
	  var h_four  = localStorage.getItem(4);
	  var h_five  = localStorage.getItem(5);
      var h_six  = localStorage.getItem(6);
	  document.getElementById("star_history").innerHTML = "0 stars: "+h_zero+"<br>1 stars: "+h_one+"<br> 2 stars: "+h_two+"<br> 3 stars: "+h_three+"<br> 4 stars: "+h_four+"<br> 5 stars: "+h_five+"<br> 6 stars: "+h_six+"";
	  var stars = localStorage.getItem("today_score");
	  var stars_earned = parseInt(stars);
	  document.getElementById("score").innerHTML = ""; 
	  for(var i=0; i<stars_earned; i++){
			document.getElementById("score").innerHTML += filled_star; 
		}
		for(var i=stars_earned; i<6; i++){
			document.getElementById("score").innerHTML += empty_star;
		}
  }
});

function panic(){
	localStorage.clear(); 
	window.location.reload();
}
</script>
</body>
</html>

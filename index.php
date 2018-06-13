<?php
include("includes/config.php");

// session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
	<script src="js/register.js"></script>
    <title>Wellcome to Your Music!</title>
</head>
<body>

    <div id="mainContainer">
        <div id="topContainer">
            <div id="navBarContainer">
                <nav class="navBar">
                    <a href="index.php" class="logo">
                     <i class="fas fa-headphones"></i>
                    </a>
                    <div class="group">
                        <div class="navItem">
                            <a href="search.php" class="navItemLink">Search
                            <i class="fas fa-search" alt="Search"></i>
                            </a>
                        </div>
                    </div>
                    <div class="group">
                        <div class="navItem">
                            <a href="browse.php" class="navItemLink">Browse</a>
                        </div>
                        <div class="navItem">
                            <a href="yourmusic.php" class="navItemLink">Your music</a>
                        </div>
                        <div class="navItem">
                            <a href="profile.php" class="navItemLink">Freddie Mercury</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    
    <div id="nowPlayingBarContainer">
        <div id=nowPlayingBar>
            <div id="nowPlayingLeft">
                <div class="content">
                    <span class="albumLink">
                        <img src="https://androidapkcloud.com/wp-content/uploads/2017/09/Square-PhotoWithout.png" class="albumImage">
                    </span>
                    <div class="trackInfo">
                        <span class="trackName">
                            <span>Another one bite to dust</span>
                        </span>
                        <span class="artistName">
                            <span>Queen</span>
                        </span>
                    </div>
                </div>
            </div>

            <div id="nowPlayingCenter">
                <div class="content playerControls">
                    <div class="buttons">
                        <button class="controlButton shuffle" title="Shuffle">
                        <i class="fas fa-random" alt="Shuffle"></i>
                        </button>
                        <button class="controlButton Previous" title="Previous">
                        <i class="fas fa-step-backward" alt="Previous"></i>
                        </button>
                        <button class="controlButton play" title="Play">
                        <i class="fas fa-play-circle" alt="Play"></i>
                        </button>
                        <button class="controlButton pause" title="Pause">
                        <i class="fas fa-pause-circle" alt="Pause"></i>
                        </button>
                        <button class="controlButton next" title="Next">
                        <i class="fas fa-step-forward" alt="Next"></i>
                        </button>
                        <button class="controlButton repeat" title="Repeat">
                        <i class="fas fa-redo-alt" alt="Repeat"></i>
                        </button>
                    </div>

                    <div class="playbackBar">
                        <span class="progressTime current">0.00</span>
                        <div class="progressBar">
                            <div class="progressBarBg">
                                <div class="progress"></div>
                            </div>
                        </div>
                        <span class="progressTime remaining">0.00</span>
                    </div>
                </div>
            </div>

            <div id="nowPlayingRight">
                <div class="volumeBar">
                    <button class="controlButton volume" title="Volume">
                    <i class="fas fa-volume-up" alt="Volume"></i>
                    </button>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</body>
</html>
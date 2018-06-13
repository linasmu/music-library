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
    <div id="nowPlayingBarContainer">
        <div id=nowPlayingBar>
            <div id="nowPlayingLeft">

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

            </div>

        </div>
    </div>
</body>
</html>
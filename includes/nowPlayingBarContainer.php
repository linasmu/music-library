<?php
$songQuery = mysqli_query($con, "SELECT * FROM songs ORDER BY RAND() LIMIT 10");

$resultArray = array();

while($row = mysqli_fetch_array($songQuery)) {
   array_push($resultArray, $row['id']); 
}

$jsonArray = json_encode($resultArray);

?>

<script>
    
$(document).ready(function() {
    currentPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(currentPlaylist[0], currentPlaylist, false);
});

function setTrack(trackId, newPlaylist, play) {
    $.post("includes/handlers/ajax/getSongJson.php", {songId: trackId}, function(data){

        var track = JSON.parse(data);

        console.log(track);
        audioElement.setTrack(track.link);
        audioElement.play();
    });

    if(play == true) {
        audioElement.play();
    }
}

function playSong() {
    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.play();
}

function pauseSong() {
    $(".controlButton.play").show();
    $(".controlButton.pause").hide();
    audioElement.pause();
}

</script>

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
                    <button class="controlButton play" title="Play" onclick="playSong()">
                    <i class="fas fa-play-circle" alt="Play"></i>
                    </button>
                    <button class="controlButton pause" title="Pause" onclick="pauseSong()">
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
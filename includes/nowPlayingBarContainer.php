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
    var newPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(newPlaylist[0], newPlaylist, false);
    updateVolumeProgressBar(audioElement.audio);

    // Prevent highlighting 
    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove" , function(e) {
        e.preventDefault();
    });

    $(".playbackBar .progressBar").mousedown(function(){
        mouseDown = true;
    });

    $(".playbackBar .progressBar").mousemove(function(e){
        if(mouseDown == true) {
            timeFromOffset(e, this);
        }
    });

    $(".playbackBar .progressBar").mouseup(function(e){
            timeFromOffset(e, this);
     });

     $(".volumeBar .progressBar").mousedown(function(){
        mouseDown = true;
    });

    $(".volumeBar .progressBar").mousemove(function(e){
        if(mouseDown == true) {
            var percentage = e.offsetX / $(this).width();

            if(percentage >= 0 && percentage <= 1) {    
                 audioElement.audio.volume = percentage;
            }
        }
    });

    $(".volumeBar .progressBar").mouseup(function(e){
        var percentage = e.offsetX / $(this).width();
            
            if(percentage >= 0 && percentage <= 1) {    
                audioElement.audio.volume = percentage;
            }
     });

     $(document).mouseup(function() {
         mouseDown = false;
     });
});



function timeFromOffset(mouse, progressBar) {
    var percentage = mouse.offsetX / $(progressBar).width() * 100;
    var seconds = audioElement.audio.duration * (percentage / 100);
    audioElement.setTime(seconds);
}

function prevSong() {
    if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
        audioElement.setTime(0);
    } else {
        currentIndex = currentIndex - 1;
        setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
}

function nextSong() {
    if(repeat == true) {
        audioElement.setTime(0);
        playSong();
        return;
    }

    if(currentIndex == currentPlaylist.length - 1) {
        currentIndex = 0;
    } else {
        currentIndex++;
    }

    var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
}

function setRepeat() {
    repeat = !repeat;
    var imageColor = repeat ? "#f78181" : "#a0a0a0";
    $(".fa-redo-alt").css("color", imageColor);
}

function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted;

    if(!audioElement.audio.muted) {
        $(".fa-volume-up").show();
        $(".fa-volume-off").hide();
    } else {
        $(".fa-volume-up").hide();
        $(".fa-volume-off").show();
    }
}

function setShuffle() {
    shuffle = !shuffle;
    var simageColor = shuffle ? "#f78181" : "#a0a0a0";
    $(".fa-random").css("color", simageColor);

    if(shuffle == true) {
        shuffleArray(shufflePlaylist);
        currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
    
    } else {
        currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
}

// RANDOMIZE ARRAY
function shuffleArray(a) {
    var j, x, i;
    for(i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}

function setTrack(trackId, newPlaylist, play) {

    if(newPlaylist != currentPlaylist) {
        currentPlaylist = newPlaylist;
        shufflePlaylist = currentPlaylist.slice();
        shuffleArray(shufflePlaylist);
    }

    if(shuffle == true) {
        currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
        currentIndex = currentPlaylist.indexOf(trackId);
    }
    pauseSong();

    $.post("includes/handlers/ajax/getSongJson.php", {songId: trackId}, function(data){

        var track = JSON.parse(data);
        
        $(".trackName span").text(track.title);

        $.post("includes/handlers/ajax/getArtistJson.php", {artistId: track.artist}, function(data){
            var artist = JSON.parse(data);
            $(".artistName span").text(artist.name);
        });

        $.post("includes/handlers/ajax/getAlbumJson.php", {albumId: track.album}, function(data){
            var album = JSON.parse(data);
            $(".albumLink img").attr("src", album.label);
        });

        audioElement.setTrack(track);
    });

    if(play == true) {
        audioElement.play();
    }
}

function playSong() {
    if(audioElement.audio.currentTime == 0) {
        $.post("includes/handlers/ajax/updatePlays.php", {songId: audioElement.currentlyPlaying.id});
    }

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
                    <img src="" class="albumImage">
                </span>
                <div class="trackInfo">
                    <span class="trackName">
                        <span></span>
                    </span>
                    <span class="artistName">
                        <span></span>
                    </span>
                </div>
            </div>
        </div>

        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle" onclick="setShuffle()">
                    <i class="fas fa-random" alt="Shuffle"></i>
                    </button>
                    <button class="controlButton Previous" title="Previous" onclick="prevSong()">
                    <i class="fas fa-step-backward" alt="Previous"></i>
                    </button>
                    <button class="controlButton play" title="Play" onclick="playSong()">
                    <i class="fas fa-play-circle" alt="Play"></i>
                    </button>
                    <button class="controlButton pause" title="Pause" onclick="pauseSong()">
                    <i class="fas fa-pause-circle" alt="Pause"></i>
                    </button>
                    <button class="controlButton next" title="Next" onclick="nextSong()">
                    <i class="fas fa-step-forward" alt="Next"></i>
                    </button>
                    <button class="controlButton repeat" title="Repeat" onclick="setRepeat()">
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
                <button class="controlButton volume" title="Volume" onclick="setMute()">
                <i class="fas fa-volume-up" alt="Volume"></i>
                <i class="fas fa-volume-off"></i>
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
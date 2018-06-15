var currentPlaylist = [];
var audioElement;

function Audio() {

    this.currentlyPlaying;
    this.audio = document.createElement("audio");

    this.setTrack = function(track) {
        this.currentlyPlaying = track;
        this.audio.src = track.link;
    }

    this.play = function() {
        this.audio.play();
    }

    this.pause = function() {
        this.audio.pause();
    }
}
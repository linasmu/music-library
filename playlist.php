<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])) {
    $playlistId = $_GET['id'];
} else {
    header("Location: index.php");
}

$playlist =new Playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());

?>

<div class="infoSection">
    <div class="leftSection">
        <i class='fas fa-music'></i>
    </div>

    <div class="rightSection">
        <h2><?= $playlist->getName(); ?></h2>
        <p>By <?= $playlist->getOwner(); ?></p>
        <p><?= $playlist->getNumberOfSongs(); ?> songs</p>
        <button class="button">DELETE PLAYLIST</button>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
        $songIdArray = array();

        $i = 1;
        foreach($songIdArray as $songId) {
            // echo $songId;
            $albumSong = new Song($con, $songId);
            $albumArtist = $albumSong->getArtist();

            echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <i class='fas fa-play' onclick='setTrack(\"". $albumSong->getId() ."\", tempPlaylist, true)'></i>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>" . $albumSong->getTitle() . "</span>
                        <span class='artistName'>" . $albumArtist->getName() . "</span>
                    </div>

                    <div class='trackOptions'>
                        <i class='fas fa-ellipsis-v'></i>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>" . $albumSong->getDuration() . "</span>
                    </div>

                </li>";

            $i++;
        }
        ?>

        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>

    </ul>
</div>

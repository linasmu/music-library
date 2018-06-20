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
        <button class="button" onclick=deletePlaylist('<?= $playlistId; ?>')>DELETE PLAYLIST</button>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
        $songIdArray = $playlist->getSongIds();

        $i = 1;
        foreach($songIdArray as $songId) {
            // echo $songId;
            $playlistSong = new Song($con, $songId);
            $songArtist = $playlistSong->getArtist();

            echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <i class='fas fa-play' onclick='setTrack(\"". $playlistSong->getId() ."\", tempPlaylist, true)'></i>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>" . $playlistSong->getTitle() . "</span>
                        <span class='artistName'>" . $songArtist->getName() . "</span>
                    </div>

                    <div class='trackOptions'>
                        <i class='fas fa-ellipsis-v'></i>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>" . $playlistSong->getDuration() . "</span>
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

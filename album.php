<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location: index.php");
}

$album =new Album($con, $albumId);
$artist = $album->getArtist();

?>

<div class="infoSection">
    <div class="leftSection">
        <img src="<?= $album->getLable(); ?>" alt="">
    </div>

    <div class="rightSection">
        <h2><?= $album->getTitle(); ?></h2>
        <p>By <?= $artist->getName(); ?></p>
        <p><?=$album->getNumberOfSongs() ?> </p>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
        $songIdArray = $album->getSongIds();

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

<div class="optionsMenu">
    <input type="hidden" class="songId">
    <div class="item">Add to playlist</div>
    <div class="item">Item2</div>
    <div class="item">Item3</div>
</div>

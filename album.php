<?php include("includes/header.php"); 

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location: index.php");
}

$album =new Album($con, $albumId);
$artist = $album->getArtist();

?>

<div class="albumInfo">
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
                        <i class='fas fa-play'></i>
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
    </ul>
</div>


<?php include("includes/footer.php"); ?>
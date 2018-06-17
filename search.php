<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
    $term = urldecode($_GET['term']);
} else {
    $term = "";
}
?>

<div class="searchContainer">
    <h4>Search for an Artist, Song or Album </h4>
    <input type="text" class="searchInput" value="<?= $term; ?>" placeholder="Search..." onfocus="this.value = this.value">
</div>

<script>

$(".searchInput").focus();

$(function() {
    
    $(".searchInput").keyup(function() {
        clearTimeout(timer);

        timer = setTimeout(function() {
            var val = $(".searchInput").val();
            openPage("search.php?term=" + val);
        }, 2000);
    })
})

</script>

<?php if($term == "") exit(); ?>


<div class="tracklistContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="tracklist">
        <?php
        $songQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");
        
        if(mysqli_num_rows($songQuery) == 0) {
            echo "<span class='noResults'> No songs found matching ". $term . "</span>";
        }

        $songIdArray = array();

        $i = 1;
        while ($row = mysqli_fetch_array($songQuery)) {

            if($i > 15) {
                break;
            }

            array_push($songIdArray, $row['id']);
       
            $albumSong = new Song($con, $row['id']);
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

<div class="artistContainer borderBottom">
    <h2>ARTISTS</h2>

    <?php
    $artistQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");
    if(mysqli_num_rows($artistQuery) == 0) {
        echo "<span class='noResults'> No artists found matching ". $term . "</span>";
    }

    while($row = mysqli_fetch_array($artistQuery)) {
        $artistFound = new Artist($con, $row['id']);

        echo "<div class='searchResultRow'>
                <div class='artistName'>
                    <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() ."\")'>
                    ". $artistFound->getName() ."
                    </span>
                </div>
            </div>";
    }
    ?>
</div>

<div class="gridViewContainer">
    <h2>ALBUMS</h2>
    <?php
        $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '$term%' LIMIT 10");

        if(mysqli_num_rows($albumQuery) == 0) {
            echo "<span class='noResults'> No albums found matching ". $term . "</span>";
        }

        while($row = mysqli_fetch_array($albumQuery)) {

            echo "<div class='gridViewItem'>
            <span role='link' tabindex='0' onclick='openPage(\"album.php?id=". $row['id'] ."\")'>
                    <img src='". $row['label'] ."'>
                    <div class='gridViewInfo'>
                    ". $row['title'] ."
                    </div>
                    </span>
                </div>";
        }
    ?>
</div>

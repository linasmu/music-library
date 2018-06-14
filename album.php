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


<?php include("includes/footer.php"); ?>
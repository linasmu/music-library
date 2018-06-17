<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
    $term = urldecode($_GET['term']);
    echo $term;
} else {
    $term = "";
}
?>

<div class="searchContainer">
    <h4>Search for an Artist, Song or Album </h4>
    <input type="text" class="searchInput" value="<?= $term ?>" placeholder="Search...">
</div>
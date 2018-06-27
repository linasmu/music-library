<?php
include("includes/includedFiles.php");
?>

<div class="info">
    <div class="centerSection">
        <div class="userInfo">
            <h1><?= $userLoggedIn->getFirstAndLastName(); ?></h1>
        </div>
    </div>

    <div class="buttonItems">
        <button class="button" onclick="openPage('updateDetails.php')">USER DETAILS</button>
        <button class="button" onclick="logout()">LOGOUT</button>
    </div>
</div>
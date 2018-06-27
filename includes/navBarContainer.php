<div id="navBarContainer">
    <nav class="navBar">
        <span class="logo" role="link" tabindex="0" onclick="openPage('index.php')">
            <i class="fas fa-headphones"></i>
        </span>
        <div class="group">
            <div class="navItem">
                <span class='navItemLink' role='link' tabindex='0' onclick='openPage("search.php")'>
                Search
                <i class="fas fa-search" alt="Search"></i>
                </span>
            </div>
        </div>
        <div class="group">
            <div class="navItem">
            <span role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink">Browse</span>
            </div>
            <div class="navItem">
            <span role="link" tabindex="0" onclick="openPage('yourMusic.php')" class="navItemLink">Your music</span>
            </div>
            <div class="navItem">
            <span role="link" tabindex="0" onclick="openPage('settings.php')" class="navItemLink"><?= $userLoggedIn->getFirstAndLastName() ?></span>
            </div>
        </div>
    </nav>
</div>
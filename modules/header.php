<div id="headerLeft">
    <a href="/index.php" title="Home"><h1 id="trippy">Trippy Rodeo <br/> Movie Reviews</h1></a>
</div>

<div id="headerRight">
    <?php
    if (isset($movieInfo['title'])) {
        echo
        '<h1 id="theTitle">' . $movieInfo['title'] . '</h1>' .
        '<h2 id="sub">' . $movieInfo['subtitle'] . '</h2>';
    } else {
        echo '<h1 id="theTitle">' . $pageInfo['title'] . '</h1>';
    }
    ?>
</div>
<div id="userName">
    <?php
    if (isset($_SESSION['email'])) {
        echo $_SESSION['name'];
        echo " || <a href='.././?action=signOut' title='Sign Out'>Sign Out</a>";
    }
    ?>
</div>



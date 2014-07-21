<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $movieInfo['title'] ?></title>
        <link href="/css/style.css" type="text/css" rel="stylesheet"  media="screen"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" type="image/png" href="../content/images/popcorn.png">
    </head>
    <body>
    <main>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
        </header>
        <div class="wrapper">      
            <nav>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/navBar.php'; ?>
            </nav>
            <?php
            if ($_SESSION['admin'] == 'Y') {
                echo "<a href='./?action=DeleteMovie&amp;id=" . $movieInfo['movie_id'] . "' title='Delete Movie'>Delete movie</a>";
                echo " || ";
                echo "<a href='./?action=UpdateMovie&amp;id=" . $movieInfo['movie_id'] . "' title='Update Movie'>Update movie</a>";
            }
            ?>
            <div id="mainContent">
                <div id="synopsisContent">
                    <div id="synopsis">
                        <figure id="moviePoster"> 
                            <img src="<?php echo $movieInfo['url'] ?>" 
                                 alt="<?php echo $movieInfo['alt'] ?>" title="<?php echo $movieInfo['alt'] ?>"/>
                        </figure>
                        <h2>Synopsis</h2>
                        <div id='synopsisP'>
                            <?php echo $movieInfo['synopsis'] ?>
                        </div>
                    </div>
                    <div class="video">
                        <?php echo $movieInfo['code'] ?>
                    </div>
                </div>
                <div id="ratings">
                    <?php
                    if (!empty($movieInfo['rating'])) {
                        echo '<p id="userRatings">Trippy Rodeo Rating: ' . $movieInfo['rating'] . '/10</p>';
                    }
                    ?>
                    <br/><br/>
                </div>
                <div id="theReview">
                    <?php
                    if (!empty($movieInfo['review'])) {
                        echo '<h2>Official Review</h2>' . $movieInfo['review'];
                    }
                    ?>
                </div>
                <div id="comments">
                    <?php 
                    echo $comments;
                    ?>
                </div>
            </div>
            <div id="extras">
                <div>
                    <dl id="movieInfo">
                        <dt>MPAA Rating:</dt> <dd><?php
                            if (empty($movieInfo['MPAA_rating'])) {
                                echo 'Unknown';
                            } else {
                                echo $movieInfo['MPAA_rating'];
                            }
                            ?></dd>
                        <dt>Length:</dt> <dd><?php
                            if (empty($movieInfo['length'])) {
                                echo 'Unknown';
                            } else {
                                echo $movieInfo['length'] . ' min';
                            }
                            ?></dd>
                        <dt>Release Date:</dt> <dd><?php echo theDate($movieInfo['release_date']) ?></dd>
                        <dt>Genres:</dt> <?php echo $movieInfo['genre'] ?>
                        <dt>Directed by:</dt> <?php echo $movieInfo['director'] ?>
                        <dt>Produced by:</dt> <?php echo $movieInfo['produced_by'] ?>
                        <dt>Released by:</dt> <?php echo $movieInfo['released_by'] ?>
                    </dl>
                </div>
                <div id="sideBoxes">
                    <aside id="boxoffice">
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/aside_box.php'; ?>
                    </aside> 
                    <aside id="comingsoon">
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/aside_coming_soon.php'; ?>
                    </aside>      
                </div>
            </div>
            <div class='clear'></div>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </main>

</body>
</html>

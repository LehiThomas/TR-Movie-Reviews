<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Update <?php echo $movieInfo['title'] ?></title>
        <link href="/css/style.css" type="text/css" rel="stylesheet" media="screen" />
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
            <form action='.' method='post' id='insertMovie'>
                <fieldset id="insertMovieField">
                    <legend>Movie Information</legend>
                    <div id="insertMovie1">
                        <input type='hidden' name='id' id='id' value="<?php echo $movieInfo['movie_id'] ?>">
                        <label for='title'>Movie Title:</label><br/>
                        <input type='text' name='title' id='title' size='40' value="<?php echo $movieInfo['title'] ?>"><br/>

                        <label for='subtitle'>Movie Subtitle:</label><br/>
                        <input type='text' name='subtitle' id='subtitle' size='40' value="<?php echo $movieInfo['subtitle'] ?>"><br/>

                        <label for='synopsis'>Synopsis:</label><br/>
                        <textarea name='synopsis' id='synopsis'><?php echo $movieInfo['synopsis'] ?></textarea><br/>

                        <label for='review'>Movie Review:</label><br/>
                        <textarea name='review' id='review'><?php echo $movieInfo['review'] ?></textarea><br/>

                        <label for='rating'>Movie Rating:</label><br/>
                        <input type='text' name='rating' id='rating' size='5' value='<?php echo $movieInfo['rating'] ?>'><br/>

                        <label for='specRating'>Specific Rating:</label><br/>
                        <input type='text' name='specRating' id='specRrating' size='5' value='<?php echo $movieInfo['spec_rating'] ?>'><br/>

                        <label for='MPAA'>MPAA Rating:</label><br/>
                        <input type='text' name='MPAA' id='MPAA' size='10' value='<?php echo $movieInfo['MPAA_rating'] ?>'><br/>

                        <label for='length'>Length:</label><br/>
                        <input type='text' name='length' id='length' size='5' value='<?php echo $movieInfo['length'] ?>'><br/>
                    </div>
                    <div id="insertMovie2">
                        <label for='genre'>Genre:</label><br/>
                        <input type='text' name='genre' id='genre' size='50' value='<?php echo $movieInfo['genre'] ?>'><br/>

                        <label for='director'>Director:</label><br/>
                        <input type='text' name='director' id='director' size='50' value='<?php echo $movieInfo['director'] ?>'><br/>

                        <label for='producer'>Producing Companies:</label><br/>
                        <input type='text' name='producer' id='producer' size='50' value='<?php echo $movieInfo['produced_by'] ?>'><br/>

                        <label for='releasedBy'>Released By:</label><br/>
                        <input type='text' name='releasedBy' id='releasedBy' size='50' value='<?php echo $movieInfo['released_by'] ?>'><br/>

                        <label for='releaseDate'>Release Date: (YYYY-MM-DD)</label><br/>
                        <input type='datetime' name='releaseDate' id='releaseDate' value="<?php echo $movieInfo['release_date'] ?>"><br/>

                        <label for='url'>Image URL:</label><br/>
                        <input type='text' name='url' id='url' size='50' value='<?php echo $movieInfo['url'] ?>'><br/>

                        <label for='alt'>Image alt:</label><br/>
                        <input type='text' name='alt' id='alt' size='50' value='<?php echo $movieInfo['alt'] ?>'><br/>

                        <label for='embed'>Trailer Embed Code:</label><br/>
                        <input type='text' name='embed' id='embed' size='50' value='<?php echo $movieInfo['code'] ?>'><br/>

                        <input type="submit" name="action" value="Update">
                    </div>
                </fieldset>
            </form>
            <footer>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
            </footer>
        </div>
    </main>
</body>
</html>

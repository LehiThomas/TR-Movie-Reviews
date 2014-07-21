<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Trippy Rodeo</title>
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
            <?php echo $message; ?>
            <form action='.' method='post' id='insertMovie'>
                <fieldset id="insertMovieField">
                    <legend>Insert Movie Information</legend>
                    <div id="insertMovie1">
                    <label for='title'>Movie Title:</label><br/>
                    <input type='text' name='title' id='title' size='40' required><br/>
                    
                    <label for='subtitle'>Movie Subtitle:</label><br/>
                    <input type='text' name='subtitle' id='subtitle' size='40'><br/>

                    <label for='synopsis'>Synopsis:</label><br/>
                    <textarea name='synopsis' id='synopsis' required></textarea><br/>
                    
                    <label for='review'>Movie Review:</label><br/>
                    <textarea name='review' id='review'></textarea><br/>
                    
                    <label for='rating'>Movie Rating:</label><br/>
                    <input type='number' name='rating' id='rating' min="1" max="10"><br/>
                    
                    <label for='specRating'>Specific Rating:</label><br/>
                    <input type='text' name='specRating' id='specRrating'><br/>
                    
                    <label for='MPAA'>MPAA Rating:</label><br/>
                    <input type='text' name='MPAA' id='MPAA' size='10'><br/>
                    
                    <label for='length'>Length:</label><br/>
                    <input type='number' name='length' id='length'><br/>
                    </div>
                    <div id="insertMovie2">
                    <label for='genre'>Genre:</label><br/>
                    <input type='text' name='genre' id='genre' size='50' required><br/>

                    <label for='director'>Director:</label><br/>
                    <input type='text' name='director' id='director' size='50' required><br/>
                    
                    <label for='producer'>Producing Companies:</label><br/>
                    <input type='text' name='producer' id='producer' size='50' required><br/>
                    
                    <label for='releasedBy'>Released By:</label><br/>
                    <input type='text' name='releasedBy' id='releasedBy' size='50' required><br/>

                    <label for='releaseDate'>Release Date: (YYYY-MM-DD)</label><br/>
                    <input type='datetime' name='releaseDate' id='releaseDate' required><br/>
                    
                    <label for='url'>Image URL:</label><br/>
                    <input type='text' name='url' id='url' size='50'><br/>
                    
                    <label for='alt'>Image alt:</label><br/>
                    <input type='text' name='alt' id='alt' size='50'><br/>
                    
                    <label for='embed'>Trailer Embed Code:</label><br/>
                    <input type='text' name='embed' id='embed' size='50'><br/><br/>                    

                    <input type="submit" name="action" value="InsertMovie">
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


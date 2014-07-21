<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Delete <?php echo $movieInfo['title'] ?></title>
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
            <div id="deleteWarning">
                <p>Do you really want to delete <?php echo $movieInfo['title'] ?>?</p>
                <a href='./?action=Delete&amp;id=<?php echo $movieInfo['movie_id'] ?>' title='delete movie' class='button'>DELETE</a>
                <a href='./?action=review&amp;id=<?php echo $movieInfo['movie_id'] ?>' title='delete movie' class='button'>CANCEL</a>
            </div>
            <footer>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
            </footer>
        </div>
    </main>
</body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Trippy Rodeo</title>
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
            <?php if(isset($message)){ echo '<p>' . $message . '</p>';} ?>
            <?php echo $pageInfo['html_code'] ?>
            <div id="sideBoxesHome">
                <aside id="boxoffice">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/aside_box.php'; ?>
                </aside>  
                <aside id="comingsoon">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/aside_coming_soon.php'; ?>
                </aside> 
            </div>
            <div class='clear'></div>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </main>
</body>
</html>
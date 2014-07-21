<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Site Plan</title>
        <link href="/css/style.css" type="text/css" rel="stylesheet" media="screen"/>
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
            <div id='plan'>
                 <?php echo $pageInfo['html_code'] ?>
            </div>
            <footer>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
            </footer>
        </div>
    </main>
</body>
</html>

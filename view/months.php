<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Movies by Month</title>
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
            <div id="add">
                <?php
                if ($_SESSION['admin'] == 'Y') {
                    echo "<a href='./?action=addMovie' title='Add a movie'>Add a movie</a>";
                }
                if (isset($message)) {
                    echo '<p>' . $message . '</p>';
                }
                ?>
            </div>
            <div class="month">
                <h2>January</h2>
                <ul>
                    <?php groupByMonth(1) ?>
                </ul>
            </div>
            <div class="month">
                <h2>February</h2>
                <ul>
                    <?php groupByMonth(2) ?>
                </ul>
            </div>
            <div class="month">
                <h2>March</h2>
                <ul>
                    <?php groupByMonth(3) ?>
                </ul>
            </div>            
            <div class="month">
                <h2>April</h2>
                <ul>
                    <?php groupByMonth(4) ?>
                </ul>
            </div>
            <div class="month">
                <h2>May</h2>
                <ul>
                    <?php groupByMonth(5) ?>
                </ul>
            </div>
            <div class="month">
                <h2>June</h2>
                <ul>
                    <?php groupByMonth(6) ?>
                </ul>
            </div>
            <div class="month">
                <h2>July</h2>
                <ul>
                    <?php groupByMonth(7) ?>
                </ul>
            </div>
            <div class="month">
                <h2>August</h2>
                <ul>
                    <?php groupByMonth(8) ?>
                </ul>
            </div>
            <div class="month">
                <h2>September</h2>
                <ul>
                    <?php groupByMonth(9) ?>
                </ul>
            </div>
            <div class="month">
                <h2>October</h2>
                <ul>
                    <?php groupByMonth(10) ?>
                </ul>
            </div>
            <div class="month">
                <h2>November</h2>
                <ul>
                    <?php groupByMonth(11) ?>
                </ul>
            </div>
            <div class="month">
                <h2>December</h2>
                <ul>
                    <?php groupByMonth(12) ?>
                </ul>
            </div>  
            <div class='clear'></div>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </main>
</body>
</html>

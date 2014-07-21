<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Teaching Presentation: For loops</title>
        <link href="/css/style.css" type="text/css" rel="stylesheet" />
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
            <h1>Teaching Presentation</h1>
            <h2>For loops</h2>
            <p>
                According to php.net, for loops are the most complex loop, 
                but also the fastest. <br/> <br/>
                Requires:
            </p>
            <ul>
                <li>A counter</li>
                <li>A condition to test</li>
                <li>An increment to the counter</li>
            </ul>
            <p>
                for (init counter; test counter; increment counter) { <br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; code to be executed; <br/>
                }
            </p>
            <div class="ex">
                <p>
                    for ($i=0; $i &lt; 10; $i++) { <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    echo $i; <br/>
                    }
                </p>
                <?php
                for ($i = 0; $i < 10; $i++) {
                    echo $i;
                }
                ?> 
            </div>
            <br/><br/>
            <p>
                For loops are also valuable for reading in, displaying, or
                stepping through arrays. 
            </p>

            <div class="ex">
                <p>
                    $array = ['This', 'is', 'a', 'dumb', 'example!']; <br/><br/>
                    for ($i = 0; $i &lt; count($array); $i++){ <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    echo $array[$i] . " "; <br/>
                    }
                </p>
                <?php
                $array = ['This', 'is', 'a', 'dumb', 'example!'];
                for ($i = 0; $i < count($array); $i++) {
                    echo $array[$i] . " ";
                }
                ?>
            </div>
            <p>
                A faster way...
            </p>
            <div class="ex">
                <p>
                    $array = ['This', 'is', 'a', 'dumb', 'example!']; <br/><br/>
                    for ($i = 0, $x = count($array); $i &lt; $x;  $i++){ <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    echo $array[$i] . " "; <br/>
                    }
                </p>
                <?php
                $array = [ 'This', 'is', 'a', 'dumb', 'example!'];
                for ($i = 0, $x = count($array); $i < $x; $i++) {
                    echo $array[$i] . " ";
                }
                ?>
            </div>

        </div>

        <footer> 
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </main>
</body>
</html>

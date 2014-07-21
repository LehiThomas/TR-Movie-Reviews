<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login/Register</title>
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
            <?php if(isset($message)){ echo '<p>' . $message . '</p>';} ?>
            <div id='loginForm'>
                <form class="login" method="post" action=".">
                    <fieldset>
                        <legend>Login</legend>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" size="30" required>
                        <br/>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" size="15" required>
                        <br/>
                        <label for="login">&nbsp;</label>
                        <input type="submit" name="action" id="login" value="Login">
                    </fieldset>
                </form>
            </div>
            <div id='registrationform'>
                <form class="register" method="post" action=".">
                    <fieldset>
                        <legend>New Users</legend>
                        <label for="firstname">First Name:</label>
                        <input type="text" name="firstname" id="firstname" size="15" required>
                        <br/>
                        <label for="lastname">Last Name:</label>
                        <input type="text" name="lastname" id="lastname" size="25" required>
                        <br/>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" size="30" required>
                        <br/>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" size="15" required>
                        <br/>
                        <label for="password2">Confirm Password:</label>
                        <input type="password" name="password2" id="password2" size="15" required>

                        <label for="register">&nbsp;</label>
                        <input type="submit" name="action" id="register" value="Register">
                    </fieldset>
                </form>      
            </div>
            <div class='clear'></div>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </main>
</body>
</html>
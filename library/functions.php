<?php

function connection() {
    $server = 'localhost';
    $database = 'trippyro_movies';
    $user = 'trippyro_iClient';
    $password = 'C3CmX^Fccd)i';
    $dsn = "mysql:host=$server; dbname=$database";
    $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $connected = new PDO($dsn, $user, $password, $option);
    } catch (PDOException $exc) {
        header('location: /errordocs/500.php');
        exit;
    }

    return $connected;
}

function groupByMonth($month) {
    $titles = getTitles($month);
    foreach ($titles as $title) {
        if (!empty($title['subtitle'])) {
            echo "<li><a href='./?action=review&amp;id=" . $title['movie_id'] . "' title='Go to the "
            . $title['title'] . " movie page'>" . $title['title'] . ": " . $title['subtitle'] . "</a></li>";
        } else {
            echo "<li><a href='./?action=review&amp;id=" . $title['movie_id'] . "' title='Go to the "
            . $title['title'] . " movie page'>" . $title['title'] . "</a></li>";
        }
    }
}

function topMovies() {
    $titles = bestMovies();
    foreach ($titles as $title) {
        if (!empty($title['subtitle'])) {
            echo "<li><a href='./?action=review&amp;id=" . $title['movie_id'] . "' title='Go to the "
            . $title['title'] . " movie page'>" . $title['title'] . ": " . $title['subtitle'] . "</a></li>";
        } else {
            echo "<li><a href='./?action=review&amp;id=" . $title['movie_id'] . "' title='Go to the "
            . $title['title'] . " movie page'>" . $title['title'] . "</a></li>";
        }
    }
}

function comingSoon() {
    $titles = upComing();
    foreach ($titles as $title) {
        if (!empty($title['subtitle'])) {
            echo "<li><a href='./?action=review&amp;id=" . $title['movie_id'] . "' title='Go to the "
            . $title['title'] . " movie page'>" . $title['title'] . ": " . $title['subtitle'] . "</a></li>";
        } else {
            echo "<li><a href='./?action=review&amp;id=" . $title['movie_id'] . "' title='Go to the "
            . $title['title'] . " movie page'>" . $title['title'] . "</a></li>";
        }
    }
}

function theDate($oldDate) {
    $newDate = showDate($oldDate);
    for ($i = 0; $i < 1; $i++) {
        echo $newDate[0];
    }
}

function getInfo($id) {
    $pageInfo = support($id);
    return $pageInfo;
}

/**
 * 
 * @param type String
 * @return type String
 * 
 * This function sanitizes a string and returns the cleaned version
 */
function valString($string) {
    $string = filter_var(trim($string), FILTER_SANITIZE_STRING);
    return $string;
}

function cleanEmail($email) {
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $email;
}

function valNum($num) {    
    if (is_int($num)) {        
        $num = filter_var(trim($num), FILTER_SANITIZE_NUMBER_INT);
        $num = filter_var($num, FILTER_VALIDATE_INT);
    } elseif (is_float($num)) {
        $num = filter_var(trim($num), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $num = filter_var($num, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);
    } else {
        $num = false;
    }
    return $num;
}

function hashPassword($password) {
    $salt = '$5$rounds=25000$' . substr(md5(uniqid(rand(), true)), 0, 16) . '$';
    return crypt($password, $salt);
}

function comparePasswords($password, $hashedPassword) {
    return crypt($password, $hashedPassword) == $hashedPassword;
}

function changeUserForm($userInfo) {
    $output = "<form action='.' method='post' style='width: 40%; margin: 40px;'>
                <fieldset>
                    <legend>Update Personal Information</legend>
                    <input type='hidden' name='id' id='id' value=" . $userInfo['user_id'] . ">
                    
                    <label for='email'>E-mail:</label><br/>
                    <input type='email' name='email' id='email' size='30' value=" . $userInfo['email'] . "><br/>

                    <label for='firstName'>First Name:</label><br/>
                    <input type='text' name='firstName' id='firstName' size='20' value=" . $userInfo['first_name'] . "><br/>

                    <label for='lastName'>Last Name:</label><br/>
                    <input type='text' name='lastName' id='lastName' size='20' value=" . $userInfo['last_name'] . "><br/>

                    <label for='password'>Password:</label><br/>
                    <input type='password' name='password' id='password' size='15'><br/>

                    <input type='submit' name='action' value='Update Account'>
                    <input type='submit' name='action' value='Delete Your Account'>
                </fieldset>
            </form>";
    if ($_SESSION['admin'] == 'Y') {
        $everyone = getAllUsers();
        foreach ($everyone as $user) {
            $output .= "
             <form action='.' method='post' class='everyone'>
                <fieldset >
                    <legend>Update User Information</legend>
                    <input type='hidden' name='id' id='id' value=" . $user['user_id'] . ">
                    
                    <label for='email'>E-mail:</label>
                    <input type='email' name='email' id='email' size='30' value=" . $user['email'] . ">

                    <label for='firstName'>First Name:</label>
                    <input type='text' name='firstName' id='firstName' size='20' value=" . $user['first_name'] . ">

                    <label for='lastName'>Last Name:</label>
                    <input type='text' name='lastName' id='lastName' size='20' value=" . $user['last_name'] . ">

                    <label for='admin'>Admin:</label>
                    <input type='text' name='admin' id='admin' size='1' value=" . $user['admin'] . "><br/>

                    <input type='submit' name='action' value='Update Account'>
                    <input type='submit' name='action' value='Delete Account'>
                </fieldset>
            </form>";
        }
    }
    return $output;
}

function comments($movieid){
    $comments = displayComments($movieid);
    if(!isset($_SESSION['email'])){
        $message = "You must be logged in to leave a comment.";
    } else if (empty($comments)){
        $message = "Leave the first comment!";
        $message.= "<form action='.' method='post' id='insertComment'>
                    <fieldset id='insertComment'>
                    <legend>Add Comment</legend>
                    <input type='hidden' name='id' id='id' value='" . $movieid . "'>
                        
                    <label for='title'>Title:</label><br/>
                    <input type='text' name='title' id='commentTitle' required><br/>

                    <label for='comment'>Comment:</label><br/>
                    <textarea name='comment' id='comment'></textarea><br/>                 

                    <input type='submit' name='action' value='Insert Comment'>        
                </fieldset>
            </form>";
    } else {
        $message= "<form action='.' method='post' id='insertComment'>
                    <fieldset id='insertComment'>
                    <legend>Add Comment</legend>
                    <input type='hidden' name='id' id='id' value='" . $movieid . "'>
                    <label for='title'>Title:</label><br/>
                    <input type='text' name='title' id='commentTitle' required><br/>

                    <label for='comment'>Comment:</label><br/>
                    <textarea name='comment' id='comment'></textarea><br/>                 

                    <input type='submit' name='action' value='Insert Comment'>        
                </fieldset>
            </form>";
    }
    
    $message .= $comments;        
    return $message;
}

function getModifiedName(){
    $first = $_SESSION['name'];
    $last = $_SESSION['last'];
    $initial = substr($first, 0, 1);
    $username = $initial . ". " . $last;
    return $username;
}

function displayComments($movieid){
    $comments = getAllComments($movieid);
    $output = "";
    foreach ($comments as $comment) {
        $output .= "<div class='userComments'><h3>".$comment['title']."</h3>"
                . "<p>".$comment['comment']."<p>" 
                . "<p>Author: ".$comment['username']
                . "<br/>Date Posted: ".$comment['date']."</p>" . "<br/></div>";
    }
    return $output;
}
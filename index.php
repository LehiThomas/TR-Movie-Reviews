<?php

// If there is no session, start one.
if (!$_SESSION) {
    session_start();
}

require 'model/db.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index';
}

if ($action == 'index') {
    $pageInfo = getInfo(1001);
    include 'view/home.php';   
    
} elseif ($action == 'months') {
    $pageInfo = getInfo(1004);
    include 'view/months.php';   
    
} elseif ($action == 'review' && isset($_GET['id'])) {
    $movieid = $_GET['id'];
    $movieInfo = getMovieInfo($movieid);
    if ($movieInfo) {
        $comments = comments($movieid);
        include 'view/review.php';
    } else {
        $message = "There was an error.";
        $pageInfo = getInfo(1001);
        include 'view/home.php';
    }

}   elseif ($action == 'Insert Comment' && !empty($_POST['id'])) {
        $movieid = $_POST['id'];    
        $userName = getModifiedName();
        $title = $_POST['commentTitle'];
        $comment = $_POST['comment'];
        
        $result = insertComment($movieid, $userName, $title, $comment);
        if($result){
            $movieInfo = getMovieInfo($movieid);
             if ($movieInfo) {
                   $_GET['id'] = $movieInfo;
                   $comments = comments($movieid);
                   include 'view/review.php';
          } else {
               $message = "There was an error.";
               $pageInfo = getInfo(1001);
               include 'view/home.php';
        }
        } else{
            $message = "There was an error.";
               $pageInfo = getInfo(1001);
               include 'view/home.php';
        }
        
        
    
} elseif ($action == 'sources') {
     $pageInfo = getInfo(1006);
    include 'class/sources.php';
}

 elseif ($action == 'addMovie'){
     $pageInfo = getInfo(1009);
    include 'edit/addMovie.php';
 }

 elseif ($action == 'InsertMovie') {
     $title = valString($_POST['title']);
     $subtitle = valString($_POST['subtitle']);
     $rating = valNum((int)$_POST['rating']);     
     $specRating = valNum((float)$_POST['specRating']);
     $synopsis = valString($_POST['synopsis']);
     $review = valString($_POST['review']);
     $genre = valString($_POST['genre']);
     $director = valString($_POST['director']);
     $producer = valString($_POST['producer']);
     $releasedBy = valString($_POST['releasedBy']);
     $MPAA = valString($_POST['MPAA']);
     $length = valNum((int)$_POST['length']);
     $releaseDate = $_POST['releaseDate'];
     $url = valString($_POST['url']);
     $alt = valString($_POST['alt']);
     $embed = valString($_POST['embed']);
     
     if($rating == FALSE || $specRating == FALSE || $length == FALSE){
        $message = "Sorry, Insert was not successful, invalid values.";
        $pageInfo = getInfo(1009);
        include 'edit/addMovie.php';
     }
    
    $insertMovie = insertMovie($title, $subtitle, $rating, $specRating, $synopsis, $review, $genre, $director, 
            $producer, $releasedBy, $MPAA, $length, $releaseDate, $url, $alt, $embed);
    
    if($insertMovie == true){
        $message = "Insert was Succesful!";
        $pageInfo = getInfo(1009);
        include 'edit/addMovie.php';
    } else {
        $message = "Sorry, Insert was not successful";
        $pageInfo = getInfo(1009);
        include 'edit/addMovie.php';
    }
}

    elseif ($action == 'DeleteMovie' && isset($_GET['id'])) {
        $movieid = $_GET['id'];
        $movieInfo = getMovieInfo($movieid);
        include 'edit/warning.php';
    }
    
    elseif ($action == 'Delete' && isset($_GET['id'])) {
        $movieid = $_GET['id'];
        $deleted = deleteMovie($movieid);
        if($deleted){
            $pageInfo = getInfo(1004);
            $message = "Movie was deleted.";
            include 'view/months.php';
        } else {
            $pageInfo = getInfo(1004);
            $message = "There was an error, Movie was not deleted.";
            include 'view/months.php';
        }
    }
    
    elseif ($action == 'UpdateMovie' && isset($_GET['id'])) {
        $movieid = $_GET['id'];
        $movieInfo = getMovieInfo($movieid);
        $pageInfo = getInfo(1008);
        include 'edit/update.php';
    }
    
    elseif ($action == 'Update' && isset($_POST['id'])) {
        $movieid = $_POST['id'];
        $title = valString($_POST['title']);
        $subtitle = valString($_POST['subtitle']);
        $rating = valNum((int)$_POST['rating']);
        $specRating = valNum((float)$_POST['specRating']);
        $synopsis = valString($_POST['synopsis']);
        $review = valString($_POST['review']);
        $genre = valString($_POST['genre']);
        $director = valString($_POST['director']);
        $producer = valString($_POST['producer']);
        $releasedBy = valString($_POST['releasedBy']);
        $MPAA = valString($_POST['MPAA']);
        $length = valNum((int)$_POST['length']);
        $releaseDate = $_POST['releaseDate'];
        $url = valString($_POST['url']);
        $alt = valString($_POST['alt']);
        $embed = valString($_POST['embed']);
        
        if($rating == FALSE || $specRating == FALSE || $length == FALSE){
        $message = "Sorry, Update was not successful, invalid values.";
        $pageInfo = getInfo(1004);
        include 'edit/addMovie.php';
     }
        $updated = updateMovie($movieid, $title, $subtitle, $rating, $specRating, $synopsis, $review, $genre, $director, 
            $producer, $releasedBy, $MPAA, $length, $releaseDate, $url, $alt, $embed);
        if($updated){
            $message = "Movie was updated.";
            $pageInfo = getInfo(1004);
            include 'view/months.php';
        } else {
            $message = "There was an error, Movie was not updated.";
            $pageInfo = getInfo(1004);
            include 'view/months.php';
        }
    }
        
    elseif ($action == 'login') {
        $pageInfo = getInfo(1005);
        include 'view/login.php';
}

    elseif ($action == 'Login'){
        $email = cleanEmail($_POST['email']);
        $password = valString($_POST['password']);
        // Verify Email
        $user = loginUser($email);
        if(!$user || $email == FALSE){
            $message = "Email or password were incorrect, Please try again.";
            $pageInfo = getInfo(1005);
            include 'view/login.php';
            exit();
        } else {
        // Verify Password
        $hashedPassword = getPassword($email);
        $testPassword = $hashedPassword['password'];
        $test = comparePasswords($password, $testPassword);
        }
        if($test == FALSE){
            $message = "Email or password were incorrect, Please try again.";
            include 'view/login.php';
            exit();
        } else {
            $_SESSION['email'] = $user['email'];
            $_SESSION['admin'] = $user['admin'];
            $_SESSION['name']  = $user['first_name'];
            $_SESSION['last']  = $user['last_name'];
            $pageInfo = getInfo(1001);
            $message = "You are now logged in, Welcome back!";
            include 'view/home.php';
        }
    }

    elseif ($action == 'Register'){
        $firstName = valString($_POST['firstname']);
        $lastName = valString($_POST['lastname']);
        $email = cleanEmail($_POST['email']);
        $password = valString($_POST['password']);
        $password2 = valString($_POST['password2']);
        $user = loginUser($email);
        
        if($email == FALSE){
            $message = "Invalid email address.";
            $pageInfo = getInfo(1005);
            include 'view/login.php';
            exit();
        }elseif(!empty($user)){
            $message = "Email address already exists.";
            $pageInfo = getInfo(1005);
            include 'view/login.php';
            exit();
        }
        
        if($password == $password2){
            $hashedPassword = hashPassword($password);
        } else {
            $message = "Passwords do not match.";
            $pageInfo = getInfo(1005);
            include 'view/login.php';
            exit();
        }
        $registerSuccess = registerUser($firstName, $lastName, $email, $hashedPassword);
        if($registerSuccess == true){
            $_SESSION['email'] = $email;
            $_SESSION['admin'] = 'N';
            $_SESSION['name']  = $firstName;
            $_SESSION['last'] = $lastName;
            $pageInfo = getInfo(1001);
            $message = "Welcome to Trippy Rodeo, " . $firstName . "!";
            include 'view/home.php';
        }else {
            $message = "Error registering, please try again.";
            $pageInfo = getInfo(1005);
            include 'view/login.php';
            exit();
        }
    }
    
    elseif($action == 'signOut'){
        unset($_SESSION);
        session_destroy();
        $pageInfo = getInfo(1001);
        include 'view/home.php';
    }
    
    elseif ($action == 'changeInfo') {
        $email = $_SESSION['email'];
        $userInfo = getUserInfo($email);
        $pageInfo = getInfo(1007);
        include 'edit/changeInfo.php';
    }

    elseif ($action == 'editInfo') {
        $pageInfo = getInfo(1007);
        include 'edit/changeInfo.php';
    }
    
    elseif ($action == 'Delete Account') {
    $id = $_POST['id'];
    $delete = deleteUser($id);
    if($delete){
        if($_SESSION['admin'] == 'Y'){
        $email = $_SESSION['email'];
        $userInfo = getUserInfo($email);
        $message = "User was deleted.";
        $pageInfo = getInfo(1007);
        include 'edit/changeInfo.php';
        }elseif($_SESSION['admin'] == 'N'){
            unset($_SESSION);
            session_destroy();
            $message = "User Accont was deleted.";
            $pageInfo = getInfo(1001);
            include 'view/home.php';
        }
    } else {
        $email = $_SESSION['email'];
        $userInfo = getUserInfo($email);
        $message = "ERROR: User was not deleted.";
        $pageInfo = getInfo(1007);
        include 'edit/changeInfo.php';
    }
}

    elseif ($action == 'Delete Your Account') {
    $id = $_POST['id'];
    $delete = deleteUser($id);
    if($delete){
        unset($_SESSION);
        session_destroy();
        $message = "User Accont was deleted.";
        $pageInfo = getInfo(1001);
        include 'view/home.php';     
    } else {
        $email = $_SESSION['email'];
        $userInfo = getUserInfo($email);
        $message = "ERROR: User was not deleted.";
        $pageInfo = getInfo(1007);
        include 'edit/changeInfo.php';
    }
}

    elseif ($action == 'Update Account') {
        $id = $_POST['id'];
        $email = cleanEmail($_POST['email']);
        $firstName = valString($_POST['firstName']);
        $lastName = valString($_POST['lastName']);
        $admin = valString($_POST['admin']);
        $password = valString($_POST['password']);
        $hashedPassword = hashPassword($password);
        
        if($email == FALSE){
            $message = "Invalid email address.";
            $email = $_SESSION['email'];
            $userInfo = getUserInfo($email);
            $pageInfo = getInfo(1007);
            include 'edit/changeInfo.php';
        }
        
        $updateSuccess = updateUser($id, $email, $firstName, $lastName);
        if(isset($admin)){
        $updateAdminSuccess = updateAdmin($id, $admin);     
        }
        if(isset($password)){
            $updatePasswordSuccess = updatePassword($id, $hashedPassword);
        }
        if($updateSuccess || $updatePasswordSuccess || $updateAdminSuccess){
            $message = "Update was successful.";
            $email = $_SESSION['email'];
            
            $userInfo = getUserInfo($email);
            $pageInfo = getInfo(1007);
            include 'edit/changeInfo.php';
        } else {
            $message = "There was an error, Please try again.";
            $email = $_SESSION['email'];
            $userInfo = getUserInfo($email);
            $pageInfo = getInfo(1007);
            include 'edit/changeInfo.php';
        }
} elseif($action == 'siteplan'){
    $pageInfo = getInfo(1002);
    include 'class/siteplan.php';
}
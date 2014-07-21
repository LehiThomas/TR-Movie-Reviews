<?php

/*
 * This file is for all SQL statements and interaction with the database.
 */

try {
    require $_SERVER['DOCUMENT_ROOT'] . '/library/functions.php';
} catch (Exception $exc) {
    header('location: /errordocs/500.php');
    exit;
}

function getMovieInfo($movieid) {
    $connected = connection();

    try {
        $sql = "SELECT m.movie_id, m.title, m.subtitle, m.rating, m.spec_rating, m.synopsis, m.review, t.code,
                   i.director, i.produced_by, i.released_by, i.MPAA_rating, i.length, i.release_date, i.genre, s.url, s.alt
                FROM movie m
                JOIN info i ON m.movie_id = i.movie_id
                JOIN trailer t ON m.movie_id = t.movie_id
                JOIN images s ON m.movie_id = s.movie_id
                WHERE m.movie_id = :id";

        $stmt = $connected->prepare($sql);
        $stmt->bindValue(":id", $movieid, PDO::PARAM_INT);
        $stmt->execute();
        $movieInfo = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        return FALSE;
    }
    if (is_array($movieInfo)) {
        return $movieInfo;
    } ELSE {
        return FALSE;
    }
}

function getTitles($month) {
    $connected = connection();
    try {
        $sql = "SELECT m.movie_id, m.title, m.subtitle, i.release_date
                FROM movie m
                JOIN info i ON m.movie_id = i.movie_id
                WHERE MONTH(i.release_date) = :month
                ORDER BY i.release_date";

        $stmt = $connected->prepare($sql);
        $stmt->bindValue(":month", $month);
        $stmt->execute();
        $titles = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        return FALSE;
    }
    if (is_array($titles)) {
        return $titles;
    } ELSE {
        return FALSE;
    }
}

function bestMovies() {
    $connected = connection();
    try {
        $sql = "SELECT movie_id, title, subtitle, spec_rating
                FROM movie
                ORDER BY spec_rating DESC
                LIMIT 5";

        $stmt = $connected->prepare($sql);
        $stmt->execute();
        $titles = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        return FALSE;
    }
    if (is_array($titles)) {
        return $titles;
    } ELSE {
        return FALSE;
    }
}

function upComing() {
    $connected = connection();
    try {
        $sql = "SELECT m.movie_id, m.title, m.subtitle, i.release_date
                FROM movie m
                JOIN info i ON m.movie_id = i.movie_id
                WHERE i.release_date <= ADDDATE( CURDATE( ) , INTERVAL 1 MONTH ) 
                AND i.release_date >= CURDATE( ) 
                ORDER BY i.release_date";

        $stmt = $connected->prepare($sql);
        $stmt->execute();
        $titles = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        return FALSE;
    }
    if (is_array($titles)) {
        return $titles;
    } ELSE {
        return FALSE;
    }
}

function showDate($date) {
    $connected = connection();
    try {
        $sql = "SELECT DATE_FORMAT(:date,  '%e %M %Y')";

        $stmt = $connected->prepare($sql);
        $stmt->bindValue(":date", $date);
        $stmt->execute();
        $newDate = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        return FALSE;
    }
    if (is_array($newDate)) {
        return $newDate;
    } ELSE {
        return FALSE;
    }
}

function support($id){
      $connected = connection();

    try {
        $sql = "SELECT * FROM support
                WHERE support_id = :id";

        $stmt = $connected->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $pageInfo = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        return FALSE;
    }
    if (is_array($pageInfo)) {
        return $pageInfo;
    } ELSE {
        return FALSE;
    }
}


function insertMovie($title, $subtitle, $rating, $specRating, $synopsis, $review, $genre, $director, 
            $producer, $releasedBy, $MPAA, $length, $releaseDate, $url, $alt, $embed) {
   
    $connected = connection();

    try {
        $connected->beginTransaction();
        
        $sql1 = "INSERT INTO movie (title, subtitle, rating, spec_rating, synopsis, review)
                VALUES (:title, :subtitle, :rating, :specRating, :synopsis, :review)";

        $stmt = $connected->prepare($sql1);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':subtitle', $subtitle, PDO::PARAM_STR);
        $stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindValue(':specRating', $specRating, PDO::PARAM_INT);
        $stmt->bindValue(':synopsis', $synopsis, PDO::PARAM_STR);
        $stmt->bindValue(':review', $review, PDO::PARAM_STR);
        $stmt->execute();
        $movieID = $connected->lastInsertId();
        $updateSuccess1 = $stmt->rowCount();
        
        $sql2 = "INSERT INTO info (movie_id, genre, director, produced_by, released_by, MPAA_rating, length, release_date)
                VALUES ($movieID, :genre, :director, :producer, :releasedBy, :MPAA, :length, :releaseDate)";
        
        $stmt2 = $connected->prepare($sql2);
        $stmt2->bindValue(':genre', $genre, PDO::PARAM_STR);
        $stmt2->bindValue(':director', $director, PDO::PARAM_STR);
        $stmt2->bindValue(':producer', $producer, PDO::PARAM_STR);
        $stmt2->bindValue(':releasedBy', $releasedBy, PDO::PARAM_STR);
        $stmt2->bindValue(':MPAA', $MPAA, PDO::PARAM_STR);
        $stmt2->bindValue(':length', $length, PDO::PARAM_INT);
        $stmt2->bindValue(':releaseDate', $releaseDate);
        $stmt2->execute();
        $updateSuccess2 = $stmt2->rowCount();
        
        
        $sql3 = "INSERT INTO images (movie_id, url, alt)
                VALUES ($movieID, :url, :alt)";
        
        $stmt3 = $connected->prepare($sql3);
        $stmt3->bindValue(':url', $url, PDO::PARAM_STR);
        $stmt3->bindValue(':alt', $alt, PDO::PARAM_STR);
        $stmt3->execute();
        $updateSuccess3 = $stmt3->rowCount();
        
        
        $sql4 = "INSERT INTO trailer (movie_id, code)
                VALUES ($movieID, :embed)";
        
        $stmt4 = $connected->prepare($sql4);
        $stmt4->bindValue(':embed', $embed, PDO::PARAM_STR);
        $stmt4->execute();
        $updateSuccess4 = $stmt4->rowCount();

        $stmt->closeCursor();
        $connected->commit();
    } catch (Exception $e) {
        $connected->rollBack();
        return FALSE;
    }
    if($updateSuccess1 == 1 || $updateSuccess2 == 1 || $updateSuccess3 == 1 || $updateSuccess4 == 1){
        return true;
    } else {
        return false;
    }
}


function deleteMovie($id){
    $connected = connection();
    try {
        $connected->beginTransaction();
        
        $sql1 = "DELETE FROM info
                 WHERE movie_id = :id";
        $stmt = $connected->prepare($sql1);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $updateSuccess1 = $stmt->rowCount();
        
        $sql2 = "DELETE FROM images
                 WHERE movie_id = :id";
        $stmt2 = $connected->prepare($sql2);
        $stmt2->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt2->execute();
        $updateSuccess2 = $stmt2->rowCount();
        
        $sql3 = "DELETE FROM trailer
                 WHERE movie_id = :id";
        $stmt3 = $connected->prepare($sql3);
        $stmt3->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt3->execute();
        $updateSuccess3 = $stmt3->rowCount();
        
        $sql4 = "DELETE FROM movie
                 WHERE movie_id = :id";
        $stmt4 = $connected->prepare($sql4);
        $stmt4->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt4->execute();
        $updateSuccess4 = $stmt4->rowCount();
        
        $stmt->closeCursor();
        $connected->commit();
    } catch (Exception $e) {
        $connected->rollBack();
        return FALSE;
    }
    if($updateSuccess1 == 1 && $updateSuccess2 == 1 && $updateSuccess3 == 1 && $updateSuccess4 == 1){
        return true;
    } else {
        return false;
    }
}


function updateMovie($id, $title, $subtitle, $rating, $specRating, $synopsis, $review, $genre, $director, 
            $producer, $releasedBy, $MPAA, $length, $releaseDate, $url, $alt, $embed) {
   
    $connected = connection();

    try {
        $connected->beginTransaction();
        $sql1 = "UPDATE movie 
                SET title = :title, subtitle = :subtitle, rating = :rating, spec_rating = :specRating, synopsis = :synopsis, review = :review
                WHERE movie_id = :id";

        $stmt = $connected->prepare($sql1);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':subtitle', $subtitle, PDO::PARAM_STR);
        $stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindValue(':specRating', $specRating, PDO::PARAM_INT);
        $stmt->bindValue(':synopsis', $synopsis, PDO::PARAM_STR);
        $stmt->bindValue(':review', $review, PDO::PARAM_STR);
        $stmt->execute();
        $updateSuccess1 = $stmt->rowCount();
        
        $sql2 = "UPDATE info 
                SET genre = :genre, director = :director, produced_by = :producer, 
                released_by = :releasedBy, MPAA_rating = :MPAA, length = :length, release_date = :releaseDate
                WHERE movie_id = :id";
        
        $stmt2 = $connected->prepare($sql2);
        $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt2->bindValue(':genre', $genre, PDO::PARAM_STR);
        $stmt2->bindValue(':director', $director, PDO::PARAM_STR);
        $stmt2->bindValue(':producer', $producer, PDO::PARAM_STR);
        $stmt2->bindValue(':releasedBy', $releasedBy, PDO::PARAM_STR);
        $stmt2->bindValue(':MPAA', $MPAA, PDO::PARAM_STR);
        $stmt2->bindValue(':length', $length, PDO::PARAM_INT);
        $stmt2->bindValue(':releaseDate', $releaseDate);
        $stmt2->execute();
        $updateSuccess2 = $stmt2->rowCount();
        
        
        $sql3 = "UPDATE images 
                SET url = :url, alt = :alt
                WHERE movie_id = :id";
        
        $stmt3 = $connected->prepare($sql3);
        $stmt3->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt3->bindValue(':url', $url, PDO::PARAM_STR);
        $stmt3->bindValue(':alt', $alt, PDO::PARAM_STR);
        $stmt3->execute();
        $updateSuccess3 = $stmt3->rowCount();
        
        
        $sql4 = "UPDATE trailer 
                SET code = :embed
                WHERE movie_id = :id";
        
        $stmt4 = $connected->prepare($sql4);
        $stmt4->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt4->bindValue(':embed', $embed, PDO::PARAM_STR);
        $stmt4->execute();
        $updateSuccess3 = $stmt3->rowCount();

        $stmt->closeCursor();
        $connected->commit();
    } catch (Exception $e) {
        $connected->rollBack();
        return FALSE;
    }
    if($updateSuccess1 == 1 || $updateSuccess2 == 1 || $updateSuccess3 == 1 || $updateSuccess4 == 1){
        return true;
    } else {
        return false;
    }
}

function registerUser($firstName, $lastName, $email, $hashedPassword){
    $connected = connection();

    try {
        
        $sql = "INSERT INTO user (email, password, first_name, last_name)
                VALUES (:email, :password, :first, :last)";

        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':first', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last', $lastName, PDO::PARAM_STR);
        $stmt->execute();
        
        $registerSuccess = $stmt->rowCount();
        $stmt->closeCursor();
    } catch (Exception $e) {
        return FALSE;
    }
    if ($registerSuccess) {
        return $registerSuccess;
    } ELSE {
        return FALSE;
    }
}

function loginUser($email){
    $connected = connection();
    $sql = "SELECT *
            FROM user
            WHERE email = :email";
    
     $stmt = $connected->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    
    $stmt->execute();
    $user = $stmt->fetch();
    $stmt->closeCursor();
    
    if(is_array($user)){
        return $user;
    } ELSE {
        return FALSE;
    }
}

function getPassword($email){
    $connected = connection();
    $sql = "SELECT password
            FROM user
            WHERE email = :email";
    
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    
    $stmt->execute();
    $password = $stmt->fetch();
    $stmt->closeCursor();
    
    if(is_array($password)){
        return $password;
    } ELSE {
        return FALSE;
    }
}

function getUserInfo($email){
    $connected = connection();
    $sql = "SELECT *
            FROM user
            WHERE email = :email";
    
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $info = $stmt->fetch();
    $stmt->closeCursor();
    
    if(is_array($info)){
        return $info;
    } ELSE {
        return FALSE;
    }
}

function getAllUsers(){
     $connected = connection();
    $sql = "SELECT *
            FROM user";
    
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $info = $stmt->fetchAll();
    $stmt->closeCursor();
    
    if(is_array($info)){
        return $info;
    } ELSE {
        return FALSE;
    }
}

function deleteUser($id){
    $connected = connection();
    try {
        
        $sql = "DELETE FROM user
                 WHERE user_id = :id";
        
        $stmt = $connected->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $deleted = $stmt->rowCount();
        
        $stmt->closeCursor();
    } catch (PDOException $e) {
        return FALSE;
    }
    if($deleted == 1){
        return true;
    } else {
        return false;
    }
}

function updateUser($id, $email, $firstName, $lastName) {
    $connected = connection();

    try {
        $sql = "UPDATE user 
                SET email = :email, first_name = :firstname, last_name = :lastname
                WHERE user_id = :id";

        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':firstname', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lastName, PDO::PARAM_STR);
        $stmt->execute();
        $updateSuccess = $stmt->rowCount();

        $stmt->closeCursor();
    } catch (PDOException $e) {
        return FALSE;
    }
    if ($updateSuccess > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function updatePassword($id, $hashedPassword) {
   
    $connected = connection();

    try {
        $sql1 = "UPDATE user 
                SET password = :password
                WHERE user_id = :id";

        $stmt = $connected->prepare($sql1);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->execute();
        $updateSuccess = $stmt->rowCount();

        $stmt->closeCursor();
    } catch (Exception $e) {
        return FALSE;
    }
    if ($updateSuccess) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function updateAdmin($id, $admin) {
   
    $connected = connection();

    try {
        $sql = "UPDATE user 
                SET admin = :admin
                WHERE user_id = :id";

        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':admin', $admin, PDO::PARAM_STR);
        $stmt->execute();
        $updateSuccess = $stmt->rowCount();

        $stmt->closeCursor();
    } catch (Exception $e) {
        return FALSE;
    }
    if ($updateSuccess) {
        return $updateSuccess;
    } else {
        return FALSE;
    }
}

function insertComment($movieid, $userName, $title, $comment){
    $connected = connection();

    try {
        
        $sql = "INSERT INTO comments (movie_id, username, title, comment, date)
                VALUES (:id, :username, :title, :comment, NOW())";

        $stmt = $connected->prepare($sql);
        $stmt->bindValue(":id", $movieid, PDO::PARAM_INT);
        $stmt->bindValue(':username', $userName, PDO::PARAM_STR);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
        $stmt->execute();
        
        $registerSuccess = $stmt->rowCount();
        $stmt->closeCursor();
    } catch (Exception $e) {
        return FALSE;
    }
    if ($registerSuccess) {
        return TRUE;
    } ELSE {
        return FALSE;
    }
}

function getAllComments($movieid){
     $connected = connection();
    $sql = "SELECT *
            FROM comments
            WHERE movie_id = :id
            ORDER BY date DESC";
    
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':id', $movieid, PDO::PARAM_STR);
    $stmt->execute();
    $info = $stmt->fetchAll();
    $stmt->closeCursor();
    
    if(is_array($info)){
        return $info;
    } ELSE {
        return FALSE;
    }
}
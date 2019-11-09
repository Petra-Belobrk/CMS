<?php

function insert_categories() {
    global $connection;
    if(isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
            echo "<div class='alert alert-danger' role='alert'>This field should NOT be empty!</div>";
        } else {
            $user_id = loggedInUserId();
            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title, user_id) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, 'si', $cat_title, $user_id);
            mysqli_stmt_execute($stmt);

            confirmQuery($stmt);
        }
    }
}

function findAllCategories() {
global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";

    }
}

function deleteCategories() {
    global $connection;
    if(isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function redirect($location){


    header("Location:" . $location);
    exit;

}

function escape($string) {

    global $connection;

    return mysqli_real_escape_string($connection, trim(strip_tags($string)));


}

function confirmQuery($result) {

    global $connection;

    if(!$result ) {

        die("QUERY FAILED ." . mysqli_error($connection));


    }


}

function users_online(){

    if(isset($_GET['onlineusers'])) {

    global $connection;
    if(!$connection) {
        session_start();
        include("../includes/db.php");

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL) {
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
        } else {
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
        }
        $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
        echo $count_user = mysqli_num_rows($users_online);

    }


}
}

function recordCount($table){
    global $connection;

    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_posts);

    confirmQuery($result);

    return $result;
}

function checkStatus($table, $column, $status){
    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$status'" ;
    $result = mysqli_query($connection, $query);

    return mysqli_num_rows($result);
}

function checkUserRole($role) {
    global $connection;

    $query = "SELECT * FROM users WHERE user_role = '$role'" ;
    $result = mysqli_query($connection, $query);

    return mysqli_num_rows($result);

}

function is_admin() {
if(isLoggedIn()){
$user_id = $_SESSION['user_id'];
$result = query("SELECT user_role FROM users WHERE user_id = '$user_id'");

    $row = fetchRecords($result);
    if($row['user_role'] == 'admin') {
        return true;
    } else {
        return false;
    }
}
return false;

}

function username_exists($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }

}

function email_exists($email){
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }

}

function register_user($username, $email, $password) {
    global $connection;

            $username = escape($username);
            $email = escape($email);
            $password = escape($password);
            $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
            $query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber' )";
            $register_user_query = mysqli_query($connection, $query);
            confirmQuery($register_user_query);

}

function login_user($username, $password) {
    global $connection;

    $username = trim(escape($username));
    $password = trim(escape($password));

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    confirmQuery($select_user_query);

    while($row = mysqli_fetch_array($select_user_query)) {
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

        if(password_verify($password, $db_password)) {
            if(session_status() == PHP_SESSION_NONE) session_start();

            $_SESSION['user_id'] = $db_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['loginTime'] = new DateTime(date('y-m-d h:i:s'));

            redirect('../admin/');

        } else {
            return false;
        }

    }
    return true;

}

function isItIsMethod($method=null) {
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
        return true;
    } else {
        return false;

    }
}

function isLoggedIn(){

    if(isset($_SESSION['user_role'])){

        return true;


    }


    return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null) {
    if(isLoggedIn()) {
        redirect($redirectLocation);
    }
}

function currentUser(){
    if(isset($_SESSION['username'])) {
        return $_SESSION['username'];
    }
}

function imagePlaceholder($image=null){
    if(!$image){
        return 'https://via.placeholder.com/300';
    } else {
        return 'images/' . $image;
    }
}

function loggedInUserId(){
    if(isLoggedIn()){
        $result = query("SELECT * FROM users WHERE username='" . $_SESSION['username'] ."'");
        confirmQuery($result);
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;
    }
    return false;
}

function userLikedThisPost($post_id=''){
    $result = query("SELECT * FROM likes WHERE user_id=" . loggedInUserId() . " AND post_id=$post_id");
    return mysqli_num_rows($result) >= 1 ? true : false;
}

function query($query){
    global $connection;
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function getPostlikes($post_id){
   $result = query("SELECT * FROM likes WHERE post_id=$post_id");
   confirmQuery($result);
   echo mysqli_num_rows($result);
}

function fetchRecords($result) {
    return mysqli_fetch_array($result);
}

function is_the_logged_in_user_owner($post_id){
    $result = query("SELECT user_id FROM posts WHERE post_id={$post_id} AND user_id=".loggedInUserId()."");
    return count_records($result) >= 1 ? true : false;
}

function get_all_user_posts(){
    $user_id = loggedInUserId();
    return query("SELECT * FROM posts WHERE user_id=$user_id");
}

function get_all_user_categories(){
    return query("SELECT * FROM categories WHERE user_id=".loggedInUserId()."");
}

function get_all_user_published_posts(){
    return query("SELECT * FROM posts WHERE user_id=".loggedInUserId()." AND post_status='published'");
}

function get_all_user_draft_posts(){
    return query("SELECT * FROM posts WHERE user_id=".loggedInUserId()." AND post_status='draft'");
}


function get_all_user_approved_posts_comments(){
    return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id = comments.comment_post_id
    WHERE user_id=".loggedInUserId()." AND comment_status='approved'");
}


function get_all_user_denied_posts_comments(){
    return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id = comments.comment_post_id
    WHERE user_id=".loggedInUserId()." AND comment_status='denied'");
}

function count_records($result){
    return mysqli_num_rows($result);
}







users_online();


<?php
include "../includes/db.php";
session_start();
$username = $_SESSION['username'];

$difference= $_SESSION['loginTime']->diff(new DateTime(date('y-m-d h:i:s')));
$diff = $difference->s;

$query = "UPDATE users SET user_session = {$diff} ";
$query .= "WHERE username = '{$username}' ";
$session_insert_query = mysqli_query($connection, $query);
if(!$session_insert_query) {
    die("QUERY FAILED " . mysqli_error($connection));
}



$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;

header("Location: ../index.php");
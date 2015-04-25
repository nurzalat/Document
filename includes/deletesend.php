<?php
session_start();
require_once("connection.php");
$nick = $_SESSION['session_username'];
$message = $_POST['message'];
$date = $_POST['maildate'];
$query = mysqli_query($con,"DELETE FROM mailboxsend WHERE date='$maildate'");
if (!$query) {
    die('Invalid query: ' . mysqli_error($con));
}
echo '<p><label>Nick:</label></p>'.$nick.'<br />';
echo '<p><label>Date:</label></p>'.$maildate.'<br />';
?>
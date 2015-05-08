<?php
session_start();
require_once("connection.php");
$nick = $_SESSION['session_username'];
$value = $_POST['value'];
$date = $_POST['maildate'.$value];

$query = mysqli_query($con,"DELETE FROM mailboxreceive WHERE date='$date'");
if (!$query) {
    die('Invalid query: ' . mysqli_error($con));
}
echo '<p><label>Nick:</label></p>'.$nick.'<br />';
echo '<p><label>Date:</label></p>'.$date.'<br />';
?>
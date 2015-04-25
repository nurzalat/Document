<?php
function db_connect()
{
    $connect = new mysqli('localhost','root','','sqlproject');
    if(!$connect)
        throw new Exception('Could not connect to database server.');
    else
        return $connect;
}
$oldpass=$_POST['oldpass'];
$password=$_POST['password'];
$confirm=$_POST['confirm'];
$conn = db_connect();
session_start();
$username=$_SESSION['session_username'];
$result ="select password from usertable where username='$username'";
$sql = mysqli_query($conn,$result);
$resultmode = mysqli_fetch_assoc($sql);
if (!$result) {
    throw new Exception('Could not execute query.');
}
if ((MD5($oldpass) != $resultmode['password'])){
    throw new Exception('Password you entered does not match.'
    .'Please go back and try again.');
}
if ($password != $confirm){
    throw new Exception('New passwords are not the same.'
    .'Please go back and try again.');
}
elseif((MD5($oldpass) == $resultmode['password']) && ($password == $confirm)){
    $retval = "update usertable set password=MD5('$password') where username='$username'";
    $query = mysqli_query($conn,$retval);
    header("Location: intropage.php");
}
?>
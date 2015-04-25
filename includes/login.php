<?php
session_start();
require_once("connection.php");
if(isset($_POST["username"]) && isset($_POST["password"])){

    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $query = mysqli_query($con,"SELECT * FROM usertable WHERE username='".$username."' AND password='".MD5($password)."'");
        if (!$query) {
            die('Invalid query: ' . mysqli_error($con));
        }
        $numrows = mysqli_num_rows($query);
        if($numrows!=0)
        {
            while($row=mysqli_fetch_assoc($query))
            {
                $dbusername=$row['username'];
                $dbpassword=$row['password'];
            }
            if($username == $dbusername && MD5($password) == $dbpassword)
            {
                // старое место расположения
                //  session_start();
                $_SESSION['session_username']=$username;
                /* Перенаправление браузера */
                header("Location: intropage.php");
            }
        } else {
            //  $message = "Invalid username or password!";

            echo  "Invalid username or password!";
        }
    }
    else {
        $message = "All fields are required!";
    }
}
?>
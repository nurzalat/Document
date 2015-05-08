<?php require_once("connection.php");
session_start();
$email = $_POST['email'];
$name = $_POST['name'];
$fname = $_POST['surname'];
$nick = $_POST['nick'];
$option = isset($_POST['curator']) ? $_POST['curator'] : false;
try {
    function filled_out($form_vars)
    {
        foreach ($form_vars as $key => $value) {
            if (!isset($key) || ($value == ''))
                return false;
        }
        return true;
    }

    function valid_email($address)
    {
        if (preg_match('/^[a-zA-Z0-9 \._\-]+@([a-zA-Z0-9][a-zA-Z0-9\-]*\.)+[a-zA-Z]+$/', $address))
            return true;
        else
            return false;
    }
    function db_connect()
    {
        $connect = new mysqli('localhost','root','','sqlproject');
        if(!$connect)
            throw new Exception('Could not connect to database server.');
        else
            return $connect;
    }

    function register($firstname, $lastname, $mail, $username, $option)
    {
        $conn = db_connect();
        $result = $conn->query("select * from usertable where username='$username'");
        $resultmode = mysqli_fetch_assoc($result);
        if (!$result) {
            throw new Exception('Could not execute query.');
        }
        if(($resultmode['username']!=$_SESSION['session_username'])&&($result->num_rows > 0)){
            throw new Exception('That username is taken.'
                . 'Please go back and choose another one.');
        }
        $sessionuser = $_SESSION['session_username'];
        $sql = "UPDATE `usertable` SET `name`='$firstname',`surname`='$lastname',`email`='$mail',`username`='$username',`manage`='$option' WHERE `username`='$sessionuser'";
        $results = mysqli_query($conn,$sql);
        if (!$results) {
            throw new Exception('Could not change your info in database.'
                . 'Please try again later.'.mysqli_error($conn));
        }
        return true;
    }
    if (!filled_out($_POST)) {
        throw new Exception('You have not filled the form out correctly '
            . '- please go back and try again.');
    }
    if (!valid_email($email)) {
        throw new Exception('That is not valid email address.'
            . 'please go back and try again.');
    }
    if($option != (-1)) {
        echo htmlentities($_POST['curator'], ENT_QUOTES, "UTF-8");
        echo $option;
    } else {
        echo "task option is required";
        exit;
    }
    if (strlen($nick) > 16) {
        throw new Exception('Your username must be less than 17 characters long.'
            . 'Please go back and try again.');
    }
    register($name, $fname, $email, $nick, $option);
    $_SESSION['session_username'] = $nick;
    header("Location: intropage.php");
}
catch (Exception $e)
{
    echo $e->getMessage();
    exit;
}
?>
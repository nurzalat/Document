<?php
session_start();
require_once("connection.php");
$username = $_SESSION['session_username'];
$subject = $_POST['subject'];
$date = date('Y-m-d H:i:s');
$message = $_POST['message'];

try {
    function filled_out($form_vars)
    {
        foreach ($form_vars as $key => $value) {
            if (!isset($key) || ($value == ''))
                return false;
        }
        return true;
    }
    function db_connect()
    {
        $connect = new mysqli('localhost','root','','sqlproject');
        if(!$connect)
            throw new Exception('Could not connect to database server.');
        else
            return $connect;
    }

    function send_mail($mail, $nick, $to, $mailsub, $dt)
    {
        $connect = db_connect();
        $sql1 = "insert into docbox (document, sendinguser, receivinguser, subject, date) values ('$mail','$nick','$to','$mailsub','$dt')";
        $result1 = mysqli_query($connect, $sql1);
        if (!$result1 ) {
            throw new Exception('Could not send your document.'
                . 'Please try again later.' . mysqli_error($connect));
        }
        return true;
    }
    if (!filled_out($_POST)) {
        throw new Exception('You have not filled the form out correctly '
            . '- please go back and try again.');
    }
    $conn = db_connect();
    $sqlquery ="select manage from usertable where username='$username'";
    $standard = mysqli_query($conn, $sqlquery);
    $standardmode = mysqli_fetch_assoc($standard);
    $touser = $standardmode['manage'];
    send_mail($message,$username,$touser,$subject,$date);
    header("Location: intropage.php");
}
catch (Exception $e)
{
    echo $e->getMessage();
    exit;
}
?>
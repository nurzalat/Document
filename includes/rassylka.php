<?php
session_start();
function db_connect()
{
    $connect = new mysqli('localhost','root','','sqlproject');
    if(!$connect)
        throw new Exception('Could not connect to database server.');
    else
        return $connect;
}
$conn = db_connect();
$username = $_SESSION['session_username'];
$result ="select * from usertable where username='$username'";
$sqlquery ="select name, surname from usertable where username='$username'";
$sql = mysqli_query($conn,$result);
$standard = mysqli_query($conn,$sqlquery);
$resultmode = mysqli_fetch_assoc($sql);
$standardmode = mysqli_fetch_assoc($standard);
$manname = $standardmode['name'];
$mansurname = $standardmode['surname'];
$manfullname = $manname." ".$mansurname;
if ($resultmode['job']<3){
    $standardquery ="select username from usertable where manage='$manfullname'";
    $managerquery = $conn->query($standardquery);
    while ($row = $managerquery->fetch_assoc()) {
        $managermode[] = $row;
    }
}
if (!$result) {
    throw new Exception('Could not execute query.');

}

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
    function send_mail($mail, $nick, $to, $mailsub, $dt)
    {
        $conn = db_connect();
        $result = $conn->query("select * from usertable where username='$to'");
        if (!$result) {
            throw new Exception('Could not execute query.');
        }
        if ($result->num_rows < 0) {
            throw new Exception('Could not find that user.'
                . 'Please go back and try to type in other username again.');
        }
        if ($result->num_rows > 0) {
            $sql1 = "insert into mailboxreceive (message,fromuser,touser,subject,date) values ('$mail', '$nick', '$to', '$mailsub', '$dt')";
            $result1 = mysqli_query($conn, $sql1);
            $sql2 = "insert into mailboxsend (message,fromuser,touser,subject,date) values ('$mail', '$nick', '$to', '$mailsub', '$dt')";
            $result2 = mysqli_query($conn, $sql2);
            if (!$result1 || !$result2) {
                throw new Exception('Could not send your message.'
                    . 'Please try again later.' . mysqli_error($conn));
            }
            return true;
        }
    }
    if (!filled_out($_POST)) {
        throw new Exception('You have not filled the form out correctly '
            . '- please go back and try again.');
    }
    $i=0;
    while(sizeof($managermode)>$i) {
        $to = $managermode[$i]['username'];
        send_mail($message,$username,$to,$subject,$date);
        $i++;
    }
    header("Location: intropage.php");
}
catch (Exception $e)
{
    echo $e->getMessage();
    exit;
}
?>
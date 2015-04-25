<?php require_once("connection.php");?>
<?php
$email = $_POST['email'];
$name = $_POST['name'];
$fname = $_POST['surname'];
$nick = $_POST['nick'];
$job = $_POST['job'];
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
        if (!$result) {
            throw new Exception('Could not execute query.');
        }
        if ($result->num_rows > 0) {
            throw new Exception('That username is taken.'
                . 'Please go back and choose another one.');
        }
        $sql = "insert into usertable (name,surname,email,username,password,job) values ('$firstname','$lastname','$mail','$username','$option')";
        $result = mysqli_query($conn,$sql);
        if (!$result) {
            throw new Exception('Could not register you in database.'
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
    if (strlen($nick) > 16) {
        throw new Exception('Your password must be less than 17 characters long.'
            . 'Please go back and try again.');
    }
    register($name, $fname, $email, $nick,$option);
    session_start();
    $_SESSION['session_username'] = $nick;
    header("Location: intropage.php");
}
catch (Exception $e)
{
    echo $e->getMessage();
    exit;
}
?>
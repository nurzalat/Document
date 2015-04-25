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
$sql = mysqli_query($conn,$result);
$resultmode = mysqli_fetch_assoc($sql);
if (!$result) {
    throw new Exception('Could not execute query.');
}
switch($resultmode['job']){
    case 0; $job = 'Decane';break;
    case 1; $job = 'Head of department';break;
    case 2; $job = 'Teacher';break;
    case 3; $job = 'Student';break;
    default; $job = 'Empty';break;
}
switch($resultmode['faculty']){
case 1; $faculty = 'Computer Engineering';break;
case 2; $faculty = 'Chemical Engineering';break;
case 3; $faculty = 'Food Engineering';break;
case 4; $faculty = 'Ecological Engineering';break;
default; $faculty = 'Empty';break;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Страница приветствия - Сайт Контроля Документооборота</title>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel ="shortcut icon" href= "favicon.ico" />
    <link href="../css/main.css" rel="stylesheet" media="screen">
    <style>
        ul.rega{
            width:400px;
        }

        ul.rega li{
            float:left;
            width:150px;
            list-style:none;
        }

        ul.rega li.in{
            width:250px;
            list-style:none;
        }
    </style>
</head>
<body>
<div id="topmenu">
    <a href="../index.html">Авторизация</a> |
    <a href="../files/register.html">Регистрация</a>
</div> <!-- Конец powered -->
<img src="../images/logo.png" id="right_text" height="80px" width="80px" />
<header id="header">
    <h2 color="white">ManasCloud </h2>
</header>
<div id="columns">
    <div id="left">
        <aside class= "sidebar-left">
            <ul>
                <li><a href="logout.php">Выйти</a></li>
                <li><a href="../files/changepass.html">Новый пароль</a></li>
                <li><a href="../files/document.html">Написать</a></li>
                <li><a href="../files/mailbox.html">Почта</a></li>
            </ul>
        </aside>
    </div><!-- Конец левой колонки -->
    <div id="center">
        <fieldset>
            <legend><h1 align="left">Страница пользователя</h1></legend>
            <form action="useredit.php" method="post" name="form1">
                <ul class="rega">
                    <li><label>Имя:</label></li>
                    <li class="in"><input disabled="true" type="text" name="name" maxlength="20" value="<?php echo $resultmode['name']?>"></li>
                </ul>
                <ul class="rega">
                    <li><label>Фамилия:</label></li>
                    <li class="in"><input disabled="true" type="text" name="surname" maxlength="20" value="<?php echo $resultmode['surname']?>"></li>
                </ul>
                <ul class="rega">
                    <li><label>Email:</label></li>
                    <li class="in"><input disabled="true" type="text" name="email" maxlength="20" value="<?php echo $resultmode['email']?>"></li>
                </ul>
                <ul class="rega">
                    <li><label>Имя пользователя:</label></li>
                    <li class="in"><input disabled="true" type="text" name="nick" maxlength="20" value="<?php echo $resultmode['username']?>"></li>
                </ul>
                <ul class="rega">
                    <li><label>Занятие:</label></li>
                    <li class="in"><input disabled="true" type="text" name="job" maxlength="20" value="<?php echo $job?>"></li>
                </ul>
                <ul class="rega">
                    <li><label>Факультет:</label></li>
                    <li class="in"><input disabled="true" type="text" name="job" maxlength="20" value="<?php echo $faculty?>"></li>
                </ul>
                <ul class="rega">
                    <li><label>Куратор:</label></li>
                    <li class="in"><input disabled="true" type="text" name="job" maxlength="20" value="null"></li>
                </ul>
                <ul class="rega">
                    <li class="in"><button type="accept" value="Edit" width="60px" height="20px">Edit</button></li>
                </ul>
            </form>
        </fieldset>

    </div> <!-- Конец центральной колонки -->


    <div id="right">
        <aside class="sidebar-right">

        </aside>
    </div> <!-- Конец правой колонки -->


</div> <!-- Конец id="columns" -->
<div id="footer"> <!-- Начало подвала -->
</div> <!-- Конец подвала -->

<div id="powered">

    <a href="../index.html">Авторизация</a> |
    <a href="../files/register.html">Регистрация</a><span>Команда <b>Oakmond Group</b> :: Сделано на <a href="http://www.symfony.com">Symfony2</a>  © Все права защищены </span>
</div>
</div>
</body>
</html>

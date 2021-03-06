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
$query = "select * from docbox where receivinguser='$username' OR sendinguser='$username'";
$results_array = array();
$sqlresult = $conn->query($query);
while ($row = $sqlresult->fetch_assoc()) {
    $results_array[] = $row;
}
if (!$query) {
    throw new Exception('Could not execute query.');
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
    <a href="logout.php">Выйти</a>
</div> <!-- Конец powered -->
<img src="../images/logo.png" id="right_text" height="80px" width="80px" />
<header id="header">
    <h2 color="white">ManasCloud </h2>
</header>
<div id="columns">
    <div id="left">
        <aside class= "sidebar-left">
            <ul>
                <li><a href="../files/docbox.html">Документооборот</a></li>
                <li><a href="formdata.php">Личный кабинет</a></li>
                <li><a href="../files/changepass.html">Новый пароль</a></li>
                <li><a href="../files/document.html">Написать</a></li>
                <li><a href="../files/mailbox.html">Почта</a></li>
                <li><a href="../files/rassylka.html">Рассылка</a></li>
            </ul>
        </aside>
    </div><!-- Конец левой колонки -->
    <div id="center">
        <fieldset>
            <legend><h1 align="left">Архив документооборота</h1></legend>
            <form action="deletereceive.php" method="post">
                <?php
                $i = 0;
                while(sizeof($results_array)>$i){
                    $date = $results_array[$i]['date'];
                    echo '<fieldset><legend><h2 align="left">'.$results_array[$i]['subject'].'</h2></legend>'
                        .'<style>ul.rega{  width:400px;  }  ul.rega li{  float:left;  width:150px;  list-style:none;  }  ul.rega li.in{  width:250px;  list-style:none;  }</style>'
                        .'<ul class="rega">'
                        .'<li><label>От кого:</label></li><li class="in"><input type="text" name="fromuser" disabled="true" value="'.$results_array[$i]['sendinguser'].'"><br /></li></ul><ul class="rega">'
                        .'<li><label>Документ:</label></li><li class="in"><textarea name="message" disabled="true" cols="45" rows="7">'.$results_array[$i]['document'].'</textarea><br /></li></ul><ul class="rega">'
                        .'<li><label>Дата:</label></li><li class="in"><input type="text" name="maildate" disabled="true" value="'.$results_array[$i]['date'].'"></li></ul><ul class="rega">'
                        .'<li><label>Статус:</label></li><li class="in"><input type="text" name="status" disabled="true" value="'.$results_array[$i]['status'].'"></li></ul><ul class="rega">'
                        .'</fieldset>';
                    $i++;
                }
                ?>
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

    <a href="logout.php">Выйти</a><span>Команда <b>Oakmond Group</b> :: Сделано на <a href="http://www.symfony.com">Symfony2</a>  © Все права защищены </span>
</div>
</div>
</body>
</html>

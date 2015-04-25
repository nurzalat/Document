<!-- /src/YourIdentifier/YourBundle/Resources/views/Page/static/base2.html.twig -->
<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Добро пожаловать - Сайт Контроля Документооборота</title>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel ="shortcut icon" href= "favicon.ico" />
    <link href="../css/main.css" rel="stylesheet" media="screen">
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
                <li><a href="formdata.php">Личный кабинет</a></li>
                <li><a href="../files/document.html">Написать</a></li>
                <li><a href="../files/changepass.html">Новый пароль</a></li>
                <li><a href="../files/mailbox.html">Почта</a></li>
            </ul>
        </aside>
    </div><!-- Конец левой колонки -->
    <div id="center">
        <div id="loginform">
            <section class= "main">
                <fieldset>
                    <div id="welcome">
                        <h2>Добро пожаловать, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
                        <p><a href="logout.php">Выйти</a> из системы</p>
                    </div>
                </fieldset>
            </section>
        </div>
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

</body>
</html>
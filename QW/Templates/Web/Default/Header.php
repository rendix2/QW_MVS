<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>QW :: <?= $this->getPageName(); ?> </title>
    <link rel="stylesheet" href="./Templates/Web/Default/css/Deafult.css">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta charset="UTF-8">

</head>
<body>
<div class="header">
    <span><a href="Index">Home</a></span>
    <span><a href="Help">Help</a></span>

    <?php

    use QW\FW\SuperGlobals\Session;

    if ( Session::get( 'logged' ) == TRUE ): ?>
        <span><a href="./User/logout">Logout</a></span>
    <?php else : ?>
        <span><a href="./User/login">Login</a></span>
    <? endif; ?>

</div>


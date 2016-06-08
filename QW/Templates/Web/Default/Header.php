<?php

    use QW\FW\Utils\SuperGlobals\Session;
    use QW\Libs\Config;

?>

<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>QW :: <?=

            $this->getPageName (); ?> </title>
    <link rel="stylesheet" type="text/css"
          href="<?= Config::URL . \QW\FW\Config::URL_DELIMITER ?>QW/Templates/Web/Default/css/Default.css">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta charset="UTF-8">

</head>
<body>
<div class="header">
    <span><a href="<?= Config::URL ?>/Index">Home</a></span>
    <span><a href="<?= Config::URL ?>/Help">Help</a></span>
    <?php

        Session::start ();

        if ( Session::get ( 'logged' ) == TRUE ): ?>
            <span><a href="<?= Config::URL ?> /User/logout">Logout</a></span>
        <?php else : ?>
            <span><a href="<?= Config::URL ?>/User/login">Login</a></span>
        <? endif; ?>

</div>


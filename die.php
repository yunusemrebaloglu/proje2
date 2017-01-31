<?php include('head.php'); ?>
<body>
<div class="container">
    <?php include('navbar.php'); ?>
    <?php
    require_once "init.php";
    session_destroy();
    echo 'çıkış yapıldı.';

    header("Location: index.php"); ?>
</div>
</body>
</html>

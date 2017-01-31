<?php

include('head.php'); ?>
<body>
<div class="container">
    <?php include('navbar.php'); ?>
    <?php
    require_once "../init.php";
    engel();
    sadecesirket ();
?>
    <div class="row">
        <div class="col-sm-4" >
            <div class="well">
            <h1><b> <br><br> BURAYA RASTGELE <br> İŞÇİLER VERİLECEK </b> </br></h1>
            </div>
        </div>
        <div class="col-sm-8" >
            <?php include('paylasim.php');  ?>
        </div>
    </div>

</div>
</body>
</html>


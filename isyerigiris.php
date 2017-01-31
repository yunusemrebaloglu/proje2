
<?php include('head.php'); ?>
<body>

<div class="container">
    <?php include('navbar.php'); ?>
    <div class="well">

        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">KULLANICI ADINIZ</label>
                <div class="col-sm-10">
                    <input name="kadi" type="text" class="form-control" id="text" placeholder="KULLANICI ADINIZ">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">PAROLANIZ</label>
                <div class="col-sm-10">
                    <input name="sifre" type="password" class="form-control" id="pwd" placeholder="ŞİFRENİZ">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">GİRİŞ</button>
                </div>
            </div>
        </form>
        <div class="text-center">
        <a href="ssifremiunuttum.php"> ŞİFREMİ UNUTTUM </a>
            <h3>ŞİRKET GİRİŞ PANELİ</h3>
        </div>
    </div>

    <?php
    require_once "init.php";
    engel();
    ozelid ();

    $kadi   = htmlspecialchars(trim(@$_POST["kadi"]));
    $sifre  = htmlspecialchars(md5(trim(@$_POST["sifre"])));


    ob_start();


    if(!empty($kadi) && !empty($sifre)){
        $cek1 = $connection->prepare("select * from sirketler WHERE kadi =? and sifre =? ");
        $cek1->execute(array($kadi,$sifre));
        $cek = $cek1->fetch();

        if($cek){
            $_SESSION["login"]       = true;
            $_SESSION["kadi"]        = $cek["kadi"];
            $_SESSION["sifre"]       = $cek["sifre"];
            $_SESSION["kurumunadi"]  = $cek["kurumunadi"];
            $_SESSION["ozelid"]      = $cek["ozelid"];
            $_SESSION["email"]       = $cek["email"];
            $_SESSION["para"]        = $cek["para"];
            $_SESSION["id"]          = $cek["id"];
            if($_SESSION["login"]){
                echo 'Hoşgeldiniz'.$_SESSION["kurumunadi"];

                header("Location: sirketler/index.php");
            }

        }else{
            echo 'Giriş başarısız';
            header("Refresh: 2; url=isyerigiris.php");

        }

    }



    ?>




</div>
</body>
</html>


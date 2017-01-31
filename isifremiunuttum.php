
<?php include('head.php'); ?>
<body>

<div class="container">
    <?php include('navbar.php'); ?>
    <?php
    // eğer post boş değilse diye başladım
    if (empty($_POST)) {
        ?>
        <form action="" method="POST">
            <table cellpadding="5" cellspacing="5">
                <tr>
                    <td><label for="kadi"><i>Kullanıcı Adı</i></label></td>
                </tr>
                <tr>
                    <td><input type="text" name="kadi" id="kadi"/></td>
                </tr>
                <tr>
                    <td><label for="email"><i>EMAİL</i></label></td>
                </tr>
                <tr>
                    <td><input type="email" name="email" id="email"/></td>
                </tr>
                <tr>
                    <td><input type="submit" value="DEVAM"></td>
                </tr>
            </table>
        </form>


        <?php
    }
    require_once "init.php";
    // kadi ve email adresini özel karakterlerle aldık.
    $kadi   = htmlspecialchars(trim(@$_POST["kadi"]));
    $email  = htmlspecialchars(trim(@$_POST["email"]));


    ob_start();

    // boş olup olmadığını kontrol ettikten sonra sözde girişimizi yaptık
    if(!empty($kadi) && !empty($email)){
        $cek1 = $connection->prepare("select * from isciler WHERE kadi =? and email =? ");
        $cek1->execute(array($kadi,$email));
        $cek = $cek1->fetch();
// sessiona bazı verilerimizi aldık ve aldığımız veriler arasınnda önemli olan engel olan değişkenimizi
// fonksiyonumuza yazdığımızdan işlemin yarısında işlemi keserse direkmen die . php ye gidip önbellekteki verileri sildiriyoruz.
        if($cek){
            $_SESSION["login"]       = true;

            $_SESSION["id"]          = $cek["id"];
            $_SESSION["gsorusu"]     = $cek["gsorusu"];
            $_SESSION["gcevap"]     = $cek["gcevap"];
            $_SESSION["engel"]      = $cek['engel'];

            if($_SESSION["login"]){
                ?>

                <form action="isifre.php" method="GET">
                    <table cellpadding="5" cellspacing="5">

                        <td><label for="gcevap"><i> GÜVENLİK SORUSU <?= $_SESSION['gsorusu'] ?></i></label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="gcevap" id="gcevap"/></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="DEVAM"></td>
                        </tr>
                    </table>
                </form>

                <?php
            }
        }else{
            echo 'Giriş başarısız';
            header("Refresh: 2; url=isifremiunuttum.php");

        }

    }



    ?>




</div>
</body>
</html>


<?php include('head.php'); ?>
<body>
<div class="container">
	<?php include('navbar.php');  ?>

<?php require_once 'init.php';?>
<?php
if (!empty($_GET['gcevap'])) {

    $gcevap = md5($_GET['gcevap']);
    if ($_SESSION["gcevap"] == $gcevap) {
        echo 'güvenlik cevabı doğru';
        ?>
        <form action="" method="POST" onsubmit="return confirm(' DEĞİŞTİRİLDİ')">
            <table cellpadding="5" cellspacing="5">
                <tr>
                    <td><label for="yenisifre"><i>Yeni Şifre</i></label></td>
                </tr>
                <tr>
                    <td><input type="password" name="yenisifre" id="sifre" /></td>
                </tr>
                <tr>
                    <td><label for="yenisifre2"><i>Yeni Şifre Tekrar </i></label></td>
                </tr>
                <tr>
                    <td><input type="password" name="yenisifre2" id="sifre" /></td>
                </tr>
                <tr>
                    <td><input type="submit" value="giriş" ></td>
                </tr>
            </table>
        </form>

        <?php

        //ilk önce eski şifreyi sorguladık acaba varmı diyerek
        //daha sonra yeni şifreyi direkt üzerine kaydettik.
        // trim boşlukları engellemek için kullanılıyor
        $id = $_SESSION['id'] ;



        ob_start();

                //______________________________________________________________________

                if($_POST) {
                    // Post üstünden gelen verileri değişkenlere alalım hepsini
                    $yenisifre           = md5(trim(htmlspecialchars($_POST['yenisifre'])));
                    $yenisifre2          = md5(trim(htmlspecialchars($_POST['yenisifre2'])));

                    //bir alt satırda boş ise diye başlayan bir if else yapısı mevcut.


                        if ($yenisifre!=$yenisifre2){
                            echo'sifreler uyuşmuyor';
                        }
                        else {


                          //sssssssssssssssssssssssssssssssssssssssssssss

                            $updateQuery = $connection->prepare("UPDATE sirketler SET  sifre = :newsifre WHERE id = :idToUpdate");

                            $isUpdated = $updateQuery->execute(array(
                                "newsifre" => $yenisifre,

                                "idToUpdate" => $id
                            ));

                            if ($isUpdated) {
                                header("Location: die.php");


                            } else  {
                                $error = "Güncellenemedi";
                            }

                            //ssssssssssssssssssssssssssssssssss



                    }
                }

    }
}else echo 'güvenlik cevabını boş bırakmayın';

?>
</div>
</body>
</html>




<?php include('head.php'); ?>
<body>

<div class="container">
    <?php include('navbar.php'); ?>



    <?php
    require_once "../init.php";
    engel();
    sadeceisci();
    //ilk önce eski şifreyi sorguladık acaba varmı diyerek
    //daha sonra yeni şifreyi direkt üzerine kaydettik.
    // trim boşlukları engellemek için kullanılıyor
    $id = $_SESSION['id'] ;
    $sifre  = trim(@$_POST["sifre"]);


    ob_start();
    if(!empty($sifre)){
        $cek1 = $connection->prepare("select * from isciler WHERE  sifre =? ");
        // md5 ile burada şifrelemek zorunda kaldım çünkü diğer tarafta hata verdi
        $cek1->execute(array( md5($sifre)));
        $cek = $cek1->fetch();

        if($cek){
            //______________________________________________________________________

            if($_POST) {
                // Post üstünden gelen verileri değişkenlere alalım hepsini
                $yenisifre           = htmlspecialchars(md5($_POST['yenisifre']));
                $yenisifre2          = htmlspecialchars(md5($_POST['yenisifre2']));

                //bir alt satırda boş ise diye başlayan bir if else yapısı mevcut.
                if (!$sifre) {
                    echo "lütfen eksik alanları bırakmayınız";
                } else {
                    if ($yenisifre!=$yenisifre2){
                        echo'sifreler uyuşmuyor';
                    }
                    else {


                        $updateQuery = $connection->prepare("UPDATE isciler SET  sifre = :newyenisifre  WHERE id = :idToUpdate");

                        $isUpdated = $updateQuery->execute(array(
                            "newyenisifre"		        =>	$yenisifre,

                            "idToUpdate"	        =>	$id
                        ));

                        if($isUpdated){
                            echo "BAŞARI İLE GÜNCELLENDİ GÜNCELLEMENİZİN DOĞRULUĞU İÇİN LÜTFEN TEKRAR GİRİŞ YAPINIZ.";
                            header("Location: cikis.php");
                        }else{
                            $error = "Güncellenemedi";
                        }


                    }
                }
            }












            //_________________________________________________________________________
        }else{
            echo 'ESKİ ŞİFRE HATALI';
            header("Refresh: 2; url=sifredegisikligi.php");

        }

    }



    ?>




</div>
</body>
</html>


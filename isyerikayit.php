<?php
/**
 * Created by PhpStorm.
 * User: yunusemre
 * Date: 10.01.2017
 * Time: 23:54
 */

include('head.php'); ?>
<body>

<div class="container">

    <?php include('navbar.php');?>
    <div class="row">
        <div class="col-sm-2" ></div>
        <div class="col-sm-8" >
            <div class="text-center"><b>
                <div class="well">
                                    LÜTFEN YILDIZLI YERLERİ BOŞ BIRAKMAYINIZ.<br><br>
                        <form action="" method="post">
                            Kullanıcı Adı:   <br> *<input type="text" name="kadi" placeholder="kullanıcı adi" ><br><br>
                            MAİL:            <br>*<input type="email" name="email" placeholder="email" ><br><br>
                            PAROLA:          <br>*<input type="password" name="sifre" placeholder="parola" ><br><br>
                            PAROLA TEKRAR:   <br>*<input type="password" name="sifre2" placeholder="parolatekrar" ><br><br>
                            Kurumun Adı:     <br>*<input type="text" name="kurumunadi" placeholder="kurumun adi" ><br><br>
                            GÜVENLİK SORUSU: <br>*<input type="text" name="gsorusu" placeholder="GÜVENLİK SORUSU" ><br><br>
                            VE CEVABI:       <br>*<input type="text" name="gcevap" placeholder="güvenlik sorusunun cevabı" ><br><br>
                            Telefon Numarası: <br>*<input type="number" name="telefonnumarasi" placeholder="telefon numarası" ><br><br>
                            ADRES : <br>*<textarea cols="65" rows="10" name="adres" style="width: 300px; height: 50px;" > </textarea><br><br>
                            <input type="submit" value="Kaydet!" >
                        </form>
                </div></b>
            </div>
        </div>
        <div class="col-sm-2" ></div>
    </div>
    <?php
    @require_once "init.php";
    engel();
    ozelid ();
    if($_POST) {
        // Post üstünden gelen verileri değişkenlere alalım hepsini
        $kadi            = htmlspecialchars($_POST['kadi']);
        $email           = htmlspecialchars($_POST['email']);
        $sifre           = htmlspecialchars(md5($_POST['sifre']));
        $sifre2          = htmlspecialchars(md5($_POST['sifre2']));
        $kurumunadi      = htmlspecialchars($_POST['kurumunadi']);
        $gsorusu           = htmlspecialchars($_POST['gsorusu']);
        $gcevap           = htmlspecialchars(md5($_POST['gcevap']));
        $telefonnumarasi = htmlspecialchars($_POST['telefonnumarasi']);
        $adres           = htmlspecialchars($_POST['adres']);
        $kayittarihi     = date('d.m.Y H:i:s');
        //bir alt satırda boş ise diye başlayan bir if else yapısı mevcut.
        if (!$kadi || !$sifre  || !$email || !$kurumunadi || !$telefonnumarasi || !$adres || !$gsorusu || !$gcevap) {
            echo "lütfen eksik alanları bırakmayınız";
        } else {
            if ($sifre!=$sifre2){
                echo'sifreler uyuşmuyor';
            }
            else {
                if (!filter_var($email)) {
                    echo "lütfen geçerli bir mail adresi girin";
                } else {

                    // bir ekleme sorgusu içine, bu değişkenlerle veritabanı sunucusuna talepte bulunalım

                    $addQuery = $connection->prepare("INSERT INTO sirketler (kadi, sifre, email, kurumunadi, telefonnumarasi, kayittarihi, adres, gsorusu, gcevap ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $isAdded = $addQuery->execute(array($kadi, $sifre, $email, $kurumunadi, $telefonnumarasi, $kayittarihi, $adres, $gsorusu, $gcevap ));

                    if ($isAdded) {
                        echo "kayıt olundu";
                        header('Refresh: 2; url=index.php');
                    } else {
                        echo "kayı olunamadı aynı kullanıcı adı veya email hesaplarından biri olabilir.";
                    }

                        }
            }
        }
    }









    ?>



</div>
</body>
</html>


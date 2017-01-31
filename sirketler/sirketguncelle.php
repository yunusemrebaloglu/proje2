
<?php include('head.php'); ?>
<body>

<div class="container">
    <?php include('navbar.php'); ?>


    <?php
require_once "../init.php";
    sadecesirket();
    engel();

    // BAĞLANTI İŞLEMLERİNİ İÇEREN DOSYAYI ÇAĞIRALIM
    $sirketlerid = (int)$_GET['id'];
    $sirketler = $connection->query("SELECT * FROM sirketler WHERE id = $sirketlerid")->fetch();
    if( ! $sirketler) { echo "MALESEF GÜNCELLEME YAPILAMADI";};

    if($_POST) {
        // sayfaya form bilgileri post ile gelmiş
        // Post üstünden gelen verileri değişkenlere alalım
        $kadi = htmlspecialchars($_POST['kadi']);
        $email = htmlspecialchars($_POST['email']);
        $telefonnumarasi = htmlspecialchars($_POST['telefonnumarasi']);
        $kurumunadi = htmlspecialchars($_POST['kurumunadi']);
        $adres = htmlspecialchars($_POST['adres']);

        if (!$kadi || !$email || !$kurumunadi || !$telefonnumarasi || !$adres) {
            echo "lütfen eksik alanları bırakmayınız";
        } else {

//güncellemeye başlayalım
            $updateQuery = $connection->prepare("UPDATE sirketler SET kadi = :newkadi, email = :newemail, telefonnumarasi = :newtelefonnumarasi, 
                                                                    kurumunadi = :newkurumunadi, adres = :newadres WHERE id = :idToUpdate");

            $isUpdated = $updateQuery->execute(array(
                "newkadi" => $kadi,
                "newemail" => $email,
                "newtelefonnumarasi" => $telefonnumarasi,
                "newkurumunadi" => $kurumunadi,
                "newadres" => $adres,

                "idToUpdate" => $sirketlerid
            ));

            if ($isUpdated) {
                echo "BAŞARI İLE GÜNCELLENDİ GÜNCELLEMENİZİN DOĞRULUĞU İÇİN LÜTFEN TEKRAR GİRİŞ YAPINIZ.";
            } else {
                $error = "Güncellenemedi";
            }
        }
    }
    ?>
    <meta charset="utf-8">
    <? if(isset($error)): ?>


    <? endif; ?>


    <?php  if ($_SESSION['id'] == $sirketler['id'] ){ ?>

    <div class="well" >
        <div class="outset">
        <form method="post">
            <div class="row">
                <div class="col-sm-6" >
                    <table>

                        <tr>
                            <td>KULLANICI ADI:</td>
                            <td><input type="text"      name="kadi"             placeholder="kullanıcı adı"     value="<?=$sirketler['kadi']?>"></td>
                        </tr>
                        <tr>
                            <td>EMAİL</td>
                            <td><input type="email"      name="email"            placeholder= "email"            value="<?=$sirketler['email']?>"></td>
                        </tr>
                        <tr>
                            <td>TELEFON NUMARASI </td>
                            <td><input type="number"    name="telefonnumarasi"  placeholder="telefonnumarasi"   value="<?=$sirketler['telefonnumarasi']?>"></td>

                        </tr>
                        <tr>
                            <td>KURUMUN ADI</td>
                            <td><input type="text"      name="kurumunadi"       placeholder="kurumunadi"        value="<?=$sirketler['kurumunadi']?>"></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td><br><br><br><button type="submit"> Bilgilerini Güncelle</button></td>

                        </tr>
                    </table>

                </div>
                <div class="col-sm-6" >
                    <br>
                    <textarea cols="65" rows="10" name="adres" style="width: 500px; height: 250px;" ><?=$sirketler['adres']?></textarea> </div>
                </div>
        </form>
            <hr>
    <h1> ŞİFRE DEĞİŞİKLİĞİ İÇİN </h1>
            <p>Şifre Değiştirme İşlemi Tamamlandıktan Sonra Otomatik Çıkış Yapılacaktır.</p>
        <form action="sifredegisikligi.php" method="POST" onsubmit="return confirm(' DEĞİŞTİRİLİYOR')">
            <table >
                <tr>
                    <td><label for="sifre"><i>Eski Şifre</i></label></td>
                </tr>
                <tr>
                    <td><input type="password" name="sifre" id="sifre" /></td>
                </tr>
                <tr>
                    <td><label for="sifre"><i>Yeni Şifre</i></label></td>
                </tr>
                <tr>
                    <td><input type="password" name="yenisifre" id="sifre" /></td>
                </tr>
                <tr>
                    <td><label for="sifre"><i>Yeni Şifre Tekrar </i></label></td>
                </tr>
                <tr>
                    <td><input type="password" name="yenisifre2" id="sifre" /></td>
                </tr>
                <tr>
                    <td><input type="submit" value="giriş" ></td>
                </tr>
            </table>
        </form>
    <?php } ?>


        </div>
    </div>



</div>
</body>
</html>

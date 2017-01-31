
<?php include('head.php'); ?>
<body>

<div class="container">
    <?php include('navbar.php'); ?>

    <?php
    engel();
    // PROFİL DETAY SAYFASI

    // Adres çubuğundan "id" değişkeni içinde gelen öğrenci id'sini $_GET üzerinden alacağız, veritabanında bu id ile kayıtlı öğrenciyi seçeceğiz ve bilgilerini ekranda göstereceğiz

    // BAĞLANTI İŞLEMLERİNİ İÇEREN DOSYAYI ÇAĞIRALIM
    require_once "../init.php";
    if ($_SESSION) {


        // GETten ID'yi integer olarak alalım
        $isciid = (int)$_GET['id'];

        // sorgu ile oluşan kaynağı dizi olarak alalım
        $isciler = $connection->query("SELECT * FROM isciler WHERE id = $isciid")->fetch();

        // şimdi de profil fotoğrafını çekelim.

        $photos = $connection->query("SELECT * FROM media WHERE user_id = $isciid")->fetch();

        // kaynaktan dizi alamadıysak ana sayfaya yönlendirelim
        if (!$isciler) echo "ulaşılamadı";

    }else {
        header("Refresh: 0; url=../index.php");
    }

    if (($_SESSION['id'] != $isciler['id']) && ($_SESSION['ozelid'] != 1)){
        header("Location: index.php");
    }

    ?>
            <meta charset="utf-8">
    <div class="well">
        <div class="row">
            <div class="col-sm-4" >
                <div class="text-center">
                        <h1> <?=$isciler['kadi']?> <br> </h1>
                                <?php if (!$photos){ ?>
                                    <?php if ($_SESSION['id']== $isciler['id'] ) {?>
                                        <hr>
                                    <h3>LÜTFEN 300x 300 px boyutunda fotoğraf yükleyiniz.</h3>
                                    <form action="upload.php" method="post" enctype="multipart/form-data" >
                                        <input type="file" name="photo" > <button type="submit">FOTOĞRAFI YÜKLE</button>
                                    </form>
                                    <?php }else {} ?>
                                <? } else{ ?>


                                    <img class="profilresmi" width="300" height="300" src="photos/<?=$photos['path']?>">
                                    <br><br><br>

                    <?php


                                    list($width, $height) = getimagesize('photos/'.$photos['path']);
                                    if ((!$width) && (!$height)) {
                                        $ozelfoto = $photos['id'];
                                        header("Location: ozelfotosil.php?id=$isciid&foto=$ozelfoto");

                                    }

                                    if ($_SESSION['id']== $isciler['id'] ) {?>
                                    <form action="fotoguncelle.php" method="get" >
                                        <input type="hidden" >
                                        <button type="submit"> FOTOĞRAFI DEĞİŞTİR.</button>
                                    </form>
                                    <?php }else {} ?>
                                <? } ?>
                </div>
            </div>
            <div class="col-sm-8" >


            <table>
                <tr>
                    <th>ADINIZ-SOYADINIZ</th>
                    <th><?=$isciler['isciadi']?> </th>
                </tr>
                <tr>
                    <td>KAÇINCI ÖĞRETİM</td>
                    <td><?=$isciler['ogretim']?> </td>
                </tr>
                <tr>
                    <td>YAŞ</td>
                    <td><?=$isciler['yas']?> </td>
                </tr>
                <?php if ($_SESSION['id'] == $isciler['id'] ) { ?>
                <tr>
                    <td>TC KİMLİK NUMARANIZ <br> (Sadece Siz Görürsünüz.)</td>
                    <td><?=($isciler['tc'] - 1 ) / $isciler['yas']?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>TECRÜBELERİ</td>
                    <td><?=$isciler['oncekiisi']?></td>
                </tr>
                <tr>
                    <td>ÇALIŞMAK İSTEDİĞİ İŞLER</td>
                    <td><?=$isciler['isistegi']?></td>
                </tr>
                <tr>
                    <td>TELEFON NUMARASI</td>
                    <td><?=$isciler['telefonnumarasi']?></td>
                </tr>
                <tr>
                    <td>ÇALIŞMA SAATLERİ</td>
                    <td><?=$isciler['kactan']?>:00 - <?=$isciler['kaca']?>:00 Arası</td>
                </tr>
                <tr>
                    <td>E MAİL ADRESİ</td>
                    <td><?=$isciler['email']?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><br><br>
                        <?php if ($_SESSION['id']== $isciler['id'] ) {?>
                        <form action="isciguncelle.php" method="get">
                            <input type="hidden" name="id" value="<?=$isciler['id']?>">
                            <button type="submit"> Bilgilerini Düzenle</button>
                        </form>
                        <?php }else {} ?>
                    </td>
                </tr>
            </table>



                <? if(isset($error)): ?> <hr> <? endif; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

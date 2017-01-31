
<?php include('head.php'); ?>
<body>

<div class="container">
    <?php include('navbar.php'); ?>
    <div class="row">
        <div class="col-sm-4" >

                <?php
                // PROFİL DETAY SAYFASI
                // Adres çubuğundan "id" değişkeni içinde gelen öğrenci id'sini $_GET üzerinden alacağız,
                // veritabanında bu id ile kayıtlı öğrenciyi seçeceğiz ve bilgilerini ekranda göstereceğiz
                // BAĞLANTI İŞLEMLERİNİ İÇEREN DOSYAYI ÇAĞIRALIM
                require_once "../init.php";
                engel();
                if ($_SESSION) {
                        // GETten ID'yi integer olarak alalım
                        $sirketid = (int)$_GET['id'];

                        // sorgu ile oluşan kaynağı dizi olarak alalım
                        $sirketler = $connection->query("SELECT * FROM sirketler WHERE id = $sirketid")->fetch();

                        // kaynaktan dizi alamadıysak ana sayfaya yönlendirelim
                        if (!$sirketler) echo "ulaşılamadı";

                        // şimdi de profil fotoğrafını çekelim.

                        $photos = $connection->query("SELECT * FROM medias WHERE user_id = $sirketid")->fetch();

                    }else {
                            header("Refresh: 0; url=../index.php");
                        }
                    ?>
                            <meta charset="utf-8">
                            <h1> Kullanıcı adı;	<?=$sirketler['kadi']?></h1> <br>

                    <?php if (!$photos){ ?>
                        <?php if ($_SESSION['id']== $sirketler['id'] ) {?>

                            <hr><h3>LÜTFEN 300x 300 px boyutunda fotoğraf yükleyiniz.</h3>
                            <form action="upload.php" method="post" enctype="multipart/form-data" >
                               <input type="file" name="photo" > <button type="submit">FOTOĞRAFI YÜKLE</button>
                            </form>
                    <?php }else {} ?>
                    <? } else{ ?>
                                 <img class="img-circle"  width="300" height="300" src="photos/<?=$photos['path']?>">

                        <?php


                    list($width, $height) = getimagesize('photos/'.$photos['path']);
                    if ((!$width) && (!$height)) {
                         $ozelid   =$sirketler['ozelid'];
                         $ozelfoto = $photos['id'];
                        header("Location: ozelfotosil.php?id=$sirketid&foto=$ozelfoto&ozelid=$ozelid");

                    }
                       // $ozl = 'photos/'.$photos['path'];
                       // $extension = pathinfo($ozl, PATHINFO_EXTENSION);

                       // if (($extension !="jpeg") || ($extension !="jpg") || ($extension !="png") || ($extension !="gif")) {
                        //       header("Location: ozelfotosil.php?id=$sirketid&foto=$ozelfoto");
                      //  }

                    }


                          ?>

                    <hr>
                    <br> KURUMUN ADI;	                <?=$sirketler['kurumunadi']?> <br>
                         TELEFON NUMARASI;	            <?=$sirketler['telefonnumarasi']?> <br>
                         Eposta:                        <?=$sirketler['email']?> <br>
                         KAYIT TARİHİ:                  <?= $sirketler['kayittarihi'] ?><br>
                         ADRES:                         <?= $sirketler['adres'] ?><br>
                    <hr>


                    <?php if ($_SESSION['id']== $sirketler['id'] ) {?>
                        <form action="sirketguncelle.php" method="get">
                            <input type="hidden" name="id" value="<?=$sirketler['id']?>">
                            <button type="submit"> Bilgilerini Düzenle</button>
                        </form>
                        <form action="fotoguncelle.php" method="get" >
                            <input type="hidden" >
                            <button type="submit"> FOTOĞRAFI DEĞİŞTİR.</button>
                        </form><hr>
                    <?php }else {} ?>


                    <? if(isset($error)): ?> <hr> <? endif; ?>


        </div>
        <div class="col-sm-8" >
                    <?php
                    if ($_SESSION['id']== $sirketler['id'] ) { ?>

                        <?php sadecesirket(include('paylasim.php'));
                    }else {} ?>

                    <?php include('ozelpaylasim.php'); ?>

        </div>
    </div>
</div>
</body>
</html>

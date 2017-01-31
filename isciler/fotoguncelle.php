
<?php

include('head.php');  ?>
<body>
<div class="container">
    <?php include('navbar.php'); ?>

    <?php
    engel();
    $isciid = $_SESSION['id'];
    $photos = $connection->query("SELECT * FROM media WHERE user_id = $isciid")->fetch();

    ?>
    <div class="row">
        <div class="col-sm-6" >
            <h3>YENİ FOTOĞRAF YÜKLEMENİZ İÇİN ESKİ RESMİNİZİ KALDIRMANIZ GEREKMEKTEDİR </h3><br>
        </div>
        <div class="col-sm-6" >
            <div class="text-center" >
                <?php if ($photos){ ?>
                    <img class="profilresmi" width="300" height="300" src="photos/<?=$photos['path']?>">



                    <h4>ESKİ FOTOĞRAFI KALDIRMAK İÇİN</h4>
                    <form method="post" action="fotosil.php" onsubmit="return confirm(' silinsin mi?')">
                        <input type="hidden" name="idToDelete" value="<?=$photos['id']?>">
                        <button type="submit" >Sil</button>
                    </form>
                <?php


                    list($width, $height) = getimagesize('photos/'.$photos['path']);
                    if ((!$width) && (!$height)) {
                        $ozelfoto = $photos['id'];
                        header("Location: ozelfotosil.php?id=$isciid&foto=$ozelfoto");

                    }

                }else { ?>
                    <h3> LÜTFEN 300x300 px boyutunda fotoğraf yükleyiniz.</h3>
                    <form action="upload.php" method="post" enctype="multipart/form-data" onsubmit="return confirm(' GÜNCELLENDİ')">
                        <input type="file" name="photo" > <button type="submit">FOTOĞRAFI YÜKLE</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>



</div>
</body>
</html>


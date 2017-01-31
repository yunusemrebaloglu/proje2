
<?php include('head.php'); ?>
<body>

<div class="container">
    <?php include('navbar.php'); engel();?>


    <?php
    // bu sayfada paylaşılan iş aramanın güncellemesini yaptık.
    require_once "../init.php";
    sadecesirket();

    // BAĞLANTI İŞLEMLERİNİ İÇEREN DOSYAYI ÇAĞIRALIM
    $paylasimid = (int)$_GET['id'];
    $paylasim = $connection->query("SELECT * FROM paylasim WHERE id = $paylasimid")->fetch();
    if( ! $paylasim) { echo "MALESEF GÜNCELLEME YAPILAMADI";};

    if($_POST){
        // sayfaya form bilgileri post ile gelmiş
        // Post üstünden gelen verileri değişkenlere alalım
        $neturis         = htmlspecialchars($_POST['neturis']);
        $kactan          = htmlspecialchars($_POST['kactan']);
        $kaca            = htmlspecialchars($_POST['kaca']);
        $ucret           = htmlspecialchars($_POST['ucret']);
        $cinsiyet        = htmlspecialchars($_POST['cinsiyet']);
        $arama           = htmlspecialchars($_POST['arama']);



//güncellemeye başlayalım
        $updateQuery = $connection->prepare("UPDATE paylasim SET neturis = :newneturis, kactan = :newkactan, kaca = :newkaca, 
                                         ucret = :newucret, cinsiyet = :newcinsiyet, arama = :newarama WHERE id = :idToUpdate");

        $isUpdated = $updateQuery->execute(array(
            "newneturis"	        =>	$neturis,
            "newkactan"		        =>	$kactan,
            "newkaca"           	=>	$kaca,
            "newucret"  	        =>	$ucret,
            "newcinsiyet"	        =>	$cinsiyet,
            "newarama"  	        =>	$arama,

            "idToUpdate"	        =>	$paylasimid
        ));

        if($isUpdated){
            echo "BAŞARI İLE GÜNCELLENDİ.";
        }else{
            $error = "Güncellenemedi";
        }
    }

    ?>
    <meta charset="utf-8">
    <? if(isset($error)): ?>

        <hr>
    <? endif; ?>


    <?php  if ($_SESSION['id'] == $paylasim['pid'] ){ ?>
    <div class="well">
    <div class="row">
        <div class="col-sm-6" >
            <form action="" method="post">
                ARANILAN İŞ : <br><textarea cols="65" rows="10" name="neturis" style="width: 499px; height: 249px;" ><?=$paylasim['neturis']?></textarea>
        </div>
        <div class="col-sm-6" >
            <br>
            <table>
                <tr>
                    <td>HANGİ SAATLER :</td>
                    <td>
                        <select name="kactan">
                            <option value="<?=$paylasim['kactan']?>"><?=$paylasim['kactan']?></option>
                            <option value="00,00">00.00</option><option value="01.00">01.00</option><option value="02.00">02.00</option>
                            <option value="03.00">03.00</option><option value="04.00">04.00</option><option value="05.00">05.00</option>
                            <option value="06.00">06.00</option><option value="07.00">07.00</option><option value="08.00">08.00</option>
                            <option value="09.00">09.00</option><option value="10.00">10.00</option><option value="11.00">11.00</option>
                            <option value="12.00">12.00</option><option value="13.00">13.00</option><option value="14.00">14.00</option>
                            <option value="15.00">15.00</option><option value="16.00">16.00</option><option value="17.00">17.00</option>
                            <option value="18.00">18.00</option><option value="19.00">19.00</option><option value="20.00">20.00</option>
                            <option value="21.00">21.00</option><option value="22.00">22.00</option><option value="23.00">23.00</option>
                        </select>-
                        <select name="kaca">
                            <option value="<?=$paylasim['kaca']?>"><?=$paylasim['kaca']?></option>
                            <option value="00.00">00.00</option><option value="01.00">01.00</option><option value="02.00">02.00</option>
                            <option value="03.00">03.00</option><option value="04.00">04.00</option><option value="05.00">05.00</option>
                            <option value="06.00">06.00</option><option value="07.00">07.00</option><option value="08.00">08.00</option>
                            <option value="09.00">09.00</option><option value="10.00">10.00</option><option value="11.00">11.00</option>
                            <option value="12.00">12.00</option><option value="13.00">13.00</option><option value="14.00">14.00</option>
                            <option value="15.00">15.00</option><option value="16.00">16.00</option><option value="17.00">17.00</option>
                            <option value="18.00">18.00</option><option value="19.00">19.00</option><option value="20.00">20.00</option>
                            <option value="21.00">21.00</option><option value="22.00">22.00</option><option value="23.00">23.00</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td> GÜNLÜK ÜCRET :</td>
                    <td> <input type="number" name="ucret" value="<?=$paylasim['ucret']?>"> <br></td>
                </tr>
                <tr>
                    <td>CİNSİYET:</td>
                    <td>
                        <select name="cinsiyet">
                            <option value="<?=$paylasim['cinsiyet']?>"> <?=$paylasim['cinsiyet']?> </option>
                            <option value="bay"> BAY </option>
                            <option value="bay"> BAYAN </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>ŞUANDA :</td>
                    <td>
                        <select name="arama">
                            <option value="<?=$paylasim['arama']?>"> <?=$paylasim['arama']?> </option>
                            <option value="araniyor"> ARANIYOR </option>
                            <option value="bulundu"> BULUNDU </option>
                        </select><br>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><br><input type="submit" value="Kaydet!" ></td>
                </tr>
            </table>

            </form>
        </div>
    </div>
</div>

    <?php } ?>






</div>
</body>
</html>

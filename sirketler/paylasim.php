
<?php
/**
Bu sayfayı iş aramak için paylaşımda bulunabilmeleri için yaptım.
 **/
engel();
//para yatıranları aktif etmek için yapıldı

if ($_SESSION['para']==1) { ?>
    <div class="well">
        <div class="text-center">
            <h3><b>PAYLAŞIM YAPMAYA YETKİNİZ YOK. LÜTFEN ABONELİĞİNİZİ SİTE YÖNETİCİSİNE ULAŞARAK AÇTIRINIZ.</b></h3>
        </div>
    </div>
<?php }elseif ($_SESSION['para']==2){
?>
<div class="well">
    <div class="row">
        <div class="col-sm-6" >
            <form action="" method="post">
            ARANILAN İŞ : <br><textarea cols="65" rows="10" name="neturis" style="width: 300px; height: 230px;" > </textarea><br>
        </div>
        <div class="col-sm-6" >
            <br>
            <table>
                <tr>
                    <td>HANGİ SAATLER :</td>
                    <td>
                        <select name="kactan">
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
                    <td><br> GÜNLÜK ÜCRET :</td>
                    <td><br> <input type="number" name="ucret" placeholder="ÜCRET" ><br></td>
                </tr>
                <tr>
                    <td><br>CİNSİYET:</td>
                    <td><br>
                        <select name="cinsiyet">
                            <option value="bay"> BAY </option>
                            <option value="bay"> BAYAN </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><br>ŞUANDA :</td>
                    <td><br>
                        <select name="arama">
                            <option value="araniyor"> ARANIYOR </option>
                        </select>
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
    <?php
    require_once "../init.php";

    if($_POST) {
        // Bazı verilerin gelişini posta bırakmadan session ile değişkene aldık
        // Post üstünden gelen verileri değişkenlere alalım
        $pid             = $_SESSION['id'];
        $kadi            = $_SESSION['kadi'];
        $kurumunadi      = $_SESSION['kurumunadi'];
        $kayittarihi     = date('d.m.Y H:i ');
        $neturis         = htmlspecialchars($_POST['neturis']);
        $kactan          = htmlspecialchars($_POST['kactan']);
        $kaca            = htmlspecialchars($_POST['kaca']);
        $ucret           = htmlspecialchars($_POST['ucret']);
        $cinsiyet        = htmlspecialchars($_POST['cinsiyet']);
        $arama           = htmlspecialchars($_POST['arama']);

        //bir alt satırda boş ise diye başlayan bir if else yapısı mevcut.
        if (!$neturis || !$kactan  || !$kaca || !$ucret ) {
            echo "lütfen eksik alanları bırakmayınız";
        } else {
            if ($kaca < $kactan){
                echo'Geçerli bir saat değil lütfen dikkatli olunuz.';
            }
            else {
                // bir ekleme sorgusu içine, bu değişkenlerle veritabanı sunucusuna talepte bulunalım

                    $addQuery = $connection->prepare("INSERT INTO paylasim (pid, kadi, kurumunadi, kayittarihi, neturis, kactan, kaca, ucret, cinsiyet, arama ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $isAdded = $addQuery->execute(array($pid, $kadi, $kurumunadi, $kayittarihi, $neturis, $kactan, $kaca, $ucret, $cinsiyet, $arama ));

                    if ($isAdded) {
                        echo "PAYLAŞILDI.";

                    } else {
                        echo "BİR DAKİKA İÇERİSİNDE İKİ DEFA GÖNDERİ PAYLAŞILAMAZ.";
                    }
            }
        }
    }
}
    ?>



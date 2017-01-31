<?php
/**
 * Created by PhpStorm.
 * User: yunusemre
 * Date: 11.01.2017
 * Time: 01:59
 */


include('head.php'); ?>
<body>

<div class="container">

    <?php include('navbar.php');?>
    <div class="row">
        <div class="col-sm-2" ></div>
        <div class="col-sm-8" >


                 <div class="text-center">
                     <div class="well">
                         <b>
                             LÜTFEN YILDIZLI YERLERİ BOŞ BIRAKMAYINIZ.<br><br>
                        <form action="" method="post">
                            Kullanıcı Adı:            <br> *<input type="text" name="kadi" placeholder="kullanıcı adi" ><br><br>
                            MAİL:                     <br>*<input type="email" name="email" placeholder="email" ><br><br>
                            ŞİFRE:                    <br>*<input type="password" name="sifre" placeholder="şifre" ><br><br>
                            ŞİFREYİ TEKRAR GİRİN:     <br>*<input type="password" name="sifre2" placeholder="şifretekrar" ><br><br>
                            Telefon Numarası:         <br>*<input type="number" name="telefonnumarasi" placeholder="telefon numarası" ><br><br>
                            ADINIZ SOYADINIZ:         <br>*<input type="text" name="isciadi" placeholder="ADINIZ SOYADINIZ" ><br><br>
                            KAÇINCI ÖĞRETİM :         <br><select name="ogretim">
                                                            <option value="Birinci Öğretim"> Birinci Öğretim</option>
                                                            <option value="İkinci Öğretim">İkinci Öğretim</option>
                                                          </select><br><br>
                            okuduğunuz bölüm:         <br><input type="text" name="bolum" placeholder="okuduğunuz bölüm" ><br><br>
                            YAŞ:                      <br>*<input type="number" name="yas" placeholder="YAŞ" ><br><br>
                            TC KİMLİK NUMARASI:<br>
                            </b>(TC KİMLİK NUMARANIZI SADECE SİZ GÖRECEKSİNİZ)<b><br><input type="number" name="tc" placeholder="TC kimlik numarası" ><br><br>
                            BOŞ OLDUĞUNUZ SAATLER :   *<select name="kactan">
                                <option value="00.00">00.00</option><option value="01.00">01.00</option><option value="02.00">02.00</option>
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
                            </select><br><br>
                            TECRÜBELERİNİZ:           <br><textarea cols="65" rows="10" name="oncekiisi" style="width: 499px; height: 149px;" > </textarea><br><br>
                            ÇALIŞMAK İSTEDİĞİNİZ İŞ:  <br><textarea cols="65" rows="10" name="isistegi"  style="width: 499px; height: 149px;" > </textarea><br><br>


                           <br> <input type="submit" value="Kaydet!" >
                        </form>
                         </b>
                     </div>

                </div>
        </div>
        <div class="col-sm-2" ></div>
    </div>
    <?php
    @require_once "init.php";
    engel();
    ozelid ();
    if($_POST)  {
        // Post üstünden gelen verileri değişkenlere alalım hepsini
        $kadi = htmlspecialchars($_POST['kadi']);
        $email = htmlspecialchars($_POST['email']);
        $sifre = htmlspecialchars(md5($_POST['sifre']));
        $sifre2 = htmlspecialchars(md5($_POST['sifre2']));
        $isciadi = htmlspecialchars($_POST['isciadi']);
        $ogretim = htmlspecialchars($_POST['ogretim']);
        $bolum = htmlspecialchars($_POST['bolum']);
        $yas = htmlspecialchars($_POST['yas']);
        $tc = htmlspecialchars($_POST['yas'] * ($_POST['tc']) + 1);
        $oncekiisi = htmlspecialchars($_POST['oncekiisi']);
        $isistegi = htmlspecialchars($_POST['isistegi']);
        $kactan = htmlspecialchars($_POST['kactan']);
        $kaca = htmlspecialchars($_POST['kaca']);
        $kac = ($_POST['kaca'] - $_POST['kactan'] ) ;
        $telefonnumarasi = htmlspecialchars($_POST['telefonnumarasi']);
        $kayittarihi = date('d.m.Y H:i:s');
        //bir alt satırda boş ise diye başlayan bir if else yapısı mevcut.
        if (!$kadi || !$sifre || !$email || !$isciadi || !$telefonnumarasi || !$kactan || !$kaca ) {
            echo "lütfen eksik alanları bırakmayınız";
        } else  {
            if ($sifre != $sifre2) {
                echo 'sifreler uyuşmuyor';
            } else  {
                if (!filter_var($email)) {
                    echo "lütfen geçerli bir mail adresi girin";
                } else  {
                    if ($kactan > $kaca) {
                        echo "lütfen geçerli bir saat girin";
                    } else  {

                        // bir ekleme sorgusu içine, bu değişkenlerle veritabanı sunucusuna talepte bulunalım

                        $addQuery = $connection->prepare("INSERT INTO isciler (kadi, sifre, email, isciadi, telefonnumarasi, ogretim, bolum, yas, tc, oncekiisi, isistegi, kactan, kaca, kac, kayittarihi ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                        $isAdded = $addQuery->execute(array($kadi, $sifre, $email, $isciadi, $telefonnumarasi, $ogretim, $bolum, $yas, $tc, $oncekiisi, $isistegi, $kactan, $kaca, $kac, $kayittarihi ));

                        if ($isAdded) {

                            echo "kayıt olundu giriş yapınız. ";
                            header("Location: index.php");
                            //BURAYA TEKRAR DÖN DÖN DÖN
                            //
                            //

                        } else  {
                            echo "kayı olunamadı aynı özel bilgiler başka hesaplarından biri olabilir.";
                            // çünkü database de  benzersiz yaptım
                                }
                            }
                        }
                    }
                }
            }
    ?>



</div>
</body>
</html>



<?php include('head.php'); ?>
<body>

<div class="container">
    <?php include('navbar.php'); ?>


    <?php
require_once "../init.php";
    engel();
sadeceisci();

    // BAĞLANTI İŞLEMLERİNİ İÇEREN DOSYAYI ÇAĞIRALIM
    $iscilerid = (int)$_GET['id'];

    $isciler = $connection->query("SELECT * FROM isciler WHERE id = $iscilerid")->fetch();
    if( ! $isciler) { echo "MALESEF GÜNCELLEME YAPILAMADI";};

    if($_POST)  {
                // sayfaya form bilgileri post ile gelmiş
                // Post üstünden gelen verileri değişkenlere alalım
                $kadi = htmlspecialchars($_POST['kadi']);
                $email = htmlspecialchars($_POST['email']);
                $telefonnumarasi = htmlspecialchars($_POST['telefonnumarasi']);
                $isciadi = htmlspecialchars($_POST['isciadi']);
                $ogretim = htmlspecialchars($_POST['ogretim']);
                $bolum = htmlspecialchars($_POST['bolum']);
                $yas = htmlspecialchars($_POST['yas']);
                $tc = htmlspecialchars($_POST['tc']);
                $oncekiisi = htmlspecialchars($_POST['oncekiisi']);
                $isistegi = htmlspecialchars($_POST['isistegi']);
                $kactan = htmlspecialchars($_POST['kactan']);
                $kaca = htmlspecialchars($_POST['kaca']);
                $kac = ($_POST['kaca'] - $_POST['kactan'] ) ;

                if ($kactan > $kaca) {
                    echo "lütfen geçerli bir saat girin";
                } else {
                        //güncellemeye başlayalım
                        $updateQuery = $connection->prepare("UPDATE isciler SET  kadi = :newkadi, email = :newemail, 
                                                        telefonnumarasi = :newtelefonnumarasi, isciadi = :newisciadi, 
                                                        ogretim = :newogretim, bolum = :newbolum, yas = :newyas, 
                                                        tc = :newtc, oncekiisi = :newoncekiisi, isistegi = :newisistegi, 
                                                        kactan = :newkactan, kaca = :newkaca, kac = :newkac  WHERE id = :idToUpdate");

                        $isUpdated = $updateQuery->execute(array(
                            "newkadi" => $kadi,
                            "newemail" => $email,
                            "newtelefonnumarasi" => $telefonnumarasi,
                            "newisciadi" => $isciadi,
                            "newogretim" => $ogretim,
                            "newbolum" => $bolum,
                            "newyas" => $yas,
                            "newtc" => ($yas * $tc + 1),
                            "newoncekiisi" => $oncekiisi,
                            "newisistegi" => $isistegi,
                            "newkactan" => $kactan,
                            "newkaca" => $kaca,
                            "newkac" => $kac,

                            "idToUpdate" => $iscilerid
                        ));

                        if ($isUpdated) {
                            echo "BAŞARI İLE GÜNCELLENDİ GÜNCELLEMENİZİN DOĞRULUĞU İÇİN LÜTFEN TEKRAR GİRİŞ YAPINIZ.";
                        } else  {
                                $error = "Güncellenemedi";
                                }
                        }
                }
    ?>
    <meta charset="utf-8">
    <? if(isset($error)): ?>

        <hr>
    <? endif; ?>

    <div class="row">
        <div class="col-sm-8" >

            <?php  if ($_SESSION['id'] == $isciler['id'] ){ ?>

                <form method="post">
                    <table>
                        <tr>
                            <th>KULLANICI ADINIZ</th>
                            <th><input type="text" name="kadi" placeholder="kullanıcı adi"  value="<?=$isciler['kadi']?>" ></th>
                        </tr>
                        <tr>
                            <td>EMAİL ADRESİNİZ</td>
                            <td><input type="email" name="email" placeholder="email" value="<?=$isciler['email']?>"></td>
                        </tr>
                        <tr>
                            <td>TELEFON NUMARASI</td>
                            <td><input type="number" name="telefonnumarasi" placeholder="telefon numarası" value="<?=$isciler['telefonnumarasi']?>"></td>
                        </tr>
                        <tr>
                            <td>ADINIZ SOYADINIZ</td>
                            <td><input type="text" name="isciadi" placeholder="ADINIZ SOYADINIZ" value="<?=$isciler['isciadi']?>"></td>
                        </tr>
                        <tr>
                            <td> KAÇINCI ÖĞRETİM</td>
                            <td>
                                <select name="ogretim">
                                    <option value="<?=$isciler['ogretim']?>"> <?=$isciler['ogretim']?></option>
                                    <option value="Birinci Öğretim"> Birinci Öğretim</option>
                                    <option value="İkinci Öğretim">İkinci Öğretim</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>OKUDUĞUNUZ BÖLÜM</td>
                            <td><input type="text" name="bolum" placeholder="okuduğunuz bölüm" value="<?=$isciler['bolum']?>"></td>
                        </tr>
                        <tr>
                            <td>YAŞ</td>
                            <td><input type="number"  name="yas" placeholder="YAŞ" value="<?=$isciler['yas']?>"></td>
                        </tr>
                        <tr>
                            <td>TC KİMLİK NUMARANIZ</td>
                            <td><input type="number"  name="tc" placeholder="TC kimlik numarası"value="<?= ($isciler['tc'] - 1 ) / $isciler['yas']?>"></td>
                        </tr>

                        <tr>
                            <td>ÇALIŞMA SAATLERİ</td>
                            <td>
                                <select name="kactan">
                                    <option value="<?=$isciler['kactan']?>"><?=$isciler['kactan']?></option>
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
                                    <option value="<?=$isciler['kaca']?>"><?=$isciler['kaca']?></option>
                                    <option value="00.00">00.00</option><option value="01.00">01.00</option><option value="02.00">02.00</option>
                                    <option value="03.00">03.00</option><option value="04.00">04.00</option><option value="05.00">05.00</option>
                                    <option value="06.00">06.00</option><option value="07.00">07.00</option><option value="08.00">08.00</option>
                                    <option value="09.00">09.00</option><option value="10.00">10.00</option><option value="11.00">11.00</option>
                                    <option value="12.00">12.00</option><option value="13.00">13.00</option><option value="14.00">14.00</option>
                                    <option value="15.00">15.00</option><option value="16.00">16.00</option><option value="17.00">17.00</option>
                                    <option value="18.00">18.00</option><option value="19.00">19.00</option><option value="20.00">20.00</option>
                                    <option value="21.00">21.00</option><option value="22.00">22.00</option><option value="23.00">23.00</option>
                                </select> SAATLERİ ARASI
                            </td>
                        </tr>
                        <tr>
                            <td>TECRÜBELER</td>
                            <td><textarea cols="65" rows="10" name="oncekiisi" style="width: 499px; height: 149px;" ><?=$isciler['oncekiisi']?></textarea></td>
                        </tr>
                        <tr>
                            <td>ÇALIŞMAK İSTEDİĞİ İŞLER</td>
                            <td><textarea cols="65" rows="10" name="isistegi" style="width: 499px; height: 149px;" ><?=$isciler['isistegi']?></textarea></td>
                        </tr>
                        <div class="text-center">
                            <tr>
                                <td></td>
                                <td><button type="submit"> Bilgilerini Güncelle</button></td>
                            </tr>
                        </div>
                    </table>


                </form>
            </div>

            <div class="col-sm-4" >
                <h2>ŞİFRE DEĞİŞTİRMEK İÇİN</h2>
                <p>Şifre Değiştirme İşlemi Tamamlandıktan Sonra Otomatik Çıkış Yapılacaktır.</p>
                <form action="sifredegisikligi.php" method="POST" onsubmit="return confirm(' DEĞİŞTİRİLİYOR')">
                    <table cellpadding="5" cellspacing="5">
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
                            <td><input type="submit" value="DEĞİŞTİR" ></td>
                        </tr>
                    </table>
                </form>

            <?php } ?>
            </div>
    </div>




</div>
</body>
</html>

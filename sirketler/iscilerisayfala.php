<?php
include('head.php'); ?>
<body>
<div class="container">
    <?php include('navbar.php'); ?>
    <?php
    require_once "../init.php";
    engel();
    sadecesirket ();
    // bu sayfada paylaşılan iş aramanın güncellemesini yaptık.

    if ($_SESSION['para']==1) { ?>
        <div class="well">
            <div class="text-center">
                <h3><b>İŞ ARAYANLARIN TAMAMINI GÖRMEYE YETKİNİZ YOK. LÜTFEN ABONELİĞİNİZİ SİTE YÖNETİCİSİNE ULAŞARAK AÇTIRINIZ.</b></h3>
            </div>
        </div>
    <?php }elseif ($_SESSION['para']==2){

    // İlk olarak GET metodu ile sayfalar arası geçiş yapacağımızdan dolayı değişken tanımlayarak olaya başlıyoruz.
    $Sayfa   = @intval($_GET['sayfa']); if(!$Sayfa) $Sayfa = 1;

    // Şimdi ise sayfalama yapacağımız verileri alıp, kaç adet veri olduğunu bulmak için, veri tabanındaki verileri saydırıyoruz.
    $Say   = $connection->query("select * from isciler order by id DESC");

    $ToplamVeri   = $Say->rowCount();

    // $Say ile verilere ulaşıp, $ToplamVeri ile de verileri başarılı bir şekilde saydırdık.
    // Şimdi yapmamız gereken şey, Limit belirlemek ve kaç sayfa olduğunu bulacağımız hesaplama değişkenlerini oluşturmaktır.
    $Limit	= 20;

    $Sayfa_Sayisi	= ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}

    //gösterilecek olan sayfa aralığını ve gösterilecek olan sayfalama numaralarını tanımlamış oluyoruz.
    $Goster   = $Sayfa * $Limit - $Limit;

    $GorunenSayfa   = 5;


    //Şimdi ise belirlenen Limit koşullarına göre verileri alacağımız sorguyu oluşturuyoruz.
    // Bununla beraber foreach döngüsü için gerekli tanımayı yapıyoruz. Bu işlemler ile sayfalama olayını bitirmiş oluyoruz.
    // Şimdi ise foreach döngüsünü kullanarak GET ile gelen değerler doğrultusunda verileri yazdıralım.



$isciler	= $connection->query("select * from isciler order by id DESC limit $Goster,$Limit");

$isci = $isciler->fetchAll(PDO::FETCH_ASSOC);

?>



        <?php foreach($isci as $iscisayfala){?>

            <div class="well" >
                <div class="row">
                    <div class="col-sm-6" >
                        <table>
                            <tr>
                                <td><h2> <a href="../isciler/profil.php?id=<?= $iscisayfala['id'] ?>"><?= $iscisayfala['isciadi'] ?></a></h2></td>
                            </tr>
                            <tr>
                                <td>TELEFON NUMARASI</td>
                                <td><?= $iscisayfala['telefonnumarasi'] ?></td>
                            </tr>
                            <tr>
                                <td>MAİL ADRESİ</td>
                                <td><?= $iscisayfala['email'] ?></td>
                            </tr>
                            <tr>
                                <td>HANGİ ÖĞRETİM</td>
                                <td><?= $iscisayfala['ogretim'] ?></td>
                            </tr>
                            <tr>
                                <td>BÖLÜM</td>
                                <td><?= $iscisayfala['bolum'] ?></td>
                            </tr>
                            <tr>
                                <td>YAŞI</td>
                                <td><?= $iscisayfala['yas'] ?></td>
                            </tr>
                            <tr>
                                <td>TOPLAM KAÇ SAAT ÇALIŞACAĞI</td>
                                <td><?= $iscisayfala['kac'] ?>:00 SAAT </td>
                            </tr>
                            <tr>
                                <td>HANGİ SAATLER ARASI</td>
                                <td> <?= $iscisayfala['kactan']?>-<?= $iscisayfala['kaca']?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6" ><br><br>
                        <div class="row">
                            <div class="col-sm-6" >
                                <br> ÖNCEKİ ÇALIŞTIĞI İŞLER:                    <br>  <?= $iscisayfala['oncekiisi'] ?>
                            </div>
                            <div class="col-sm-6" >
                                <br> ÇALIŞABİLECEĞİ İŞLER:                      <br>  <?= $iscisayfala['isistegi'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>



        <?php   //Şimdi ise listelenen verilerin alt kısmına sayfa numaralarını belirlemek kaldı.
                // Bu işlem kontrol ifadeleri ve for döngüsü ile hazırlanan basit bir yapıdır.
                // İlk olarak ilk ve önceki butonların yer aldığı tanımlamayı yapalım.

        if($Sayfa > 1){?>

        <ul class="pager">
            <li><a href="iscilerisayfala.php?sayfa=1">İlk</a></li>
            <li><a href="iscilerisayfala.php?sayfa=<?=$Sayfa - 1?>">Önceki</a></li>

            <?php } else { ?> <ul class="pager"> <?php }

        //Bu kod yapısı ile ilk ve önceki butonlarını oluşturmuş oluyoruz.
        // Şimdi ise sayfaların listeleneceği for döngüsünü oluşturuyoruz.
        // Böylelikle 1-2-3-4-5 gibi sayfa numaralarını listelemiş olacağız.

        for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){

            if($i > 0 and $i <= $Sayfa_Sayisi){

                if($i == $Sayfa){

                    echo '<span class="say_aktif">'.$i.'</span>';

                }else{

                    echo '<a class="say_a" href="iscilerisayfala.php?sayfa='.$i.'">'.$i.'</a>';

                }

            }

        }
            //Bu kod bloğu ile 1-2-3-4-5 diye sayfalama numaralarının oluşturulmasını sağladık.
            // Son adımda ise, Sonraki ve Son sayfa butonlarını oluşturuyoruz.

         if($Sayfa != $Sayfa_Sayisi){?>

                <li><a href="iscilerisayfala.php?sayfa=<?=$Sayfa + 1?>">Sonraki</a></li>
                <li><a href="iscilerisayfala.php?sayfa=<?=$Sayfa_Sayisi?>">Son</a></li>
            </ul>

        <?php }
        // SAYFALAMA BİLGİSİ KAYNAK : http://ibrahimcevruk.com/php-pdo-ile-gelismis-sayfalama-yapimi.html
        }
        ?>



</div>
</body>
</html>


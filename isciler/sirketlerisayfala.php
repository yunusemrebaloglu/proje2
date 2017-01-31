<?php
include('head.php'); ?>
<body>
<div class="container">
    <?php include('navbar.php'); ?>
    <?php
    require_once "../init.php";
    sadeceisci ();
    engel();

    // İlk olarak GET metodu ile sayfalar arası geçiş yapacağımızdan dolayı değişken tanımlayarak olaya başlıyoruz.
    $Sayfa   = @intval($_GET['sayfa']); if(!$Sayfa) $Sayfa = 1;

    // Şimdi ise sayfalama yapacağımız verileri alıp, kaç adet veri olduğunu bulmak için, veri tabanındaki verileri saydırıyoruz.
    $Say   = $connection->query("select * from sirketler order by id DESC");

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



    $sirketler	= $connection->query("select * from sirketler order by id DESC limit $Goster,$Limit");

    $sirket = $sirketler->fetchAll(PDO::FETCH_ASSOC);

    ?>



    <?php foreach($sirket as $sirketsayfala){?>

        <div class="well" >
            <table>
                <tr>
                    <th><h2><a href="../sirketler/profil.php?id=<?= $sirketsayfala['id'] ?>"><?= $sirketsayfala['kurumunadi'] ?></a></h2></th>
                </tr>
            </table>


            <div class="row">
                <div class="col-sm-6" >TELEFON NUMARASI: <?= $sirketsayfala['telefonnumarasi'] ?> </div>
                <div class="col-sm-6" >MAİL ADRESİ: <?= $sirketsayfala['email'] ?> </div>
            </div>
        </div>

    <?php } ?>



    <?php   //Şimdi ise listelenen verilerin alt kısmına sayfa numaralarını belirlemek kaldı.
    // Bu işlem kontrol ifadeleri ve for döngüsü ile hazırlanan basit bir yapıdır.
    // İlk olarak ilk ve önceki butonların yer aldığı tanımlamayı yapalım.

    if($Sayfa > 1){?>
    <ul class="pager">
        <li><a href="sirketlerisayfala.php?sayfa=1">İlk</a></li>
        <li><a href="sirketlerisayfala.php?sayfa=<?=$Sayfa - 1?>">Önceki</a></li>

        <?php } else { ?> <ul class="pager"> <?php }

            //Bu kod yapısı ile ilk ve önceki butonlarını oluşturmuş oluyoruz.
            // Şimdi ise sayfaların listeleneceği for döngüsünü oluşturuyoruz.
            // Böylelikle 1-2-3-4-5 gibi sayfa numaralarını listelemiş olacağız.

            for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){

                if($i > 0 and $i <= $Sayfa_Sayisi){

                    if($i == $Sayfa){

                        echo '<span class="say_aktif">'.$i.'</span>';

                    }else{

                        echo '<a class="say_a" href="sirketlerisayfala.php?sayfa='.$i.'">'.$i.'</a>';

                    }

                }

            }
            //Bu kod bloğu ile 1-2-3-4-5 diye sayfalama numaralarının oluşturulmasını sağladık.
            // Son adımda ise, Sonraki ve Son sayfa butonlarını oluşturuyoruz.

            if($Sayfa != $Sayfa_Sayisi){?>

            <li><a href="sirketlerisayfala.php?sayfa=<?=$Sayfa + 1?>">Sonraki</a></li>
            <li><a href="sirketlerisayfala.php?sayfa=<?=$Sayfa_Sayisi?>">Son</a></li>
        </ul>
    <?php }
    // SAYFALAMA BİLGİSİ KAYNAK : http://ibrahimcevruk.com/php-pdo-ile-gelismis-sayfalama-yapimi.html

    ?>



</div>
</body>
</html>


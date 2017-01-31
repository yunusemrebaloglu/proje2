
<?php include('head.php'); ?>
<body>

<div class="container">
    <?php include('navbar.php'); ?>



    <?php
    //connection database
    require_once "../init.php";  engel();?>

    <form  method="post" name="search">
        <input type="text"  name="search" placeholder="işçi arama">
        <input type="submit" value="search">
    </form><br>

<?php
sadeceisci();
$Sayfa   = @intval($_GET['sayfa']); if(!$Sayfa) $Sayfa = 1;

// aşağıda bulunan if else if yapısı ile ikinci sayfalara gitmeyen post değişkenini
// if yapısı kullanarak posttan geldiyse yada getten geldiyse aranan kelimeyi arama değişkenine eşitle dedik.

if (!empty($_POST['search'])){ $arama =  htmlspecialchars($_POST['search']);}
elseif (!empty($_GET['arama'])) {  $arama = $_GET['arama']; }

// Şimdi ise sayfalama yapacağımız verileri alıp, kaç adet veri olduğunu bulmak için, veri tabanındaki verileri saydırıyoruz.
//eğer posttan gelen searh boş değil ise aşağıdaki işlemleri yap dedik boş ise es geç dedik.

if(!empty($_POST["search"]) ) {

                    // posttan gelen searh ifadesini keş değişkenine eşitledik
                    $key = (htmlspecialchars($_POST["search"])) ;

                    //key değişkenini aramak istediğimiz yerde aradık
                    $search=$connection->prepare(" SELECT * FROM  sirketler WHERE  kurumunadi LIKE ? ");
                    $search->execute(array('%'.$key.'%'));
                    // aşağıda yaptığımız ise aradığımız kelimenin bize toplam kaç sonuç vereceği idi
                    $ToplamVeri   = $search->rowCount();

                    // $searh ile verilere ulaşıp, $ToplamVeri ile de verileri başarılı bir şekilde saydırdık.
                    // Şimdi yapmamız gereken şey, Limit belirlemek ve kaç sayfa olduğunu bulacağımız hesaplama değişkenlerini oluşturmaktır.
                    $Limit	= 2;
                    $Sayfa_Sayisi	= ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}

                    //gösterilecek olan sayfa aralığını ve gösterilecek olan sayfalama numaralarını tanımlamış oluyoruz.
                    $Goster   = $Sayfa * $Limit - $Limit;
                    $GorunenSayfa   = 5;

                    //Şimdi ise belirlenen Limit koşullarına göre verileri alacağımız sorguyu oluşturuyoruz.
                    // Bununla beraber foreach döngüsü için gerekli tanımayı yapacağız bunun için yazdıracağımız. sayfaya bağlanıyoruz
                    $search=$connection->prepare(" SELECT * FROM  sirketler WHERE  kurumunadi LIKE ? order by id DESC limit $Goster,$Limit");
                    $search->execute(array('%'.$key.'%'));

                    // BU SORGUDAN SONRA ARAMAMIZI FOREACH DÖNGÜSÜNE SOKMAYA HAZIRIZ
                    // AMA YUKARDA BAHSETTİĞİMİZ GİBİ İSTEDİĞİMİZ BİLGİ POSTTAN DEĞİLDE GETTEN GELDİYSE DİYE
                    // AŞAĞIDAKİ ELSEİFİ KULLANDIK

} elseif (!empty( $_GET['arama'])){

        // GETTEN gelen searh ifadesini keş değişkenine eşitledik
        $key = $_GET['arama'];

        //key değişkenini aramak istediğimiz yerde aradık
        $search=$connection->prepare(" SELECT * FROM  sirketler WHERE  kurumunadi LIKE ? ");
        $search->execute(array('%'.$key.'%'));

        // aşağıda yaptığımız ise aradığımız kelimenin bize toplam kaç sonuç vereceği idi
        $ToplamVeri   = $search->rowCount();

        // $searh ile verilere ulaşıp, $ToplamVeri ile de verileri başarılı bir şekilde saydırdık.
        // Şimdi yapmamız gereken şey, Limit belirlemek ve kaç sayfa olduğunu bulacağımız hesaplama değişkenlerini oluşturmaktır.
        $Limit	= 2;
        $Sayfa_Sayisi	= ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}

        //gösterilecek olan sayfa aralığını ve gösterilecek olan sayfalama numaralarını tanımlamış oluyoruz.
        $Goster   = $Sayfa * $Limit - $Limit;
        $GorunenSayfa   = 5;

        //Şimdi ise belirlenen Limit koşullarına göre verileri alacağımız sorguyu oluşturuyoruz.
        // Bununla beraber foreach döngüsü için gerekli tanımayı yapacağız bunun için yazdıracağımız. sayfaya bağlanıyoruz

        $search=$connection->prepare(" SELECT * FROM  sirketler WHERE  kurumunadi LIKE ? order by id DESC limit $Goster,$Limit");
        $search->execute(array('%'.$key.'%'));
        // BU SORGUDAN SONRA ARAMAMIZI FOREACH DÖNGÜSÜNE SOKMAYA HAZIRIZ
}
?>
    <!--if search is emtyp ,then we want least one letter from user-->
    <?php if (empty($key)) {}
    else{ ?> <!--if search isn't empty,display customers or customer -->
        <?php foreach ($search as $data): ?>
            <div class="wall">

                <form>
                    <?=$data['kurumunadi']?><br>
                    <?=$data['telefonnumarasi']?><br>
                    <?=$data['email']?><br>


                </form>
            </div>
            <br>    <a href="../sirketler/profil.php?id=<?= $data['id'] ?>"> profiline git </a><br><hr>
        <?php endforeach; ?>
    <?php }

    //Şimdi ise listelenen verilerin alt kısmına sayfa numaralarını belirlemek kaldı.
    // Bu işlem kontrol ifadeleri ve for döngüsü ile hazırlanan basit bir yapıdır.
    // İlk olarak ilk ve önceki butonların yer aldığı tanımlamayı yapalım.

if($Sayfa > 1){?>

            <a href="searchsayfala.php?sayfa=1&arama=<?=$arama?>">İlk</a>

            <a href="searchsayfala.php?sayfa=<?=$Sayfa - 1?>&arama=<?=$arama?>">Önceki</a>

<?php }

    //Bu kod yapısı ile ilk ve önceki butonlarını oluşturmuş oluyoruz.
    // Şimdi ise sayfaların listeleneceği for döngüsünü oluşturuyoruz.
    // Böylelikle 1-2-3-4-5 gibi sayfa numaralarını listelemiş olacağız.


if (!empty($arama)){

            for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){

                if($i > 0 and $i <= $Sayfa_Sayisi){

                    if($i == $Sayfa){

                        echo '<span class="say_aktif">'.$i.'</span>';

                    }else{

                        echo '<a class="say_a" href="searchsayfala.php?sayfa='.$i.'&arama='.$arama.'">'.$i.'</a>';

                    }

                }

            }
            //Bu kod bloğu ile 1-2-3-4-5 diye sayfalama numaralarının oluşturulmasını sağladık.
            // Son adımda ise, Sonraki ve Son sayfa butonlarını oluşturuyoruz.

            if($Sayfa != $Sayfa_Sayisi){?>

                <a href="searchsayfala.php?sayfa=<?=$Sayfa + 1?>&arama=<?=$arama?>">Sonraki</a>

                <a href="searchsayfala.php?sayfa=<?=$Sayfa_Sayisi?>&arama=<?=$arama?>">Son</a>

                                <?php }
            } ?>
</div>
</body>
</html>

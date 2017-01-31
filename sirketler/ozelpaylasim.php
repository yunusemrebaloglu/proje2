<?php

/**
Bu sayfayı profilde kullanıcının kendi paylaştığı gönderileri oluşturmak için
 **/



require_once "../init.php";
engel();



?>
<?php
//profilde paylaşılanlara bakalım
$pid = $_GET['id'];
foreach ($connection->query("SELECT * FROM paylasim WHERE pid = $pid") as $sirketsayfala):
    ?>
    <div class="outset">
            <table class="table">
                <tr>
                    <td>KURUMUN ADI</td>
                    <td><?= $sirketsayfala['kurumunadi'] ?></td>
                </tr>
                <tr>
                    <td>PAYLAŞILAN TARİH</td>
                    <td><?= $sirketsayfala['kayittarihi'] ?></td>
                </tr>
                <tr>
                    <td>HANGİ SAATLER ARASI</td>
                    <td><?= $sirketsayfala['kactan'] ?>:00-<?= $sirketsayfala['kaca'] ?>:00</td>
                </tr>
                <tr>
                    <td>HANGİ İŞLERDE ÇALIŞILACAK</td>
                    <td><p><?= $sirketsayfala['neturis'] ?></p></td>
                </tr>
                <tr>
                    <td>GÜNLÜK ÜCRET</td>
                    <td><?= $sirketsayfala['ucret'] ?></td>
                </tr>
                <tr>
                    <td>ARANILAN CİNSİYET</td>
                    <td> <p> <?= $sirketsayfala['cinsiyet'] ?> </p></td>
                </tr>
                <tr>
                    <td>HALA ARANIYORMU.</td>
                    <td><?= $sirketsayfala['arama'] ?></td>
                </tr>
            <?php  if ($_SESSION['id'] == $sirketsayfala['pid'] ){ ?>
                <tr>
                    <td><a href="paylasimupdate.php?id=<?= $sirketsayfala['id'] ?>"> GÜNCELLE </a></td>
                    <td><form method="post" action="paylasilan_sil.php" onsubmit="return confirm(' silinsin mi?')">
                            <input type="hidden" name="idToDelete" value="<?=$sirketsayfala['id']?>">
                            <button type="submit" >Sil</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </table>
            <br>

    </div>
    <br>
<?php endforeach;
// bir döngü ile gelen her bir paylaşımı ekrana bastık
?>

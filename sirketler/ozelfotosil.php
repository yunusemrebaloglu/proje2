<?php
require_once "../init.php"; engel();
if(isset($_GET['foto'])){
$kim = htmlspecialchars($_GET['id']);
//__________________________________________________________________
        // Post üstünden gelen verileri değişkenlere alalım hepsini
        $ozelid         = htmlspecialchars($_GET['ozelid']);
        $kid            = $kim;
        $date           = htmlspecialchars(date('d.m.Y H:i:s'));

        //bir alt satırda boş ise diye başlayan bir if else yapısı mevcut.

                    // bir ekleme sorgusu içine, bu değişkenlerle veritabanı sunucusuna talepte bulunalım

                    $addQuery = $connection->prepare("INSERT INTO yanlisdosya (ozelid, kid, date ) VALUES (?, ?, ?)");

                    $isAdded = $addQuery->execute(array($ozelid, $kid, $date ));

                    if ($isAdded) {


//___________________________________________________________________
$photos = $connection->query("SELECT * FROM medias WHERE user_id = $kim")->fetch();
//fotoğrafı silip yerine yenisini yükleyeceğiz
$eskiadi = $photos['path'];
unlink("photos/$eskiadi");



    $idToDelete = (int)$_GET['foto'];

    // DELETE FROM foto WHERE id = $idToDelete
    $deleteQuery = $connection->prepare("DELETE FROM medias WHERE id = ?");
    $isDeleted = $deleteQuery->execute([$idToDelete]);

    echo 'BAŞARIYLA SİLİNDİ';



 header("Location: index.php");


                    } else {
                        echo "yanlış bölgedesiniz.";
                    }

}

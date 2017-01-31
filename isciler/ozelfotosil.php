<?php
require_once "../init.php"; engel();
if(isset($_GET['foto'])){
$kim = $_GET['id'];
$photos = $connection->query("SELECT * FROM media WHERE user_id = $kim")->fetch();
//fotoğrafı silip yerine yenisini yükleyeceğiz
$eskiadi = $photos['path'];
unlink("photos/$eskiadi");



    $idToDelete = (int)$_GET['foto'];

    // DELETE FROM foto WHERE id = $idToDelete
    $deleteQuery = $connection->prepare("DELETE FROM media WHERE id = ?");
    $isDeleted = $deleteQuery->execute([$idToDelete]);

    echo 'BAŞARIYLA SİLİNDİ';
}


 header("Location: index.php");
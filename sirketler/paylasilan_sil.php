<?php include('head.php'); ?>
<body>

<div class="container">
    <?php include('navbar.php'); ?>


    <?php
    engel();
    require_once "../init.php";
    $id =$_SESSION['id'];
    if(isset($_POST['idToDelete'])){
        $idToDelete = (int)$_POST['idToDelete'];

        // DELETE FROM students WHERE id = $idToDelete
        $deleteQuery = $connection->prepare("DELETE FROM paylasim WHERE id = ?");
        $isDeleted = $deleteQuery->execute([$idToDelete]);

        echo 'BAŞARIYLA SİLİNDİ';
        header('Location: index.php');
    }
    ?>
</div>
</body>
</html>

<?php require_once "../init.php";?>
<div class="container-baş">

    <div class="row">
        <div class="col-sm-12" >
            <div class="resim">
                <img src="../img/bayrakkenar.jpg"  width="0" height="277">
            </div>
        </div>



    </div>
</div>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <?php if ($_SESSION['ozelid'] == 1) {?>
                <a class="navbar-brand" href="../sirketler/index.php">ANASAYFA</a>
            <?php } elseif ($_SESSION['ozelid']==2) { ?>
                <a class="navbar-brand" href="index.php">ANASAYFA</a>
                <a class="navbar-brand" href="sirketlerisayfala.php">ŞİRKETLER</a>
            <? }?>

        </div>
        <div class="collapse navbar-collapse" id="myNavbar">

             <ul class="nav navbar-nav navbar-right">
                 <a class="navbar-brand" href="paylasilanlarisayfala.php">Hali Hazırda İşler</a>
                 <?php if ($_SESSION['ozelid'] == 1) {?>
                     <a class="navbar-brand" href="../sirketler/paylasilanlarisayfala.php">Hali Hazırda İşler</a>
                     <li class="dropdown">
                         <a class="dropdown-toggle" data-toggle="dropdown" href="#">Listeleme paneli <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="../sirketler/iscilerisayfala.php">İşçiler</a></li>
                             <li><a href="../sirketler/sirketlerisayfala.php">Şirketler</a></li>
                         </ul>
                     </li>
                 <?php } ?>
                 <li class="dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">profil paneli <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                         <?php if ($_SESSION['ozelid'] == 1) {?>
                             <li><a href="../sirketler/profil.php?id=<?= $_SESSION["id"]?>">profilim</a></li>
                         <?php } elseif ($_SESSION['ozelid']==2) { ?>
                             <li><a href="profil.php?id=<?= $_SESSION["id"]?>">profilim</a></li>
                         <? }?>
                         <li><a href="cikis.php">ÇIKIŞ YAP</a></li>

                     </ul>
                 </li>

             </ul>
        </div>
        </div>

</nav>

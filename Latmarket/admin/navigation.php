<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<header>

    <a href="index.php" class="<?= $currentPage == 'index.php' ? 'in' : '' ?>"><i class="fa fa-home"></i>Sakuma lapa</a>

    <a href="atsauksmes.php" class="<?= $currentPage == 'atsauksmes.php' ? 'in' : '' ?>"><i class="far fa-comment"></i>Atsaukmes</a>

    <a href="sludinajumi.php" class="<?= $currentPage == 'sludinajumi.php' ? 'in' : '' ?>"><i class="fa fa-home"></i>Sludinājumi</a>

    <a href="lietotaji.php" class="<?= $currentPage == 'lietotaji.php' ? 'in' : '' ?>"><i class="fas fa-user-alt"></i>Lietotāji</a>

    <a href="jaunumi.php" class="<?= $currentPage == 'jaunumi.php' ? 'in' : '' ?>"><i class="fas fa-newspaper"></i>Jaunumi</a>

    <a href="/database/logout.php" class="logout"><i class="fa fa-sign-out"></i>Logout</a>

</header>
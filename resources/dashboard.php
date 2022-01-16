<?php
$title = 'Dashboard';
?>
<h1>Welcome back, <?php echo $user->username; ?></h1>

<a href="<?= RouteHelper::getRoute('logout') ?>">Logout</a>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="/Style/dashboard.css">

</head>
<body>
  
</body>
</html>

<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<h2>Bonjour <?= $user->getFirstname() ?>, bienvenue sur votre tableau de bord.</h2>
<br>
<a href="<?php echo  ONLINE_DOMAIN . "/" . SITE_NAME ?>">
  <button class="btn btn-success mybutton">Voir le site</button>
</a>
<br><br>
<a href="<?php echo ONLINE_DOMAIN ?>/users">
  <button class="btn btn-outline-primary mybutton">Utilisateurs</button>
</a>
<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
  <br><br>
  <a href="<?php echo ONLINE_DOMAIN ?>/pages">
  <button class="btn btn-outline-primary mybutton">Pages</button>
  </a>
  <br><br>
  <a href="<?php echo ONLINE_DOMAIN ?>/articles">
  <button class="btn btn-outline-primary mybutton">Articles</button>
  </a>
  <br><br>
<?php } ?>

<?php if ($_SESSION['role'] == 1) { ?>
  <a href="<?php echo ONLINE_DOMAIN ?>/menus">
  <button class="btn btn-outline-primary mybutton">Menu</button>
  </a>
  <br><br>
<?php } ?>
<br><br>
<a href="<?php echo ONLINE_DOMAIN ?>/logout">
  <button class="btn btn-outline-danger mybutton">Se déconnecter</button>
</a>
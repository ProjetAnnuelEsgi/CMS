<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(false);
?>
<a href="<?php echo ONLINE_DOMAIN ?>/home">
  <button>Accueil</button>
</a>
<h1>Inscription</h1>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../Style/register.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
  <div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
  </div>

  <?php $this->includePartial("form", $user->getRegisterForm()) ?>
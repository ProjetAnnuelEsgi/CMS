<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(false);
?>

<a href="http://localhost/">
  <button>Accueil</button>

</a>
<a href="http://localhost/showpwd">
  <button>Mot de passe oublié ?</button>
</a>
<h1>Se connecter</h1>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../Style/login.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />
</head>

<body>
  <div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
  </div>
</body>

<?php $this->includePartial("form", $user->getLoginForm()); ?>
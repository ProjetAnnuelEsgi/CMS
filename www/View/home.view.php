<h1>Bienvenue sur notre CMS</h1>

<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(false);

?>
<div class="home-button">
<br>
<a href="http://localhost/login">
  <button>Se connecter</button>
</a>

<!-- Espace &#160 -->
&#160;

<a href="http://localhost/register">
  <button>S'inscrire</button>
</a>
</div>
<html lang="en">
<head>
    <link rel="stylesheet" href="../Style/home.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>
<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<h2>Bonjour <?= $_SESSION['firstname'] ?>, bienvenue sur votre tableau de bord.</h2>

<a href="http://localhost/users">
  <button>Utilisateurs</button>
</a>

<a href="http://localhost/pages">
  <button>Pages</button>
</a>

<a href="http://localhost/logout">
  <button>Se déconnecter</button>
</a>
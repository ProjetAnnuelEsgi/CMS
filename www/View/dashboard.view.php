<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<h2>Bonjour <?= $user->getFirstname() ?>, bienvenue sur votre tableau de bord.</h2>

<a href="<?php echo ONLINE_DOMAIN ?>/users">
  <button>Utilisateurs</button>
</a>

<a href="<?php echo ONLINE_DOMAIN ?>/pages">
  <button>Pages</button>
</a>

<a href="<?php echo ONLINE_DOMAIN ?>/articles">
  <button>Articles</button>
</a>

<a href="<?php echo ONLINE_DOMAIN ?>/logout">
  <button>Se déconnecter</button>
</a>
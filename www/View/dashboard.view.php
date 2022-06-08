<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated();
?>
<h2>Bonjour <?= $_SESSION['firstname'] ?>, bienvenue sur votre dashboard.</h2>

<?php echo "Ceci est un beau dashboard"; ?>

<a href="http://localhost/user/index">
  <button> List Users</button>
</a>

<a href="http://localhost/logout">
  <button>Logout</button>
</a>
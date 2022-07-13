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
<h1>Page de login</h1>
<h2>veuillez vous connecter</h2>
<?php

$this->includePartial("form", $user->getLoginForm());

?>
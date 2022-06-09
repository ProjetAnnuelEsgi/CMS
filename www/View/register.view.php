<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(false);
?>
<a href="http://localhost/">
  <button>Homepage</button>
</a>
<h1>S'inscrire</h1>

<?php $this->includePartial("form", $user->getRegisterForm()) ?>
<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(false);
?>

<a href="http://localhost/">
  <button>Homepage</button>
</a>
<h1>Page de login</h1>
<h2>veuillez vous connecter</h2>
<?php

$this->includePartial("form", $user->getLoginForm());

?>
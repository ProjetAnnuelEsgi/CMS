<h1>Welcome</h1>

<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(false);

?>

<a href="http://localhost/login">
  <button>Login</button>
</a>
<a href="http://localhost/register">
  <button>Register</button>
</a>
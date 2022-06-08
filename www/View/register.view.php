<?php
session_start();
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {
  header("location: dashboard");
  exit;
}
?>
<a href="http://localhost/">
  <button>Homepage</button>
</a>
<h1>S'inscrire</h1>

<?php $this->includePartial("form", $user->getRegisterForm()) ?>
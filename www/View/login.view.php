<?php
session_start();
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {
  header("location: dashboard");
  exit;
}
?>

<h1>Page de login</h1>
<h2>veuillez vous connecter</h2>
<?php

$this->includePartial("form", $user->getLoginForm());

?>
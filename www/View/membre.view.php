<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Page membre</title>
  <meta name="description" content="Description de ma page">
</head>

<body>

  <?php include "View/" . $this->view . ".view.php"; ?>

</body>

</html>
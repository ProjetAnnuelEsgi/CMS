<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);

$titre = $page->getPageTitle();
$contenu = $page->getPageContent();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page</title>
</head>
<body>
    <h1><?= $titre ?></h1>
    <p><?= $contenu ?></p>
</body>
</html>
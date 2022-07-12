<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);

$titre = $article->getArticleTitle();
$contenu = $article->getArticleContent();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Article</title>
</head>
<body>
    <h1><?= $titre ?></h1>
    <p><?= $contenu ?></p>
</body>
</html>
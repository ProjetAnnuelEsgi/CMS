<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  
</body>
</html>

<?php

use App\Controller\Authenticator;
use App\Model\User;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<html>
<a href="<?php echo ONLINE_DOMAIN ?>/dashboard">
  <button class="btn btn-secondary">Tableau de bord</button>
</a>

<a href="<?php echo ONLINE_DOMAIN ?>/page/add">
  <button class="btn btn-info">Ajouter une page</button>
</a>

<center>
  <br>

  <h1>Pages</h1>
</html>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Editeur</th>
      <th scope="col">Date</th>
      <th scope="col">Editer</th>
      <th scope="col">Voir</th>
    </tr>
  </thead>
  <?php

  //liste des pages présentes en bdd

  $user = new User();
  $abonneData = [];
  foreach ($pages as $page) {
    if ($connectedUser->getRole() === '3') {
      if ($page['page_authorId'] == $connectedUser->getId()) {
        array_push($abonneData, $page);
      }
    } else {
      $abonneData = $pages;
    }
  }

  foreach ($abonneData as $page) {

    $foundCreator = $user->findOne(['id' => $page['page_authorId']]);
    $date = $page['page_createdAt'];
    $date =  date('d-m-Y', strtotime($date));

    $slug = $page['page_slug'];

    echo "<tr><td> " . $page['page_title'] . "</td>";
    echo "<td>" . $foundCreator->getFullName() . "</td>";
    echo  "<td>" . $date . "</td>";

    $linkEdit = "href=page/edit?id=" . $page[0];
    $linkArticle = "href=$slug";
    $iconEdit = "<img src=/Medias/icon_edit.png width=30 height=30>";
    $iconArticle = "<img src=/Medias/icon_article.png width=30 height=30>";

    echo "<td><a " . $linkEdit . ">" . $iconEdit . "</a></td>";
    echo "<td><a " . $linkArticle . ">" . $iconArticle . "</a></td>";
  }

  ?>

  </center>
</table>
<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<html>
<a href="<?php echo ONLINE_DOMAIN ?>/dashboard">
  <button>Tableau de bord</button>
</a>

<a href="<?php echo ONLINE_DOMAIN ?>/article/add">
  <button>Ajouter un article</button>
</a>

<center>
  <br>


</html>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Auteur</th>
      <th scope="col">Catégorie</th>
      <th scope="col">Date de création</th>
    </tr>
  </thead>
  <?php

  //liste des articles présents en bdd
  foreach ($articles as $article) {

    $date = $article['article_createdAt'];
    $date =  date('d-m-Y', strtotime($date));

    $slug = $article['article_slug'];

    echo "<tr><td> " . $article['article_title'] . "</td>";
    echo "<td>" . $article['article_authorId'] . "</td>";
    echo "<td>" . $article['article_categoryId'] . "</td>";
    echo  "<td>" . $date . "</td>";

    $linkEdit = "href=article/edit?id=" . $article[0];
    $linkArticle = "href=$slug";
    $iconEdit = "<img src=/Medias/icon_edit.png width=30 height=30>";
    $iconArticle = "<img src=/Medias/icon_article.png width=30 height=30>";

    echo "<td><a " . $linkEdit . ">" . $iconEdit . "</a></td>";
    echo "<td><a " . $linkArticle . ">" . $iconArticle . "</a></td>";
  }

  ?>

  </center>
</table>
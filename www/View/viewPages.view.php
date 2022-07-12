<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<html>
<a href="http://localhost/dashboard">
  <button>Tableau de bord</button>
</a>

<a href="http://localhost/page/add">
  <button>Ajouter une page</button>
</a>

<center>
  <br>


</html>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Auteur</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <?php

  //liste des pages présentes en bdd

  foreach ($pages as $page) {

    $date = $page['page_createdAt'];
    $date =  date('d-m-Y', strtotime($date));

    $slug = $page['page_slug'];

    echo "<tr><td> " . $page['page_title'] . "</td>";
    // echo "<td>" . $findone->getFullName() . "</td>";
    echo "<td>" . '' . "</td>";
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
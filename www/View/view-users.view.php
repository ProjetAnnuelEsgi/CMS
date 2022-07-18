<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<html>
<a href="http://localhost/dashboard">
  <button>Tableau de bord</button>
</a>

<a href="http://localhost/admin/createUser">
  <button>Ajouter un utilisateur</button>
</a>

<center>
  <br>

</html>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Mail</th>
      <th scope="col">Détails</th>
    </tr>
  </thead>
  <?php

  //liste des users présents en bdd
  foreach ($users as $user) {
    echo "<tr><td> " . $user['lastname'] . "</td>";
    echo  "<td>" . $user['firstname'] . "</td>";
    echo  "<td>" . $user['email'] . "</td>";

    $linkShow = "href=user/show?id=" . $user[0];
    $iconShow = "<img src=/Medias/icon_show.png width=30 height=30>";

    echo "<td><a " . $linkShow . ">" . $iconShow . "</a></td>";
  }

  ?>

  </center>
</table>
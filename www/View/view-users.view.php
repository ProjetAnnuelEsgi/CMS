<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<html>
<a href="<?php echo ONLINE_DOMAIN ?>/dashboard">
  <button>Tableau de bord</button>
</a>

<a href="<?php echo ONLINE_DOMAIN ?>/admin/createUser">
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
      <th scope="col">Roles</th>
      <th scope="col">Détails</th>
    </tr>
  </thead>
  <?php

  //liste des users présents en bdd
  foreach ($users as $user) {

    $r = '';

    switch ($user['role']) {
      case '0':
        $r = 'Abonné';
        break;
      case '1':
        $r = 'Admin';
        break;
      case '2':
        $r = 'Auteur';
        break;
    }

    echo "<tr><td> " . $user['lastname'] . "</td>";
    echo  "<td>" . $user['firstname'] . "</td>";
    echo  "<td>" . $user['email'] . "</td>";
    echo  "<td>" . $r . "</td>";

    $linkShow = "href=user/show?id=" . $user[0];
    $iconShow = "<img src=/Medias/icon_show.png width=30 height=30>";

    $iconShow = "<img src=/Medias/icon_show.png width=45 height=50>";
    echo "<td><a " . $linkShow . ">" . $iconShow . "</a></td>";
  }

  ?>

  </center>
</table>
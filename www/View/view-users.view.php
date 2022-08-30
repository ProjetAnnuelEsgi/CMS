<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<html>
<a href="<?php echo ONLINE_DOMAIN ?>/dashboard">
  <button>Tableau de bord</button>
</a>

<?php
if ($foundUser->getRole() === '0' || $foundUser->getRole() === '1') { ?>
  <a href="<?php echo ONLINE_DOMAIN ?>/admin/createUser">
    <button>Ajouter un utilisateur</button>
  </a>
<?php
}
?>

<center>
  <br>
  <?php
  if ($foundUser->getId() !== $_SESSION['userId']) {
  } elseif ($foundUser->getId() === $_SESSION['userId'] && count($adminUsers) === 0) {
    die;
  }

  if ($foundUser->getRole() == '0' || $foundUser->getRole() == '1') { ?>
    <h1>Utilisateurs</h1>

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

    // liste des users de l'admin présents en bdd
    foreach ($adminUsers as $user) {

      $r = '';

      switch ($user['role']) {
        case '1':
          $r = 'Admin';
          break;
        case '2':
          $r = 'Editeur';
          break;
        case '3':
          $r = 'Abonné';
          break;
      }

      echo "<tr><td> " . $user['lastname'] . "</td>";
      echo  "<td>" . $user['firstname'] . "</td>";
      echo  "<td>" . $user['email'] . "</td>";
      echo  "<td>" . $r . "</td>";

      $linkShow = "href=/user/show?id=" . $user[0];
      $iconShow = "<img src=/Medias/icon_show.png width=30 height=30>";

      $iconShow = "<img src=/Medias/icon_show.png width=45 height=50>";
      echo "<td><a " . $linkShow . ">" . $iconShow . "</a></td>";
    }
  }
    ?>
    </table>
</center>

</html>
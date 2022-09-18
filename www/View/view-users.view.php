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

$auth = new Authenticator();
$auth->authenticated(true);
?>
<html>
<a href="<?php echo ONLINE_DOMAIN ?>/dashboard">
  <button class="btn btn-secondary">Tableau de bord</button>
</a>

<?php
if ($foundUser->getRole() === '1') { ?>
  <a href="<?php echo ONLINE_DOMAIN ?>/admin/createUser">
    <button class="btn btn-info">Ajouter un utilisateur</button>
  </a>
<?php
}
?>

<center>
  <br>
  <?php
  // if ($foundUser->getId() !== $_SESSION['userId']) {
  // } elseif ($foundUser->getId() === $_SESSION['userId'] && count($adminUsers) === 0) {
  //   die;
  // }
  ?>
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
    if ($foundUser->getRole() == '1') {
      // liste des users de l'admin présents en bdd
      if (count($adminUsers) != 0) {

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
      } else {

        $r = '';

        switch ($foundUser->getRole()) {
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
        echo "<tr><td> " . $foundUser->getLastname() . "</td>";
        echo  "<td>" . $foundUser->getFirstname() . "</td>";
        echo  "<td>" . $foundUser->getEmail() . "</td>";
        echo  "<td>" . $r . "</td>";

        $linkShow = "href=/user/show?id=" . $foundUser->getId();
        $iconShow = "<img src=/Medias/icon_show.png width=30 height=30>";

        $iconShow = "<img src=/Medias/icon_show.png width=45 height=50>";
        echo "<td><a " . $linkShow . ">" . $iconShow . "</a></td>";
      }
    } else {

      $r = '';

      switch ($foundUser->getRole()) {
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
      echo "<tr><td> " . $foundUser->getLastname() . "</td>";
      echo  "<td>" . $foundUser->getFirstname() . "</td>";
      echo  "<td>" . $foundUser->getEmail() . "</td>";
      echo  "<td>" . $r . "</td>";

      $linkShow = "href=/user/show?id=" . $foundUser->getId();
      $iconShow = "<img src=/Medias/icon_show.png width=30 height=30>";

      $iconShow = "<img src=/Medias/icon_show.png width=45 height=50>";
      echo "<td><a " . $linkShow . ">" . $iconShow . "</a></td>";
    }
    ?>
  </table>
</center>

</html>
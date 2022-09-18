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

<br>


<center>

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Pages</th>
        <th scope="col">Ajouter / Retirer</th>
      </tr>
    </thead>
    <?php

    foreach ($pages as $page) {

      $iconPlus = "<img src=/Medias/icon_plus.png width=30 height=30>";
      $iconMoins = "<img src=/Medias/icon_moins.png width=30 height=30>";

      $addLink = "href=menu/add?id=" . $page['id'];
      $removeLink = "href=menu/delete?id=" . $page['id'];

      echo "<tr><td> " . $page['page_title'] . "</td>";

      if (!in_array($page['id'], $allMenuPageId)) {
        echo "<td><a " . $addLink . ">" . $iconPlus . "</a></td>";
      } else {
        echo "<td><a " . $removeLink . ">" . $iconMoins . "</a></td>";
      }
    }
    ?>

  </table>

</center>
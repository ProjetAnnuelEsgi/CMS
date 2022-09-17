<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<html>
<a href="<?php echo ONLINE_DOMAIN ?>/dashboard">
  <button>Tableau de bord</button>
</a>

<br>


<center>

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Page</th>
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
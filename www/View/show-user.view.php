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
<button class="bi bi-arrow-return-right" type="button" onclick="history.back()"> <img src="/Medias/icon_arrow_return_left.png" height ="20" width="35" /></button>

<a href="<?php echo ONLINE_DOMAIN ?>/dashboard">
	<button class="btn btn-secondary">Tableau de bord</button>
</a>
<div id="contenu">

	<center>
		<table border="1" cellpadding="15">
			<tr>
				<h1>Informations de <?php echo $user->getFirstname() ?></h1>

				<input type=text name=lastname placeholder="Nom" disabled value=<?php echo $user->getLastname() ?>>
				<!-- Espace &#160 -->
                &#160;
				<input type=text name=firstname placeholder="Prénom" disabled value=<?php echo $user->getFirstname() ?>>
				<!-- Espace &#160 -->
                &#160;
				<input type=text name=email placeholder="Email" disabled value=<?php echo $user->getEmail() ?>>
				<!-- Espace &#160 -->
                &#160;
				<input type=text name=role placeholder="Role" disabled value=<?php echo $user->getUserRoleByName() ?>>
			</tr>
		</table>

		<br>
		<a href="edit?id=<?php echo $_GET['id'] ?>">
			<img src="/Medias/icon_edit.png" height="30" width="30"></a>

		<a href="delete?id=<?php echo $_GET['id'] ?>">
			<img src="/Medias/icon_delete.png" height="30" width="30"></a>
		<?php

		if (count($adminUsers) === 0) {
			die;
		}

		if ($user->getRole() == 'Admin') { ?>

			<h1>Mes utilisateurs</h1>

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
</div>
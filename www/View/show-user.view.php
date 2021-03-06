<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<a href="<?php echo ONLINE_DOMAIN ?>/dashboard">
	<button>Tableau de bord</button>
</a>
<button onclick="history.back()">Retour</button>

<div id="contenu">

	<center>
		<table border="1" cellpadding="15">
			<tr>
				<h1>Informations de <?php echo $user->getFirstname() ?></h1>

				<input type=text name=lastname placeholder="Nom" disabled value=<?php echo $user->getLastname() ?>>
				<input type=text name=firstname placeholder="Prénom" disabled value=<?php echo $user->getFirstname() ?>>
				<input type=text name=email placeholder="Email" disabled value=<?php echo $user->getEmail() ?>>
				<input type=text name=role placeholder="Role" disabled value=<?php echo $user->getUserRoleByName() ?>>
			</tr>
		</table>

		<br>
		<a href="edit?id=<?php echo $_GET['id'] ?>">
			<img src="/Medias/icon_edit.png" height="30" width="30"></a>

		<a href="delete?id=<?php echo $_GET['id'] ?>">
			<img src="/Medias/icon_delete.png" height="30" width="30"></a>

		<?php
		if ($user->getId() !== $_SESSION['userId']) {
			die();
		} elseif ($user->getRole() !== 'Admin' && $user->getId() === $_SESSION['userId'] && count($adminUsers) === 0) {
			die;
		}
		?>
		<h1>Mes Utilisateurs</h1>

		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Nom</th>
					<th scope="col">Prénom</th>
					<th scope="col">Mail</th>
				</tr>
			</thead>
			<?php

			// liste des users de l'admin présents en bdd
			foreach ($adminUsers as $user) {
				echo "<tr><td> " . $user['lastname'] . "</td>";
				echo  "<td>" . $user['firstname'] . "</td>";
				echo  "<td>" . $user['email'] . "</td>";

				$linkShow = "href=/user/show?id=" . $user[0];
				$iconShow = "<img src=/Medias/icon_show.png width=30 height=30>";

				echo "<td><a " . $linkShow . ">" . $iconShow . "</a></td>";
			}
			?>
	</center>
</div>
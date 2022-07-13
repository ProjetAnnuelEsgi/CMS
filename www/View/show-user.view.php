<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<a href="http://localhost/dashboard">
	<button>Tableau de bord</button>
</a>
<button onclick="history.back()">Retour</button>

<div id="contenu">

	<table border="1" cellpadding="15">
		<tr>
			<center>
				<h1>Informations de <?php echo $user->getFirstname() ?></h1>
			</center>

			<form action="update?id=<?php echo $_GET['id'] ?>" method="post">
				<input type=text name=lastname placeholder="Nom" disabled value=<?php echo $user->getLastname() ?>>
				<input type=text name=firstname placeholder="Prénom" disabled value=<?php echo $user->getFirstname() ?>>
				<input type=text name=email placeholder="Email" disabled value=<?php echo $user->getEmail() ?>>
		</tr>
	</table>

	<br>
	<a href="edit?id=<?php echo $_GET['id'] ?>">
		<img src="/Medias/icon_edit.png" height="30" width="30"></a>

	<a href="delete?id=<?php echo $_GET['id'] ?>">
		<img src="/Medias/icon_delete.png" height="30" width="30"></a>

	</form>
</div>
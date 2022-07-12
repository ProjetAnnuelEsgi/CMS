<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<a href="http://localhost/users">
	<button> Liste des utilisateurs</button>
</a>
<button onclick="history.back()">Retour</button>

<div id="contenu">

	<table border="1" cellpadding="15">
		<tr>
			<center>
				<h1>Modifier les informations <?php echo $user->getFirstname() ?></h1>
			</center>

			<form action="update?id=<?php echo $_GET['id'] ?>" method="post">
				<input type=text name=lastname placeholder="Nom" value=<?php echo $user->getLastname() ?>>
				<input type=text name=firstname placeholder="Prénom" value=<?php echo $user->getFirstname() ?>>
				<input type=text name=email placeholder="Email" value=<?php echo $user->getEmail() ?>>
				<input type=submit name=valider value=valider></td>
		</tr>
	</table>
	</form>
</div>
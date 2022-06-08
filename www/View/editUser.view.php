<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated();
?>
<div id="contenu">

	<table border="1" cellpadding="15">
		<tr>
			<center>
				<h1>Modifier mes informations</h1>
			</center>

			<form action="update?id=<?php echo $_GET['id'] ?>" method="post">

				<td><input type=text name=lastname placeholder="Nom" value=<?php echo $user->getLastname() ?>></td>
				<td><input type=text name=firstname placeholder="Prénom" value=<?php echo $user->getFirstname() ?>></td>
				<td><input type=text name=email placeholder="Email" value=<?php echo $user->getEmail() ?>></td>
				<td><input type=submit name=valider value=valider></td>
		</tr>
	</table>
	</form>
</div>
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
		<center><h1>Ajouter un utilisateur</h1></center>

<form action="" method="post" onsubmit="mysubmit()">

            <input type=text name=firstname placeholder="Prénom">
            <!-- Espace &#160 -->
            &#160;
            <input type=text name=lastname placeholder="Nom">
            &#160;
            <input type=email name=email placeholder="Email">
            &#160;
            <input type=password name=password placeholder="Mot de passe">
            <br><br>
			<input type=submit name=valider value=valider>
		</tr>
	</table>
</form>
</div>
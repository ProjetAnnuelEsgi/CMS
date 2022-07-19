<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>
<a href="<?php echo ONLINE_DOMAIN ?>/users">
	<button> Liste des utilisateurs</button>
</a>
<button onclick="history.back()">Retour</button>

<div id="contenu">

	<center>
		<table border="1" cellpadding="15">
			<tr>
				<h1>Modifier les informations <?php echo $user->getFirstname() ?></h1>

				<form action="update?id=<?php echo $_GET['id'] ?>" method="post">
					<input type=text name=lastname placeholder="Nom" value=<?php echo $user->getLastname() ?>>
					<input type=text name=firstname placeholder="Prénom" value=<?php echo $user->getFirstname() ?>>
					<input type=text name=email placeholder="Email" value=<?php echo $user->getEmail() ?>>
					<select id="roles" name='role' onfocus="buttonToggle()">
						<option selected><?php echo $user->getUserRoleByName() ?></option>
						<option id="r" value='0'>Abonné</option>
						<option id="r" value='1'>Admin</option>
						<option id="r" value='2'>Auteur</option>
					</select>
					<input type=submit name=valider value=valider></td>
			</tr>
		</table>
		<center>
			</form>
</div>
<?php

$userId = $user->getId();
$loggedInUserId = $_SESSION['userId'];
$loggedInUserRole = $_SESSION['role'];

?>
<script type="text/javascript">
	function buttonToggle() {
		if (<?php echo ($loggedInUserRole); ?> !== 1 || <?php echo ($userId); ?> === <?php echo ($_SESSION['userId']); ?>) {
			document.querySelectorAll("#r").forEach(opt => {
				opt.disabled = true;
			});
		}
	}
</script>
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

<div id="contenu">

	<center>
		<table border="1" cellpadding="15">
			<tr>
				<h1>Modifier les informations <?php echo $user->getFirstname() ?></h1>

				<form action="update?id=<?php echo $_GET['id'] ?>" method="post">
					<input type=text name=lastname placeholder="Nom" value=<?php echo $user->getLastname() ?>>
					<!-- Espace &#160 -->
					&#160;
					<input type=text name=firstname placeholder="Prénom" value=<?php echo $user->getFirstname() ?>>
					<!-- Espace &#160 -->
					&#160;
					<input type=text name=email placeholder="Email" value=<?php echo $user->getEmail() ?>>
					<!-- Espace &#160 -->
					&#160;
					<select id="roles" name='role' onfocus="buttonToggle()">
						<option selected><?php echo $user->getUserRoleByName() ?></option>
						<option id="r" value='1'>Admin</option>
						<option id="r" value='2'>Editeur</option>
						<option id="r" value='3'>Abonné</option>
					</select>
					<br><br>
					<input type=submit class="btn btn-success" name=valider value=valider></td>
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
		if (<?php echo ($loggedInUserRole) ?> === 1) {
			document.querySelectorAll("#r").forEach(opt => {
				opt.disabled = false;
			});
		} else {
			document.querySelectorAll("#r").forEach(opt => {
				opt.disabled = true;
			});
		}
	}
</script>
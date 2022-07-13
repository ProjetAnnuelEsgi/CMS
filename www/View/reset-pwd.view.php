	<!doctype html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Réinitialisation du mot de passe</title>
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	</head>

	<body>
		<div class="container">
			<div class="card">
				<div class="card-header text-center">
				Réinitialiser le mot de passe
				</div>
				<div class="card-body">
					<?php

					if (isset($_GET['key']) && isset($_GET['token'])) {
						$curDate = date("Y-m-d H:i:s");
						$email = $_GET['key'];
						$token = $_GET['token'];
						$reset_link_token = $_GET['key'] . $_GET['token'];
						$foundUser = $user->findOne(['reset_link_token' => $reset_link_token]);
						if ($foundUser) {
							$activation_expiry = $foundUser->getActivationExpiry();
						} else {
							header("Location: showpwd");
						}

						if ($activation_expiry >= $curDate) { ?>

							<form action="/setpwd" method="post">
								<input type="hidden" name="email" value="<?php echo $email; ?>">
								<input type="hidden" name="reset_link_token" value="<?php echo $token; ?>">
								<div class="form-group">
									<label; for="exampleInputEmail1">Nouveau mot de passe</label;>
									<input type="password" name='password' id='password' class="form-control">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Confirmation du nouveau mot de passe</label>
									<input type="password" name='confirm' id="confirm" class="form-control">
								</div>
								<input type="submit" name="new-password" class="btn btn-primary">
							</form>
						<?php } else { ?>
							<p>Nous sommes désolés mais votre lien a expiré</p>
					<?php }
					}
					?>
				</div>
			</div>
		</div>
	</body>

	</html>
	<script>
		var password = document.getElementById("password");
		var cpassword = document.getElementById("confirm");

		function hasLowerCase(str) {
			return (/[a-z]/.test(str));
		}

		function hasCapitalCase(str) {
			return (/[A-Z]/.test(str));
		}

		function hasNumber(str) {
			return (/[0-9]/.test(str));
		}

		function validatePassword() {
			if (password.value != cpassword.value) {
				cpassword.setCustomValidity("Passwords Don't Match");
			} else if (password.value.length <= 8) {
				password.setCustomValidity("Your Password Must Contain At Least 8 Characters!");
			} else if (!hasNumber(password.value)) {
				password.setCustomValidity("Your Password Must Contain At Least 1 Number!");
			} else if (!hasCapitalCase(password.value)) {
				password.setCustomValidity("Your Password Must Contain At Least 1 Capital Letter!");
			} else if (!hasLowerCase(password.value)) {
				password.setCustomValidity("Your Password Must Contain At Least 1 Lowercase Letter!");
			} else {
				cpassword.setCustomValidity('');
			}
		}

		password.addEventListener('change', (event) => {
			validatePassword()
		});

		cpassword.addEventListener('keyup', (event) => {
			validatePassword()
		});
	</script>
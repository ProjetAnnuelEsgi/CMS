<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(false);

?>

<h1>Welcome</h1>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>User Account Activation by Email Verification using PHP</title>
<!-- CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php
    $msg = '';
    if(isset($_GET['key']))
    {
        $activationCode = $_GET['key'];
        $foundUser = $user->findOne(['activation_code'=>$activationCode]);
        
        $date = date('Y-m-d H:i:s');
        if($foundUser === false){
            $msg = "L'email n'existe pas";
        }elseif($foundUser->getActive() === 1 && $foundUser->getActivatedAt() !== null){
            $msg = "Votre compte à déja été activé";
        }else {
            $foundUser->setActive(1);
            $foundUser->setActivatedAt($date);

            $foundUser->save();

            echo 'Votre compte à bien été activé, vous pouvez vous connecter 
            <a 
                href="http://localhost/login"
                <button>Se connecter</button>
            </a>';
        }
    }

?> 
<div class="container mt-3">
<div class="card">
<div class="card-header text-center">
User Account Activation by Email Verification using PHP
</div>
<div class="card-body">
<p><?php echo $msg; ?></p>
</div>
</div>
</div>
</body>
</html>



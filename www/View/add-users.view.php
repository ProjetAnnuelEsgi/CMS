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
                <center>
                    <h1>Ajouter un utilisateur</h1>
                </center>
    
                <form action="" method="post">
    
                    <input type=text name=firstname placeholder="Prénom">
                    <!-- Espace &#160 -->
                    &#160;
                    <input type=text name=lastname placeholder="Nom">
                    &#160;
                    <input type=email name=email placeholder="Email">
                    &#160;
                    <input type=password name=password placeholder="Mot de passe">
                    &#160;
                    <input name="admin_id" type="hidden" value=<?php echo $_SESSION['userId']   ?> id="article_content" />
                    <select id="roles" name='role' onfocus="buttonToggle()">
                        <option selected><?php echo $user->getUserRoleByName() ?></option>
                        <option id="r" value='1'>Admin</option>
                        <option id="r" value='2'>Editeur</option>
                        <option id="r" value='3'>Abonné</option>
                    </select>
    
                    &#160; <br><br>
                    <input type=submit class="btn btn-success" name=valider value=valider></td>
            </tr>
        </table>
    </center>
    </form>
</div>
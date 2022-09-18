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
                <input type=submit name=valider value=valider>
        </tr>
    </table>
    </form>
</div>
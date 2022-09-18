<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <center>

  <h1>Installation</h1>
  <form action="checkData" method="post">
    <label>Nom d'utilisateur base de données</label></br>
    <input type=text name=dbuser placeholder="Nom"></br>
    <br>
    <label>Mot de passe base de données</label></br>
    <input type=password name=dbpassword placeholder="Mot de passe"></br>
    <br>
    <label>Nom base de données</label></br>
    <input type=text name=dbname placeholder="Nom base de données"></br>
    <br>
    <label>Hôte base de données</label></br>
    <input type=text name=dbhost placeholder="Hôte base de données"></br>
    <br>
    <label>Port base de données</label></br>
    <input type=number name=dbport placeholder="Port base de données"></br>
    <br>
    <label>Nom du site</label></br>
    <input type=text name=siteName placeholder="Nom du site"></br>
    <br>
    <input type=submit class="btn btn-success" name=valider value=valider></td>
    </tr>
    </table>
  </form>

  </center>
</body>

</html>
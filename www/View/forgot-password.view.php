<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header text-center">
        Envoi de lien pour la réinitialisation du mot de passe
      </div>
      <div class="card-body">
        <form action="/forget" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Adresse mail</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre adresse électronique avec qui que ce soit.</small>
          </div>
          <input type="submit" name="forget" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>

</body>

</html>
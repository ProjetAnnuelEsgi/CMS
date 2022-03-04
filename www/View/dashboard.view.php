<?php session_start(); ?>
<h2>Bonjour <?= $_SESSION['firstname'] ?>, bienvenue sur votre dashboard.</h2>

<?php echo "Ceci est un beau dashboard"; ?>

<a href="http://localhost/logout">
  <button>Logout</button>
</a>
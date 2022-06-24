<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Template BACK</title>
    <meta name="description" content="Description de ma page">
</head>

<body>
    <?php var_dump($this->view) ?>
    <?php include "View/" . $this->view . ".view.php"; ?>
</body>

</html>
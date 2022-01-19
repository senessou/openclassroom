<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Site de recettes - login</title>
</head>

<body>
    <?php include_once('header.php'); ?>
    <?php
    // Validation du formulaire
    if (isset($_POST['email']) &&  isset($_POST['password'])) {
        foreach ($users as $user) {
            if (
                $user['email'] === $_POST['email'] &&
                $user['password'] === $_POST['password']
            ) {
                $loggedUser = [
                    'email' => $user['email'],
                ];
            } else {
                $errorMessage = sprintf(
                    'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                    $_POST['email'],
                    $_POST['password']
                );
            }
        }
    }
    ?>
    <?php if (!isset($loggedUser)) : ?>
        <form action="home.php" method="post">
            <!-- si message d'erreur on l'affiche -->
            <?php if (isset($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
                <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <!-- 
        Si utilisateur/trice bien connectée on affiche un message de succès
    -->
    <?php else : ?>
        <div class="alert alert-success" role="alert">
            Bonjour <?php echo $loggedUser['email']; ?> et bienvenue sur le site !
        </div>
    <?php endif; ?>
</body>

</html>

<?php
$db = new PDO(
    'mysql:host=localhost;dbname=my_recipes;charset=utf8',
    'root',
    'root',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
);

$sqlQuery = "SELECT * FROM users WHERE author = ?";
$row = $db->prepare($sqlQuery);
$row->execute([
    $_POST['author'],
]);

$requete = "SELECT u.full_name, c.comment
FROM user u LEFT JOIN comments c ON u.user_id = c.user_id WHERE u.recipe = 'Cassoulet'
ORDER BY c.created_at DESC LIMIT 10";



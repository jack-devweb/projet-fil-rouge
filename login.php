<?php
session_start();
require_once('db.php');

if(isset($_POST['username']) && isset($_POST['password'])) {
    $db = new Db();
    $conn = $db->getConnection();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE nom = :username AND password = :password');
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: forum.php');
        exit();
    } else {
        $error = 'Nom d\'utilisateur ou mot de passe incorrect';
        echo $error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page de connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>
<body>
    <?php if (!isset($_SESSION['user_id'])): ?> <!-- Ajoutez cette ligne -->
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" class="login-form">
            <img src="images/img-appli.png" alt="Image de l'application">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" required>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>
            <button type="submit" class="custom-button">Continuer</button>
        </form>
        <p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
    <?php endif; ?> <!-- Ajoutez cette ligne -->
</body>
</html>
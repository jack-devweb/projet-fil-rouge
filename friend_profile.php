<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['friend_id'])) {
    $friend_id = $_GET['friend_id'];

    // Récupérer les informations de l'ami
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :friend_id");
    $stmt->execute(['friend_id' => $friend_id]);
    $friend = $stmt->fetch();

    if (!$friend) {
        // Ami non trouvé
        header('Location: error_page.php');
        exit();
    }
} else {
    // ID d'ami non fourni
    header('Location: error_page.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil de l'ami</title>
    <!-- Ajoutez vos fichiers CSS ici -->
</head>
<body>
    <h1><?php echo htmlspecialchars($friend['nom']); ?></h1>
    <img src="uploads/<?php echo $friend['image']; ?>" alt="<?php echo htmlspecialchars($friend['nom']); ?>" style="border-radius: 50%;">
    <p>Email: <?php echo htmlspecialchars($friend['email']); ?></p>
    <!-- Ajouter un ami -->
<form action="ajouter_amis.php" method="post">
    <input type="hidden" name="user_id2" value="<?php echo $friend_id; ?>">
    <input type="submit" name="add_friend" value="Ajouter comme ami">
</form>

<!-- Supprimer un ami -->
<form action="supprimer_amis.php" method="post">
    <input type="hidden" name="user_id2" value="<?php echo $friend_id; ?>">
    <input type="submit" name="remove_friend" value="Supprimer l'ami">
</form>
</body>
</html>

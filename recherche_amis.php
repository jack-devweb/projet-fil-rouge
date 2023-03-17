<?php
session_start();
require_once 'db.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupère les informations de l'utilisateur connecté
$db = new Db();
$conn = $db->getConnection();
$stmt = $conn->prepare('SELECT * FROM users WHERE id = :user_id');
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Si le formulaire a été soumis
if (isset($_POST['add_friend'])) {
    $friend_id = $_POST['friend_id'];

    // Vérifie que l'utilisateur n'est pas déjà ami avec cet utilisateur
    $stmt = $conn->prepare('SELECT * FROM amis WHERE user_id = :user_id AND friend_id = :friend_id');
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':friend_id', $friend_id);
    $stmt->execute();
    $existing_friendship = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_friendship) {
        // Si l'utilisateur est déjà ami avec cet utilisateur, affiche un message d'erreur
        $message = 'Vous êtes déjà ami avec cet utilisateur.';
    } else {
        // Si l'utilisateur n'est pas déjà ami avec cet utilisateur, ajoute une nouvelle demande d'ami
        $stmt = $conn->prepare('INSERT INTO demandes_amis (user_id, friend_id) VALUES (:user_id, :friend_id)');
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':friend_id', $friend_id);
        $stmt->execute();
        $message = 'Votre demande d\'ami a été envoyée.';
    }
}

// Recherche des utilisateurs
if (isset($_POST['search'])) {
    $search_term = $_POST['search_term'];
    $stmt = $conn->prepare('SELECT * FROM users WHERE nom LIKE :search_term');
    $stmt->bindValue(':search_term', '%' . $search_term . '%');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $results = [];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recherche d'amis</title>
</head>
<body>
    <h1>Recherche d'amis</h1>
    <p>Bienvenue <?php echo htmlspecialchars($user['nom']); ?> !</p>
    <p>Rechercher des amis :</p>
    <form method="POST">
        <input type="text" name="search_term">
        <input type="submit" name="search" value="Rechercher">
    </form>
    <ul>
        <?php foreach ($results as $result) { ?>
            <li>
                <?php echo htmlspecialchars($result['nom']); ?>
                <form method="POST">
                    <input type="hidden" name="friend_id" value="<?php echo $result['id']; ?>">
                    <input type="submit" name="add_friend" value="Ajouter comme ami">
                </form>
            </li>
        <?php } ?>
    </ul>
    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
</body>
</html>

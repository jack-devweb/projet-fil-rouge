<?php
// Inclure les fichiers de configuration et de connexion à la base de données
require_once 'config.php';
require_once 'db.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Récupérer les données de l'utilisateur connecté
$db = new Db();
$conn = $db->getConnection();
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare('SELECT * FROM users WHERE id = :user_id');
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupérer la liste des amis de l'utilisateur
$stmt = $conn->prepare('SELECT amis.*, users.username, users.email FROM amis INNER JOIN users ON amis.friend_id = users.id WHERE user_id = :user_id');
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$amis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste d'amis</title>
</head>
<body>
    <h1>Liste d'amis</h1>
    <p>Bienvenue, <?php echo $user['username']; ?></p>

    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($amis as $ami) : ?>
                <tr>
                    <td><?php echo $ami['username']; ?></td>
                    <td><?php echo $ami['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php">Retour à l'accueil</a>
</body>
</html>

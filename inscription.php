<?php
// Démarrer la session
session_start();
// Inclure le fichier db.php qui contient la classe Db
require_once('db.php');
// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Créer une nouvelle instance de la classe Db
    $db = new Db();
    // Établir la connexion à la base de données
    $conn = $db->getConnection();
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $date = date("Y-m-d H:i:s");
    $bio = $_POST['bio'];
    $avatar = $_POST['avatar'];
    $jeux_favoris = $_POST['jeux_favoris'];
    // Préparer la requête d'insertion des données dans la table users
    $stmt = $conn->prepare('INSERT INTO users (nom, password, email, date, bio, avatar, jeux_favoris) VALUES (:nom, :password, :email, :date, :bio, :avatar, :jeux_favoris)');
    $stmt->bindParam(':nom', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':bio', $bio);
    $stmt->bindParam(':avatar', $avatar);
    $stmt->bindParam(':jeux_favoris', $jeux_favoris);
    $stmt->execute();
    // Récupérer l'id de l'utilisateur qui vient d'être ajouté à la base de données
    $_SESSION['user_id'] = $conn->lastInsertId();
    // Rediriger l'utilisateur vers la page de chat
    header('Location: chat.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <h1>Inscription</h1>
    <form method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" required><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required><br>
        <label for="email">Email :</label>
        <input type="email" name="email" required><br>
        <label for="bio">Biographie :</label>
        <textarea name="bio"></textarea><br>
        <label for="avatar">Avatar :</label>
        <input type="text" name="avatar"><br>
        <label for="jeux_favoris">Jeux favoris :</label>
        <input type="text" name="jeux_favoris"><br>
        <input type="submit" name="submit" value="S'inscrire">
    </form>
    <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a>.</p>
</body>

</html>
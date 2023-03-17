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

// Récupère la liste des amis de l'utilisateur
$stmt = $conn->prepare('SELECT * FROM amis WHERE user_id = :user_id');
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$friends = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Si le formulaire a été soumis
if (isset($_POST['send_message'])) {
    $friend_id = $_POST['friend_id'];
    $message = $_POST['message'];

    // Envoie le message à l'ami sélectionné
    $stmt = $conn->prepare('INSERT INTO messages (sender_id, recipient_id, message) VALUES (:sender_id, :recipient_id, :message)');
    $stmt->bindParam(':sender_id', $_SESSION['user_id']);
    $stmt->bindParam(':recipient_id', $friend_id);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

    $success_message = 'Votre message a été envoyé !';
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Messages d'amis</title>
</head>
<body>
    <h1>Messages d'amis</h1>
    <p>Bienvenue <?php echo htmlspecialchars($user['nom']); ?> !</p>
    <form method="POST">
        <label for="friend_id">Sélectionnez un ami :</label>
        <select name="friend_id">
            <?php foreach ($friends as $friend) { ?>
                <?php
                    // Récupère les informations sur l'ami
                    $stmt = $conn->prepare('SELECT * FROM users WHERE id = :friend_id');
                    $stmt->bindParam(':friend_id', $friend['friend_id']);
                    $stmt->execute();
                    $friend_info = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <option value="<?php echo $friend_info['id']; ?>"><?php echo $friend_info['nom']; ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="message">Message :</label>
        <textarea name="message"></textarea>
        <br>
        <input type="submit" name="send_message" value="Envoyer le message">
    </form>

    <?php if (isset($success_message)) { ?>
        <p><?php echo $success_message; ?></p>
    <?php } ?>
</body>
</html>

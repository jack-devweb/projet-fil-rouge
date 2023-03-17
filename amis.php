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

// Récupère tous les utilisateurs, sauf l'utilisateur connecté
$stmt = $conn->prepare('SELECT * FROM users WHERE id != :user_id');
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ajoute un ami
if (isset($_POST['add_friend'])) {
    $friend_id = $_POST['friend_id'];
    $stmt = $conn->prepare('INSERT INTO friends (user_id, friend_id) VALUES (:user_id, :friend_id)');
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':friend_id', $friend_id);
    $stmt->execute();
}

// Supprime un ami
if (isset($_POST['delete_friend'])) {
    $friend_id = $_POST['friend_id'];
    $stmt = $conn->prepare('DELETE FROM friends WHERE user_id = :user_id AND friend_id = :friend_id');
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':friend_id', $friend_id);
    $stmt->execute();
}

// Récupère la liste des amis de l'utilisateur
$stmt = $conn->prepare('SELECT users.nom, users.id FROM friends JOIN users ON friends.friend_id = users.id WHERE friends.user_id = :user_id');
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$friends = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/1z8SoEvPzUHBzIOAU5w6gA2Y7rUp6UJLl0rJ6+"
 crossorigin="anonymous" />
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-**************" crossorigin="anonymous" />
</head>

<body>
    <header class="header">
        <a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a>
    <title>Amis</title>
    <style>
        .user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <h1>Amis</h1>
    <p>Bienvenue
        <?php echo htmlspecialchars($user['nom']); ?> !
    </p>
    <h2>Ajouter un ami</h2>
    <form method="post">
        <select name="friend_id">
            <?php foreach ($users as $user) { ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['nom']; ?></option>
            <?php } ?>
        </select>
        <button type="submit" name="add_friend">Ajouter</button>
    </form>
    <h2>Liste d'amis</h2>
    <ul>
    <?php foreach ($friends as $friend) { ?>
    <li>
        <?php
            $stmt = $conn->prepare('SELECT * FROM users WHERE id = :friend_id');
            $stmt->bindParam(':friend_id', $friend['id']);
            $stmt->execute();
            $friend_user = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <img src="<?php echo $friend_user['image']; ?>" alt="<?php echo $friend_user['nom']; ?>" class="user-image">
        <?php echo $friend_user['nom']; ?> (<?php echo $friend['jeux_favoris']; ?>)
        <form method="post">
            <input type="hidden" name="friend_id" value="<?php echo $friend['id']; ?>">
            <button type="submit" name="delete_friend">Supprimer</button>
        </form>
    </li>
<?php } ?>

    </ul>
    <h2>Liste des utilisateurs</h2>
<ul>
    <?php foreach ($users as $user) { ?>
        <li>
            <img src="uploads/<?php echo $user['image']; ?>" alt="<?php echo $user['nom']; ?>" class="user-image">
            <?php echo $user['nom']; ?>
            <?php
            $stmt = $conn->prepare('SELECT users.nom, users.id, GROUP_CONCAT(game.name SEPARATOR \', \') AS jeux_favoris FROM friends JOIN users ON friends.friend_id = users.id JOIN game ON users.jeu_prefere_id = game.id WHERE friends.user_id = :user_id GROUP BY users.nom, users.id');
            $stmt->bindParam(':user_id', $_SESSION['user_id']);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                echo '<br>Jeux favoris: ' . $row['jeux_favoris'];
            }
            ?>
        </li>
    <?php } ?>
</ul>
<ul>
    <li><a href="recherche_amis.php">Rechercher des amis</a></li>
    <li><a href="messages_amis.php">Envoyer un message à un ami</a></li>
</ul>
</body>

</html>
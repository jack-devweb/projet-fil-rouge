<?php
session_start();
include_once('db.php');
$pdo = new PDO('mysql:host=localhost;dbname=mobi;charset=utf8', 'root', '');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['game_id'])) {
    $game_id = $_GET['game_id'];
    $stmt = $pdo->prepare("SELECT * FROM game WHERE id = ?");
    $stmt->execute([$game_id]);
    $game = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header('Location: game.php');
    exit;
}

$stmt = $pdo->prepare("SELECT game_id FROM favorite_games WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$favorite_games_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
$friends_favorite_games = array();

if (isset($_POST['toggle_favorite'])) {
    $game_id = $_POST['game_id'];
    if (in_array($game_id, $favorite_games_ids)) {
        $stmt = $pdo->prepare("DELETE FROM favorite_games WHERE user_id = ? AND game_id = ?");
        $stmt->execute([$_SESSION['user_id'], $game_id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO favorite_games (user_id, game_id) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user_id'], $game_id]);
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}
$friends_favorite_games = array();
$stmt = $pdo->prepare("SELECT f.friend_name, g.name as game_name
                       FROM friends as f
                       INNER JOIN favorite_games as fg ON f.friend_id = fg.user_id
                       INNER JOIN game as g ON g.id = fg.game_id
                       WHERE f.user_id = ?");


$stmt->execute([$_SESSION['user_id']]);
$friends_favorite_games = $stmt->fetchAll(PDO::FETCH_ASSOC);


// jeux favoris 

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contacts</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="custom.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/1z8SoEvPzUHBzIOAU5w6gA2Y7rUp6UJLl0rJ6+" crossorigin="anonymous" />
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-**************" crossorigin="anonymous" />
</head>
<body>
    <main>
  <h1><?= $game['name'] ?></h1>
  <img src="<?= 'images/' . $game['name'] . '.png' ?>" alt="<?= $game['description'] ?>">
  <p><?= $game['description'] ?></p>
  <p>Date de sortie : <?= $game['annee_de_sortie'] ?></p>
  
  <form method="post">
      <input type="hidden" name="game_id" value="<?= $game_id ?>">
      <button type="submit" name="toggle_favorite"><?= in_array($game_id, $favorite_games_ids) ? "Supprimer des favoris" : "Ajouter aux favoris" ?></button>
      <a href="game.php">Retour à la liste des jeux</a>
    </form>
  <h2>Jeux favoris des amis</h2>
  <ul>
      <?php foreach ($friends_favorite_games as $friend_favorite_game) : ?>
          <li>
              <?= $friend_favorite_game['friend_name'] ?> : <?= $friend_favorite_game['game_name'] ?>
          </li>
      <?php endforeach ?>
  </ul>
      </main>
  <footer>
    <nav>
      <ul>
        <li><a href="forum.php"><i class="fas fa-home"></i></a></li>
        <li><a href="contact.php"><i class="fas fa-user"></i></a></li>
        <li><a href="game.php"><i class="fas fa-gamepad"></i></a></li>
        <li><a href="chat.php"><i class="fas fa-envelope"></i></a></li>
        <li><a href="#"> <i class="fas fa-cog"></i></a></li>
      </ul>
    </nav>
  </footer>
</body>
</html>

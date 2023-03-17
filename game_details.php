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

// jeux favoris 

?>

<!DOCTYPE html>
<html>
<head>
  <title><?= $game['name'] ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script src="script.js"></script>
</head>
<body>
  <h1><?= $game['name'] ?></h1>
  <img src="<?= 'images/' . $game['name'] . '.png' ?>" alt="<?= $game['description'] ?>">
  <p><?= $game['description'] ?></p>
  <p>Date de sortie : <?= $game['annee_de_sortie'] ?></p>
  
  <form method="post">
      <input type="hidden" name="game_id" value="<?= $game_id ?>">
      <button type="submit" name="toggle_favorite"><?= in_array($game_id, $favorite_games_ids) ? "Supprimer des favoris" : "Ajouter aux favoris" ?></button>
  </form>
  <a href="game.php">Retour à la liste des jeux</a>

  <h2>Jeux favoris des amis</h2>
  <ul>
      <?php foreach ($friends_favorite_games as $friend_favorite_game) : ?>
          <li>
              <?= $friend_favorite_game['friend_name'] ?> : <?= $friend_favorite_game['game_name'] ?>
          </li>
      <?php endforeach ?>
  </ul>
</body>
</html>

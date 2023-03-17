<?php
// Démarrer la session
session_start();
include_once('config.php');

// Inclure le fichier de connexion à la base de données
include_once('db.php');

// Créer une connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=mobi;charset=utf8', 'root', '');

// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupérer les jeux de la table 'game'
$query = $pdo->query('SELECT * FROM game');
// Stocker les jeux dans la variable $games sous forme de tableau associatif
$games = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Le reste du code est du HTML -->

<!DOCTYPE html>
<html>
<head>
  <title>Liste des jeux</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script src="script.js"></script>
</head>
<body>
<h1>Mes jeux</h1>
<!-- Parcourir les jeux et créer un élément pour chaque jeu -->
<?php foreach ($games as $game): ?>
<div class="grid-item">
  <!-- Créer un lien vers game_details.php avec l'ID du jeu en paramètre GET -->
  <a href="game_details.php?game_id=<?= $game['id'] ?>">
    <!-- Afficher l'image du jeu -->
    <img src="<?= 'images/' . $game['name'] . '.png' ?>" alt="<?= $game['description'] ?>">
  </a>
</div>
<?php endforeach ?>


<footer>
  <nav>
    <ul>
      <li><a href="forum.php"><i class="fas fa-home"></i></a></li>
      <li><a href="contact.php"><i class="fas fa-user"></i></a></li>
      <li><a href="game.php"><i class="fas fa-gamepad"></i></a></li>
      <li><a href="chat.php"><i class="fas fa-envelope"></i></a></li>
      <li><a href="#"><i class="fas fa-cog"></i></a></li>
    </ul>
  </nav>
</footer>

</body>
</html>
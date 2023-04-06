<?php
// Démarrer la session
session_start();

// Inclure le fichier de configuration

include_once('config.php');

// Inclure le fichier de connexion à la base de données
include_once('db.php');

// Créer une connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=mobi;charset=utf8', 'root', '');

// Récupérer les jeux de la table 'game'
$query = $pdo->query('SELECT * FROM game');
// Stocker les jeux dans la variable $games sous forme de tableau associatif
$games = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Le reste du code est du HTML -->

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
  <header>
  <form action="logout.php" method="post">
  <button type="submit">Se deconnecter</button>
</form>
  </header>
  <main>
  <div class="discussion-container">
<div class="contenu">
    <h1>Mes jeux</h1>
    <div class="grid">
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
    </div>
  </div>
      </main>
  <footer>
    <nav>
      <ul>
        <li><a href="forum.php"><i class="fas fa-home"></i></a></li>
        <li><a href="contact.php"><i class="fas fa-user"></i></a></li>
        <li><a href="game.php"><i class="fas fa-gamepad"></i></a></li>
        <li><a href="chat.php"><i class="fas fa-envelope"></i></a></li>
      </ul>

    </nav>
  </footer>

</body>

</html>
<?php
session_start();
require_once 'config.php';
require_once 'db.php';

// Connexion à la base de données
try {
  $db = new Db();
  $pdo = $db->getConnection();
  // Récupérer les sujets de discussion
  $stmt = $pdo->prepare("SELECT * FROM news ORDER BY date DESC");
  $stmt->execute();
  $sujets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Erreur de connexion à la base de données : " . $e->getMessage();
  exit();
}
?>
<!-- Code HTML pour afficher le bouton de déconnexion -->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="custom.css">
  <script src="script.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <title>Forum de discussion</title>
</head>

<body>
  <header>
  <form action="logout.php" method="post">
  <button type="submit">Se deconnecter</button>
</form>
  </header>
  <main>
  <div class="discussion-container">
  <h1>Forum de discussion</h1>
  <div class="article">
    <img src="images\jv2.jpg" alt="jeu">
    <div>
      <h2>Bienvenue sur notre forum dédié aux passionnés de jeux vidéo de tous genres ! 
        Ici, nous célébrons la diversité et la richesse du monde du gaming. 
        Rejoignez notre communauté pour discuter des dernières nouveautés,
         partager des astuces et des conseils, ou simplement échanger sur vos expériences de jeu.
          Des jeux d'action et d'aventure aux jeux de stratégie, en passant par les RPG,
           les jeux de sport et les jeux indépendants, nous couvrons tous les aspects du monde fascinant des jeux vidéo.
            Alors, préparez-vous, détendez-vous et plongez dans les discussions avec d'autres passionnés partageant les mêmes intérêts !</p>

</h2>
      <a href="nouveau_sujet.php">Créer un nouveau sujet de discussion</a>
    </div>
  </div>
    <?php foreach ($sujets as $sujet) { ?>
      <div class="article">
        <img src="<?php echo $sujet['image_path']; ?>" alt="Image du sujet">
        <div>
        </h2>
          <p>
            <?php echo $sujet['contenu']; ?>
          </p>
          <a href="discussion.php?id=<?php echo $sujet['id']; ?>">Voir la discussion</a>
          <?php if ($_SESSION['user_id'] === $sujet['id_users']) { ?>
            <form action="supprimer_sujet.php" method="post">
              <input type="hidden" name="sujet_id" value="<?php echo $sujet['id']; ?>">
              <button type="submit">Supprimer le sujet</button>
            </form>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
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

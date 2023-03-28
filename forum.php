<?php
session_start();
require_once 'config.php';
require_once 'db.php';
// Connexion à la base de données
try {
  $db = new Db();
  $pdo = $db->getConnection();
  // Récupérer les sujets de discussion
  $stmt = $pdo->prepare("SELECT * FROM news"); // Remplacez "sujets" par le nom de votre table de sujets
  $stmt->execute();
  $sujets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Erreur de connexion à la base de données : " . $e->getMessage();
  exit();
}

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  header('Location: forum.php');
  exit;
}
?>
<!-- Code HTML pour afficher le bouton de déconnexion -->
<form action="logout.php" method="post">
  <button type="submit">Déconnexion</button>
</form>
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

  <h1>Forum de discussion</h1>

  <div class="article">
    <img src="images\jv2.jpg" alt="jeu">
    <div>
      <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, illum? Nulla, necessitatibus velit. Totam
        unde, eius sequi velit, ab saepe molestiae dolore accusamus nihil vitae deserunt, veritatis quaerat nemo
        voluptas.</h2>
      <a href="nouveau_sujet.php">Créer un nouveau sujet de discussion</a>
    </div>
  </div>

  <div class="article">
    <img src="images\jv3.jpg" alt="jeu">
    <div>
      <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, illum? Nulla, necessitatibus velit. Totam
        unde, eius sequi velit, ab saepe molestiae dolore accusamus nihil vitae deserunt, veritatis quaerat nemo
        voluptas.</h2>
      <a href="nouveau_sujet.php">Créer un nouveau sujet de discussion</a>
    </div>
  </div>

  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque magni eum, deserunt quo est earum tempore, ipsum
    error impedit amet dolorum. Modi tempore quaerat dignissimos excepturi. Recusandae vero laudantium alias?</p>

  <div class="article">
    <img src="images\jv1.jpg" alt="jeu">
    <div>
      <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, explicabo delectus amet expedita atque
        quibusdam laudantium vel dolor ab quae consectetur nemo dignissimos quo nesciunt, omnis officia quis, saepe
        voluptatibus?</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis quas earum quo illum, mollitia laudantium
        saepe praesentium vitae molestiae hic reiciendis nobis commodi, ex cum architecto ab aut assumenda ipsum.</p>
    </div>
  </div>
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
  <?php foreach ($sujets as $sujet) { ?>
    <h3>
      <?php echo $sujet['titre']; ?>
    </h3>
    <p>Date de création :
      <?php echo $sujet['date_creation']; ?>
    </p>
    <a href="discussion.php?id=<?php echo $sujet['id']; ?>">Voir la discussion</a>

  <?php } ?>

</body>

</html>
<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'mobi';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

// Récupération des sujets de discussion depuis la base de données
$stmt = $pdo->query('SELECT id, titre, date_creation FROM sujet_discussion ORDER BY date_creation DESC');
$sujets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum de discussion</title>
</head>
<body>
    <h1>Forum de discussion</h1>

    <a href="nouveau_sujet.php">Créer un nouveau sujet de discussion</a>
    <h2>Bienvenue sur le forum !</h2>
    <p>Voici une image de chaton :</p>
    <img src="images\mario-g7261e971e_1920.jpg" alt="jeu">
    <img src="images\mario-g86786cace_1920.jpg" alt="jeu">

    <h2>Liste des sujets de discussion</h2>

    <?php foreach ($sujets as $sujet) { ?>
        <h3><?php echo $sujet['titre']; ?></h3>
        <p>Date de création : <?php echo $sujet['date_creation']; ?></p>
        <a href="discussion.php?id=<?php echo $sujet['id']; ?>">Voir la discussion</a>
    <?php } ?>
</body>
</html>
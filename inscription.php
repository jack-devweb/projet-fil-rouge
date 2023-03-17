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
    $jeux_favoris = $_POST['jeux_favoris'];
    $image = "uploads"; // Remplacez cela par le chemin de l'image par défaut
    // traitement du champ image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        // Verif taille max autorisée (10Mo trop lourd !!!)
        if ($_FILES['image']['size'] <= 10000000) {
  
          $infosfichier = pathinfo($_FILES['image']['name']);
          $extension_upload = $infosfichier['extension'];
          $extensions_autorisees = array('jpg','jpeg','gif','png');
  
          if (in_array($extension_upload, $extensions_autorisees)) {
  
            // Récupération du nom du fichier téléchargé
            $filename = basename($_FILES['image']['name']);
            $imageToDB = date("Y-m-d-s") .'.'. $filename;
  
            // Déplacement du fichier téléchargé vers le répertoire uploads/
            move_uploaded_file($_FILES['image']['tmp_name'],'uploads/' . $imageToDB);
           // echo "L'envoi a bien été effectué !";
  
          }
        }
      }
    // FIN traitement du champ image

    // Préparer la requête d'insertion des données dans la table users
    $stmt = $conn->prepare('INSERT INTO users (nom, password, email, date, bio, jeux_favoris, image) VALUES (:nom, :password, :email, :date, :bio, :jeux_favoris, :imageToDB)');
    $stmt->bindParam(':nom', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':imageToDB', $imageToDB);
    $stmt->bindParam(':bio', $bio);
    $stmt->bindParam(':jeux_favoris', $jeux_favoris);
    $stmt->execute();
    // Récupérer l'id de l'utilisateur qui vient d'être ajouté à la base de données
    $_SESSION['user_id'] = $conn->lastInsertId();
    // Rediriger l'utilisateur vers la page de chat
    header('Location: forum.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <h1>Inscription</h1>
    <form method="POST" class="login-form" enctype="multipart/form-data">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" required><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required><br>
        <label for="email">Email :</label>
        <input type="email" name="email" required><br>
        <label for="bio">Biographie :</label>
        <textarea name="bio"></textarea><br>
        <label for="avatar">Avatar :</label>
        <input type="file" name="image" id="image">
        <label for="jeux_favoris">Jeux favoris :</label>
        <input type="text" name="jeux_favoris"><br>
        <input type="submit" name="submit" value="S'inscrire">
       

    <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a>.</p>
    </form>
</body>

</html>
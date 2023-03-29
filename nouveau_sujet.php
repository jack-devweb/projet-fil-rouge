<?php
session_start();
require_once 'config.php';
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $contenu = $_POST['contenu'];
    $id_users = $_SESSION['user_id'];
    $date = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $image_path = '';

    if ($image['error'] === UPLOAD_ERR_OK) {
        $image_ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $image_name = uniqid() . '.' . $image_ext;
        $upload_dir = 'images/';
        $image_path = $upload_dir . $image_name;

        if (!move_uploaded_file($image['tmp_name'], $image_path)) {
            $error = 'Erreur lors du téléchargement de l\'image';
            $image_path = '';
        }
    }

    try {
        $db = new Db();
        $pdo = $db->getConnection();
        $stmt = $pdo->prepare('INSERT INTO news (title, contenu, date, id_users, image_path) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$title, $contenu, $date, $id_users, $image_path]);
        header('Location: forum.php');
        exit;
    } catch (PDOException $e) {
        $error = 'Erreur lors de la création du nouveau sujet: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouveau sujet de discussion</title>
</head>
<body>
<h1>Créer un nouveau sujet de discussion</h1>
<?php if (isset($error)) { ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php } ?>
<form action="nouveau_sujet.php" method="post" enctype="multipart/form-data">
    <label for="title">Titre:</label>
    <input type="text" name="title" id="title" required>
    <br>
    <label for="contenu">Contenu:</label>
    <textarea name="contenu" id="contenu" required></textarea>
    <br>
    <label for="image">Image:</label>
    <input type="file" name="image" id="image">
    <br>
    <input type="submit" value="Créer un nouveau sujet">
</form>
</body>
</html>
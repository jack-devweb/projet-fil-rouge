<?php
session_start();
require_once 'config.php';
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $sujet_id = $_POST['sujet_id'];
    $user_id = $_SESSION['user_id'];

    try {
        $db = new Db();
        $pdo = $db->getConnection();
        $stmt = $pdo->prepare('DELETE FROM news WHERE id = ? AND id_users = ?');
        $stmt->execute([$sujet_id, $user_id]);
        header('Location: forum.php');
        exit;
    } catch (PDOException $e) {
        $error = 'Erreur lors de la suppression du sujet: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un sujet de discussion</title>
</head>
<body>
<?php if (isset($error)) { ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php } ?>
</body>
</html>

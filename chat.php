<?php
session_start();
require_once('db.php');

//Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;

}
// Récupère le nom de l'utilisateur connecté
$userName = getUserName($_SESSION['user_id']);

// Récupère les utilisateurs connectés de la base de données
$db = new Db();
$conn = $db->getConnection();
$stmt = $conn->prepare('SELECT nom FROM users WHERE est_connecte = 1');
$utilisateurs_connectes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affiche les utilisateurs connectés
echo '<ul>';
foreach ($utilisateurs_connectes as $utilisateur) {
    echo '<li>' . $utilisateur['nom'] . '</li>';
}
echo '</ul>';

function getUserName($userId)
{
    require_once('db.php');
    $db = new Db();
    $conn = $db->getConnection();
    $stmt = $conn->prepare('SELECT nom FROM users WHERE id = :userId');
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['nom'];
}


// Récupère les messages de la base de données
$db = new Db();
$conn = $db->getConnection();
$stmt = $conn->query('SELECT messages.*, users.nom FROM messages JOIN users ON messages.id = users.id');
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];
    $now = date('Y-m-d H:i:s'); // ou $now = date('Y-m-d H:i:s', time());
    $id_discussion = 1; // Remplacer 1 par l'ID que vous souhaitez utiliser

    $stmt = $conn->prepare('INSERT INTO messages (contenu, date, id) VALUES (:contenu, :date, :id)');
    $stmt->bindParam(':contenu', $message);
    $stmt->bindParam(':date', $now);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link rel="stylesheet"  href="style.css">
    <link rel="stylesheet"  href="custom.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-**************" crossorigin="anonymous" />


</head>

<body>
    <header class="header">
        <h1 class="title">Chat</h1>
        <p class="welcome"><img src="images/profil2.jpg">
            <?php echo $userName; ?>!
        </p>
        <!-- <p class="welcome">Bienvenue  echo $_SESSION['user_id']; ?>!</p> -->
    </header>
    <main class="main">
    <section class="messages-section">
        <h2 class="section-title">Messages</h2>
        <ul class="messages-list">
<?php foreach ($messages as $message) { 
    $length = strlen($message['contenu']);
    if ($length <= 50) {
        $borderSize = "2px";
    } else if ($length > 50 && $length <= 100) {
        $borderSize = "4px";
    } else {
        $borderSize = "6px";
    }
?>
    <li class="message-item" style="border-width: <?php echo $borderSize; ?>;">
        <strong class="message-author">
            <?php echo $message['nom']; ?>:
        </strong>
        <?php echo $message['contenu']; ?>
        <form method="POST" class="delete-message-form">
            <input type="hidden" name="message_id" value="<?php echo $message['id_message']; ?>">
            <button type="submit" name="delete_message" class="delete-message-button">
            <i class="fas fa-trash delete-icon" title="Supprimer"></i>
            </button>
        </form>
    </li>
<?php } ?>
</ul>


    </section>
    <section class="send-message-section">
    <h2 class="section-title">Envoyer un message</h2>
    <form method="POST" class="send-message-form">
        <label for="message"></label>
        <textarea id="message" name="message"></textarea>
        <label for="message" class="send-message-label"></label> 
        <button class="button-85" role="button">Envoyer</button>
    </form>
</section>
</main>

<footer>
  <nav>
    <ul>
    <li><a href="forum.php"><i class="fas fa-home"></i></a></li>
      <li><a href="#"><i class="fas fa-user"></i></a></li>
      <li><a href="#"><i class="fas fa-gamepad"></i></a></li>
      <li><a href="#"><i class="fas fa-envelope"></i></a></li>
      <li><a href="#"> <i class="fas fa-cog"></i></a></li>
    </ul>
  </nav>
</footer>
    <?php
    if (isset($_POST['delete_message'])) {
        $message_id = $_POST['message_id'];
        $stmt = $conn->prepare('DELETE FROM messages WHERE id_message = :message_id');
        $stmt->bindParam(':message_id', $message_id);
        $stmt->execute();
        // header('Location: game.php');
        exit;
    }
    ?>

</body>

</html>
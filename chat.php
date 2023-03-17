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
// Récupère l'image de l'utilisateur connecté
$userImage = getUserImage($userName);
// Récupère les utilisateurs connectés de la base de données
$db = new Db();
$conn = $db->getConnection();
$stmt = $conn->prepare('SELECT nom, image FROM users WHERE est_connecte = 1');
$stmt->execute();
$utilisateurs_connectes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affiche les utilisateurs connectés
echo '<ul class="users-list">';
foreach ($utilisateurs_connectes as $utilisateur) {
    echo '<li class="user-container">';
    echo '<img src="uploads/' . $utilisateur['image'] . '" class="user-img">';
    echo '<span>' . $utilisateur['nom'] . '</span>';
    echo '</li>';
}
echo '</ul>';

// Affiche l'image de l'utilisateur connecté
echo '<p class="welcome"><img src="uploads/' . $userImage . '">' . $userName . '!</p>';
function getUserImage($username)
{
    require_once('db.php');
    $db = new Db();
    $conn = $db->getConnection();
    $stmt = $conn->prepare('SELECT image FROM users WHERE nom = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['image'];
}

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
$stmt = $conn->query('SELECT messages.*, users.nom, users.image FROM messages JOIN users ON messages.id = users.id ORDER BY date DESC');
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['submit_message']) && isset($_POST['message'])) {
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];
    $now = date('Y-m-d H:i:s'); // ou $now = date('Y-m-d H:i:s', time());
    $id_discussion = 1; // Remplacer 1 par l'ID que vous souhaitez utiliser

    $stmt = $conn->prepare('INSERT INTO messages (contenu, date, id, discussion_id) VALUES (:contenu, :date, :id, :discussion_id)');
    $stmt->bindParam(':contenu', $message);
    $stmt->bindParam(':date', $now);
    $stmt->bindParam(':id', $user_id);
    $stmt->bindParam(':discussion_id', $id_discussion); // Ajoutez cette ligne
    $stmt->execute();

    // Rediriger l'utilisateur vers la même page pour éviter une nouvelle soumission du formulaire lors de l'actualisation de la page
    header('Location: chat.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/1z8SoEvPzUHBzIOAU5w6gA2Y7rUp6UJLl0rJ6+"
 crossorigin="anonymous" />
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-**************" crossorigin="anonymous" />
</head>

<body>
    <header class="header">
        <a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a>
        <p class="welcome"><img src="images/profil2.jpg">
            <?php echo $userName; ?>!
        </p>
        <!-- <p class="welcome">Bienvenue  echo $_SESSION['user_id']; ?>!</p> -->
    </header>
    <main class="main">
    <section class="messages-section">
        <h2 class="section-title"></h2>
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
            <img src="uploads/<?php echo $message['image']; ?>" class="user-img">
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
    <form action="chat.php" method="POST" class="send-message-form">
    <label for="message"></label>
    <textarea id="message" name="message"></textarea>
    <label for="message" class="send-message-label"></label>
    <input type="submit" name="submit_message" value="Envoyer" class="custom-button">
   
</form>
</section>
</main>


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
<footer>
  <nav>
    <ul>
    <li><a href="forum.php"><i class="fas fa-home"></i></a></li>
        <li><a href="contact.php"><i class="fas fa-user"></i></a></li>
       <li><a href="<?php echo isset($_SESSION['user_id']) ? 'game.php' : 'login.php'; ?>">
    <i class="fas fa-gamepad"></i></a></li>
        <li><a href="chat.php"><i class="fas fa-envelope"></i></a></li>
        <li><a href="#"> <i class="fas fa-cog"></i></a></li>
    </ul>
  </nav>
</footer>

</body>
</html>

<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$db = new Db();
$conn = $db->getConnection();

$stmt = $conn->prepare('SELECT id, nom, image FROM users WHERE id != :userId');
$stmt->bindParam(':userId', $_SESSION['user_id']);
$stmt->execute();
$contacts_potentiels = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


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
<script>

document.querySelectorAll('.add-friend').forEach(button => {
    button.addEventListener('click', () => {
        const userId = button.getAttribute('data-user-id');
        fetch('ajouter_amis.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `user_id2=${userId}`
        }).then(response => response.text()).then(text => {
            alert(text);
        });
    });
});

document.querySelectorAll('.remove-friend').forEach(button => {
    button.addEventListener('click', () => {
        const userId = button.getAttribute('data-user-id');
        fetch('supprimer_amis.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `user_id2=${userId}`
        }).then(response => response.text()).then(text => {
            alert(text);
        });
    });
});
</script>

<body>
    <header class="header">
        <h1 class="title">Contacts</h1>
        <a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a>
    </header>
    <main class="main">
        <ul class="contacts-list">
            <?php foreach ($contacts_potentiels as $contact) { ?>
                <li class="contact-item">
                    <img src="uploads/<?php echo $contact['image']; ?>" class="user-img">
                    <span>
                        <?php echo $contact['nom']; ?>
                    </span>
                    <div class="actions">
                        <button class="add-friend" data-user-id="<?php echo $contact['id']; ?>">Ajouter en ami</button>
                        <button class="remove-friend" data-user-id="<?php echo $contact['id']; ?>">Supprimer</button>
                        <a href="chat.php?user_id=<?php echo $contact['id']; ?>" class="action">Envoyer un message</a>
                        <a href="friend_profile.php?friend_id=<?php echo $friend_id; ?>">Voir le profil</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </main>
    <footer>
        <div class="footer-container">
            <nav>
                <ul>
                    <li><a href="forum.php"><i class="fas fa-home"></i></a></li>
                    <li><a href="contact.php"><i class="fas fa-user"></i></a></li>
                    <li><a href="<?php echo isset($_SESSION['user_id']) ? 'game.php' : 'login.php'; ?>">
                            <i class="fas fa-gamepad"></i></a></li>
                    <li><a href="chat.php"><i class="fas fa-envelope"></i></a></li>
                    <li><a href="#"><i class="fas fa-cog"></i></a></li>
                </ul>
            </nav>
        </div>
    </footer>
</body>

</html>
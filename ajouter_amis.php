
<?php
session_start();
require_once "config.php";

if (isset($_SESSION["id"]) && isset($_POST["user_id2"])) {
    $user_id = $_SESSION["id"];
    $user_id2 = $_POST["user_id2"];

    $sql = "INSERT INTO amis (user_id, user_id2, statut, date_demande) VALUES (:user_id, :user_id2, 'en_attente', NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id2', $user_id2, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Demande d'amis envoyée";
    } else {
        echo "Erreur lors de l'envoi de la demande d'amis.";
    }
}
if ($stmt->execute()) {
    echo "Opération réussie";
} else {
    echo "Erreur : " . $stmt->errorInfo()[2];
}
?>

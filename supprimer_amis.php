<?php
session_start();
require_once "config.php";

if (isset($_SESSION["id"]) && isset($_POST["user_id2"])) {
    $user_id = $_SESSION["id"];
    $user_id2 = $_POST["user_id2"];

    $sql = "DELETE FROM amis WHERE (user_id = :user_id AND user_id2 = :user_id2) OR (user_id = :user_id2 AND user_id2 = :user_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id2', $user_id2, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Ami supprimé";
    } else {
        echo "Erreur lors de la suppression de l'ami.";
    }
}
?>

<?php

// Inclure les fichiers de configuration et de connexion à la base de données
require_once 'config.php';
require_once 'db.php';
// inclure les pages
include 'index.php';
include 'login.php';
include 'logout.php';
include 'inscription.php';
include 'discussionRepository.php';
include 'chat.php';
include 'index2.php';
include 'amis.php';


// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
// Récupérer les données de l'utilisateur connecté
$db = new Db();
$conn = $db->getConnection();
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare('SELECT * FROM users WHERE id = :user_id');
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>
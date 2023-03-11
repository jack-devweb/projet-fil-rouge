<?php
session_start();
require_once('db.php');

class DiscussionRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    /**
     * Récupère toutes les discussions enregistrées dans la base de données
     * @return array Tableau contenant les discussions
     */
    public function getAllDiscussions()
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM discussions ORDER BY date DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Crée une nouvelle discussion dans la base de données
     * @param string $titre Titre de la discussion
     * @param int $createur ID de l'utilisateur qui a créé la discussion
     * @return bool Retourne vrai si la création a réussi, faux sinon
     */
    public function createDiscussion($titre, $createur)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('INSERT INTO discussions (titre, createur) VALUES (:titre, :createur)');
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':createur', $createur);
        return $stmt->execute();
    }

    /**
     * Récupère une discussion spécifique en fonction de son ID
     * @param int $id ID de la discussion à récupérer
     * @return mixed Tableau contenant les informations de la discussion si elle est trouvée, faux sinon
     */
    public function getDiscussionById($id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM discussions WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Récupère tous les messages d'une discussion spécifique en fonction de son ID
     * @param int $id ID de la discussion dont les messages doivent être récupérés
     * @return array Tableau contenant les messages de la discussion si elle est trouvée, faux sinon
     */
    public function getAllMessagesByDiscussionId($id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('SELECT messages.*, users.nom as nom_utilisateur FROM messages INNER JOIN users ON messages.createur = users.id WHERE discussion_id=:id ORDER BY messages.date ASC');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Ajoute un nouveau message à une discussion spécifique
     * @param int $createur ID de l'utilisateur qui a créé le message
     * @param int $discussion_id ID de la discussion à laquelle ajouter le message
     * @param string $message Contenu du message
     * @return bool Retourne vrai si l'ajout a réussi, faux sinon
     */
    public function addMessageToDiscussion($createur, $discussion_id, $message)
    {
        // Obtenir une connexion à la base de données
        $conn = $this->db->getConnection();

        // Préparer une requête SQL insérant un nouveau message dans la table des messages
        $stmt = $conn->prepare('INSERT INTO messages (createur, discussion_id, message) VALUES (:createur, :discussion_id, :message)');

        // Lier les paramètres à la requête préparée
        $stmt->bindParam(':createur', $createur, PDO::PARAM_INT);
        $stmt->bindParam(':discussion_id', $discussion_id, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);

        // Exécuter la requête et retourner vrai si elle réussit, faux sinon
        return $stmt->execute();
    }
}
?>
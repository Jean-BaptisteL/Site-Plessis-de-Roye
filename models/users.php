<?php

include_once 'models/database.php';

class users {
    public $id = 0;
    public $firstname = '';
    public $lastname = '';
    public $email = '';
    public $password = '';
    public $hash = '';
    public $type = '';
    public $db = NULL;
    
    public function __construct() {
        $this->db = database::getInstance();
    }
    
    /**
     * Méthode permettant d'enregistrer un nouvel utilisateur.
     * @return BOOL
     */
    public function addNewUser() {
        $query = 'INSERT INTO `chtsc_users` (`firstname`, `lastname`, `email`, `password`, `hash`, `type`) '
                . 'VALUES (:firstname, UPPER(:lastname), :email, :password, :hash, :type)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $statement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $statement->bindValue(':hash', $this->hash, PDO::PARAM_STR);
        $statement->bindValue(':type', $this->type, PDO::PARAM_STR);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant de vérifier si un utilisateur existe déjà.
     * @return OBJ
     */
    public function checkIfUserExists() {
        $query = 'SELECT COUNT(`id`) AS `userExists` FROM `chtsc_users` '
                . 'WHERE (`firstname` = :firstname AND `lastname` = :lastname) OR `email` = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $statement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de récupérer les informations d'un utilisateur
     * afin de créer une variable superglobale $_SESSION contenant les informations.
     * @return OBJ
     */
    public function getUserInfos() {
        $query = 'SELECT `id`, `firstname`, `lastname`, `password`, `email`, `type` FROM `chtsc_users` '
                . 'WHERE`email` = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Methode permettant de modifier les informations d'un utilisateur
     * @return BOOL
     */
    public function updateUserInfos() {
        $query = 'UPDATE `chtsc_users` '
                . 'SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $statement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
    
    /**
     * Methode permettant de modifier le mot de passe d'un utilisateur
     * @return BOOL
     */
    public function updatePassword() {
        $query = 'UPDATE `chtsc_users` '
                . 'SET `password` = :password '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
}

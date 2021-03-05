<?php

include_once 'models/database.php';

class users {
    public $id = 0;
    public $firstname = '';
    public $password = '';
    public $db = NULL;
    
    public function __construct() {
        $this->db = database::getInstance();
    }
    
    /**
     * Méthode permettant de vérifier si un utilisateur existe déjà.
     * @return OBJ
     */
    public function checkIfUserExists() {
        $query = 'SELECT COUNT(`id`) AS `userExists` FROM `chtsc_users` '
                . 'WHERE `firstname` = :firstname';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de récupérer les informations d'un utilisateur
     * afin de créer une variable superglobale $_SESSION contenant les informations.
     * @return OBJ
     */
    public function getUserInfos() {
        $query = 'SELECT `id`, `firstname`, `password` FROM `chtsc_users` '
                . 'WHERE `firstname` = :firstname';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
}

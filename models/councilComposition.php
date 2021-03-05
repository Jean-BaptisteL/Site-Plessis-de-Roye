<?php

include_once 'models/database.php';

class councilComposition {
    public $id = 0;
    public $firstname = '';
    public $lastname = '';
    public $photoPath = '';
    public $job = '';
    public $db = NULL;
    
    public function __construct() {
        $this->db = database::getInstance();
    }
    
    /**
     * Méthode permettant d'enregistrer un nouveau membre du conseil.
     * @return type BOOL
     */
    public function addNewConcilMember() {
        $query = 'INSERT INTO `chtsc_councilcomposition` (`firstname`, `lastname`, `photoPath`, `job`) '
                . 'VALUES (:firstname, UPPER(:lastname), :photoPath, :job)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $statement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $statement->bindValue(':photoPath', $this->photoPath, PDO::PARAM_STR);
        $statement->bindValue(':job', $this->job, PDO::PARAM_STR);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant de vérifier si un membre existe déjà.
     * @return type OBJ
     */
    public function checkIfMemberExists() {
        $query ='SELECT COUNT(`id`) AS `memberExists` '
                . 'FROM `chtsc_councilcomposition` '
                . 'WHERE `firstname` = :firstname AND `lastname` = :lastname';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $statement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant d'afficher le maire.
     * @return type OBJ
     */
    public function showMayor() {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `id`, `firstname`, `lastname`, `job`, `photoPath` '
                . 'FROM `chtsc_councilcomposition` '
                . 'WHERE `job` LIKE \'Maire%\'';
        $statement = $this->db->query($query);
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant d'afficher les adjoints.
     * @return type OBJ
     */
    public function showAssistants() {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `id`, `firstname`, `lastname`, `job`, `photoPath` '
                . 'FROM `chtsc_councilcomposition` '
                . 'WHERE `job` LIKE \'%adjoint%\' '
                . 'ORDER by `job` ASC';
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function showAdvisor() {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `id`, `firstname`, `lastname`, `job`, `photoPath` '
                . 'FROM `chtsc_councilcomposition` '
                . 'WHERE `job` LIKE \'Conseill%\' '
                . 'ORDER by `id` ASC';
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant d'afficher les autres membres.
     * @return type OBJ
     */
    public function showOtherMembers() {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `id`, `firstname`, `lastname`, `job`, `photoPath` '
                . 'FROM `chtsc_councilcomposition` '
                . 'WHERE `job` NOT LIKE \'%adjoint%\' AND `job` NOT LIKE \'Maire%\' AND `job` NOT LIKE \'Conseill%\'';
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de connaître le nombre de membre du conseil.
     * @return type OBJ
     */
    public function numberOfMember() {
        $query = 'SELECT found_rows()';
        $statement = $this->db->query($query);
        return $statement->fetchColumn();
    }
    
    /**
      * Méthode permettant de modifier les infos d'un membre.
      * @return type BOOL
      */
    public function updateMemberInfos() {
        $query = 'UPDATE `chtsc_councilcomposition` '
                . 'SET `firstname` = :firstname, `lastname` = :lastname, `job` = :job, `photoPath` = :photoPath '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $statement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $statement->bindValue(':job', $this->job, PDO::PARAM_STR);
        $statement->bindValue(':photoPath', $this->photoPath, PDO::PARAM_STR);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
    
     /**
     * Méthode permettant de vérifier si un autre membre possède déjà ce nom et ce prénom.
     * @return type OBJ
     */
    public function checkIfOtherMemberExists() {
        $query ='SELECT COUNT(`id`) AS `memberExists` '
                . 'FROM `chtsc_councilcomposition` '
                . 'WHERE `firstname` = :firstname AND `lastname` = :lastname AND `id` != :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $statement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de supprimer un membre du conseil
     * @return type BOOL
     */
    public function deleteMember() {
        $query = 'DELETE FROM `chtsc_councilcomposition` '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant de vérifier si un membre existe.
     * @return type OBJ
     */
    public function checkIfIdAndPathOfMemberExist() {
        $query = 'SELECT COUNT(`id`) AS `idAndPathExists` '
                . 'FROM `chtsc_councilcomposition`'
                . 'WHERE `id` = :id AND `photoPath` = :photoPath';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $statement->bindValue(':photoPath', $this->photoPath, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
}

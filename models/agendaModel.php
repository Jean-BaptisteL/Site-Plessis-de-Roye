<?php

include_once 'models/database.php';

class agenda {
    public $id = 0;
    public $topic = '';
    public $description = '';
    public $date = '1992-01-10 15:45:00';
    public $db = NULL;
    
    public function __construct() {
        $this->db = database::getInstance();
    }
    
    /**
     * Méthode permettant d'ajouter une nouvelle entrée à l'agenda.
     * @return type BOOL
     */
    public function addNewDate() {
        $query = 'INSERT INTO `chtsc_agenda` (`topic`, `description`, `date`) '
                . 'VALUES (:topic ,:description, :date)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':topic', $this->topic, PDO::PARAM_STR);
        $statement->bindValue(':description', $this->description, PDO::PARAM_STR);
        $statement->bindValue(':date', $this->date, PDO::PARAM_STR);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant d'afficher les entrées de l'agenda.
     * @return type OBJ
     */
    public function showAgenda() {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `id`, `topic`, `description`, `date`, DATE_FORMAT(`date`, \'%d/%m/%Y\') AS `dateFormat` '
                . 'FROM `chtsc_agenda` '
                . 'ORDER BY `date` ASC';
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de connaître le nombre d'évènement dans l'agenda.
     * @return type OBJ
     */
    public function numberOfEvent() {
        $query = 'SELECT found_rows()';
        $statement = $this->db->query($query);
        return $statement->fetchColumn();
    }
    
    /**
     * Méthode permettant de modifier une entrée de l'agenda.
     * @return type BOOL
     */
    public function updateDate() {
        $query = 'UPDATE `chtsc_agenda` '
                . 'SET `topic` = :topic, `description` = :description, `date` = :date '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $statement->bindValue(':topic', $this->topic, PDO::PARAM_STR);
        $statement->bindValue(':description', $this->description, PDO::PARAM_STR);
        $statement->bindValue(':date', $this->date, PDO::PARAM_STR);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant de supprimer une entrée de l'agenda.
     * @return type BOOL
     */
    public function deleteDate() {
        $query = 'DELETE FROM `chtsc_agenda` '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant de supprimer une entrée de l'agenda quand la date est dépassée.
     * @return type BOOL
     */
    public function deleteOldDate() {
        $query = 'DELETE FROM `chtsc_agenda` '
                . 'WHERE DATE_ADD(`date`, INTERVAL 1 DAY) < NOW()';
        $statement = $this->db->query($query);
        return $statement->execute();
    }
    
    public function checkIfEventExist() {
        $query = 'SELECT COUNT(`id`) AS `numberOfEvent` '
                . 'FROM `chtsc_agenda` '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
}

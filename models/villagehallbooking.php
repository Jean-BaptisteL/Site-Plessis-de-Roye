<?php

include_once 'models/database.php';

class villagehallbooking {
    public $id = 0;
    public $startDate = '1992-01-10 15:45:00';
    public $endDate = '1992-01-10 15:45:00';
    public $name = '';
    public $db = NULL;
    
    public function __construct() {
        $this->db = database::getInstance();
    }
    
    /**
     * Méthode permettant d'ajouter une réservation pour la salle des fêtes.
     * @return type BOOL
     */
    public function addBooking() {
        $query = 'INSERT INTO `chtsc_villagehallbooking` (`startDate`, `endDate`, `name`) '
                . 'VALUES (:startDate, :endDate, :name)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':startDate', $this->startDate, PDO::PARAM_STR);
        $statement->bindValue(':endDate', $this->endDate, PDO::PARAM_STR);
        $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant d'afficher les réservations.
     * @return type OBJ
     */
    public function showBookings() {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `id`, `startDate`, `endDate`, `name`, DATE_FORMAT(`startDate`, \'%d/%m/%Y\') AS `startDateFormat`, DATE_FORMAT(`endDate`, \'%d/%m/%Y\') AS `endDateFormat` '
                . 'FROM `chtsc_villagehallbooking` '
                . 'ORDER BY `startDate` ASC';
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de connaître le nombre de réservation.
     * @return type OBJ
     */
    public function numberOfBooking() {
        $query = 'SELECT found_rows()';
        $statement = $this->db->query($query);
        return $statement->fetchColumn();
    }
    
    /**
     * Méthode permettant de modifier une réservation.
     * @return type BOOL
     */
    public function updateBooking() {
        $query = 'UPDATE `chtsc_villagehallbooking` '
                . 'SET `startDate` = :startDate, `endDate` = :endDate, `name` = :name '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $statement->bindValue(':startDate', $this->startDate, PDO::PARAM_STR);
        $statement->bindValue(':endDate', $this->endDate, PDO::PARAM_STR);
        $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant de supprimer une réservation.
     * @return type BOOL
     */
    public function deleteDate() {
        $query = 'DELETE FROM `chtsc_villagehallbooking` '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant de supprimer une réservation quand la date est dépassée.
     * @return type BOOL
     */
    public function deleteOldDate() {
        $query = 'DELETE FROM `chtsc_villagehallbooking` '
                . 'WHERE DATE_ADD(`endDate`, INTERVAL 1 DAY) < NOW()';
        $statement = $this->db->query($query);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant de vérifier si une réservation existe.
     * @return typeOBJ
     */
    public function checkIfBookingExist() {
        $query = 'SELECT COUNT(`id`) AS `numberOfBooking` '
                . 'FROM `chtsc_villagehallbooking` '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
}

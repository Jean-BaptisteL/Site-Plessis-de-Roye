<?php

include_once 'models/database.php';

class infoconnection {
    public $id = 0;
    public $datetime = '1992-01-10 00:00:00';
    public $db = NULL;
    
    public function __construct() {
        $this->db = database::getInstance();
    }
    
    /**
     * Méthode permettant d'incrémenter une connexion.
     * @return type BOOL
     */
    public function addConnection() {
        $query = 'INSERT INTO `chtsc_infoconnection` (`datetime`) '
                . 'VALUE (NOW())';
        $statement = $this->db->query($query);
        return $statement;
    }
    
    /**
     * Méthode permettant de récupérer le nombre de connexion au site par jour dans un interval d'un mois
     * @return type OBJ
     */
    public function getConnexionsByDate() {
        $query = "SELECT DATE_FORMAT(`datetime`, \"%d/%m/%Y\") AS `connexionsDate`, COUNT(`id`) "
                . "FROM `chtsc_infoconnection` "
                . "WHERE `datetime` BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW() "
                . "GROUP BY `datetime` ";
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}

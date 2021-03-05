<?php

include_once 'models/database.php';

class publications {
    public $id = 0;
    public $title = '';
    public $path = '';
    public $date = '1992-01-10';
    public $type = '';
    public $db = NULL;
    
    public function __construct() {
        $this->db = database::getInstance();
    }
    
    /*
     * Méthode permettant d'enregistrer le chemin d'un fichier.
     * @return BOOL
     */
    public function addNewPublication(){
        $query = 'INSERT INTO `chtsc_publications` (`title`, `path`, `date`, `type`) '
                . 'VALUES (:title, :path, NOW(), :type)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $statement->bindValue(':path', $this->path, PDO::PARAM_STR);
        $statement->bindValue(':type', $this->type, PDO::PARAM_STR);
        return $statement->execute();
    }
    
    /*
     *Méthode permettant d'afficher les publications enregistrées.
     * @return OBJ 
     */
    public function showPublication() {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `title`, `date`, DATE_FORMAT(`date`, \'%d/%m/%Y\') AS `publicationDate`, `path`, `type` '
                . 'FROM `chtsc_publications` '
                . 'ORDER BY `date` DESC '
                . 'LIMIT 5';
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    /*
     * Méthode permettant de connaitre le nombre de publications dans la base de données.
     * @return COL
     */
    public function numberOfPublications() {
        $query = 'SELECT found_rows()';
        $statement = $this->db->query($query);
        return $statement->fetchColumn();
    }
    
    /**
     * Méthode permettant de montrer les articles par type
     * @param type $offset
     * @return type OBJ
     */
    public function showArticlesByTypes($offset) {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `title`, `date`, DATE_FORMAT(`date`, \'%d/%m/%Y\') AS `publicationDate`, `path`, `type` '
                . 'FROM `chtsc_publications` '
                . 'WHERE `type` = :type '
                . 'ORDER BY `date` DESC '
                . 'LIMIT 10 OFFSET :offset';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':type', $this->type, PDO::PARAM_STR);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de récupérer tous les articles.
     * @param type $offset
     * @return type OBJ
     */
    public function showAllArticles($offset) {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `id`, `title`, `date`, DATE_FORMAT(`date`, \'%d/%m/%Y\') AS `publicationDate`, `path`, `type` '
                . 'FROM `chtsc_publications` '
                . 'ORDER BY `date` DESC '
                . 'LIMIT 10 OFFSET :offset';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de vérifier si un titre existe déjà.
     * @return type OBJ
     */
    public function checkIfArticleTitleExists() {
        $query = 'SELECT COUNT(`title`) AS `titleExists` '
                . 'FROM `chtsc_publications`'
                . 'WHERE `title` = :title';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de vérifier si le nouveau titre existe déjà.
     * @return type OBJ
     */
    public function checkIfArticleTitleExistsById() {
        $query = 'SELECT COUNT(`title`) AS `titleExists` '
                . 'FROM `chtsc_publications`'
                . 'WHERE `title` = :title AND `id` <> :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de vérifier si un article existe déjà.
     * @return type OBJ
     */
    public function checkIfArticleExists() {
        $query = 'SELECT COUNT(`path`) AS `articleExists` '
                . 'FROM `chtsc_publications`'
                . 'WHERE `path` = :path';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':path', $this->path, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de vérifier si un article existe déjà.
     * @return type OBJ
     */
    public function checkIfIdAndPathExist() {
        $query = 'SELECT COUNT(`id`) AS `idAndPathExists` '
                . 'FROM `chtsc_publications`'
                . 'WHERE `id` = :id AND `path` = :path';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $statement->bindValue(':path', $this->path, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
     /**
      * Méthode permettant de modifier le titre et le type d'un article.
      * @return type BOOL
      */
    public function updateArticleInfos() {
        $query = 'UPDATE `chtsc_publications` '
                . 'SET `title` = :title, `type` = :type, `path` = :path, `date` = NOW() '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $statement->bindValue(':type', $this->type, PDO::PARAM_STR);
        $statement->bindValue(':path', $this->path, PDO::PARAM_STR);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
    
    public function deleteArticle() {
        $query = 'DELETE FROM `chtsc_publications` '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
}

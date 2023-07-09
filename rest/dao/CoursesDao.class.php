<?php
require_once "BaseDao.class.php";



class CoursesDao extends BaseDao{  //EXTENDS to add inheritance

    public function __construct(){
        parent::__construct("courses"); //if child class extends inherits from parent class, it has access to any methods in BaseDao
    }
    // Metoda za ažuriranje statusa kursa
public function updateStatus($courseId, $status) {
    $query = "UPDATE courses SET status = :status WHERE id = :courseId";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':courseId', $courseId);
    $stmt->execute();
  }

  
  
  




}


?>
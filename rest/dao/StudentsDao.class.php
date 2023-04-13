<?php

  class StudentsDao{ //file which contains definitions 

    private $conn; 

    /**
     * Class constructor used to establish connection to db
     */

    public function __construct(){
        $servername = "localhost";
        $username= "root";
        $password = "root";
        $schema = "mydb";

try{
    $this->conn = new PDO ("mysql:host=$servername;dbname=$schema",$username, $password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    //$stmt =$this->conn->prepare("SELECT * FROM students"); //stmt ide da nam da podatke iz baze, u ovom slucaju sve o studentima
    //$stmt->execute();
    //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //print_r($result);
}catch (PDOException $e){
    echo "Connection failed " . $e->getMessage();
}
}

    /**
     * Method used to get all students from db
     */

     public function get_all(){
        $stmt = $this->conn->prepare("SELECT * FROM students"); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

     }

     /**
     * Method used to get student by id from db
     */

     public function get_by_id($id){
      $stmt = $this->conn->prepare("SELECT * FROM students WHERE id=:id"); 
      $stmt->execute(['id' => $id]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

   }

     /**
     * Method used to add students to db
     */

     public function add($student){
        $stmt = $this->conn->prepare("INSERT INTO students (firstName, lastName, email, dateOfBirth) VALUES (:firstName, :lastName, :email, :dateOfBirth)");
        $stmt->execute($student); //everything from the request is in this path here
        $student['id'] = $this->conn->lastInsertId(); //method which will return us the id of the last inserted record 
        return $student;
  }  
  /**
     * Method used to update students from db
     */

     public function update($student, $id){
      $student['id'] = $id; //updating id
      $stmt = $this->conn->prepare("UPDATE students SET firstName =:firstName, lastName=:lastName, email = :email, dateOfBirth = :dateOfBirth, WHERE id = :id ");
      $stmt->execute($student);
      return $student;
  
       }
      /**
       * method used to delete student from database
       */
      public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM Students WHERE id= :id");
        $stmt->bindParam(':id', $id);   //prevent SQL injection, we have this so when we put OR 1=1 not everything will be deleted. Security is better.
        $stmt->execute();
     
    }

}



  ?>


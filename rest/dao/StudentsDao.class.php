<?php

  class StudentsDao{

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
    echo "Connected successfully";
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
     * Method used to add students to db
     */

     public function add($firstName, $lastName, $dateOfBirth, $email){
        $stmt = $this->conn->prepare("INSERT INTO students (firstName, lastName, dateOfBirth, email) VALUES ('student003', 'test003', '12.1.2002', 'student003.test@stu.ibu.edu.ba')");
        $result = $stmt->execute();
   
  }
  /**
     * Method used to update students from db
     */

     public function update($firstName,$lastName, $dateOfBirth, $email, $id){
        $stmt = $this->conn->prepare("UPDATE students SET firstName =':firstName', lastName=':lastName', dateOfBirth=':dateOfBirth', email = ':email' WHERE id = :id");
        $stmt->execute(['firstName'=> $firstName, 'lastName'=>$lastName, 'dateOfBirth'=>$dateOfBirth, 'email' => $email, 'id'=>$id]);
  
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


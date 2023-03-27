<?php
class StudentsDao{

    private $conn;

    /**
     * Class constructor used to establish connection to database
     */

    public function __construct(){
        try{
        $servername = "localhost";
        $username= "root";
        $password = "mina50";
        $schema = "student_information_system";

        $this->conn = new PDO ("mysql:host=$servername;dbname=$schema",$username, $password);
        
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        
        }catch (PDOException $e){
            echo "Connection failed " . $e->getMessage();
        }
    }
    /**
     * method used to get all students from database
     */
    public function get_all(){
        $stmt = $this->conn->prepare("SELECT * FROM students");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    /**
     * method used to add student to database
     * string $firstName : is a first name of a student
     * int $age : age of a student
     */
    public function add($firstName, $lastName, $age){
        $stmt = $this->conn->prepare("INSERT INTO Students (firstName, lastName, age) VALUES (':firstName', ':lastName', ':age')");
        $result = $stmt->execute(['firstName'=> $firstName, 'lastName'=>$lastName, 'age'=>$age]);   
    }
    /**
     * method used to update student from database
     */
    public function update($firstName, $lastName, $age, $id){
        $stmt = $this->conn->prepare("UPDATE Students SET firstName=':firstName', lastName=':lastName', age =':age' WHERE id=:id");
        $stmt->execute(['firstName'=> $firstName, 'lastName'=>$lastName, 'age'=>$age,'id'=>$id]);   
    }
    /**
     * method used to delete student from database
     */
    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM Students WHERE id= :id");
        $stmt->bindParam(':id', $id);                   //prevent SQL injection, we have this so when we put OR 1=1 not everything will be deleted. Security is better.
        $stmt->execute();   
    }
}

?>
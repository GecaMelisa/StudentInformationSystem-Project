<?php

require_once("rest/dao/StudentsDao.class.php");
$student_dao = new StudentsDao();

$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName']; 
$dateOfBirth = $_REQUEST['dateOfBirth']; 
$email = $_REQUEST['email']; 

$result = $student_dao->add($firstName, $lastName, $dateOfBirth, $email);
print_r($results);


/*/
$servername = "localhost";
$username= "root";
$password = "root";
$schema = "mydb";

try{
    $conn = new PDO ("mysql:host=$servername;dbname=$schema",$username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    print_r($_REQUEST);

    $stmt = $conn->prepare("INSERT INTO students (firstName, lastName, dateOfBirth, email) VALUES ('student003', 'test003', '12.1.2002', 'student003.test@stu.ibu.edu.ba')"); 
    //stmt ide da nam da podatke iz baze, u ovom slucaju sve o studentima
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

}catch (PDOException $e){
    echo "Connection failed " . $e->getMessage();
}

/*/


?>
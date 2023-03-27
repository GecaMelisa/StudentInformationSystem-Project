<?php

require_once("rest/dao/StudentsDao.class.php");
$student_dao= new StudentsDao();
$firstName=$_REQUEST['firstName'];
$lastName=$_REQUEST['lastName'];
$age=$_REQUEST['age'];
$results=$student_dao->add($firstName, $lastName, $age);
print_r($results);

/**$servername = "localhost";
$username= "root";
$password = "mina50";
$schema = "student_information_system";

try{
    $conn = new PDO ("mysql:host=$servername;dbname=$schema",$username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    print_r($_REQUEST);
    $firstName=$_REQUEST['firstName'];
    $lastName=$_REQUEST['lastName'];
    $age=$_REQUEST['age'];
    $stmt = $conn->prepare("INSERT INTO Students (firstName, lastName, age) VALUES ('$firstName', '$lastName', '$age')");
    $result = $stmt->execute();
    print_r($result);
}catch (PDOException $e){
    echo "Connection failed " . $e->getMessage();
}
*/
?>
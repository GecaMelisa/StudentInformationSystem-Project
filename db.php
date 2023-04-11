<?php

require_once("rest/dao/StudentsDao.class.php");
$student_dao= new StudentsDao();

$results=$student_dao->get_all();
print_r($results);
/**$servername = "localhost";
$username= "root";
$password = "";
$schema = "mydb";

try{
    $conn = new PDO ("mysql:host=$servername;dbname=$schema",$username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

    $stmt = $conn->prepare("SELECT * FROM students");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
}catch (PDOException $e){
    echo "Connection failed " . $e->getMessage();
}

*/

?>
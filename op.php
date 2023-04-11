<?php

require_once("rest/dao/StudentsDao.class.php");      //import skript or a class
$student_dao= new StudentsDao();                     //create a object

$type=$_REQUEST['type'];

switch ($type){
    case 'add':
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName']; 
        $dateOfBirth = $_REQUEST['dateOfBirth']; 
        $email = $_REQUEST['email']; 

        $result = $student_dao->add($firstName, $lastName, $dateOfBirth, $email);
        print_r($results);
        break;

    case 'delete':
        $id=$_REQUEST['id'];
        $student_dao->delete($id);
        print_r('delete');
        break;

    case 'update':
        $firstName=$_REQUEST['firstName'];
        $lastName=$_REQUEST['lastName'];
        $dateOfBirth=$_REQUEST['dateOfBirth'];
        $email=$_REQUEST['email'];
        $id=$_REQUEST['id'];
        $student_dao->update($firstName, $lastName, $dateOfBirth, $email, $id);
        print_r('update');
        break;

    case 'get':
    default:
        $results = $student_dao->get_all();
        print_r($results);
        break;



}



?>
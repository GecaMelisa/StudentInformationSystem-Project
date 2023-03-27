<?php

require_once("rest/dao/StudentsDao.class.php");      //import skript or a class
$student_dao= new StudentsDao();                     //create a object

$type=$_REQUEST['type'];

switch($type){

    case 'add' :
        $firstName=$_REQUEST['firstName'];
        $lastName=$_REQUEST['lastName'];
        $age=$_REQUEST['age'];
        $results=$student_dao->add($firstName, $lastName, $age);
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
        $age=$_REQUEST['age'];
        $id=$_REQUEST['id'];
        $student_dao->update($firstName, $lastName, $age, $id);
        print_r('update');
        break;

    case 'get' :
    default:
        $results=$student_dao->get_all();
        print_r($results);
        break;

}



?>
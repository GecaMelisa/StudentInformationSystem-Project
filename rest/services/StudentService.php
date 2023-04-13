<?php
require 'BaseService.php';
require __DIR__."/../dao/StudentsDao.class.php";

class StudentService extends BaseService{
    private $student_dao;
    public function __construct(){
       parent::__construct(new StudentsDao);
    }

    //public function add($entity){
        //parent::add($entity);
        //send an email
       
}

?>
<?php
require_once 'BaseService.php';

require_once __DIR__."/../dao/StudentsDao.class.php";

class StudentService extends BaseService{

    
    
    public function __construct(){
        parent::__construct(new StudentsDao);
    } 

    public function add($entity){
        return parent::add($entity);
        /*
        example 
        send an email
        if(!validateField($entity['first_name'])){
            //error
        }
        */
    }
    public function getCoursesByStudentId($studentId){
        return $this->dao->getCoursesByStudentId($studentId);
    }

    public function getGradesByStudentandCourse($studentId, $courseId){
        return $this->dao->getGradesByStudentandCourse($studentId, $courseId);
    }

    public function getStudentInfo($studentId){
        return $this->dao->getStudentInfo($studentId);
    }
    

}
?>
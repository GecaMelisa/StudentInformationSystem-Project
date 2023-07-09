<?php
require_once 'BaseService.php';

require_once __DIR__."/../dao/StudentsDao.class.php";

class StudentService extends BaseService{

    
    
    public function __construct(){
        parent::__construct(new StudentsDao);
    } 

    public function add($entity){
        return parent::add($entity);
        
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

    public function getAllGradesByStudentandCourse($studentId, $courseId){
        return $this->dao->getAllGradesByStudentandCourse($studentId, $courseId);
    }
    
    public function getAllAttendanceByStudentandCourse($studentId, $courseId){
        return $this->dao->getAllAttendanceByStudentandCourse($studentId, $courseId);
    }

    public function get_user_students($user){
        return $this->dao->get_user_students($user['id']);
    }

    //FETCH ALL GRADES FOR ONE STUDENT
    public function getStudentGrades($studentId){
        return $this->dao->getStudentGrades($studentId);
    }
    public function changePassword($password,$email){
        return $this->dao->changePassword($password,$email);
    }
}
?>
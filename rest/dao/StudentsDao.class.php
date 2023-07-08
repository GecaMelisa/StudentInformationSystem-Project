<?php
require_once "BaseDao.class.php";

class StudentsDao extends BaseDao {


    public function __construct(){
        parent::__construct("students");
    }


    public function getGradesByStudentandCourse($studentId, $courseId) {
        // Izvršavanje upita s parametrima
        $query = $this->query("
            SELECT grade
            FROM grades
            WHERE students_id = :studentId AND courses_id = :courseId",
            ["studentId" => $studentId, "courseId" => $courseId]
        );
    }
    

    public function getStudentInfo($studentId) {
        return $this->query("SELECT * FROM students s WHERE s.id = :id", array(':id' => $studentId));
    }

    /*
    get all grades for student - total
    */

    public function getAllGradesByStudentandCourse($studentId, $courseId){
        return $this->query("SELECT g.midterm, g.final, g.quiz
        FROM students AS s
        JOIN grades AS g ON g.students_id = s.id
        JOIN courses AS c ON g.courses_id = c.id
        WHERE s.id = :stu_id and c.id= :cour_id", ["stu_id" => $studentId, "cour_id" => $courseId]);
    }
    
    /*
    get attendance by course_id and student_id
    */
    public function getAllAttendanceByStudentandCourse($studentId, $courseId){
        return $this->query(
            "SELECT a.att_per_course
        FROM attendance a
        JOIN courses c ON a.course_id = c.id
        JOIN students s ON a.student_id = s.id
        WHERE c.status = 1 AND a.student_id = :stu_id AND c.id = :cour_id", ["stu_id" => $studentId, "cour_id" => $courseId]);
        
    }

/*
Courses and Grades - mid, final, quiz
*/
    public function getStudentGrades($studentId) {
        return $this->query
        ("SELECT c.id, c.name, g.final, g.midterm, g.quiz, g.courses_id
         FROM grades g JOIN courses c ON g.courses_id = c.id 
           WHERE students_id = :id", array(':id' => $studentId));
    }
      

}

?>
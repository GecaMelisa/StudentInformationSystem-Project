<?php
require_once "BaseDao.class.php";

class StudentsDao extends BaseDao {

    

    public function __construct(){
        parent::__construct("students");
    }

    public function getCoursesByStudentId($studentId) {
        
    
        $query="SELECT c.name, e.attendance, c.id
        FROM students AS s
        JOIN enrollments AS e ON e.students_id = s.id
        JOIN courses AS c ON e.courses_id = c.id
        WHERE s.id = :id";


        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $studentId); 
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $courses;
                  
    }

    public function getGradesByStudentandCourse($studentId, $courseId){
        return $this->query("SELECT g.grade
        FROM students AS s
        JOIN grades AS g ON g.students_id = s.id
        JOIN courses AS c ON g.courses_id = c.id
        WHERE s.id = :stu_id and c.id= :cour_id", ["stu_id" => $studentId, "cour_id" => $courseId]);
    }

    /*public function getAttendance($studentId){
        $query="SELECT a.status
        FROM attendance a
        JOIN enrollments AS e ON a.enrollments_id=e.id
        JOIN students AS s ON s.id=e.students_id
        JOIN courses AS c ON e.courses_id=c.id
        WHERE s.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $studentId); 
        $stmt->execute();
        $attendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $attendance;
    }*/
}

?>
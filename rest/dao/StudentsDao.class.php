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

    public function getAllGradesByStudentandCourse($studentId, $courseId){
        return $this->query("SELECT g.midterm, g.final, g.quiz
        FROM students AS s
        JOIN grades AS g ON g.students_id = s.id
        JOIN courses AS c ON g.courses_id = c.id
        WHERE s.id = :stu_id and c.id= :cour_id", ["stu_id" => $studentId, "cour_id" => $courseId]);
    }

    /*
    get all attendace for attendance.html so attendace for each course for specific student 
    */
    public function getAllAttendanceByStudentandCourse($studentId, $courseId){
        return $this->query(
            "SELECT a.att_per_course
        FROM attendance a
        JOIN courses c ON a.course_id = c.id
        JOIN students s ON a.student_id = s.id
        WHERE c.status = 1 AND a.student_id = :stu_id AND c.id = :cour_id", ["stu_id" => $studentId, "cour_id" => $courseId]);
        
    }


    public function getStudentGrades($studentId) {
        return $this->query("SELECT c.id, c.name, g.final, g.midterm, g.quiz, g.courses_id FROM grades g JOIN courses c ON g.courses_id = c.id   WHERE students_id = :id", array(':id' => $studentId));
    }
        
       /* ("SELECT a.lab, a.lesson, a.total
        FROM enrollments AS e 
        JOIN attendance AS a ON a.enrollments_id = e.id
        JOIN courses AS c ON e.courses_id = c.id
        JOIN students AS s ON e.students_id= s.id
        WHERE s.id = :stu_id and c.id= :cour_id", ["stu_id" => $studentId, "cour_id" => $courseId]);
    }
    */
    
    

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
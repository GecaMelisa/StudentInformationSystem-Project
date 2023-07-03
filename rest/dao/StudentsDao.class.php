<?php
require_once "BaseDao.class.php";

class StudentsDao extends BaseDao {

    

    public function __construct(){
        parent::__construct("students");
    }

    public function getCoursesByStudentId($studentId) {
        
        /*$query = "SELECT c.name FROM courses c
          JOIN enrollments e ON c.id = e.courses_id
          JOIN students s ON s.id = e.students_id
          WHERE e.students_id = :studentsId
          GROUP BY s.id";*/

        $query="SELECT c.name
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
}

?>

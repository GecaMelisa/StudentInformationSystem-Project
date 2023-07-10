<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../vendor/autoload.php"; //means exit from the rest and enter to the vendor; da smo trebali i u dao, ../ bi bilo potrebno

use Firebase\JWT\JWT;
use Firebase\JWT\Key;






// middleware method for login
Flight::route('/*', function(){
  // Perform JWT decode
  $path = Flight::request()->url;
  if ($path == '/loginUser') return TRUE; // Exclude login route from middleware

  $headers = getallheaders();
  if (!isset($headers['Authorization'])){
    Flight::json(["message" => "Authorization is missing"], 403);
    return FALSE;
  } else {
    try {
      $decoded = (array)JWT::decode($headers['Authorization'],new Key('secret_key_20202','HS256'));
      Flight::set('user', $decoded);
      return TRUE;
    } catch (\Exception $e) {
      Flight::json(["message" => "Authorization token is not valid"], 403);
      return FALSE;
    }
  }
});


require "dao/StudentsDao.class.php";
require "services/StudentService.php";
Flight::register("student_service", "StudentService");
require_once 'routes/StudentRoutes.php';


require "dao/CoursesDao.class.php";
Flight::register("course_dao", "CoursesDao");
require "services/CourseService.php";
require_once 'routes/CourseRoutes.php';

require "dao/ProfessorsDao.class.php";
Flight::register("professor_service", "ProfessorService");
require "services/ProfessorService.php";
require_once 'routes/ProfessorRoutes.php';

require "dao/AttendanceDao.class.php";
Flight::register("attendance_dao", "AttendanceDao");
require "services/AttendanceService.php";
require_once 'routes/AttendanceRoutes.php';

require "dao/EnrollmentsDao.class.php";
Flight::register("enrollement_dao", "EnrollementsDao");
require "services/EnrollmentService.php";
require_once 'routes/EnrollmentRoutes.php';

require "dao/GradesDao.class.php";
Flight::register("grades_service", "GradeService");
require "services/GradeService.php";
require_once 'routes/GradeRoutes.php';


require "dao/UserDao.class.php";
Flight::register("userDao", "UserDao");
require_once 'routes/UserRoutes.php';






Flight::start();


?>
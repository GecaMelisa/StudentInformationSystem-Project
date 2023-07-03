<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../vendor/autoload.php"; //means exit from the rest and enter to the vendor; da smo trebali i u dao, ../ bi bilo potrebno
require "dao/StudentsDao.class.php";
require "dao/CoursesDao.class.php";

require "services/StudentService.php";
require "services/CourseService.php";


Flight::register('student_service', "StudentService"); //registering StudentService class
Flight::register('course_service', "CourseService"); //kada dodamo novi Dao, moramo ovdje registrovati flight i require once

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// middleware method for login
/*Flight::route('/*', function(){
    //perform JWT decode
    $path = Flight::request()->url;
    if ($path == '/login' || $path == '/docs.json') return TRUE; // exclude login route from middleware
  
    $headers = getallheaders();
    if (!$headers['Authorization']){
      Flight::json(["message" => "Authorization is missing"], 403);
      return FALSE;
    }else{
      try {
        $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
        Flight::set('user', $decoded);
        return TRUE;
      } catch (\Exception $e) {
        Flight::json(["message" => "Authorization token is not valid"], 403);
        return FALSE;
      }
    }
  });

  */



require_once 'routes/StudentRoutes.php';
require_once 'routes/CourseRoutes.php';


Flight::start();


?>
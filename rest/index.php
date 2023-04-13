<?php
require "../vendor/autoload.php"; //means exit from the rest and enter to the vendor; da smo trebali i u dao, ../ bi bilo potrebno
require "dao/StudentsDao.class.php";
require "dao/CoursesDao.class.php";

require "services/StudentService.php";
require "services/CourseService.php";


Flight::register('student_service', "StudentService"); //registering StudentService class
Flight::register('course_service', "CourseService"); //kada dodamo novi Dao, moramo ovdje registrovati flight i require once

require_once 'routes/StudentRoutes.php';
require_once 'routes/CourseRoutes.php';


Flight::start();


?>
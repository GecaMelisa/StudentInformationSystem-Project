<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');
require 'vendor/autoload.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=studentinformationsystem','root',''));

Flight::route('GET /api/students', function(){
   $students = Flight::db()->query('SELECT * FROM Students', PDO::FETCH_ASSOC)->fetchAll();
   var_dump($students);
   Flight::json($students);
   });


require 'vendor/autoload.php';

Flight::route('/', function(){
    echo 'hello world!';
  });
  
  Flight::start();
?>
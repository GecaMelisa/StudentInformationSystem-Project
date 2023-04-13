<?php
require "../vendor/autoload.php"; //means exit from the rest and enter to the vendor; da smo trebali i u dao, ../ bi bilo potrebno
require "dao/StudentsDao.class.php";

Flight::register('student_dao', "StudentsDao"); //registering studentsDao class

Flight:: route('/', function(){
    echo "Hello from / route";
  });

  /*/ get_all
  /*/
  Flight:: route('GET /students/', function(){ 
    //echo "Hello from /students route";
    //$student_dao= new StudentsDao(); //create a object
    //$results = Flight::student_dao()->get_all(); //using registred class
    //print_r($results);
    Flight::json( Flight::student_dao()->get_all()); // to return results in json format

  });

  //Route

  Flight:: route('GET /student_by_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::student_dao()->get_by_id($id)); // to return results in json format

  });



  Flight:: route('GET /students/@id', function($id){ //with parameter
    //echo "Hello from /students route";
    //$student_dao= new StudentsDao(); //create a object
    //$results = $student_dao->get_by_id($id);
    //print_r($results);
    Flight::json(Flight::student_dao()->get_by_id($id)); // to return results in json format

  });

  /*/ post method
  /*/

  Flight:: route('POST /student', function(){ 
    //echo "Hello from /students route";
    //$student_dao= new StudentsDao(); //create a object
    $request = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //dodali smo ->data tako da extract  data part; request data
    //print_r($request); samo za testiranje
    //die;
    //$response = $student_dao->add($request);  //we need to provide add
    Flight::json(['message' => "Student added successfully",
                 'data' => Flight::student_dao()->add($request)
                ]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali studenta

  });

/*/ update method
  /*/

  Flight:: route('PUT /student/@id', function($id){ 
    //echo "Hello from /students route";
   // $student_dao= new StudentsDao();
    $student = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //$response = $student_dao->update($student, $id);  //we need to provide add
    Flight::json(['message' => "Student edit successfully", 'data' => Flight::student_dao()->update($student, $id)]); 

  });


  /*/ Delete by id
  /*/

  Flight:: route('DELETE /students/@id', function($id){ 
    //echo "Hello from /students route";
    //$student_dao= new StudentsDao(); //create a object
    Flight::student_dao()->delete($id); //ne treba nam result ovdje
    //print_r($results);
    Flight::json(['message' => "Student deleted successfully"]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali studenta

  });

  Flight:: route('GET /students/@name', function($name){ //pozivanje sa parametrom
    echo "Hello from /students route with name = ".$name;
  });

  Flight:: route('GET /students/@name/@status', function($name, $status){ 
    echo "Hello from /students route with name = ".$name . "and status = " .$status; 
  });

Flight::start();


?>
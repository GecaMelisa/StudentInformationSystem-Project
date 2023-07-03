<?php

/*/ get_all
  /*/
  Flight:: route('GET /students', function(){ 
    //echo "Hello from /students route";
    //$= new StudentsDao(); //create a object
    //$results = Flight::()->get_all(); //using registred class
    //print_r($results);
    Flight::json( Flight::student_service()->get_all()); // to return results in json format
  });


  Flight:: route('GET /student_by_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::student_service()->get_by_id($id)); // to return results in json format

  });



  Flight:: route('GET /students/@id', function($id){ //with parameter
    //echo "Hello from /students route";
    //$= new StudentsDao(); //create a object
    //$results = $->get_by_id($id);
    //print_r($results);
    Flight::json(Flight::student_service()->get_by_id($id)); // to return results in json format

  });


  /*/ post method
  /*/

  Flight:: route('POST /student', function(){ 
    //echo "Hello from /students route";
    
    $request = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //dodali smo ->data tako da extract  data part; request data
    //print_r($request); samo za testiranje
    //die;
    //$response = $->add($request);  //we need to provide add
    Flight::json(['message' => "Student added successfully",
                 'data' => Flight::student_service()->add($request)
                ]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali studenta

  });

/*/ update method
  /*/

  Flight:: route('PUT /student/@id', function($id){ 
    $student = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //$response = $->update($student, $id);  //we need to provide add
    Flight::json(['message' => "Student edit successfully", 'data' => Flight::student_service()->update($student, $id)]); 

  });


  /*/ Delete by id
  /*/

  Flight:: route('DELETE /students/@id', function($id){ 
    Flight::student_service()->delete($id); //ne treba nam result ovdje
    //print_r($results);
    Flight::json(['message' => "Student deleted successfully"]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali studenta

  });

  Flight:: route('GET /students/@name', function($name){ //pozivanje sa parametrom
    echo "Hello from /students route with name = ".$name;
  });

  Flight:: route('GET /students/@name/@status', function($name, $status){ 
    echo "Hello from /students route with name = ".$name . "and status = " .$status; 
  });

  /*
  get courses for student by student id
  */
  Flight::route('GET /studentcourses/@id', function($id){
    $courses = Flight::student_service()->getCoursesByStudentId($id);
    Flight::json($courses);
});



?>


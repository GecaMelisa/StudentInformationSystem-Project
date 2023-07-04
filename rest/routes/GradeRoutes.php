<?php

/*/ get_all
  /*/
  Flight:: route('GET /grade/', function(){ 
    //echo "Hello from /grade route";
    //$= new gradeDao(); //create a object
    //$results = Flight::()->get_all(); //using registred class
    //print_r($results);
    Flight::json( Flight::grade_service()->get_all()); // to return results in json format
  });


  Flight:: route('GET /grade_by_student_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::grade_service()->get_by_id($id)); // to return results in json format

  });



  Flight:: route('GET /grade/@id', function($id){ //with parameter
    //echo "Hello from /grade route";
    //$= new gradeDao(); //create a object
    //$results = $->get_by_id($id);
    //print_r($results);
    Flight::json(Flight::grade_service()->get_by_id($id)); // to return results in json format

  });


  /*/ post method
  /*/

  Flight:: route('POST /grade', function(){ 
    $request = Flight::request()->data->getData(); 
    Flight::json(['message' => "Grade added successfully",
                 'data' => Flight::grade_service()->add($request)
                ]); 

  });

/*/ update method
  /*/

  Flight:: route('PUT /grade/@id', function($id){ 
    //echo "Hello from /grade route";
   // $= new gradeDao();
    $grade = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //$response = $->update($student, $id);  //we need to provide add
    Flight::json(['message' => "Grade edit successfully", 'data' => Flight::grade_service()->update($grade, $id)]); 

  });


  /*/ Delete by id
  /*/

  Flight:: route('DELETE /grade/@id', function($id){ 
    Flight::grade_service()->delete($id); 
    Flight::json(['message' => "Grade deleted successfully"]);
  });




?>
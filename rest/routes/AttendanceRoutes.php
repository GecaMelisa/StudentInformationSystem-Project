<?php

/*/ get_all
  /*/
  Flight::route('GET /attendance/', function(){ 
    //echo "Hello from /attendance route";
    //$attendance_dao= new attendanceDao(); //create a object
    //$results = Flight::attendance_dao()->get_all(); //using registred class
    //print_r($results);
    Flight::json( Flight::attendance_dao()->get_all()); // to return results in json format
  });


  Flight::route('GET /attendance_by_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::attendance_dao()->get_by_id($id)); // to return results in json format

  });



  Flight::route('GET /attendance/@id', function($id){ //with parameter
    //echo "Hello from /attendance route";
    //$attendance_dao= new attendanceDao(); //create a object
    //$results = $attendance_dao->get_by_id($id);
    //print_r($results);
    Flight::json(Flight::attendance_dao()->get_by_id($id)); // to return results in json format

  });

  
  /*/ post method
  /*/

  Flight::route('POST /attendance', function(){ 
    //echo "Hello from /attendance route";
    //$attendance_dao= new attendanceDao(); //create a object
    $request = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //dodali smo ->data tako da extract  data part; request data
    //print_r($request); samo za testiranje
    //die;
    //$response = $attendance_dao->add($request);  //we need to provide add
    Flight::json(['message' => "attendance added successfully",
                 'data' => Flight::attendance_dao()->add($request)
                ]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali attendancea

  });

/*/ update method
  /*/

  Flight::route('PUT /attendance/@id', function($id){ 
    //echo "Hello from /attendance route";
   // $attendance_dao= new attendanceDao();
    $attendance = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //$response = $attendance_dao->update($attendance, $id);  //we need to provide add
    Flight::json(['message' => "attendance edit successfully", 'data' => Flight::attendance_dao()->update($attendance, $id)]); 

  });


  /*/ Delete by id
  /*/

  Flight::route('DELETE /attendance/@id', function($id){ 
    //echo "Hello from /attendance route";
    //$attendance_dao= new attendanceDao(); //create a object
    Flight::attendance_dao()->delete($id); //ne treba nam result ovdje
    //print_r($results);
    Flight::json(['message' => "attendance deleted successfully"]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali attendancea

  });

  Flight::route('GET /attendance/@name', function($name){ //pozivanje sa parametrom
    echo "Hello from /attendance route with name = ".$name;
  });

  Flight::route('GET /attendance/@name/@status', function($name, $status){ 
    echo "Hello from /attendance route with name = ".$name . "and status = " .$status; 
  });




?>
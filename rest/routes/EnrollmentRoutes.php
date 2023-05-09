<?php

/*/ get_all
  /*/
  Flight::route('GET /enrollment/', function(){ 
    //echo "Hello from /enrollment route";
    //$enrollment_dao= new enrollmentDao(); //create a object
    //$results = Flight::enrollment_dao()->get_all(); //using registred class
    //print_r($results);
    Flight::json( Flight::enrollment_dao()->get_all()); // to return results in json format
  });


  Flight::route('GET /enrollment_by_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::enrollment_dao()->get_by_id($id)); // to return results in json format

  });



  Flight::route('GET /enrollment/@id', function($id){ //with parameter
    //echo "Hello from /enrollment route";
    //$enrollment_dao= new enrollmentDao(); //create a object
    //$results = $enrollment_dao->get_by_id($id);
    //print_r($results);
    Flight::json(Flight::enrollment_dao()->get_by_id($id)); // to return results in json format

  });

  
  /*/ post method
  /*/

  Flight::route('POST /enrollment', function(){ 
    //echo "Hello from /enrollment route";
    //$enrollment_dao= new enrollmentDao(); //create a object
    $request = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //dodali smo ->data tako da extract  data part; request data
    //print_r($request); samo za testiranje
    //die;
    //$response = $enrollment_dao->add($request);  //we need to provide add
    Flight::json(['message' => "enrollment added successfully",
                 'data' => Flight::enrollment_dao()->add($request)
                ]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali enrollmenta

  });

/*/ update method
  /*/

  Flight::route('PUT /enrollment/@id', function($id){ 
    //echo "Hello from /enrollment route";
   // $enrollment_dao= new enrollmentDao();
    $enrollment = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //$response = $enrollment_dao->update($enrollment, $id);  //we need to provide add
    Flight::json(['message' => "enrollment edit successfully", 'data' => Flight::enrollment_dao()->update($enrollment, $id)]); 

  });


  /*/ Delete by id
  /*/

  Flight::route('DELETE /enrollment/@id', function($id){ 
    //echo "Hello from /enrollment route";
    //$enrollment_dao= new enrollmentDao(); //create a object
    Flight::enrollment_dao()->delete($id); //ne treba nam result ovdje
    //print_r($results);
    Flight::json(['message' => "enrollment deleted successfully"]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali enrollmenta

  });

  Flight::route('GET /enrollment/@name', function($name){ //pozivanje sa parametrom
    echo "Hello from /enrollment route with name = ".$name;
  });

  Flight::route('GET /enrollment/@name/@status', function($name, $status){ 
    echo "Hello from /enrollment route with name = ".$name . "and status = " .$status; 
  });




?>
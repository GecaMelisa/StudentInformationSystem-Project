<?php

/*/ get_all
  /*/
  Flight::route('GET /course/', function(){ 
    //echo "Hello from /course route";
    //$Course_dao= new courseDao(); //create a object
    //$results = Flight::Course_dao()->get_all(); //using registred class
    //print_r($results);
    Flight::json( Flight::course_dao()->get_all()); // to return results in json format
  });


  Flight::route('GET /course_by_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::course_dao()->get_by_id($id)); // to return results in json format

  });



  Flight::route('GET /course/@id', function($id){ //with parameter
    //echo "Hello from /course route";
    //$Course_dao= new courseDao(); //create a object
    //$results = $Course_dao->get_by_id($id);
    //print_r($results);
    Flight::json(Flight::course_dao()->get_by_id($id)); // to return results in json format

  });

  
  /*/ post method
  /*/

  Flight::route('POST /course', function(){ 
    //echo "Hello from /course route";
    //$Course_dao= new courseDao(); //create a object
    $request = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //dodali smo ->data tako da extract  data part; request data
    //print_r($request); samo za testiranje
    //die;
    //$response = $Course_dao->add($request);  //we need to provide add
    Flight::json(['message' => "Course added successfully",
                 'data' => Flight::course_dao()->add($request)
                ]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali Coursea

  });

/*/ update method
  /*/

  Flight::route('PUT /course/@id', function($id){ 
    //echo "Hello from /course route";
   // $Course_dao= new courseDao();
    $Course = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //$response = $Course_dao->update($Course, $id);  //we need to provide add
    Flight::json(['message' => "Course edit successfully", 'data' => Flight::course_dao()->update($Course, $id)]); 

  });


  /*/ Delete by id
  /*/

  Flight::route('DELETE /course/@id', function($id){ 
    //echo "Hello from /course route";
    //$Course_dao= new courseDao(); //create a object
    Flight::course_dao()->delete($id); //ne treba nam result ovdje
    //print_r($results);
    Flight::json(['message' => "Course deleted successfully"]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali Coursea

  });

  Flight::route('GET /course/@name', function($name){ //pozivanje sa parametrom
    echo "Hello from /course route with name = ".$name;
  });

  Flight::route('GET /course/@name/@status', function($name, $status){ 
    echo "Hello from /course route with name = ".$name . "and status = " .$status; 
  });




?>
<?php

/*/ get_all
  /*/
  Flight:: route('GET /professor', function(){ 
    //echo "Hello from /professor route";
    //$= new professorDao(); //create a object
    //$results = Flight::()->get_all(); //using registred class
    //print_r($results);
    Flight::json( Flight::professor_service()->get_all()); // to return results in json format
  });


  Flight:: route('GET /professor_by_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::professor_service()->get_by_id($id)); // to return results in json format

  });



  Flight:: route('GET /professor/@id', function($id){ //with parameter
    //echo "Hello from /professor route";
    //$= new professorDao(); //create a object
    //$results = $->get_by_id($id);
    //print_r($results);
    Flight::json(Flight::professor_service()->get_by_id($id)); // to return results in json format

  });


  /*/ post method
  /*/

  Flight:: route('POST /professor', function(){ 
    //echo "Hello from /professor route";
    //$= new professorDao(); //create a object
    $request = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //dodali smo ->data tako da extract  data part; request data
    //print_r($request); samo za testiranje
    //die;
    //$response = $->add($request);  //we need to provide add
    Flight::json(['message' => "professor added successfully",
                 'data' => Flight::professor_service()->add($request)
                ]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali professora

  });

/*/ update method
  /*/

  Flight:: route('PUT /professor/@id', function($id){ 
    //echo "Hello from /professor route";
   // $= new professorDao();
    $professor = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //$response = $->update($professor, $id);  //we need to provide add
    Flight::json(['message' => "professor edit successfully", 'data' => Flight::professor_service()->update($professor, $id)]); 

  });


  /*/ Delete by id
  /*/

  Flight:: route('DELETE /professor/@id', function($id){ 
    //echo "Hello from /professor route";
    //$= new professorDao(); //create a object
    Flight::professor_service()->delete($id); //ne treba nam result ovdje
    //print_r($results);
    Flight::json(['message' => "professor deleted successfully"]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali professora

  });

  Flight:: route('GET /professor/@name', function($name){ //pozivanje sa parametrom
    echo "Hello from /professor route with name = ".$name;
  });

  Flight:: route('GET /professor/@name/@status', function($name, $status){ 
    echo "Hello from /professor route with name = ".$name . "and status = " .$status; 
  });



?>
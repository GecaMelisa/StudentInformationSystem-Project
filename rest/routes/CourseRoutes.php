<?php

/*/ get_all
  /*/
  Flight::route('GET /course/', function(){ 
    Flight::json( Flight::course_dao()->get_all()); // to return results in json format
  });


  Flight::route('GET /course_by_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::course_dao()->get_by_id($id)); // to return results in json format

  });



  Flight::route('GET /course/@id', function($id){ //with parameter
    Flight::json(Flight::course_dao()->get_by_id($id)); // to return results in json format

  });

  
  /*/ post method
  /*/

  Flight::route('POST /course', function(){ 
    $request = Flight::request()->data->getData(); 
    $request['students_id'] = Flight::get('user');
    Flight::json(['message' => "Course added successfully",
                 'data' => Flight::course_dao()->add($request)
                ]);

  });

/*/ update method
  /*/

  Flight::route('PUT /studentcourses/' , function($id){ 
    $Course = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    Flight::json(['message' => "Course edit successfully", 'data' => Flight::course_dao()->update($Course, $id)]); 

  });

  // NOT REGISTERED - REGISTERED COURSE

 Flight::route('PUT /course/@courseId', function($courseId){
  $status = 1; 

  // Promjena statusa kursa u tabeli courses
  Flight::course_dao()->updateStatus($courseId, $status);

  // Prebacivanje kursa iz tabele courses u tabelu mycourses
  Flight::json(['message' => 'Course status successfully updated and moved to My Courses']);
});


Flight::route('PUT /course/delete/@id', function($id){
  $status = 0;
  Flight::course_dao()->updateStatus($id, $status);
  // Vratite odgovor o uspješnom brisanju kursa
  Flight::json(['message' => 'Course successfully deleted']);
});


  /*/ Delete by id
  /*/

  Flight::route('DELETE /studentcourses/@id', function($id){ 
    Flight::course_dao()->delete($id); //ne treba nam result ovdje
    Flight::json(['message' => "Course deleted successfully"]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali Coursea

  });

  Flight::route('GET /course/@name', function($name){ //pozivanje sa parametrom
    echo "Hello from /course route with name = ".$name;
  });

  Flight::route('GET /course/@name/@status', function($name, $status){ 
    echo "Hello from /course route with name = ".$name . "and status = " .$status; 
  });


 /* get courses for student by student id
  */
  Flight::route('GET /studentcourses/@id', function($id){
    $courses = Flight::student_service()->getCoursesByStudentId($id);
    Flight::json($courses);
});

/*delete course from my courses
*/

Flight::route('DELETE /studentcourses/@id', function($id){ 
  Flight::course_dao()->delete($id); //ne treba nam result ovdje
  Flight::json(['message' => "Course deleted successfully"]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali Coursea

});


 ?>
<?php

/**
 * @OA\Get(path="/studentcourses", tags={"students"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all students from the API. ",
 *         @OA\Response( response=200, description="List of students.")
 * )
 */

// get_all
  //
  Flight:: route('GET /students', function(){ 
    Flight::json( Flight::student_service()->get_all()); // to return results in json format
  });

  Flight::route('GET /student/@id', function($id){
    Flight::json(Flight::studentService()->select_by_id($id));
  });

  Flight:: route('GET /student_by_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::student_service()->get_by_id($id)); // to return results in json format

  });


  Flight:: route('GET /students/@id', function($id){ 
    Flight::json(Flight::student_service()->get_by_id($id)); // to return results in json format

  });


  // post method
  //

  Flight:: route('POST /student', function(){ 
    //echo "Hello from /students route";
    
    $request = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    Flight::json(['message' => "Student added successfully",
                 'data' => Flight::student_service()->add($request)
                ]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali studenta

  });

// update method
  //

  Flight:: route('PUT /student/@id', function($id){ 
    $student = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //$response = $->update($student, $id);  //we need to provide add
    Flight::json(['message' => "Student edit successfully", 'data' => Flight::student_service()->update($student, $id)]); 

  });


  Flight::route('PUT /changePassword/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(['message' => $data]);
    // Provjera da li postoji student s ID-om $id
    $student = Flight::student_service()->get_by_id(Flight::get('user')["id"]);
    if($student[0]["password"] == $data["currentPassword"]){
      Flight::student_service()->changePassword($data["newPassword"],Flight::get('user')["email"]);
    }
});


  // Delete by id
  //

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

  /*
  get grades for student by student id and course id
  */
  Flight::route('GET /studentgrades/', function($studentId, $couruseId) {
    $grades = Flight::student_service()->getGradesByStudentandCourse($studentId, $couruseId);
    Flight::json($grades);
});


/*
get information about student
*/
Flight::route('GET /studentInfo/@id', function($id){
  $courses = Flight::student_service()->getStudentInfo($id);
  Flight::json($courses);
});

Flight::route('GET /studentGrades/@id', function($id){
  $courses = Flight::student_service()->getStudentGrades($id);
  Flight::json($courses);
});

/*
get all grades (midterm,final,quiz) for by studen id and course id
*/
Flight::route('GET /allgrades/@stu_id/@cour_id', function($id, $id2){
  $grades= Flight::student_service()->getAllGradesByStudentandCourse($id, $id2);
  Flight::json($grades);
});

/*
  all attendance for some specific student and his course
  */
  Flight::route('GET /allattendance/@stu_id/@cour_id', function($id, $id2){
    $attendance= Flight::student_service()->getAllAttendanceByStudentandCourse($id, $id2);
    Flight::json($attendance);
  });

  /*all attendance for some specific student and his course
  */
  Flight::route('GET /allattendance/@stu_id/@cour_id', function($id, $id2){
    $attendance= Flight::student_service()->getAllAttendanceByStudentandCourse($id, $id2);
    Flight::json($attendance);
  });

  

?>




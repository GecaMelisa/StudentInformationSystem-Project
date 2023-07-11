<?php

// get_all
/**
 * @OA\Get(path="/students", tags={"students"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all students from the API. ",
 *         @OA\Response( response=200, description="List of students.")
 * )
 */
  Flight:: route('GET /students', function(){ 
    Flight::json( Flight::student_service()->get_all()); // to return results in json format
  });

//get student by id
  /**
  * @OA\Get(path="/student/{id}", tags={"students"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Student ID"),
  *     @OA\Response(response="200", description="Fetch individual student")
  * )
  */

  Flight::route('GET /student/@id', function($id){
    Flight::json(Flight::studentService()->select_by_id($id));
  });

//get student by id
 /**
  * @OA\Get(path="/student_by_id", tags={"students"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="query", name="id", example=1, description="Student ID"),
  *     @OA\Response(response="200", description="Fetch individual student")
  * )
  */

  Flight:: route('GET /student_by_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::student_service()->get_by_id($id)); // to return results in json format

  });

//get students by id
  /**
  * @OA\Get(path="/students/{id}", tags={"students"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Student ID"),
  *     @OA\Response(response="200", description="Fetch individual student")
  * )
  */

  Flight:: route('GET /students/@id', function($id){ 
    Flight::json(Flight::student_service()->get_by_id($id)); // to return results in json format

  });


  // post method
  /**
* @OA\Post(
*     path="/student", security={{"ApiKeyAuth": {}}},
*     description="Add student",
*     tags={"students"},
*     @OA\RequestBody(description="Add new student", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="firstName", type="string", example="Amina",	description="Student first name"),
*    				@OA\Property(property="lastName", type="string", example="Meric",	description="Student last name" ),
*           @OA\Property(property="email", type="string", example="amina@gmail.com",	description="Student email" ),
*           @OA\Property(property="password", type="string", example="12345",	description="Password" ),
*           @OA\Property(property="dateOfBirth", type="string", example="2002-03-21",	description="Student birth day" ),
*           @OA\Property(property="country", type="string", example="BiH",	description="Student's country" ),
*           @OA\Property(property="city", type="string", example="Brcko",	description="Student's city" ),
*           @OA\Property(property="studentId", type="string", example="123",	description="ID" ),
*           @OA\Property(property="phone", type="string", example="062250747",	description="Student's phone" ),
*           @OA\Property(property="photo", type="string", example="images/mely.jpg",	description="Photo" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Student has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

  Flight:: route('POST /student', function(){ 
    //echo "Hello from /students route";
    
    $request = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    Flight::json(['message' => "Student added successfully",
                 'data' => Flight::student_service()->add($request)
                ]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali studenta

  });

// update method
/**
 * @OA\Put(
 *     path="/student/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit student",
 *     tags={"students"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Student ID"),
 *     @OA\RequestBody(description="Student info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    			@OA\Property(property="firstName", type="string", example="Amina",	description="Student first name"),
*    				@OA\Property(property="lastName", type="string", example="Meric",	description="Student last name" ),
*           @OA\Property(property="email", type="string", example="amina@gmail.com",	description="Student email" ),
*           @OA\Property(property="password", type="string", example="12345",	description="Password" ),
*           @OA\Property(property="dateOfBirth", type="string", example="2002-03-21",	description="Student birth day" ),
*           @OA\Property(property="country", type="string", example="BiH",	description="Student's country" ),
*           @OA\Property(property="city", type="string", example="Brcko",	description="Student's city" ),
*           @OA\Property(property="studentId", type="string", example="123",	description="ID" ),
*           @OA\Property(property="phone", type="string", example="062250747",	description="Student's phone" ),
*           @OA\Property(property="photo", type="string", example="images/mely.jpg",	description="Photo" ),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Student has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

  Flight:: route('PUT /student/@id', function($id){ 
    $student = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
    //$response = $->update($student, $id);  //we need to provide add
    Flight::json(['message' => "Student edit successfully", 'data' => Flight::student_service()->update($student, $id)]); 

  });

/**
 * @OA\Put(
 *     path="/changePassword/{id}",
 *     tags={"students"},
 *     security={{"ApiKeyAuth": {}}},
 *     summary="Change password for a student",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Student ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Request body containing current and new passwords",
 *         @OA\JsonContent(
 *             @OA\Property(property="currentPassword", type="string", description="Current password"),
 *             @OA\Property(property="newPassword", type="string", description="New password")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Password changed successfully"),
 *     @OA\Response(response="404", description="Student not found"),
 *     @OA\Response(response="403", description="Invalid current password")
 * )
 */

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
/**
 * @OA\Delete(
 *     path="/students/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete student",
 *     tags={"students"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Student ID"),
 *     @OA\Response(
 *         response=200,
 *         description="Note deleted"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
*/ 

  Flight:: route('DELETE /students/@id', function($id){ 
    Flight::student_service()->delete($id); //ne treba nam result ovdje
    //print_r($results);
    Flight::json(['message' => "Student deleted successfully"]); //nemamo result, zato kreiramo array koji će biti zapravo poruka da smo uspješno izbrisali studenta

  });

   /**
  * @OA\Get(path="/student/{name}", tags={"students"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="name", example=1, description="Student name"),
  *     @OA\Response(response="200", description="Fetch individual student")
  * )
  */

  Flight:: route('GET /students/@name', function($name){ //pozivanje sa parametrom
    echo "Hello from /students route with name = ".$name;
  });

 /**
 * @OA\Get(
 *     path="/students/{name}/{status}",
 *     tags={"students"},
 *     security={{"ApiKeyAuth": {}}},
 *     summary="Get all grades for a student by student ID and course ID",
 *     @OA\Parameter(
 *         name="name",
 *         in="path",
 *         required=true,
 *         description="Student name",
 *         @OA\Schema(type="string", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="status",
 *         in="path",
 *         required=true,
 *         description="Student Status",
 *         @OA\Schema(type="string", example=1)
 *     ),
 *     @OA\Response(response="200", description="Successful operation")
 * )
 */

  Flight:: route('GET /students/@name/@status', function($name, $status){ 
    echo "Hello from /students route with name = ".$name . "and status = " .$status; 
  });


  
  //get courses for student by student id
  
 /**
  * @OA\Get(path="/studentcourses/{id}", tags={"students"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Student courses"),
  *     @OA\Response(response="200", description="Fetch individual student")
  * )
  */

  Flight::route('GET /studentcourses/@id', function($id){
    $courses = Flight::student_service()->getCoursesByStudentId($id);
    Flight::json($courses);
});

/**
 * @OA\Get(path="/studentgrades", tags={"students"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all student grades from the API. ",
 *         @OA\Response( response=200, description="List of students.")
 * )
 */

  
  //get grades for student by student id and course id
  
  Flight::route('GET /studentgrades/', function($studentId, $couruseId) {
    $grades = Flight::student_service()->getGradesByStudentandCourse($studentId, $couruseId);
    Flight::json($grades);
});



//get information about student

/**
  * @OA\Get(path="/studentInfo/{id}", tags={"students"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Student Info"),
  *     @OA\Response(response="200", description="Fetch individual student")
  * )
  */

Flight::route('GET /studentInfo/@id', function($id){
  $courses = Flight::student_service()->getStudentInfo($id);
  Flight::json($courses);
});

/**
  * @OA\Get(path="/studentGrades/{id}", tags={"students"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Student Grades"),
  *     @OA\Response(response="200", description="Fetch individual student")
  * )
  */

Flight::route('GET /studentGrades/@id', function($id){
  $courses = Flight::student_service()->getStudentGrades($id);
  Flight::json($courses);
});



//get all grades (midterm,final,quiz) for by studen id and course id

/**
 * @OA\Get(
 *     path="/allgrades/{stu_id}/{cour_id}",
 *     tags={"students"},
 *     security={{"ApiKeyAuth": {}}},
 *     summary="Get all grades for a student by student ID and course ID",
 *     @OA\Parameter(
 *         name="stu_id",
 *         in="path",
 *         required=true,
 *         description="Student ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="cour_id",
 *         in="path",
 *         required=true,
 *         description="Course ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(response="200", description="Successful operation")
 * )
 */
Flight::route('GET /allgrades/@stu_id/@cour_id', function($id, $id2){
  $grades= Flight::student_service()->getAllGradesByStudentandCourse($id, $id2);
  Flight::json($grades);
});



  //all attendance for some specific student and his course
  
/**
 * @OA\Get(
 *     path="/allattendance/{stu_id}/{cour_id}",
 *     tags={"students"},
 *     security={{"ApiKeyAuth": {}}},
 *     summary="Get all grades for a student by student ID and course ID",
 *     @OA\Parameter(
 *         name="stu_id",
 *         in="path",
 *         required=true,
 *         description="Student ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="cour_id",
 *         in="path",
 *         required=true,
 *         description="Course ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(response="200", description="Successful operation")
 * )
 */
  Flight::route('GET /allattendance/@stu_id/@cour_id', function($id, $id2){
    $attendance= Flight::student_service()->getAllAttendanceByStudentandCourse($id, $id2);
    Flight::json($attendance);
  });

?>




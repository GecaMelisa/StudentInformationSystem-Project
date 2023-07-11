<?php

// get_all
 /**
 * @OA\Get(path="/course", tags={"courses"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return course students from the API. ",
 *         @OA\Response( response=200, description="List of courses.")
 * )
 */ 
  Flight::route('GET /course/', function(){ 
    Flight::json( Flight::course_dao()->get_all()); // to return results in json format
  });

  /**
  * @OA\Get(path="/course_by_id", tags={"courses"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="query", name="id", example=1, description="Course ID"),
  *     @OA\Response(response="200", description="Fetch individual student")
  * )
  */

  Flight::route('GET /course_by_id', function(){ //here we don't have variable as parameter
    $id = Flight::request()->query['id'];
    Flight::json(Flight::course_dao()->get_by_id($id)); // to return results in json format

  });

 /**
  * @OA\Get(path="/course/{id}", tags={"courses"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Student ID"),
  *     @OA\Response(response="200", description="Fetch individual course")
  * )
  */

  Flight::route('GET /course/@id', function($id){ //with parameter
    Flight::json(Flight::course_dao()->get_by_id($id)); // to return results in json format

  });

  
  //post method
  /**
* @OA\Post(
*     path="/course", security={{"ApiKeyAuth": {}}},
*     description="Add course",
*     tags={"courses"},
*     @OA\RequestBody(description="Add new course", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="Calculus",	description="Course name"),
*    				@OA\Property(property="professors_id", type="integer", example="1",	description="Professor id" ),
*           @OA\Property(property="status", type="integer", example="0",	description="Status of course" ),
*      
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

Flight::route('POST /course', function(){ 
  $request = Flight::request()->data->getData(); 
  $request['students_id'] = Flight::get('user');
  Flight::json(['message' => "Course added successfully",
               'data' => Flight::course_dao()->add($request)
              ]);

});

// update method
/**
* @OA\Put(
*     path="/studentcourses/{id}", security={{"ApiKeyAuth": {}}},
*     description="Edit course",
*     tags={"courses"},
*     @OA\Parameter(in="path", name="id", example=1, description="Course ID"),
*     @OA\RequestBody(description="Course info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    			@OA\Property(property="name", type="string", example="Calculus",	description="Course name"),
*    				@OA\Property(property="professors_id", type="integer", example="1",	description="Professor id" ),
*           @OA\Property(property="status", type="integer", example="0",	description="Status of course" ),
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

Flight::route('PUT /studentcourses/@id' , function($id){ 
  $Course = Flight::request()->data->getData(); // kada dodamo u postmanu json, ovdje trazimo request da vidimo
  Flight::json(['message' => "Course edit successfully", 'data' => Flight::course_dao()->update($Course, $id)]); 

});

  // NOT REGISTERED - REGISTERED COURSE
  /**
* @OA\Put(
*     path="/course/add/{id}", security={{"ApiKeyAuth": {}}},
*     description="Edit Course by Adding",
*     tags={"courses"},
*     @OA\Parameter(in="path", name="id", example=1, description="Course ID"),
*     @OA\RequestBody(description="Course info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    	
*           @OA\Property(property="status", type="integer", example="0",	description="Status of course" ),
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

    Flight::route('PUT /course/add/@id', function($id){
    $status = 1; 

  // Promjena statusa kursa u tabeli courses
    Flight::course_dao()->updateStatus($id, $status);

  // Prebacivanje kursa iz tabele courses u tabelu mycourses
    Flight::json(['message' => 'Course status successfully updated and moved to My Courses']);
  });

  /**
* @OA\Put(
*     path="/course/delete/{id}", security={{"ApiKeyAuth": {}}},
*     description="Edit Course by Deleting",
*     tags={"courses"},
*     @OA\Parameter(in="path", name="id", example=1, description="Course ID"),
*     @OA\RequestBody(description="Course info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    	
*           @OA\Property(property="status", type="integer", example="0",	description="Status of course" ),
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

Flight::route('PUT /course/delete/@id', function($id){
  $status = 0;
  Flight::course_dao()->updateStatus($id, $status);
  // Vratite odgovor o uspješnom brisanju kursa
  Flight::json(['message' => 'Course successfully deleted']);
});

/*Flight::route('PUT /course/add/@id', function($id){
  $status = 0;
  Flight::course_dao()->updateStatus($id, $status);
  // Vratite odgovor o uspješnom brisanju kursa
  Flight::json(['message' => 'Course successfully added']);
});
*/


  //Delete by id
  /**
 * @OA\Delete(
 *     path="/studentcourses/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete course",
 *     tags={"courses"},
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

Flight::route('GET /studentcourses/@id', function($id){
  $courses = Flight::student_service()->getCoursesByStudentId($id);
  Flight::json($courses);
});



 ?>
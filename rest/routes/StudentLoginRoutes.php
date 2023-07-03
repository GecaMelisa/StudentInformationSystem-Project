<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route("POST /login", function () {
    $data = Flight::request()->data->getData();

    $email = $data['email'];
    $password = $data['password'];

    // Preuzmi hashiranu verziju lozinke iz baze podataka
    $user = Flight::StudentLoginDao()->getStudentByEmail($email);
    $hashedPassword = $user['password'];

    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        // Email i password su tačni, preusmeri na dashboard.html
        header("Location: frontend/dashboard.html");
        exit();
    } else {
        // Prikazivanje greške ako email ili password nisu tačni
        Flight::json(["message" => "ERROR MESSAGE: Invalid email or password"], 404);
    }
});


Flight::route("GET /logindata",function(){
  $student = Flight::get('student');
  Flight::json($student);
});
?>
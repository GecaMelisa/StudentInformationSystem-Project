<?php

require_once __DIR__.'/BaseDao.class.php';

class StudentLoginDao extends BaseDao{

  public function __construct(){
    parent::__construct("students");
  }
  public function getStudentByEmail($email){
    return $this->query_unique("SELECT * FROM students WHERE email = :email", ['email'=>$email]);

  }


}



?>
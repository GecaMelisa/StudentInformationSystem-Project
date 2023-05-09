<?php
require_once "BaseDao.class.php";
class CoursesDao extends BaseDao{  //EXTENDS to add inheritance


    public function __construct(){
        parent::__construct("courses"); //if child class extends inherits from parent class, it has access to any methods in BaseDao
    }


}


?>
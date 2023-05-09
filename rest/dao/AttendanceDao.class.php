<?php
require_once "BaseDao.class.php";
class AttendanceDao extends BaseDao{  //EXTENDS to add inheritance

    public function __construct(){
        parent::__construct("attendance"); //if child class extends inherits from parent class, it has access to any methods in BaseDao
    }

}

?>
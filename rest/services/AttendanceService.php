<?php
require_once "BaseService.php";
require_once __DIR__."/../dao/AttendanceDao.class.php";

class AttendanceService extends BaseService{
    private $course_dao;
    public function __construct(){
       parent::__construct(new AttendanceDao);
}
}

?>
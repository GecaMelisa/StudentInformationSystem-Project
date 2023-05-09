<?php
require_once "BaseService.php";
require_once __DIR__."/../dao/EnrollmentsDao.class.php";

class EnrollmentService extends BaseService{
    private $course_dao;
    public function __construct(){
       parent::__construct(new EnrollmentsDao);
}
}

?>
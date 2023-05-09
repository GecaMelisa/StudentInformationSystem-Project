<?php
require_once "BaseService.php";
require_once __DIR__."/../dao/GradesDao.class.php";

class GradeService extends BaseService{
    private $course_dao;
    public function __construct(){
       parent::__construct(new GradesDao);
}
}

?>
<?php
require_once "BaseService.php";
require_once __DIR__."/../dao/ProfessorsDao.class.php";

class ProfessorService extends BaseService{
    private $course_dao;
    public function __construct(){
       parent::__construct(new ProfessorsDao);
}
}

?>
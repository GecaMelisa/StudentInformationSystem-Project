<?php
require_once "BaseDao.class.php";

class EnrollmentsDao extends BaseDao {

    public function __construct(){
        parent::__construct("enrollments");
    }
}
?>
<?php
require_once "BaseDao.class.php";

class GradesDao extends BaseDao {

    public function __construct(){
        parent::__construct("grades");
    }
}
?>
<?php
require_once "BaseDao.class.php";

class ProfessorsDao extends BaseDao {

    public function __construct(){
        parent::__construct("professors");
    }
}
?>
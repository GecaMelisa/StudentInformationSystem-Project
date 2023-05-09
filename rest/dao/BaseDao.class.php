<?php
require_once __DIR__."/../Config.class.php";

class BaseDao{
    private $conn;

    private $table_name;

    /**
     * Class constructor used to establish connection to db
     */

    public function __construct($table_name){

        try {
            $this->table_name = $table_name;
            $servername = Config::DB_HOST();
            $username = Config::DB_USERNAME();
            $password = Config::DB_PASSWORD();
            $schema = Config::DB_SCHEMA();;
            $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
        
}

  /**
    * Method used to get all entities from db
 */

    public function get_all(){
      $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

     
  /**
  * Method used to get entity by id from db
  */
  public function get_by_id($id) {
     $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id=:id");
     $stmt->execute(['id' => $id]);
     return $stmt->fetchAll();
}


     /**
    * Method used to delete entity from database
    */
      public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . "WHERE id= :id");
        $stmt->bindParam(':id', $id);   //prevent SQL injection, we have this so when we put OR 1=1 not everything will be deleted. Security is better.
        $stmt->execute();
     
    }
    
     /**
     * Method used to add entity to db
     * updated method which work for any number of columns
     */
    public function add($entity){
      $query = "INSERT INTO " . $this->table_name . " (";
      foreach($entity as $column => $value){
          $query.= $column . ' , ';
      }
      $query = substr($query, 0, -2);
      $query.= ") VALUES (";
      foreach($entity as $column => $value){
          $query.= ":" . $column . ', ';
      }
      $query = substr($query, 0, -2);
      $query.= ")";
      
      $stmt = $this->conn->prepare($query);
      $stmt->execute($entity);//everything from the request is in this path here
      $entity['id'] = $this->conn->lastInsertId(); //method which will return us the id of the last inserted record 
      return $entity;
  }

        

  /**
     * Method used to update entity to db
     * updated method which work for any number of columns
     */
     public function update($entity, $id, $id_column = "id") { //this $id_column je zapravo default id koji ne moramo da pišemo kada update po id
        $query = "UPDATE " . $this->table_name . " SET ";
        foreach($entity as $column => $value){
            $query.= $column . '=: ' . $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query.="WHERE ${id_column} = :id";
        $stmt = $this->conn->prepare($query);
        $entity['id'] = $id; 
        $stmt->execute($entity);
        return $entity;
    
         }
}


?>
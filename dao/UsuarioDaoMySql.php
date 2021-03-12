<?php
require_once 'models/Usuario.php';

class UsuarioDaoMySql  implements UsuarioDAO {
  private $pdo;
  
  public function __construct(PDO $driver){
    $this->pdo = $driver;
  }
    public function add(Usuario $u){

    }
    public function findAll(){

    }
    public function findById($id) {

    }
    public function update(Usuario $u) {

    }
    public function delete(Usuario $id) {

    }
}
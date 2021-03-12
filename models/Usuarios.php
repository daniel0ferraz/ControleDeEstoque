<?php

class Usuarios {

  private $id;
  private $nome;
  private $email;
  private $senha;

  public function getId() {
    return $this->id;
  }
  public function setId() {
    return $this->id = trim($i);
  }

  
  public function getNome() {
    return $this->nome;
  }
  public function setNome($n) {
    return $this->nome = ucwords(trim($n));
  }

  public function getEmail() {
    return $this->email;
  }
  public function setEmail($e) {
    return $this->email = strtolower(trim($e));
  }

  public function getSenha() {
    return $this->senha;
  }
  public function setSenha($s) {
    return $this->senha = strtolower(trim($s));
  }

}

interface UsuarioDAO {
    public function add(Usuario $u);
    public function findAll();
    public function findById($id);
    public function update(Usuario $u);
    public function delete(Usuario $id);
}
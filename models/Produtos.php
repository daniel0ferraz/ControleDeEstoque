<?php 

class Produtos {
  private $CODIGO;
  private $DESCRICAO;
  private $DATA;
  private $QUANTIDADE;
  private $VALOR;
  private $OBS;

  public function setCODIGO() {
    return $this->CODIGO;
  }
  public function setDESCRICAO() {
    return $this->DESCRICAO;
  }

  public function setDATA() {
    return $this->DATA;
  }

  public function setQUANTIDADE() {
    return $this->QUANTIDADE;
  }
}
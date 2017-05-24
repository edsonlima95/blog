<?php

namespace app\conn;
use app\conn\conn;

class create extends conn {

    private $tabela;
    private $dados;
    private $resultado;

    /** @var PDOStatement */
    private $create;

    /** @var PDO Description */
    private $conn;

    public function ExeCreate($tabela, array $dados) {
        $this->tabela = $tabela;
        $this->dados = $dados;
        $this->getSintaxe();
        $this->execute();
    }

    //Sintaxe, query select.
    private function getSintaxe() {
        $campos = implode(', ', array_keys($this->dados));
        $valores = ":" . implode(', :', array_keys($this->dados));
        $this->create = "INSERT INTO {$this->tabela} ({$campos}) VALUES ({$valores})";
    }

    private function getconn() {
        $this->conn = parent::Conn();
        $this->create = $this->conn->prepare($this->create);
    }

    public function getResultado() {
        return $this->resultado;
    }

    private function execute() {
        $this->getconn();
        try {
            $this->create->execute($this->dados);
            $this->resultado = $this->conn->lastInsertId();
        } catch (PDOException $e) {
            $this->resultado = null;
            echo "<span style=\"color:red; font-weight: bold\">Erro ao tentar cadastrar -></span> <strong>{$e->getMessage()}</strong>, "
            . "linha <strong>{$e->getLine()}</strong> arquivo <strong>{$e->getFile()}</strong>";
        }
    }

}

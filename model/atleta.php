<?php 
    require_once "../model/pessoa.php";
    class Atleta extends Pessoa {
        private $idade;
        private $altura;
        private $peso;

        public function __construct($nome, $idade){
            $this->nome = $nome;
            $this->idade = $idade;
        }

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }
    }
?>
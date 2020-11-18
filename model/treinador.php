<?php 
    require_once "../model/pessoa.php";

    class Treinador extends Pessoa{
        private $qntVitoria;
        private $bonusSalario;

        public function __construct($nome, $salario) {
            $this->nome =  $nome;
            $this->salario = $salario;
        }
        
        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

    }
?>
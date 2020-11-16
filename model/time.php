<?php 
    class Time {
        private $id;
        private $nome;
        private $cidade;
        private $qntVitoria;
        private $anoFundacao;
        private $treinador;
        private $atletas = array();

        public function __construct($nome, $cidade, $treinador, $atletas){
            $this->nome = $nome;
            $this->cidade = $cidade;
            $this->treinador = $treinador;
            $this->atletas = $atletas;
        }

        public function __set($atributo, $valor){
            $this->$atributo =  $valor;
        }

        public function __get($atributo)   {
            return $this->$atributo;
        }
    }
?>
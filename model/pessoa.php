<?php 
    abstract class Pessoa {

        private $id;
        private $nome;
        private $salario;

      
        public function __get($atributo)
        {
            return $this->$atributo;
        }

        public function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }


    }
?>
<?php 
    class Conexao {
        private $host = 'localhost';
        private $db = 'projetoTimes';
        private $usuario = 'marcos';
        private $senha = '123456';

        public function conectar() {
            try {
                $conexao = new PDO(
                    "mysql:host=$this->host;dbname=$this->db",
                    "$this->usuario", "$this->senha"
                );
                return $conexao;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>
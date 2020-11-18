<?php 
    require_once "../db/conexao.php";
    require_once "../model/atleta.php";

    class AtletaDao {
        private $conexao;

        public function __construct(Conexao $conexao){
            $this->conexao = $conexao->conectar();
        }


        public function pesquisarId($id){
            $sql = "SELECT * from atleta WHERE id = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id', $id);

            $resultado = $stmt->fetch(PDO::FETCH_OBJ);
            $atleta = new Atleta($resultado->nome, $resultado->idade);
            $atleta->__set('id', $id);

            return $atleta;
        }
    }
?>
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

        public function pesquisarTime($idTime){
            $sql = "SELECT * FROM  atleta a INNER JOIN atletaTime at ON a.id = at.idAtleta WHERE at.idTime = :idTime";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':idTime', $idTime);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            $atletas = array();        
            foreach($resultados as $key => $objeto){
                $atleta = new Atleta($objeto->nome, $objeto->idade);
                $atleta->__set('id', $objeto->id);
                $atleta->__set('altura', $objeto->id);
                $atleta->__set('peso', $objeto->peso);
                $atleta->__set('salario', $objeto->id);

                $atletas[] = $atleta;

            }

            return $atletas;
        }
    }
?>
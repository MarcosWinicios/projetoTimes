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
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_OBJ);
            $atleta = new Atleta($resultado->nome, $resultado->idade);
            $atleta->__set('id', $id);
            $atleta->__set('altura', $resultado->id);
            $atleta->__set('peso', $resultado->peso);
            $atleta->__set('salario', $resultado->id);

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

        public function pesquisarNome($nome){
            $sql = "SELECT * from atleta WHERE nome like :nome";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':nome', "%$nome%");
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            $atletas =  array();

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

        public function listarTudo(){
            $sql = "SELECT * FROM atleta";

            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            $atletas =  array();

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

        public function salvar(Atleta $atleta){
            $sql = "INSERT INTO atleta(nome, salario, idade, altura, peso)VALUES(:nome, :salario, :idade, :altura, :peso)";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':nome', $atleta->nome);
            $stmt->bindValue(':salario', $atleta->salario);
            $stmt->bindValue(':idade', $atleta->idade);
            $stmt->bindValue(':altura', $atleta->altura);
            $stmt->bindValue(':peso', $atleta->peso);
            $stmt->execute();

            $atleta->__set('id', $this->conexao->lastInsertId());
            return $atleta;
        }
    }
?>
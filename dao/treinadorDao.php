<?php 
    require_once "../db/conexao.php";
    require_once "../model/treinador.php";

    class TreinadorDao {
        private $conexao;

        public function __construct(Conexao $conexao) {
            $this->conexao = $conexao->conectar();
        }
        
        public function listarTudo(){
            $sql = "SELECT * FROM treinador";
            $stmt =  $this->conexao->prepare($sql);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            $treinadores = array();

            foreach ($resultados as $id => $objeto){
                $treinador =  new Treinador($objeto->nome, $objeto->salario);
                $treinador->__set('id', $objeto->id);
                $treinador->__set('qntVitoria', $objeto->qntVitoria);
                $treinador->__set('bonusSalario', $objeto->bonusSalario);

                $treinadores[] = $treinador;
            }

            return $treinadores;
        }

        public function pesquisarNome($nome){
            $sql = "SELECT * FROM treinador WHERE nome like :nome";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':nome',"%$nome%");
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            $treinadores = array();

            foreach ($resultados as $id => $objeto){
                $treinador =  new Treinador($objeto->nome, $objeto->salario);
                $treinador->__set('id', $objeto->id);
                $treinador->__set('qntVitoria', $objeto->qntVitoria);
                $treinador->__set('bonusSalario', $objeto->bonusSalario);

                $treinadores[] = $treinador;
            }

            return $treinadores;
        }

        public function pesquisarId($id){
            $sql = "SELECT * FROM treinador WHERE id = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $resultado =  $stmt->fetch(PDO::FETCH_OBJ);
            $treinador = new Treinador($resultado->nome, $resultado->salario);
            $treinador->__set('id', $resultado->id);
            $treinador->__set('qntVitoria', $resultado->qntVitoria);
            $treinador->__set('bonusSalario', $resultado->bonusSalario);

            return $treinador;
        }

        public function salvar(Treinador $treinador){
            $sql = "INSERT INTO treinador(nome, salario, qntVitoria, bonusSalario)VALUES (:nome, :salario, :qntVitoria, :bonusSalario)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue('nome', $treinador->__get('nome'));
            $stmt->bindValue('salario', $treinador->__get('salario'));
            $stmt->bindValue('qntVitoria', $treinador->__get('qntVitoria'));
            $stmt->bindValue('bonusSalario', $treinador->__get('bonusSalario'));
            $stmt->execute();

            $treinador->__set('id', $this->conexao->lastInsertId());
            return $treinador;
        }

    }
?>
<?php 
    require_once "../model/time.php";
    require_once "../db/conexao.php";
    require_once "../model/treinador.php";
    require_once "../dao/treinadorDao.php";
    require_once "../dao/atletaDao.php";

    class TimeDao {
        private $conexao;
        private $atletaDao;
        private $treinadorDao;

        public function __construct(Conexao $conexao){
            $this->conexao = $conexao->conectar();
            $this->atletaDao = new AtletaDao($conexao);
            $this->treinadorDao = new TreinadorDao($conexao);
        }

        public function listarTudo(){
            $sql = "SELECT * FROM time";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            $times = array();

            foreach($resultados as $key => $resultado){
                $treinador = $this->treinadorDao->pesquisarId($resultado->idTreinador);
                $atletas = $this->atletaDao->pesquisarTime($resultado->id);

                $time =  new Time($resultado->nome, $resultado->cidade, $treinador, $atletas);
                $time->__set('id', $resultado->id);
                $time->__set('qntVitoria', $resultado->qntVitoria);
                $time->__set('anoFundacao', $resultado->anoFundacao);

                $times[] = $time;
            }
            return $times;
        }

        public function pesquisarNome($nome){
            $sql = "SELECT * FROM time WHERE nome = :nome";
            $stmt =  $this->conexao->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->execute();

            $resultados =  $stmt->fetchAll(PDO::FETCH_OBJ);
            $times = array();

            foreach($resultados as $key => $resultado){
                $atletas = $this->atletaDao->pesquisarTime($resultado->id);
                $treinador =  $this->treinadorDao->pesquisarId($resultado->idTreinador);
                $time = new Time($resultado->nome, $resultado->cidade, $treinador, $atletas);
                $time->__set('id', $resultado->id);
                $time->__set('qntVitoria', $resultado->qntVitoria);
                $time->__set('anoFundacao', $resultado->anoFundacao);

                $times[] = $time;
            }
            return $times;
        }

        public function pesquisarId($id){
            $sql = "SELECT * FROM time WHERE id = :id";
            $stmt =  $this->conexao->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $resultado =  $stmt->fetch(PDO::FETCH_OBJ);

            
            $atletas = $this->atletaDao->pesquisarTime($resultado->id);
            $treinador =  $this->treinadorDao->pesquisarId($resultado->idTreinador);
            $time = new Time($resultado->nome, $resultado->cidade, $treinador, $atletas);
            $time->__set('id', $resultado->id);
            $time->__set('qntVitoria', $resultado->qntVitoria);
            $time->__set('anoFundacao', $resultado->anoFundacao);

            return $time;
        }
          

        
    }
?>
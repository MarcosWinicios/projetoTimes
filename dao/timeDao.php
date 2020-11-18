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

            foreach($resultados as $key => $objeto){
                $treinador = $this->treinadorDao->pesquisarId($objeto->idTreinador);
                $atletas = $this->atletaDao->pesquisarTime($objeto->id);

                $time =  new Time($objeto->nome, $objeto->cidade, $treinador, $atletas);
                $time->__set('id', $objeto->id);
                $time->__set('qntVitoria', $objeto->qntVitoria);
                $time->__set('anoFundacao', $objeto->anoFundacao);

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

            foreach($resultados as $key => $objeto){
                $atletas = $this->atletaDao->pesquisarTime($objeto->id);
                $treinador =  $this->treinadorDao->pesquisarId($objeto->idTreinador);
                $time = new Time($objeto->nome, $objeto->cidade, $treinador, $atletas);
                $time->__set('id', $objeto->id);
                $time->__set('qntVitoria', $objeto->qntVitoria);
                $time->__set('anoFundacao', $objeto->anoFundacao);

                $times[] = $time;
            }
            return $times;
        }
    }
?>
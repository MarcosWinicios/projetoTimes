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
            $sql = "SELECT * FROM time WHERE nome like :nome";
            $stmt =  $this->conexao->prepare($sql);
            $stmt->bindValue(':nome', "%$nome%");
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
          
        public function salvar(Time $time){
            $sql = "INSERT INTO time(nome, cidade, qntvitoria, anoFundacao, idTreinador)VALUES(:nome, :cidade, :qntVitoria, :anoFundacao, :idTreinador)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':nome', $time->__get('nome'));
            $stmt->bindValue(':cidade', $time->__get('cidade'));
            $stmt->bindValue(':qntVitoria', $time->__get('qntVitoria'));
            $stmt->bindValue(':anoFundacao', $time->__get('anoFundacao'));
            $treinador = $time->__get('treinador');
            $stmt->bindValue(':idTreinador', $treinador->__get('id'));
            $stmt->execute();       

            $time->__set('id', $this->conexao->lastInsertId());
            $this->addAtletas($time);
            return $time;
        }

        private function addAtletas(Time $time){
            
            foreach($time->__get('atletas') as $atleta => $objeto){  
              
                $sql = "INSERT INTO atletaTime(idTime, idAtleta)VALUES(:idTime, :idAtleta)";
                $stmt =  $this->conexao->prepare($sql);
                $stmt->bindValue(':idTime', $time->__get('id'));
                $stmt->bindValue(':idAtleta', $objeto->id);
                $stmt->execute();

            }
            
        }
        
    }
?>
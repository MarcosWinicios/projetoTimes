<?php 
    require_once "../model/time.php";
    require_once "../db/conexao.php";
    require_once "../model/treinador.php";
    require_once "../dao/treinadorDao.php";
    require_once "../dao/atletaDao.php";

    class TimeDao {
        private $conexao;

        public function __construct(Conexao $conexao){
            $this->conexao = $conexao->conectar();
        }

        public function listarTudo(){
            $sql = "SELECT * FROM time t INNER JOIN atletaTime at ON t.id = at.idTime";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            $times = array();

            $con = new Conexao();
            $treinadorDao = new TreinadorDao($con);
            $atletaDao = new AtletaDao($con);
            
            $atletas = array();

            foreach($resultados as $key => $objeto){
                $treinador = $treinadorDao->pesquisarId($objeto->idTreinador);
                $atleta = $atletaDao->pesquisarId($objeto->idAtleta);
                $atletas[] = $atleta;

                $time =  new Time($objeto->nome, $objeto->cidade, $treinador, $atletas);
                $time->__set('id', $objeto->id);
                $time->__set('qntVitoria', $objeto->qntVitoria);
                $time->__set('anoFundacao', $objeto->anoFundacao);


            }
            return $time;
        }
    }
?>
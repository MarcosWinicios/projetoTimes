<?php 
    require_once "../model/time.php";
    require_once "../dao/timeDao.php";
    require_once "../db/conexao.php";
    require_once "../dao/atletaDao.php";
    require_once "../dao/treinadorDao.php";


    $conexao = new Conexao();
    $timeDao = new TimeDao($conexao);
    
    //Listar Tudo
    echo "<h1>Listar todos os Times</h1>";

    $times =  $timeDao->listarTudo();

    echo "<pre>";
    print_r($times);
    echo "</pre>";

    //Pesquisando times por nome
    echo "<h1>Pesquisa de Times por nome</h1>";

    $times2 = $timeDao->pesquisarNome('s');

    echo "<pre>";
    print_r($times2);
    echo "</pre>";

    //Pesquisar por Time
    echo "<h1>Pesquisa de Times por id</h1>";
    $time = $timeDao->pesquisarId(1);

    echo "<pre>";
    print_r($time);
    echo "</pre>";

    //Testando Salvar
    echo "<h1>Testando Salvar</h1>";

    $atletaDao = new AtletaDao($conexao);
    $treinadorDao =  new TreinadorDao($conexao);

    $atletas =  array();

    $atletas[] = $atletaDao->pesquisarId(9);
    $atletas[] = $atletaDao->pesquisarId(10);
    // $atletas[] = $atletaDao->pesquisarId(8);

    $treinador = $treinadorDao->pesquisarId(4);


    $time2 =  new Time('Grêmio', 'Itapaci', $treinador, $atletas);
    $time2->__set('qntVitoria', 8);
    $time2->__set('anoFundacao', 1940);


    echo "<pre>";
    print_r($timeDao->salvar($time2));
    echo "</pre>";


?>
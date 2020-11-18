<?php 
    require_once "../model/time.php";
    require_once "../dao/timeDao.php";
    require_once "../db/conexao.php";


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

    $times2 = $timeDao->pesquisarNome('Goiás');

    echo "<pre>";
    print_r($times2);
    echo "</pre>";

?>
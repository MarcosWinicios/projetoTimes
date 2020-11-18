<?php 
    require_once "../model/atleta.php";
    require_once "../db/conexao.php";
    require_once "../dao/atletaDao.php";
    
    $conexao =  new Conexao();
    $atletaDao =  new AtletaDao($conexao);
   
    $atleta = new Atleta('João',22);

    $atleta->__set('altura', 1.70);
    $atleta->__set('peso', 70);
    $atleta->__set('salario', 1000);
    $atleta->__set('id', 10);

    echo "<pre>";
    print_r($atleta);
    echo "</pre>";

    //Teste pesquisar atletas por Time

    echo "<h1>Pesquisa de atletas por time</h1>";
    $atletas =  $atletaDao->pesquisarTime(1);
    
    echo "<pre>";
    print_r($atletas);
    echo "</pre>";

?>
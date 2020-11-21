<?php 
    require_once "../model/atleta.php";
    require_once "../db/conexao.php";
    require_once "../dao/atletaDao.php";
    
    $conexao =  new Conexao();
    $atletaDao =  new AtletaDao($conexao);
   
    //Pesquisar Atleta por id
    echo "<h1>Pesquisa de atletas por id</h1>";

    $atleta = $atletaDao->pesquisarId(1);

    echo "<pre>";
    print_r($atleta);
    echo "</pre>";


    //Pesquisar Atleta por nome
    echo "<h1>Pesquisa de atletas por nome</h1>";

    $atleta2 = $atletaDao->pesquisarNome('a');

    echo "<pre>";
    print_r($atleta2);
    echo "</pre>";

    //Teste pesquisar atletas por Time

    echo "<h1>Pesquisa de atletas por time</h1>";
    $atletas =  $atletaDao->pesquisarTime(1);
    
    echo "<pre>";
    print_r($atletas);
    echo "</pre>";

    //Teste Listar Todos os Atletas
    echo "<h1>Listar todos os Atletas</h1>";

    $atletas2 = $atletaDao->listarTudo();

    echo "<pre>";
    print_r($atletas2);
    echo "</pre>";

    //Salvar atleta
    echo "<h1>Salvar Atleta</h1>";

    $at =  new Atleta('Fernando', 23);
    $at->__set('altura', 1.75);
    $at->__set('peso', 87);
    $at->__set('salario', 1650);

    
    echo "<pre>";
    print_r($atletaDao->salvar($at));
    echo "</pre>";
?>
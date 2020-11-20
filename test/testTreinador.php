<?php 
    require_once "../model/treinador.php";
    require_once "../dao/treinadorDao.php";
    require_once "../db/conexao.php";

    $conexao = new Conexao();
    $treinadorDao =  new TreinadorDao($conexao);

    //Listar Todos os Treinadores
    echo "<h1>Listar todos os treinadores</h1>";

    $treinadores = $treinadorDao->listarTudo();
    echo "<pre>";
    print_r($treinadores);
    echo "</pre>";

    //Pesquisar Por Nome
    echo "<h1>Pesquisar Treinador por nome</h1>";

    $treinador = $treinadorDao->pesquisarNome('Fulano');
    echo "<pre>";
    print_r($treinador);
    echo "</pre>";

    //Pesquisar por ID
    echo "<h1>Pesquisar Treinador por ID</h1>";
    $treinador2 = $treinadorDao->pesquisarId(2);

    echo "<pre>";
    print_r($treinador2);
    echo "</pre>";

    //Salvar
    echo "<h1>Salvar Treinador</h1>";

    $tr =  new Treinador('Siclando', 1600);
    $tr->__set('qntVitoria', 12);
    $tr->__set('bonusSalario', 1300.25);


    echo "<pre>";
    print_r($treinadorDao->salvar($tr));
    echo "</pre>";


    
?>


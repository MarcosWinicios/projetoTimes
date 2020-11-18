<?php 
    require_once "../model/time.php";
    require_once "../dao/timeDao.php";
    require_once "../db/conexao.php";


    $conexao = new Conexao();
    //Listar Tudo

    $timeDao = new TimeDao($conexao);

    $times =  $timeDao->listarTudo();

    echo "<pre>";
    print_r($times);
    echo "</pre>"
?>
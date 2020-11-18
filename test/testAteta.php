<?php 
    require_once "../model/atleta.php";
    require_once "../db/conexao.php";
    
   
    $atleta = new Atleta('João',22);

    $atleta->__set('altura', 1.70);
    $atleta->__set('peso', 70);
    $atleta->__set('salario', 1000);
    $atleta->__set('id', 10);




    echo "<pre>";
    print_r($atleta);
    echo "</pre>";
    
?>
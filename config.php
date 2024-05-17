<?php

    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'formulario_usuario';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    /*if ($conexao->connect_errno) {
        echo "Erro";
    } else {
        echo "conexao efeituada com sucesso";
    } */

?>
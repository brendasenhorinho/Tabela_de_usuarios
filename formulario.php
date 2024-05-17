<?php

include_once('config.php');

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$dataNasc = $_POST['dataNasc'];


$result = mysqli_query($conexao, "INSERT INTO tabela_usuario(nome,cpf,dataNasc)
VALUES ('$nome', '$cpf', '$dataNasc')" );


if ($result) {
    // Se a inserção foi bem-sucedida, redirecione para a página inicial
    header("Location: teste.php");
    exit;
} else if($result) {
    echo "Erro ao inserir dados: " . mysqli_error($conexao);
} else {
// Se os valores do POST não estiverem definidos, exiba uma mensagem de erro
echo "Os valores do formulário não foram recebidos corretamente.";
}


?>
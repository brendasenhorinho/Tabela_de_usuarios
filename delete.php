<?php
include_once('config.php');

// Verifica se o parâmetro 'cpf' foi passado
if(isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];

    // Prepara e executa a consulta para excluir o registro
    $sql = "DELETE FROM tabela_usuario WHERE cpf = '$cpf'";
    if ($conexao->query($sql) === TRUE) {
        // Redireciona de volta para a página principal após a exclusão
        header("Location: teste.php");
        exit();
    } else {
        echo "Erro ao excluir registro: " . $conexao->error;
    }
} else {
    echo "CPF do usuário não fornecido.";
}
?>

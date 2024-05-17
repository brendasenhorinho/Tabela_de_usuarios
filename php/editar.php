<?php
include_once('config.php');

if(isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];

    // Verifica se o formulário de edição foi enviado
    if(isset($_POST['submit'])) {
        // Recebe os dados do formulário
        $nome = $_POST['nome'];
        $new_cpf = $_POST['new_cpf'];
        $dataNasc = $_POST['dataNasc'];

        // Verifica se o novo CPF já existe no banco de dados
        $sql_check_cpf = "SELECT cpf FROM tabela_usuario WHERE cpf = '$new_cpf' AND cpf != '$cpf'";
        $result_check = $conexao->query($sql_check_cpf);
        
        if ($result_check->num_rows > 0) {
            echo "O novo CPF já está em uso.";
        } else {
            // Prepara e executa a consulta para atualizar o registro
            $sql = "UPDATE tabela_usuario SET nome = '$nome', cpf = '$new_cpf', dataNasc = '$dataNasc' WHERE cpf = '$cpf'";
            if ($conexao->query($sql) === TRUE) {
                // Redireciona de volta para a página principal após a edição
                header("Location: ../index.php");
                exit();
            } else {
                echo "Erro ao editar registro: " . $conexao->error;
            }
        }
    }

    // Carrega os dados do usuário com base no CPF recebido
    $sql_select = "SELECT * FROM tabela_usuario WHERE cpf = '$cpf'";
    $result = $conexao->query($sql_select);
    $user_data = $result->fetch_assoc();
} else {
    echo "CPF do usuário não fornecido.";
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../styles/formulario.css">
    <title>Editar Usuário</title>
</head>
<body>
    
    <form method="POST" action="">
        <div id="form">
            <h1 class="titulo_cadastro">Editar</h1>
                <br><br>
            
            <label for="nome">Nome</label>
            <div class="input_form">
                <i class="bi bi-person-circle"></i>
                <input type="text" name="nome" id="nome" placeholder="Username" value="<?php echo $user_data['nome']; ?>" required><br>
            </div>
            
            <label for="new_cpf">CPF</label>
            <div class="input_form">
                <i class="bi bi-person-vcard"></i>
                <input type="text" id="new_cpf" name="new_cpf" value="<?php echo $user_data['cpf']; ?>" required><br>
            </div>
            
            <label for="dataNasc">Data de Nascimento</label>
            <div class="input_date">
                <input type="date" name="dataNasc" id="dateNasc" value="<?php echo $user_data['dataNasc']; ?>" required><br>
            </div>

            <div id="buttonEnviar">
            <input type="submit" name="submit" value="Salvar" class="button_form">
            </div>
        </div>

    </form>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    
    <script>
         $('#new_cpf').mask('000.000.000-00');
    </script>
</body>
</html>

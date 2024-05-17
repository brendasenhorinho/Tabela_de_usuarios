<?php
include_once('config.php');

// Executa a consulta SQL
$sql = "SELECT * FROM tabela_usuario ORDER BY cpf DESC";
$result = $conexao->query($sql);

// Verifica se a consulta foi bem-sucedida
if ($result === false) {
    die("Erro na consulta: " . $conexao->error);
}

// Função para formatar o CPF
function formatCpf($cpf) {
    // Remove quaisquer caracteres que não sejam dígitos
    $cpf = preg_replace('/\D/', '', $cpf);

    // Verifica se o CPF tem exatamente 11 dígitos
    if (strlen($cpf) !== 11) {
        return 'CPF inválido';
    }

    // Formata o CPF
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
}
// Função para formatar a data
function formatDate($date) {
    $dateObject = DateTime::createFromFormat('Y-m-d', $date);
    return $dateObject->format('d/m/Y');
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./styles/teste.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>teste</title>
</head>
<body>
    <div id="to_do">
        <form action="" class="to-do-form">
            <h1>Usuários</h1>
            <a href="./formulario.html" class="action_botao">
                <i class="bi bi-plus-circle-fill custom-icon"></i>
            </a>
        </form>
        
        <div id="tasks">
            <?php 
            $counter = 1; 
            while ($user_data = mysqli_fetch_assoc($result)): ?>
                <div class="task">
                    <button type="button" name="progress" class="progress" onclick="ligarEDesligarDiv('oculto_<?php echo $counter; ?>');">Info</button>
                    <p class="task-description">
                        <?php echo $user_data['nome']; ?>
                    </p>
                    <div class="oculto" id="oculto_<?php echo $counter; ?>" style="display: none;">
                        <p><strong> CPF: <?php echo formatCpf($user_data['cpf']); ?></strong></p>
                        <p><strong>Data: <?php echo formatDate($user_data['dataNasc']); ?></strong></p>
                    </div>
                    <div class="task-actions">
                        <a href="./editar.php?cpf=<?= $user_data['cpf']?>" class="action_botao edit_botao">
                            <i class="bi bi-pencil-square custom-icon"></i>
                        </a>
                        <a href="./delete.php?cpf=<?= $user_data['cpf']?>" class="action_botao delete_botao">
                            <i class="bi bi-trash3 custom-icon"></i>
                        </a>
                    </div>
                </div>
            <?php 
            $counter++; 
            endwhile; ?>
        </div>
    </div>
    <script src="./teste.js"></script>
</body>
</html>

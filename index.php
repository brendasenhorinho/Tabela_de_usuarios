<?php
include_once('config.php');

$sql = "SELECT * FROM tabela_usuario ORDER BY cpf DESC";

$result = $conexao->query($sql);

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Usuários</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

:root{
    --cor-fonte:#FFFFFF;
    --fonte-principal: 'Poppins';
}

*{
    margin: 0;
    padding: 0;
}

#body{ 
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: var(--fonte-principal);
    background: linear-gradient(-40deg, rgb(227, 254, 247), rgb(119, 176, 170), rgb(19, 93, 102));

}

.corpo{
   background-color: #003C43;
   border-radius: 10px;
    padding: 80px;
    position: absolute;
    top:10%;
    left:40%;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
}
.botao_adcionar{
    
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1em;
    color: var(--cor-fonte);
    
    
}

.tabela{
    margin-top: 1em;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
   
}

.botao_dados {
    flex-direction: column;

}

.input_usuario {
    display: none;
}

.informacao-header {
    cursor: pointer;
    padding: 10px;
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    border-radius: 5px;
    min-width: 200px;
}

.infomacao-oculto {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}

.input_usuario:checked + .informacao-header + .infomacao-oculto {
    max-height: 2000px; 
}

.titulo{
    text-align: center;
}

.custom-icon{
    color: #77B0AA;
}

.informacao-header{
    background-color: #003C43;
    padding: 8px;
    
}

.input_usuario{
    width: 3em;
}


</style>

<body id="body">
    <div class="corpo">
        <div class="botao_adcionar">
            <h1 class="titulo">USUÁRIOS</h1>
            <a href="./formulario.html">
                <i class="bi bi-plus-circle-fill custom-icon"></i>
            </a>
        </div>
        
            
            <div class="tabela">
            <?php while($user_data = mysqli_fetch_assoc($result)): ?>
                <div class="botao_dados">   
                    <input type="checkbox" id="botao_usuarios" class="input_usuario">
                            <label id="nome" class="informacao-header" for="botao_usuarios" ><?php echo $user_data['nome']; ?></label>
                            <div class="infomacao-oculto">
                                <div class="informacao-body">
                                <p id="cpf"><?php echo $user_data['cpf']; ?></p>

                                    <p id="dataNasc"><?php echo $user_data['dataNasc']; ?></p>
                                </div>
                            </div>
                            
                </div>             
                            <div class="task-acao">
                                <a href="" class="acao_botao editar_botao">
                                    <i class="bi bi-pencil-square custom-icon"></i>
                                </a>
                                
                                <a href="./delete.php?cpf=<?= $user_data['cpf'] ?>" class="acao_botao delete_botao custom-icon">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </div>

            
                            <?php endwhile; ?>
                            
            </div>
    </div>    
    
   
</body>
</html>     
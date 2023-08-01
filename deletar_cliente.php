<?php

    //Só vai existir quando clicar no "Sim"
    if (isset($_POST['confirmar'])) {
        include("conexao.php");

        //Pegando o id da url como parametro 
        $id = intval($_GET['id']);
        $sql_code = "DELETE FROM clientes WHERE id = '$id'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

        //Retorna true (deu certo) ou false (não deu)
        if ($sql_query) { ?>
            <h1>Clinte deletado com sucesso!</h1>
            <p><a href="clientes.php">Clique aqui</a> para voltar a lista de clientes</p>
        <?php
        //Para não aparecer a msg de confirmação dnv, colocamos o die
        die();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
</head>
<body>
    <h1>Tem certeza que deseja deletar este cliente?</h1>

    <form action="" method="post">
        <a href="clientes.php">Não</a>
        <button name="confirmar" value="1" type="submit">Sim</button>
    </form>
    
</body>
</html>
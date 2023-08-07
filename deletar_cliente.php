<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    //Se admin ñ existe ou existir mas for false, redirecionar para pag de clientes (evitar que usuario comum possa cadastrar ou editar; apenas admin pode)
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header("Location: clientes.php");
        die();
    }

    //Só vai existir quando clicar no "Sim"
    if (isset($_POST['confirmar'])) {
        include("lib/conexao.php");

        //Pegando o id da url como parametro 
        $id = intval($_GET['id']);

        //Consultando se existe foto
        $sql_cliente = "SELECT foto FROM clientes WHERE id = '$id'";
        $query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
        $cliente = $query_cliente->fetch_assoc();

        $sql_code = "DELETE FROM clientes WHERE id = '$id'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

        //Retorna true (deu certo) ou false (não deu)
        if ($sql_query) { 
            
            if(!empty($cliente['foto'])) {
                unlink($cliente['foto']);
            }

            ?>
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
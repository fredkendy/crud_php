<?php

    if (isset($_POST['email']) && isset($_POST['senha']))  {

        include("lib/conexao.php");

        //Evitar SQL injection
        $email = $mysqli->escape_string($_POST['email']);
        $senha = $_POST['senha'];
        
        $sql_code = "SELECT * FROM clientes WHERE email = '$email'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        
        //Verificando se existe o email informado
        if ($sql_query->num_rows == 0) {
            echo "O email informado é incorreto";
        } else {
            $usuario = $sql_query->fetch_assoc();
            if (!password_verify($senha, $usuario['senha'])) {
                echo "A senha informada está incorreta";
            } else {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['usuario'] = $usuario['id'];
                $_SESSION['admin'] = $usuario['admin'];
                header("Location: clientes.php");
            }
        }


    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
</head>
<body>
    <h1>Entrar</h1>

    <form action="" method="post">
        <p>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email">
        </p>

        <p>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha">
        </p>

        <button type="submit">Entrar</button>
    </form>

    
</body>
</html>
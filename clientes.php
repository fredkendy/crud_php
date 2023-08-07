<?php

    include('lib/conexao.php');

    $sql_clientes = "SELECT * FROM clientes";
    $query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);

    //Verificar quantos clientes existem
    $num_clientes = $query_clientes->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>

    <p><a href="cadastrar_cliente.php">Cadastrar um Cliente</a></p>

    <p>Estes são os clientes cadastrados no seu sistema:</p>

    <table border="1" cellpadding="10">
        <thead>
            <th>Imagem</th>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Data de nascimento</th>
            <th>Data de cadastro</th>
            <th>Ações</th>
        </thead>

        <tbody>
            <?php
                if ($num_clientes == 0) { ?>
                    <tr>
                        <td colspan="7">Nenhum cliente foi cadastrado</td>
                    </tr>
            <?php 
                } else { 
                    while($cliente = $query_clientes->fetch_assoc()) {
                    
                    $telefone = "Não informado";
                    if (!empty($cliente['telefone'])) {
                        $telefone = formatarTelefone($cliente['telefone']);
                    }

                    $nascimento = "Não informada";
                    if (!empty($cliente['data_nascimento'])) {
                        $nascimento = formatarData($cliente['data_nascimento']);
                    }

                    //strtotime (serve para formato americano) transforma o cliente data_cadastro em timestamp (segundos desde 1970)
                    $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data_cadastro']));

            ?>
            <tr>
                <!-- Imagem aparece apenas no localhost; contratar hospedagem -->
                <td><img height="40" src="<?php echo $cliente['foto']; ?>" ></td>
                <td><?php echo $cliente['id']; ?></td>
                <td><?php echo $cliente['nome']; ?></td>
                <td><?php echo $cliente['email']; ?></td>
                <td><?php echo $telefone; ?></td>
                <td><?php echo $nascimento; ?></td>
                <td><?php echo $data_cadastro; ?></td>
                <td>
                    <!-- Passando o id por atributo get (url) -->
                    <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">Editar</a>
                    <a href="deletar_cliente.php?id=<?php echo $cliente['id']; ?>">Deletar</a>
                </td>
            </tr>
            <?php
                    } 
                }
            ?>
        </tbody>
    </table>
</body>
</html>
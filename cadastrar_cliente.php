<?php

    //Utilizado para limpar qualquer coisa que não seja número do campo 'telefone'
    function limparTexto($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    //se o tamanho do array for maior que zero
    if (count($_POST) > 0) {

        include("conexao.php");

        //Se não tiver erro, vai continuar sendo false
        $erro = false; 

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $data_nascimento = $_POST['data_nascimento'];

        //Fazendo a verificação dos itens obrigatórios
        if (empty($nome)) {
            $erro = "Preencha o nome";
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro = "Preencha o email";
        }

        //Verificação da data (deve seguir o formato americano p/ inserir no db)
        if (!empty($data_nascimento)) {
            $pedacos = explode('/', $data_nascimento);  //variável temporária que guarda o array de elementos (dd, mm, aaaa)
            if (count($pedacos) == 3) { //deve ter 3 elementos (dia, mes e ano)
                $data_nascimento = implode('-', array_reverse($pedacos));
            } else {
                $erro = "A data de nascimento deve seguir o padrão dia/mês/ano";
            }
        }

        if (!empty($telefone)) {
            $telefone = limparTexto($telefone);
            if (strlen($telefone) != 11) {
                $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
            }
        }

        //Imprimindo o erro que foi detectado
        if ($erro) {
            echo "<p><b>$erro</b></p>";
        } else {
            //Caso não tenha erro, fazer inserção no banco de dados
            $sql_code = "INSERT INTO clientes (nome, email, telefone, data_nascimento, data_cadastro) 
            VALUES ('$nome', '$email', '$telefone', '$data_nascimento', NOW())";
            //Já incluiu o conexao.php
            $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
            if ($deu_certo) {
                echo "<p><b>Cliente cadastrado com sucesso!</b></p>";
                unset($_POST);  //limpar post (zerar campos)
            }
        }

    }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <a href="clientes.php">Voltar para a lista</a>

    <form action="" method="post">
        <p>
            <label for="nome">Nome:</label>
            <!-- value: valor que será atribuído por padrão -->
            <!-- verificacao para caso o usuário n digitar um campo corretamente, não perder as infos já colocadas no campo -->
            <input value="<?php if(isset($_POST['nome'])){ echo $_POST['nome']; } ?>" type="text" name="nome" id="nome">
        </p>
        
        <p>
            <label for="email">E-mail:</label>
            <input value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" type="email" name="email" id="email">
        </p>

        <p>
            <label for="telefone">Telefone:</label>
            <input value="<?php if(isset($_POST['telefone'])){ echo $_POST['telefone']; } ?>" placeholder="(11) 98888-8888" type="text" name="telefone" id="telefone">
        </p>

        <p>
            <label for="data_nascimento">Data de nascimento:</label>
            <input value="<?php if(isset($_POST['data_nascimento'])){ echo $_POST['data_nascimento']; } ?>" type="text" name="data_nascimento" id="data_nascimento">
        </p>
        
        <p>
            <button type="submit">Salvar Cliente</button>
        </p>
    </form>
    

</body>
</html>
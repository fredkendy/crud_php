<?php

    $host = "localhost";
    $db = "crud_clientes";
    $user = "root";
    $pass = "";

    $mysqli = new mysqli($host, $user, $pass, $db);
    if ($mysqli->connect_errno) {
        die("Falha na conexão com o banco de dados");
    }

    //Como conexao.php está incluso em todas as páginas, incluiu uma função para formatações em geral
    function formatarData($data_cadastro) {
        return implode('/', array_reverse(explode('-', $data_cadastro)));
    }

    function formatarTelefone($telefone) {
        if (!empty($telefone)) {
            //Substring: função que pega partes de uma string (qual string, onde começa, tamanho que quer(qtos numeros))
            $ddd = substr($telefone, 0, 2);
            $parte1 = substr($telefone, 2, 5); 
            $parte2 = substr($telefone, 7);  //qdo n tem tamanho, é pq é até o final
            return "($ddd) $parte1-$parte2";
        } else {
            return "";
        }
    }

?>
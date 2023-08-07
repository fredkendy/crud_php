<?php

    function enviarArquivo($error, $size, $name, $tmp_name) {

        //'error' é propriedade que veio do servidor, visualizado no var_dump
        if ($error) {
            die("Falha ao enviar arquivo");
        }

        //Fazendo a verificação de tamanho ('size' é propriedade que veio do servidor, visualizado no var_dump)
        if ($size > 2097152) {
            die("Arquivo muito grande. Máximo: 2 MB");
        }

        //Definindo onde o arquivo deve ir
        $pasta = "arquivos/";

        //Criando um novo nome único (uniqid) para o arquivo (se o servidor recebe com o nome de origem, aumenta a chance de homonimo e consequentemente sobrescrever algum arquivo com nome igual)
        $nomeDoArquivo = $name;
        $novoNomeDoArquivo = uniqid();

        //Verificando qual a extensão do arquivo
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
        
        if ($extensao != "jpeg" && $extensao != 'png') {
            die("Tipo de arquivo não aceito");
        }

        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

        //Essa função retorna true (se deu certo) ou false (deu errado)
        $deu_certo = move_uploaded_file($tmp_name, $path);

        if ($deu_certo) {
            //retornar o path para poder salvar no BD
            return $path;
        } else {
            return false;
        }
    }

?>
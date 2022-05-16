<?php
    include('../../config.php');
    if(!Painel::logado()){
        die('Você não tem permissão para estar aqui!');
    }

    $response = array();
    $response['case'] = 'sucesso';
    
    $imagem = $_FILES['file'];
    if(Painel::validarImagem($imagem)){
        //Apagando antiga imagem de perfil
        $imagemAntiga = Painel::selecionarDadosEspecificos('tb_admin.usuarios','imagem','`id` = ?',array($_SESSION['id']));
        Painel::deletarFile($imagemAntiga['imagem']);
        //Subindo nova imagem de perfil
        $novaImagem = Painel::subirArquivo($imagem);
        //Adicionando nova imagem ao banco de dados
        Painel::editarDados('tb_admin.usuarios','`id` = ?',array('imagem'),array($novaImagem,$_SESSION['id']));
        $response['response'] = 'sucesso';
    }else{
        $response['case'] = 'erro';
        $response['reason'] = 'Imagem invalida!';
    };

    die(json_encode($response));
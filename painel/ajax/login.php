<?php

    include('../../config.php');
    //sleep(2);

    
    $response = [];
    $response['case'] = 'success';
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];


    if($usuario == '' || $senha == ''){
        $response['case'] = 'error';
        $response['reason'] = 'Campos vazios :(';
    }

    if(isset($_SESSION['tempo']) && (time() - $_SESSION['tempo']) >= 60*29){
        $_SESSION['tentativas'] = 1;
    }

    if(@$_SESSION['tentativas'] >= 7){
        $response['case'] = 'error';
        $minutosRestantes = floor(((60*29) - (time() - $_SESSION['tempo']))/60)+1;
        $response['reason'] = 'Você tentou mais de 6 vezes, aguarde '.$minutosRestantes.' minuto(s) e tente novamente';
    }else{
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE `usuario` = ? AND `senha` = ? ");
        $sql->execute(array($usuario,$senha));
        $userInfo = $sql->fetchAll();
        if($sql->rowCount() != 0){
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['nome'] = $userInfo[0]['nome'];
            $_SESSION['cargo'] = $userInfo[0]['cargo'];
            $_SESSION['img-perfil'] = $userInfo[0]['imagem'];
            $_SESSION['login'] = $userInfo[0]['usuario'];
            $_SESSION['id'] = $userInfo[0]['id'];
            if($_POST['lembrar'] == 'true'){
                setcookie('lembrar',true,time() + 60*60*24*15,'/');
                setcookie('usuario',$usuario,time() + 60*60*24*15,'/');
                setcookie('senha',$senha,time() + 60*60*24*15,'/');
            }   
        }else{
            if(!isset($_SESSION['tentativas'])){
                $_SESSION['tentativas'] = 1;
            }else{
                $_SESSION['tempo'] = time();
                $_SESSION['tentativas']++;
            }
            $response['case'] = 'error';
            $response['reason'] = 'Usuario ou senha incorretos : (';
        }
    }
    
    die(json_encode($response));
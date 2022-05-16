    <?php

        if(isset($_POST['editar-usuario'])){
            $usuarioAtual = Painel::selecionarDadosEspecificos('tb_admin.usuarios','*','`id` = ?',array($_SESSION['id']))[0];
            
            if($usuarioAtual['nome'] == $_POST['novo-nome']){
                if(Painel::dadoDuplicado('tb_admin.usuarios','`usuario` = ?',$_POST['novo-login'])){
                    Painel::mensagem('erro','Este nome de usuario ou login já existe!');
                }else{
                    if($_POST['novo-nome'] == '' || $_POST['novo-login'] == ''){
                        Painel::mensagem('erro','Campos vazios não são permitidos');
                    }else{
                        if(Painel::editarDados('tb_admin.usuarios','`id` = ?',array("nome","usuario"),array($_POST['novo-nome'],$_POST['novo-login'],$_SESSION['id']))){
                            Painel::mensagem('sucesso','Informações editadas com sucesso!');
                        };
                    }
                }
                
            }else if($usuarioAtual['usuario'] == $_POST['novo-login']){
                if(Painel::dadoDuplicado('tb_admin.usuarios','`nome` = ?',$_POST['novo-nome'])){
                    Painel::mensagem('erro','Este nome de usuario ou login já existe!');
                }else{
                    if($_POST['novo-nome'] == '' || $_POST['novo-login'] == ''){
                        Painel::mensagem('erro','Campos vazios não são permitidos');
                    }else{
                        if(Painel::editarDados('tb_admin.usuarios','`id` = ?',array("nome","usuario"),array($_POST['novo-nome'],$_POST['novo-login'],$_SESSION['id']))){
                            Painel::mensagem('sucesso','Informações editadas com sucesso!');
                        };
                    }
                }
            }else{
                if(Painel::dadoDuplicado('tb_admin.usuarios','`nome` = ?',$_POST['novo-nome'])){
                    Painel::mensagem('erro','Este nome de usuario ou login já existe!');
                }else{
                    if($_POST['novo-nome'] == '' || $_POST['novo-login'] == ''){
                        Painel::mensagem('erro','Campos vazios não são permitidos');
                    }else{
                        if(Painel::editarDados('tb_admin.usuarios','`id` = ?',array("nome","usuario"),array($_POST['novo-nome'],$_POST['novo-login'],$_SESSION['id']))){
                            Painel::mensagem('sucesso','Informações editadas com sucesso!');
                        };
                    }
                }
            }
        }

        if(isset($_POST['editar-senha'])){
            if(strlen($_POST['antiga-senha']) < 5 || strlen($_POST['nova-senha']) < 5){
                Painel::mensagem('erro','Sua senha precisa ter no mínimo 5 caracteres');
            }else{
                $senhaAntiga = Painel::selecionarDadosEspecificos('tb_admin.usuarios','senha','`id` = ?',array($_SESSION['id']))['senha'];
                if($_POST['nova-senha'] == '' || $_POST['antiga-senha'] == ''){
                    Painel::mensagem('erro','Campos vazios não são permitidos');
                }

                if($senhaAntiga == $_POST['antiga-senha']){
                    //Pode escolher uma nova senha
                    $novaSenha = $_POST['nova-senha'];
                    if(Painel::editarDados('tb_admin.usuarios','`id` = ?',array('senha'),array($novaSenha,$_SESSION['id']))){
                        Painel::mensagem('sucesso','Senha alterada com sucesso!');
                    }else{
                        Painel::mensagem('erro','Ocorreu um erro ao alterar sua senha');
                    }
                }else{
                    //Não pode escolgher uma nova senha
                    Painel::mensagem('erro','Senha antiga incorreta');
                }
            }
            
        }

        //Recuperando informações do usuario
        $usuarioInfo = Painel::selecionarDadosEspecificos('tb_admin.usuarios','*','`id` = ?',array($_SESSION['id']))[0];
    ?>
    <div class="option-name-box">
        <i class="fas fa-globe-americas"></i>
        <h1>Meu perfil</h1>
    </div>

    <div class="profile-box">
        <div class="profile-info">
            <div class="profile-imgs">
                
                <?php
                    if($usuarioInfo['imagem'] == ''){
                ?>
                <div class="default-icon">
                    <i class="fas fa-user-alt"></i>
                </div>
                <?php
                    }else{
                ?>
                <img style="object-fit: cover;" src="<?php echo PATH_PAINEL; ?>uploads/<?php echo $usuarioInfo['imagem'] ?>" />
                <?php
                    };
                ?>
                
                <i style="font-size: 30px; margin: 0 1rem;" class="fas fa-arrow-right"></i>
                <label for="new-profile-img">
                    <div class="change-profile-img">
                        Trocar
                    </div>
                </label>
                <form method="post" enctype="multipart/form-data" id="new-profile-img-form">
                    <input type="file" id="new-profile-img" name="new-profile-img" />
                </form>
            </div>
            <p><?php echo $usuarioInfo['nome'] ?></p>
            <p><?php echo Painel::$cargo[$usuarioInfo['cargo']]; ?></p>
        </div>

        <div class="edit-profile-box">
            <h2>Editar Perfil</h2>
            <form method="post" id="editar-usuario">
                <label>Nome</label>
                <input type="text" name="novo-nome" value="<?php echo $usuarioInfo['nome']; ?>"/>
                <label>LogIn</label>
                <input type="text" name="novo-login" value="<?php echo $usuarioInfo['usuario']; ?>"/>
                <input type="submit" value="Salvar" name="editar-usuario" />
            </form>
        </div>

        <div class="edit-profile-box">
            <h2>Editar Senha</h2>
            <form method="post" id="editar-senha">
            <label>Antiga senha</label>
                <input type="password" name="antiga-senha" check="checkPassword" required/>
                <label>Nova senha</label>
                <input type="password" name="nova-senha" check="checkPassword" required/>
                <input type="submit" value="Salvar" name="editar-senha" />
            </form>
        </div>

    </div>
<?php
    if($_SESSION['cargo'] < 1){
?>  
     <?php Painel::mensagem('erro','Você precisa ser administrador para acessar esta página!'); ?>

<?php
    }else{

        if(isset($_GET['user-delete'])){
            if($_GET['user-delete'] == $_SESSION['id']){
                Painel::mensagem('erro','Você não pode excluir sua própria conta!');
            }else{
                @$imagem = Painel::selecionarDadosEspecificos('tb_admin.usuarios','imagem','`id` = ?',array($_GET['user-delete']))['imagem'];
                Painel::deletarFile($imagem);
                if(Painel::deletarDados('tb_admin.usuarios','','`id` = ?',array($_GET['user-delete']))){
                    Painel::mensagem('sucesso','Usuário excluido com sucesso!');
                }else{
                    Painel::mensagem('erro','Ocorreu um erro ao excluir o usuário!');
                }
            }
           
        }

        if(isset($_POST['addUser'])){
            if(Painel::dadoDuplicado('tb_admin.usuarios','`nome` = ?',$_POST['nome']) || Painel::dadoDuplicado('tb_admin.usuarios','`usuario` = ?',$_POST['usuario'])){
                Painel::mensagem('erro','Este nome de usuário ou login já existe!');
            }else{
                if(strlen($_POST['senha']) < 5){
                    Painel::mensagem('erro','A senha precisa ter no mínimo 5 caracteres!');
                }else{
                    if($_FILES['imagem'] == ''){
                        //nenhuma imagem selecionada
                        Painel::inserirDados('tb_admin.usuarios',$_POST,$_FILES['imagem']['name']);
                    }else{
                        Painel::validarImagem($_FILES['imagem']);
                        $img = Painel::subirArquivo($_FILES['imagem']);
                        Painel::inserirDados('tb_admin.usuarios',$_POST,$img);
                    }
                    
                    Painel::mensagem('sucesso','Usuário adicionado com sucesso!');
                }
            }
        }
?>

    <div class="option-name-box">
        <i class="fas fa-users-cog"></i>
        <h1>Usuários do painel</h1>
    </div>

    <div class="responsive-table">
        <table>
            <tr>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Deletar</th>
            </tr>

            <?php
                $usuariosPainel = Painel::selecionarTodosDados('tb_admin.usuarios');
                foreach($usuariosPainel as $key => $value){ 
            ?>
            <tr>
                <td><?php echo $value['nome']; ?></td>
                <td><?php echo Painel::$cargo[$value['cargo']] ?></td>
                <td><div class="delete-btn"><a href="<?php echo PATH_PAINEL; ?>usuarios?user-delete=<?php echo $value['id']; ?>">Remover</a></div></td>
            </tr>
            <?php
                };
            ?>
        </table>
    </div>

    <div class="option-name-box">
        <i class="fas fa-users-cog"></i>
        <h1>Adicionar Usuários</h1>
    </div>

    <div class="add-users-box">
        <form method="post" enctype="multipart/form-data" id="add-users-form">
            <label for="add-imagem-perfil" id="select-profile-img" >
                <p>Imagem (opcional)</p>
                <div class="change-profile-img" style="margin-bottom: 1rem;">Adicionar</div>
            </label>
            <input type="file" name="imagem" id="add-imagem-perfil" />
            <input type="text" placeholder="Nome" name="nome" required/>
            <input type="text" placeholder="LogIn" name="usuario" required/>
            <input type="password" placeholder="Senha" name="senha" required/>
            <select name="cargo" required>
                <option value="0">Usuario comum</option>
                <option value="1">Administrador</option>
            </select>
            <input type="submit" value="Adicionar" name="addUser" />
        </form>
    </div>
<?php
    };
?>
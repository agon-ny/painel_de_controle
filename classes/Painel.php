<?php

    class Painel
    {


        //Função para verificar se o usuário esta logado ou não
        public static function logado(){
            if(isset($_SESSION['logado'])){
                return true;
            }else{
                return false;
            }
        }

        //Redirecionar para qualquer página
        public static function redirecionar($caminho){
            header("Location: ".PATH_PAINEL.$caminho);
        }

        //Carregando páginas dinâmicamente através da Url
        public static function carregarPagina(){
            @$url = $_GET['url'];
            $url = explode('/',$url);
            $url = $url[0];
            if($url != ''){
                if(file_exists('pages/'.$url.'.php')){
                    include('pages/'.$url.'.php');
                }else{
                    include('pages/home.php');
                }
            }else{
                include('pages/home.php');
            }
        }

        //Fazer logOut do sistema
        public static function logout(){
            if(isset($_GET['logout'])){
                session_destroy();
                setcookie('lembrar',false,time() - 999,'/');
                self::redirecionar('');
            }
        }

        //Pegar o cargo do usuario atual
        public static $cargo = ['0'=>'Usuário Comum','1'=>'Administrador'];

        //Verificar se uma imagem é valida
        public static function validarImagem($img){
            $imgType = $img['type'];
            if($imgType != 'image/png' && $imgType != 'image/jpeg' && $imgType != 'image/jpg'){
                return false;
            }else{
                return true;
            }
        }


        //Inserir no banco automaticamente
        public static function inserirDados($tabelaNome,$informacoes,$imagemNome){
            //Retirando o ultimo valor das informações enviadas
            array_pop($informacoes);
            if($imagemNome == 'none'){
                $query = "INSERT INTO `".$tabelaNome."` VALUES(null";
                foreach($informacoes as $key => $value){
                    $informacoesExecute[] = $value;
                    $query.= ",?";
                }
                $query.= ")";
                $sql = MySql::conectar()->prepare($query);
                $sql->execute($informacoesExecute);
            }else{
                array_push($informacoes, $imagemNome);
                $query = "INSERT INTO `".$tabelaNome."` VALUES(null";
                foreach($informacoes as $key => $value){
                    $informacoesExecute[] = $value;
                    $query.= ",?";
                }
                $query.= ")";
                $sql = MySql::conectar()->prepare($query);
                $sql->execute($informacoesExecute);
            }
            
            return $query;
        }

        //Fazer o upload do arquivo
        public static function subirArquivo($img){
            $imgGerada = explode('.',$img['name']);
            $imgGerada[0] = uniqid().'.';
            $imgGerada = implode($imgGerada);
            if(move_uploaded_file($img['tmp_name'],RAIZ.'/painel/uploads/'.$imgGerada)){
                return $imgGerada;
            }else{
                return false;
            }
        
        }

        //Selecionar todos os dados de uma certa tabela
        public static function selecionarTodosDados($tabelaNome){
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabelaNome` ");
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        //Seleciona dados especificos de acordo com a informação passada
        public static function selecionarDadosEspecificos($tabelaNome,$selecao,$condicao,$valorCondicao){
            $query = "SELECT $selecao FROM `$tabelaNome` WHERE $condicao";
            $sql = MySql::conectar()->prepare($query);
            $sql->execute($valorCondicao);
            if($selecao == '*'){
                return $sql->fetchAll();
            }else{
                return $sql->fetch();
            }
        }

        //Atualizar valores do banco dinamicamente
        /*REGRAS DE USO 
        Voce deve passar os arrays campo e dados na ordem certa de valores
        A valor condição feita deve ser colocada no ultimo indice do array dados
        */
        public static function editarDados($tabelaNome,$where,$campos,$dados){
            $query = "UPDATE `$tabelaNome` SET ";
            foreach($campos as $key => $value){
                if($key == count($campos) - 1){
                    $query.= " `$value` = ?";
                }else{
                    $query.= " `$value` = ?,";
                }
            }
            $query.= " WHERE $where";
            $sql = MySql::conectar()->prepare($query);
            $sql->execute($dados);
            return $query;
        }

        //Deleta dados do banco com filtro ou sem
        public static function deletarDados($tabelaNome,$dados,$condicao,$valorCondicao){
            $query = "DELETE $dados FROM `$tabelaNome` WHERE $condicao ";
            $sql = MySql::conectar()->prepare($query);
            if($sql->execute($valorCondicao)){
                return true;
            }else{
                return false;
            }
        }

        //Deletar arquivos
        public static function deletarFile($file){
            @unlink(RAIZ.'/painel/uploads/'.$file);
        }

        //Verifica se existe algum dado duplicado
        //É PREMITIDO SOMENTE 1 DADO POR PESQUISA
        public static function dadoDuplicado($tabelaNome,$condicao,$dado){
            $query = "SELECT * FROM `$tabelaNome` WHERE $condicao ";
            $sql = MySql::conectar()->prepare($query);
            $sql->execute(array($dado));
            if($sql->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        //Aviso de erro ou sucesso
        public static function mensagem($tipo,$mensagem){
            if($tipo == 'erro'){
                //Mostrar erro
                echo "<div class='warning-box-error'><span><i class='fas fa-exclamation-triangle'></i> ".$mensagem."</span></div>";
            }else if($tipo == 'sucesso'){
                //Mostrar aviso de sucesso
                echo "<div class='warning-box-success'><i class='fas fa-check-circle'></i><span> ".$mensagem."</span></div>";
            }
        }








        public static function listarUsuariosOnline(){
			self::limparUsuariosOnline();
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.online`");
			$sql->execute();
			return $sql->fetchAll();
		}

		public static function limparUsuariosOnline(){
			$date = date('Y-m-d H:i:s');
			$sql = MySql::conectar()->exec("DELETE FROM `tb_admin.online` WHERE ultima_acao < '$date' - INTERVAL 1 MINUTE");
		}


    }
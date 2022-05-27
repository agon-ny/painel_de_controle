<?php
    
    if(isset($_COOKIE['lembrar'])){
        $usuario = $_COOKIE['usuario'];
        $senha = $_COOKIE['senha'];

        $verificacao = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE `usuario` = ? AND `senha` = ? ");
        $verificacao->execute(array($usuario,$senha));
        if($verificacao->rowCount() != 0){
            $_SESSION['logado'] = true;
            Painel::redirecionar('');
        }else{
            die('Você tentou entrar utilizando cookies falsos!');
        }
    }

?>  
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo CLIENTE; ?> - Fazer LogIn</title>
        <meta charset="utf-8" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <link rel="icon" href="<?php echo PATH_PAINEL; ?>style/images/logo.ico" >
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo PATH_PAINEL; ?>style/style.css" >
    </head>
    <body>

        <main id="login-body">
            
            <div class="left-side">

                <div class="logo">
                    <img><h1>Logo</h1></img>
                </div>
              
                <div class="square square-shape"></div>
                <div class="square2 square-shape"></div>
                <div class="square3 square-shape"></div>
                <div class="square4 square-shape"></div>

                <div class="clear-float"></div><!--Limpando float usado-->
                <div class="panel-info-box">
                    <ul>
                        <li><i class="fas fa-check-circle"></i>Painel Rápido, Seguro e Dinâmico</li>
                        <li><i class="fas fa-check-circle"></i>Controle total de seu Website</li>
                        <li><i class="fas fa-check-circle"></i>Use também em seu SmartPhone</li>
                    </ul>
                </div>

                <p>Navegadores Compatíveis</p>

                <div class="compatible-browsers">

                    <div class="browser-box">
                        <i style="color: #00c6ff;" class="fab fa-internet-explorer"></i>
                        <p>Explorer</p>
                    </div>

                    <div class="browser-box">
                        <i style="color: #F9D423;" class="fab fa-firefox"></i>
                        <p>Firefox</p>
                    </div>

                    <div class="browser-box">
                        <i style="color: #FF4E50;" class="fab fa-chrome"></i>
                        <p>Chrome</p>
                    </div>

                    <div class="browser-box">
                        <i style="color: #00c6ff;" class="fab fa-safari"></i>
                        <p>Safari</p>
                    </div>

                    <div class="browser-box">
                        <i class="fas fa-plus-circle"></i>
                        <p>Outros</p>
                    </div>
                    
                    
                </div>


            </div><!--Estrutura todo o conteúdo da esquerda-->
            

            <div class="right-side">

                <div class="responsive-logo" >
                    <img src="<?php echo PATH_PAINEL; ?>style/images/logo-blackwhite.png"/>
                </div>

                <div class="login-box">
                    <h1>Login</h1>
                    <form method="post" id="login-form">
                        <input type="text" placeholder="Usuário" name="usuario">
                        <input type="password" placeholder="Senha" name="senha">
                        <div class="remmember-me">
                            <input type="checkbox" name="lembrar" value="true">
                            <label>Lembrar de mim</label>
                        </div>
                        <input style="background-color: rgba(0,149,246,.3); border-bottom: 0; " disabled type="submit" value="Entrar" name="logar">
                    </form>
                </div><!--Caixa que guarda o form-->

                <div class="info-box login-info">
                    
                    <p>Faça login para acessar</p>
                </div>

                <div class="feedback">
                    <div class="red-btn feedback-btn" id="bug-report-click">
                        <i style="font-size: 18px;" class="fas fa-bug"></i>
                        <p>Reportar Bug</p>
                    </div>

                    <div class="blue-btn feedback-btn" id="feedback-report-click"> 
                        <i style="font-size: 18px;" class="far fa-comment-dots"></i>
                        <p>Feedback</p>
                    </div>
                </div>

                <div class="info-box"></div>

                <p id="powered">Powered by <a style="color: white;" href="https://github.com/SoloDv" target="_blank">Solo</a></p>
            

            </div><!--Estrutura todo o conteúdo da direita-->

                <div class="report">
                    <div class="report-box bug-box-send" style="display: none;">

                        <h1><i class="fas fa-flag"></i> Reportar <span style="color: #EA384D;">Bug</span></h1>

                        <div class="report-explain">
                            <p>Encontrou algum bug? Nos envie uma mensagem no Instagram explicando o que há de errado e nós o corrijiremos o mais rápido possível!</p>
                        </div>

                        <div class="report-buttons">
                            <a style="margin-right: 10px;" href="#" target="_blank" class="link-box blue-btn">
                                <i class="far fa-paper-plane"></i><span>  Enviar</span>
                            </a>

                            <div class="close-btn red-btn close-report">
                                <i class="fas fa-times-circle"></i><span> Fechar</span>
                            </div>

                        </div>

                    </div>

                    <div class="report-box feedback-box-send" id="feedback-report-click" style="display: none;">

                        <h1><i class="fas fa-comment-dots"></i> Enviar <span style="color: springgreen;">FeedBack</span></h1>

                        <div class="report-explain">
                            <p>Nos envie um inbox no insta. Adoraríamos receber seu feedback contando o que achou de seu website, sinta-se livre para escrever o que achar necessário!</p>
                        </div>

                        <div class="report-buttons">
                            <a style="margin-right: 10px;" href="#" target="_blank" class="link-box blue-btn">
                                <i class="far fa-paper-plane"></i><span>  Enviar</span>
                            </a>

                            <div class="close-btn red-btn close-report">
                                <i class="fas fa-times-circle"></i><span> Fechar</span>
                            </div>

                        </div>

                    </div>
                </div>

    </main><!--Estrutura todo o conteúdo-->

        <script src="<?php echo PATH; ?>scripts/libs/jquery.js"></script>
        <script src="https://kit.fontawesome.com/e33890c2d5.js" crossorigin="anonymous"></script>
        <script src="<?php echo PATH_PAINEL; ?>scripts/login.js"></script>
        <script src="<?php echo PATH_PAINEL; ?>scripts/popups.js"></script>
    </body>
</html>
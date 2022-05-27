<?php
    if(!Painel::logado()){
        die('Você não tem permissão para estar aqui');
    }
    Painel::logout();
    $usuarioInfo = Painel::selecionarDadosEspecificos('tb_admin.usuarios','imagem','`id` = ?',array($_SESSION['id']));
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo CLIENTE; ?> - Painel de Controle</title>
        <meta charset="utf-8" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <link rel="icon" href="<?php echo PATH_PAINEL; ?>style/images/logo.ico" >
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo PATH_PAINEL; ?>style/style.css" >
    </head>
    <body>

        <main id="panel-main">
            <div class="panel-navsidebar">
                <header>
                    <div class="sidebar-logo">
                        <h1>Logo</h1>
                    </div>
                </header>

                <div class="nav-sidebar-overflow">

                    <div <?php if(@$_GET['url'] == '' || @$_GET['url'] == 'home'){ echo "style='background-color: white'"; };?> class="feature-name">
                        <a <?php if(@$_GET['url'] == '' || @$_GET['url'] == 'home'){ echo "style='color: black;'";}; ?>href="<?php echo PATH_PAINEL; ?>home">
                            <i class="fas fa-home"></i><span>Home</span>
                        </a>
                    </div>

                    <div <?php if(@$_GET['url'] == 'usuarios'){ echo "style='background-color: white;'"; };?> class="feature-name">
                        <a <?php if(@$_GET['url'] == 'usuarios'){ echo "style='color: black;'";}; ?> href="<?php echo PATH_PAINEL; ?>usuarios">
                            <i class="fas fa-user-shield"></i></i><span>Usuarios</span>
                        </a>
                    </div>
                
                </div>

            </div>

            <div  class="panel-show-content">
                <header>
                    <div class="left-header-panel">
                        <div id="sidebar-close">
                            <i style="font-size: 20px;" class="fas fa-arrow-left"></i>
                            <i style="font-size: 20px;" class="fas fa-bars"></i>
                        </div>
                        <i style="font-size: 20px;  margin-left: 20px;" class="fas fa-clipboard-check"></i><span> Painel de Controle</span>
                    </div>

                    <div class="right-header-panel">

                        <div class="feedback-panel">
                            <div style="margin-right: 10px;" class="red-btn" id="bug-report-click">
                                <i class="fas fa-bug"></i>
                                <span style="font-size: 13px;">Reportar Bug</span>
                            </div>

                            <div class="blue-btn" id="feedback-report-click"> 
                                <i class="far fa-comment-dots"></i>
                                <span style="font-size: 13px;">Feedback</span>
                            </div>
                        </div>

                        <div class="user-config">
                            <div class="user-pic">
                                <?php
                                    if($usuarioInfo['imagem'] == ''){
                                ?>
                                <i class="fas fa-user-alt"></i>
                                <?php
                                    }else{
                                ?>
                                <img style="width: 30px; height: 30px; object-fit: cover;" src="<?php echo PATH_PAINEL; ?>uploads/<?php echo $usuarioInfo['imagem']; ?>" />
                                <?php
                                    };
                                ?>
                            </div>

                            <div class="down-arrow-user">
                                <i class="fas fa-arrow-down"></i>
                            </div> 

                            <div class="user-config-box" style="display: none;">
                                <div class="my-profile">
                                    <a href="<?php echo PATH_PAINEL; ?>perfil" class="link-box">
                                        <i class="fas fa-user-alt"></i>
                                        <span>Meu Perfil</span>
                                    </a>
                                </div>

                                <div class="logout">
                                    <a href="<?php echo PATH_PAINEL; ?>?logout=true" class="link-box">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>                        
                        </div>

                    </div>

                </header>

                <div class="feature-show">
                    <?php
                        Painel::carregarPagina();
                    ?>
                </div>

            </div>



            <div class="report" >
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
           
        </main>

    
        <script src="<?php echo PATH; ?>scripts/libs/jquery.js"></script>
        <script src="https://kit.fontawesome.com/e33890c2d5.js" crossorigin="anonymous"></script>
        <script src="<?php echo PATH_PAINEL; ?>scripts/popups.js"></script>
        <script src="<?php echo PATH_PAINEL; ?>scripts/forms.js"></script>
    </body>
</html>
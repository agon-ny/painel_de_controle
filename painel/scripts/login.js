$(function(){
    
    //Script para garantir a quantidade minima de login

    function loginvalido(){
        $('input[name=usuario],input[name=senha]').keyup(function(e){
            var key = e.which;
            if(key == 13){
                return false;
            }
            var usuarioLen = $('input[name=usuario]').val().length;
            var senhaLen = $('input[name=senha]').val().length;
    
            if(usuarioLen < 2 || senhaLen < 5){
                $('input[name=logar]').css("background-color",'rgba(0,149,246,.3)');
                $('input[name=logar]').css("border",'0');
                $('input[name=logar]').attr('disabled','true');
            }
    
            if(usuarioLen >= 2){
                if(senhaLen >= 5){
                    //Pronto para logar
                    $('input[name=logar]').css("background-color",'rgba(0,149,246,1)');
                    $('input[name=logar]').css("border-bottom","5px solid rgb(16, 64, 95)");
                    $('input[name=logar]').removeAttr('disabled');
                }
            }
            
        })
    }
    loginvalido();

    function fazerLogin(){
        $('#login-form > input[name=logar]').click(function(){
            var usuario = $('#login-form > input[name=usuario]').val();
            var senha = $('#login-form > input[name=senha]').val();
            
            if($("input[name=lembrar]").is(':checked')){
                var lembrar = "true";
            }else{
                var lembrar = "false";
            }
            
            $.ajax({
                url: 'ajax/login.php',
                method: 'post',
                dataType: 'json',
                beforeSend: function(){
                    $('input[name=logar]').attr('disabled','true');
                    $('input[name=logar]').css('background-color','rgba(0,149,246,.3)');
                    $('input[name=logar]').css('border-bottom','0');
                    $('.login-info').html("<img style='width: 30px; height: 30px;' src='style/images/loading.gif'></img>");
                },
                data: {'usuario':usuario,'senha':senha,'lembrar':lembrar},
                success: function(response){
                    console.log(response);
                    if(response.case == 'success'){
                        //redirect login
                        window.location.reload();
                    }else if(response.case == 'error'){
                        $('input[name=logar]').removeAttr('disabled');
                        $('input[name=logar]').css('background-color','rgb(0, 149, 246)');
                        $('input[name=logar]').css('border-bottom','5px solid rgb(16, 64, 95)');
                        $('.login-info').html("<p style='color: red;'>"+response.reason+"</p>");
                    }
                }
            })

            return false;
        })
    }
    fazerLogin();
    

})
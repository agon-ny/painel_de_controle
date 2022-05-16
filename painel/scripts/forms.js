$(function(){

    //Atualizando imagem do perfil do usuário
    $('input[name=new-profile-img]').change(function(){
        var file_data = $('input[name=new-profile-img]').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        $.ajax({
            url: 'ajax/img-perfil.php',
            dataType: 'json', 
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            beforeSend: function(){
                $('.change-profile-img').html('espere');
            },
            success: function(data){
                if(data.case == 'sucesso'){
                    location.reload();
                }else if(data.case == 'erro'){
                    
                }
            }
         });
    });

    //Verificando as senhas
    function loginvalido(){
        $('input[name=editar-senha]').css("background-color",'rgba(0,149,246,.3)');
        $('input[name=editar-senha]').attr('disabled','true');
        $('input[name=antiga-senha],input[name=nova-senha]').keyup(function(e){
            var key = e.which;
            if(key == 13){
                return false;
            }
            var usuarioLen = $('input[name=antiga-senha]').val().length;
            var senhaLen = $('input[name=nova-senha]').val().length;
    
            if(usuarioLen < 5 || senhaLen < 5){
                $('input[name=editar-senha]').css("background-color",'rgba(0,149,246,.3)');
                $('input[name=editar-senha]').attr('disabled','true');
            }
    
            if(usuarioLen >= 5){
                if(senhaLen >= 5){
                    //Pronto para logar
                    $('input[name=editar-senha]').css("background-color",'rgba(0,149,246,1)');
                    $('input[name=editar-senha]').removeAttr('disabled');
                }
            }
            
        })
    }
    loginvalido();

});
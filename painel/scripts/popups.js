$(function(){

    function abrirReports(){
        $('#bug-report-click').click(function(){
            $('.report').css('display','flex');
            $('.bug-box-send').fadeIn();
        })

        $('#feedback-report-click').click(function(){
            $('.report').css('display','flex');
            $('.feedback-box-send').fadeIn();
        })

        $('.close-report').click(function(){
            $('.report').fadeOut();
            $('.bug-box-send').fadeOut();
            $('.feedback-box-send').fadeOut();
        })
    }
    abrirReports();
    
    function abrirPerfil(){
        $('.user-pic,.down-arrow-user').click(function(){
            $('.user-config-box').fadeToggle();
        })
    }
    abrirPerfil();


    //Abrir ou fechar side bar
    function esconderSidebar(){

        var open = true;
        var windowSize = $(window)[0].innerWidth;
        $(window).resize(function(){
            windowSize = $(window)[0].innerWidth;
        });

        var panelWidth = '78%';
        var navsideWidth = '22%';

        if(windowSize <= 930){
            panelWidth = '70%';
            navsideWidth = '30%';
            $('.nav-sidebar-overflow').css('padding','0');
            $('.panel-navsidebar').css('width','0%');
            $('.panel-show-content').css('width','100%');
            $('.sidebar-logo > img').css('display','none');
            open = false;
        }
        if(windowSize <= 750){
            panelWidth = '65%';
            navsideWidth = '35%';
        }
        if(windowSize <= 650){
            panelWidth = '40%';
            navsideWidth = '60%';
            $('#sidebar-close').click(function(){
                if(open){
                    setTimeout(function(){
                        $('.feature-show').fadeIn();
                        $('.user-config').css('display','flex');
                        $('.left-header-panel > i, .left-header-panel > span').css('display','inline-block');
                    },400)
                }else{
                    $('.feature-show').css('display','none');
                    $('.user-config').css('display','none');
                    $('.left-header-panel > i, .left-header-panel > span').css('display','none');
                }
            })
        }
        
        $('#sidebar-close').click(function(){
            if(open){
                $('.feature-name').animate({'width':'0','opacity':'0%'});
                setTimeout(function(){
                    $('.sidebar-logo > img').fadeOut();
                    $('.panel-navsidebar').animate({'width':'0%'});
                    $('.panel-show-content').animate({'width':'100%'});
                },50); 
                setTimeout(function(){
                    $('.nav-sidebar-overflow').css('padding','0');
                },400)
                
                open = false;
            }else{
                $('.panel-show-content').animate({'width':panelWidth});
                $('.panel-navsidebar').animate({'width':navsideWidth});
                $('.sidebar-logo > img').fadeIn();
                $('.feature-name').css('width','auto');
                setTimeout(function(){
                    $('.feature-name').animate({'opacity':'100%'});
                },50)
                $('.nav-sidebar-overflow').css('padding','1rem');
                open = true;
            }
        });
        
    }
    esconderSidebar();
});
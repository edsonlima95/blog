$(function () {
       
    //EFEITOS DA HOME DO SITE.
    
    //Adiciona o submit ao botao.
    $('.pesquisa .j_send').click(function () {
        $('form[name="busca-geral"]').submit();
    });
    
    //LOGO.
    $('.logo p').delay('500').slideDown('slow');
    
    //MENU.
    $('#menu-desk li').mouseover(function () {
         $(this).find('ul.sub-menu-site').fadeIn('fast');
    }).mouseleave(function () {
        $(this).find('ul.sub-menu-site').fadeOut('fast');
    });
    
    //BOTAO PESQUISA.
    $('#menu-desk').find('.botao-pesquisa').on('click',function () {
        $('header#cabecalho .pesquisa').fadeToggle('fast');
    });
    
    //MENU-MOBILE.
    //Abri o menu.
    $('#menu-desk').find('.j_open').click(function () {
        $('nav#menu-mobile').find('ul').animate({width: 'toggle'});
        $('body').find('.back-dark').fadeIn('fast');
    });
    
    //Fecha o menu.
    $('nav#menu-mobile').find('.close-menu').click(function () {
        $('nav#menu-mobile').find('ul').animate({width: 'toggle'});
        $('body').find('.back-dark').fadeOut('fast');
        return false;
    });
    //Fecha o menu no body, html.
    $('body').find('.back-dark').click(function () {
        $('nav#menu-mobile').find('ul').animate({width: 'toggle'});
        $('body').find('.back-dark').fadeOut('fast');
        return false;
    });
    
    //SLIDE E NOTICIAS ESTILOS.
    var box = $('#slide-noticia .conteudo-noticias');
    
    //Efeito noticias do slide.
    box.css({
        padding: '10px',
        background: 'rgba(0,0,0,0.7)',
        color: '#fff',
        position: 'absolute',
        top: '126px',
        width: '98%',
        'font-size': '15px'
    });
    
    box.find('h1 a').css({
       color: '#fff',
       'text-decoration': 'none',
    });
    
    box.find('time').css({
       'font-size': '10px',
        float: 'left',
       'margin-right': '10px'
    });
    
    //BOTAO TOPO.
    $('#topo').click(function () {
       $('body, html').animate({scrollTop: 0},1000); 
    });
    
    $(document).scroll(function () {
        var s = $(this).scrollTop();
        if(s >= 500){
            $('#topo').fadeIn('slow');
        }else {
             $('#topo').fadeOut('slow');
        }
    });
    
    //EFEITOS CATEGORIA.
    $('.top-empresas').find('h1').mouseover(function () {
       $('.top-empresas').find('ul').fadeIn('slow'); 
    }).mouseleave(function () {
       $('.top-empresas').find('ul').fadeOut('fast'); 
    });
    
    Shadowbox.init();
    
});
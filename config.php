<?php

    //Configurando o horário para brasilia
    date_default_timezone_set('America/Sao_Paulo');

    //Começando as sessões
    session_start();

    //Constantes
    define('PATH','http://localhost/vendasweb/');
    define('PATH_PAINEL','http://localhost/vendasweb/painel/');
    define('HOST','localhost');
    //CHANGE THE DBNAME IF YOU NEED TO
    //TROQUE O NOME DA SUA BASE DE DADOS SE DESEJAR
    define('DBNAME','painel_de_controle');
    define('PASS','');
    define('USER','root');
    define('CLIENTE','Evolken');
    define('RAIZ',__DIR__);

    //Carregar todas as classes
    $autoLoad = function($class){
        include('classes/'.$class.'.php');
    };
    spl_autoload_register($autoLoad);

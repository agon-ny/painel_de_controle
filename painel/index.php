<?php
    include('../config.php');

    if(Painel::logado()){
        include('main.php');
    }else{
        include("login.php");
    };

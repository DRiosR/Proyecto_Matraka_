<?php

//Llamando a config


require_once 'config/config.php';

//llamando a url herlper
require_once 'helpers/url_helper.php';

//Llamado a libs
spl_autoload_register(function($files){
    require_once 'libs/' . $files . '.php';
});


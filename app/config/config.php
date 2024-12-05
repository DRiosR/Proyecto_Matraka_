<?php

//Blockchain
require_once 'Blockchain.php';

$blockchain = new Blockchain();

//definimos las constantes de nuestra base de datos

define('DB_HOST','localhost');
define('DB_NAME','redsocial');
define('DB_USER','root');
define('DB_PASSWORD','');

//Definir las constantes de nuestro proyecto

define('URL_APP', dirname(dirname(__FILE__)));
define('URL_PROJECT', 'http://localhost/Proyecto_Matraka');
define('NAME_PROJECT', 'GOSSIP');

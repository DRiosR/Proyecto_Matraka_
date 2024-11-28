<?php

// Definimos las constantes de nuestra base de datos para Azure
define('DB_HOST', 'srvgossip.database.windows.net');  // Dirección de tu servidor en Azure
define('DB_NAME', 'bdGosssip');  // Nombre de tu base de datos en Azure
define('DB_USER', 'Rios@srvgossip');  // Tu usuario en Azure SQL Database
define('DB_PASSWORD', 'Moto030804');  // Tu contraseña de Azure SQL Database


// Definir las constantes de nuestro proyecto
define('URL_APP', dirname(dirname(__FILE__)));
define('URL_PROJECT', 'https://gossip-h6bzcrfqg5h8axgn.westus-01.azurewebsites.net');  // URL pública de tu app en Azure
define('NAME_PROJECT', 'GOSSIP');

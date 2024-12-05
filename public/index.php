<?php
require_once 'C:\xampp\htdocs\Proyecto_Matraka\app\config\Blockchain.php';

// Cargar archivo blockchain.json si existe
if (file_exists('blockchain.json')) {
    $blockchainData = json_decode(file_get_contents('blockchain.json'), true);

    $blockchain = new Blockchain();
    $blockchain->chain = array_map(function ($block) {
        return new Block(
            $block['index'],
            $block['timestamp'],
            $block['data'],
            $block['previousHash']
        );
    }, $blockchainData);
} else {
    $blockchain = new Blockchain(); // Crear una nueva cadena si no existe
}


// Llamado al iniciador
require_once "../app/initializer.php";


//iniciamos core
$init = new Core;
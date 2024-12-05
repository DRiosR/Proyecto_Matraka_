<?php
include 'Blockchain.php'; // Incluye la clase creada antes

// Instanciar el blockchain
$blockchain = new Blockchain();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $denuncia = $_POST['denuncia'];
    $blockchain->addBlock($denuncia);

    echo "¡Denuncia registrada en el blockchain!";
    echo "<pre>";
    print_r($blockchain->chain); // Imprime la cadena completa
    echo "</pre>";
}
?>

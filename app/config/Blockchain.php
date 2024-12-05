<?php

class Block {
    public $index;
    public $timestamp;
    public $data;
    public $previousHash;
    public $hash;

    public function __construct($index, $timestamp, $data, $previousHash = '') {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->hash = $this->calculateHash();
    }

    // Método para calcular el hash del bloque
    public function calculateHash() {
        return hash('sha256', $this->index . $this->timestamp . json_encode($this->data) . $this->previousHash);
    }
}



class Blockchain {
    public $chain;
    private $filePath;

    public function __construct($filePath = 'blockchain.json') {
        $this->filePath = $filePath;
        $this->chain = $this->loadChain();
        
        if (empty($this->chain)) {
            // Crear el bloque génesis si no hay datos
            $this->chain[] = $this->createGenesisBlock();
            $this->saveChain();
        }
    }

    // Crear el bloque génesis
    private function createGenesisBlock() {
        return new Block(0, date('Y-m-d H:i:s'), "Genesis Block", "0");
    }

    // Cargar la cadena desde un archivo JSON
    private function loadChain() {
        if (file_exists($this->filePath)) {
            $jsonData = file_get_contents($this->filePath);
            $chainData = json_decode($jsonData, true);

            // Convertir los datos del JSON a objetos `Block`
            return array_map(function ($blockData) {
                return new Block(
                    $blockData['index'],
                    $blockData['timestamp'],
                    $blockData['data'],
                    $blockData['previousHash']
                );
            }, $chainData);
        }
        return [];
    }

    // Guardar la cadena en un archivo JSON
    private function saveChain() {
        $jsonData = json_encode($this->chain, JSON_PRETTY_PRINT);
        file_put_contents($this->filePath, $jsonData);
    }

    // Obtener el último bloque
    public function getLastBlock() {
        return $this->chain[count($this->chain) - 1];
    }

    // Agregar un nuevo bloque
    public function addBlock($data) {
        $lastBlock = $this->getLastBlock();
        $newBlock = new Block(count($this->chain), date('Y-m-d H:i:s'), $data, $lastBlock->hash);
        $this->chain[] = $newBlock;
        $this->saveChain(); // Guardar la cadena actualizada
    }

    // Validar la cadena
    public function isChainValid() {
        for ($i = 1; $i < count($this->chain); $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i - 1];

            if ($currentBlock->hash !== $currentBlock->calculateHash()) {
                return false;
            }

            if ($currentBlock->previousHash !== $previousBlock->hash) {
                return false;
            }
        }
        return true;
    }
}

<?php

class Controller
{
    protected $blockchain;

    public function __construct() {
        global $blockchain; // Asegúrate de que la instancia esté accesible
        $this->blockchain = $blockchain;
    }
    
    public function model($modelo)
    {
        require_once '../app/models/' . $modelo . '.php';

        return new $modelo;
    }

    public function view($view, $datos = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            echo 'la vista no exixte';
        }
    }
}
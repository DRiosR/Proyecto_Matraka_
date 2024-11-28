<?php

class usuario
{
    private $db;


    public function __construct()
    {
        $this->db = new Base;
    }

    public function getUsuario($usuario)#va a obtener la informacion de ususario que se mande
    {
        $this->db->query('SELECT * FROM usuarios WHERE usuario = :user');
        $this->db->bind(':user', $usuario);
        return $this->db->register();

    }

    public function getPerfil($idusuario)#manda la ID del usuario
    {
        $this->db->query('SELECT * FROM perfil WHERE idUsuario = :id');
        $this->db->bind(':id', $idusuario);
        return $this->db->register();

    }

    public function verificarContrasena($datosUsuario, $contrasena)
    {
        if (password_verify($contrasena, $datosUsuario->contrasena)) {
            return true;
        } else {
            return false;
        }
    }
    public function verificarUsuario($datosUsuario)
    {
        $this->db->query('SELECT usuario FROM usuarios WHERE usuario = :user');
        $this->db->bind(':user', $datosUsuario['usuario']);
        $this->db->execute();

        if ($this->db->rowCount()) {
            return false;
        } else {
            return true;
        }
    }

    public function verificarCorreo($datosUsuario)
    {
        $this->db->query('SELECT * FROM usuarios WHERE correo = :user');
        $this->db->bind(':user', $datosUsuario['email']);
        $this->db->execute();

        if ($this->db->rowCount()) {
            return false;
        } else {
            return true;
        }
    }

  
    public function register($datosUsuario)
    {
        $this->db->query('INSERT INTO usuarios (idPrivilegio , correo, usuario, contrasena) VALUES (:privilegio, :email, :usuario, :contrasena)');
        $this->db->bind(':privilegio', $datosUsuario['privilegio']);
        $this->db->bind(':email', $datosUsuario['email']);
        $this->db->bind(':usuario', $datosUsuario['usuario']);
        $this->db->bind(':contrasena', $datosUsuario['contrasena']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function insertarPerfil($datos)
    {
        $this->db->query('INSERT INTO perfil (idUsuario, idFoto) VALUES (:id , :rutaFoto)');
        $this->db->bind(':id', $datos['idusuario']);
        $this->db->bind(':rutaFoto', $datos['ruta']);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function buscar($busqueda){
        $this->db->query('SELECT U.idUsuario , U.usuario , P.idFoto FROM usuarios U 
        INNER JOIN perfil P ON P.idUsuario = U.idusuario WHERE U.usuario LIKE :buscar');
        $this->db->bind(':buscar', $busqueda);
        return $this->db->registers();
    }
}

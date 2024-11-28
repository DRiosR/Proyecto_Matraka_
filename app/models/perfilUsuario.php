<?php

class perfilUsuario
{
    private $db;


    public function __construct()
    {
        $this->db = new Base;
    }

    public function editarFoto($datos)
    {
        $this->db->query('UPDATE perfil SET idFoto = :ruta WHERE idUsuario = :iduser');
        $this->db->bind(':ruta', $datos['ruta']);
        $this->db->bind(':iduser', $datos["idusuario"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function obtenerPublicacionesPorUsuario($idUsuario)
{
    $this->db->query(" SELECT p.idpublicacion, p.contenidoPublicacion, p.fotoPublicacion, 
        p.fechaPublicacion, u.usuario, u.idusuario, Per.idFoto
        FROM publicaciones p
        JOIN usuarios u ON p.idUserPublico = u.idusuario
        LEFT JOIN perfil Per ON u.idusuario = Per.idusuario  -- Aquí se añade el LEFT JOIN con la tabla perfil
        WHERE p.idUserPublico = :idusuario
        ORDER BY p.fechaPublicacion DESC
    ");
    $this->db->bind(':idusuario', $idUsuario);
    return $this->db->registers(); // Asegúrate de que 'registers' devuelve los datos correctamente
}


}
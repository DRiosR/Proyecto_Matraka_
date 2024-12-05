<?php
class publicar
{

    private $db;
    private $blockchain;


    public function __construct()
    {
        $this->db = new Base;
        if (file_exists('blockchain.json')) {
            $blockchainData = json_decode(file_get_contents('blockchain.json'), true);
            $this->blockchain = new Blockchain();
            $this->blockchain->chain = array_map(function ($block) {
                return new Block(
                    $block['index'],
                    $block['timestamp'],
                    $block['data'],
                    $block['previousHash']
                );
            }, $blockchainData);
        } else {
            $this->blockchain = new Blockchain();
        }
    }

    
    public function publicar($datos)
{
    global $blockchain;

    // Inserta la publicación en la base de datos
    $this->db->query('INSERT INTO publicaciones (idUserPublico, contenidoPublicacion, fotoPublicacion) VALUES (:iduser, :contenido, :foto)');
    $this->db->bind(':iduser', $datos['iduser']);
    $this->db->bind(':contenido', $datos['contenido']);
    $this->db->bind(':foto', $datos['foto']);

    if ($this->db->execute()) {
        // Si se inserta con éxito, agrega un bloque al blockchain
        $blockchain->addBlock([
            'iduser' => $datos['iduser'],
            'contenido' => $datos['contenido'],
            'foto' => $datos['foto'],
            'fecha' => date('Y-m-d H:i:s')
        ]);

        // Guarda el blockchain en un archivo para persistencia
        file_put_contents('blockchain.json', json_encode($blockchain->chain));

        return true;
    } else {
        return false;
    }
    if (!$blockchain->isChainValid()) {
        die("El blockchain ha sido alterado. Se necesita una revisión.");
    }
}





    public function getPublicaciones()
    {
        $this->db->query('SELECT P.idpublicacion, P.contenidoPublicacion, P.fotoPublicacion, P.fechaPublicacion, P.estadoPublicacion, U.usuario, U.idusuario, Per.idFoto 
                          FROM publicaciones P 
                          INNER JOIN usuarios U ON U.idusuario = P.idUserPublico  
                          INNER JOIN perfil Per ON Per.idUsuario = P.idUserPublico');
        return $this->db->registers();
    }
    


    public function getPublicacion($id)
    {
        $this->db->query('SELECT * FROM publicaciones WHERE idpublicacion = :id');
        $this->db->bind(':id', $id);
        return $this->db->register();
    }


    
    public function eliminarPublicacion($publicacion)
    {
        $this->db->query('DELETE FROM publicaciones WHERE idpublicacion = :id');
        $this->db->bind(':id', $publicacion->idpublicacion);

        if ($this->db->execute()) {
            return true;
        } else {

            return false;
        }
    }
    public function getComentariosPorPublicacion($idpublicacion)
    {
        $this->db->query('SELECT * FROM comentarios WHERE idPublicacion = :id');
        $this->db->bind(':id', $idpublicacion);
        return $this->db->registers();
    }


    public function publicarComentario($datos)
    {
        $this->db->query('INSERT INTO comentarios (idPublicacion , idUser , contenidoComentario) VALUES (:idpubli , :iduser , :comentario)');
        $this->db->bind(':idpubli', $datos['idPublicacion']);
        $this->db->bind(':iduser', $datos['iduser']);
        $this->db->bind(':comentario', $datos['comentario']);
        if ($this->db->execute()) {
            return true;
        } else {

            return false;
        }
    }


    public function getComentarios()
    {
        $this->db->query('SELECT * FROM comentarios');
        return $this->db->registers();
    }

    public function getInformacionComentarios($comentarios)
    {
        $this->db->query('SELECT C.idPublicacion , C.iduser , C.idcomentario ,  C.contenidoComentario , C.fechaComentario, P.idFoto, U.usuario FROM comentarios C 
        INNER JOIN perfil P ON P.idUsuario = C.idUser 
        INNER JOIN usuarios U ON U.idusuario = C.idUser');
        return $this->db->registers();
    }

    public function eliminarComentarioUsuario($id)
    {
        $this->db->query('DELETE FROM comentarios WHERE idcomentario = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {

            return false;
        }
    }

    public function getCantidadPublicaciones($idUsuario)
    {
        $this->db->query('SELECT COUNT(*) as cantidad FROM publicaciones WHERE idUserPublico = :idusuario');
        $this->db->bind(':idusuario', $idUsuario);
        $resultado = $this->db->register();
        return $resultado->cantidad;
    }

    public function getPublicacionesPorUsuario($idusuario)
    {
        // Asegúrate de usar el nombre correcto de la columna en la tabla publicaciones
        $this->db->query('SELECT * FROM publicaciones WHERE idUserPublico = :idusuario ORDER BY fechaPublicacion DESC');

        // Vincula el parámetro para prevenir inyecciones SQL
        $this->db->bind(':idusuario', $idusuario);

        // Ejecuta la consulta y retorna los resultados
        return $this->db->registers();
    }

    public function cambiarEstadoPublicacion($idPublicacion, $nuevoEstado)
    {
        // Consulta para actualizar el estado
        $this->db->query('UPDATE publicaciones SET estadoPublicacion = :nuevoEstado WHERE idpublicacion = :idPublicacion');
        $this->db->bind(':nuevoEstado', $nuevoEstado);
        $this->db->bind(':idPublicacion', $idPublicacion);

        // Ejecutar la consulta y retornar si fue exitosa o no
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

}
<?php

class Publicaciones extends Controller
{
    public function __construct()
    {
        $this->publicar = $this->model('publicar');
    }

    public function publicar($idUsuario)
    {
        if (isset($_FILES['imagen'])) {
            // Usamos la ruta relativa en lugar de una ruta absoluta local.
            $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/public/img/imagenesPublicaciones/';
            
            // Aseguramos que la carpeta exista
            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $rutaImagen = 'img/imagenesPublicaciones/' . $_FILES['imagen']['name'];
            $ruta = $carpeta . $_FILES['imagen']['name'];

            // Si la imagen es válida, la movemos a la carpeta destino
            if (!empty($_FILES['imagen']['tmp_name'])) {
                move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
            } else {
                $rutaImagen = 'sin imagen';  // Si no hay imagen, usamos esta opción
            }
        }

        $datos = [
            'iduser' => trim($idUsuario),
            'contenido' => trim($_POST['contenido']),
            'foto' => $rutaImagen
        ];

        // Llamamos al modelo para guardar la publicación
        if ($this->publicar->publicar($datos)) {
            redireccion('/home');
        } else {
            echo 'Algo ocurrió al publicar';
        }
    }
    public function eliminar($idpublicacion)
    {
        // Primero, obtener la publicación y los comentarios asociados
        $publicacion = $this->publicar->getPublicacion($idpublicacion);
        
        // Obtener los comentarios asociados a la publicación
        $comentarios = $this->publicar->getComentariosPorPublicacion($idpublicacion);
        
        // Eliminar los comentarios asociados
        foreach ($comentarios as $comentario) {
            if ($this->publicar->eliminarComentarioUsuario($comentario->idcomentario)) {
                // Continuar con el siguiente comentario si se elimina correctamente
                continue;
            } else {
                // Si hay un error al eliminar un comentario
                echo 'Error al eliminar comentario con ID: ' . $comentario->idcomentario;
            }
        }
    
        // Ahora, eliminar la publicación
        if ($this->publicar->eliminarPublicacion($publicacion)) {
            // Si la publicación se elimina correctamente, eliminar la imagen
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $publicacion->fotoPublicacion)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $publicacion->fotoPublicacion);
            }

            // Redirigir después de la eliminación exitosa
            redireccion('/home');
        } else {
            // Si algo sale mal al eliminar la publicación
            echo 'Error al eliminar la publicación';
        }
    }

    public function comentar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'iduser' => $_SESSION['logueado'],  // Usamos el id del usuario logueado
                'idPublicacion' => trim($_POST['idpublicacion']),
                'comentario' => trim($_POST['comentario'])
            ];
    
            if ($this->publicar->publicarComentario($datos)) {
                
                redireccion('/home');
            } else {
                redireccion('/home');
            }
        } else {
            redireccion('/home');
        }
    }

    public function eliminarComentario($id)
    {
        if ($this->publicar->eliminarComentarioUsuario($id)) {
            redireccion('/home');
        } else {
            redireccion('/home');

        }
    }
}
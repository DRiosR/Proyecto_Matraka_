<?php

class Publicaciones extends Controller
{
    public $publicar;
    public function __construct()
    {
        $this->publicar = $this->model('publicar');
    }


    public function publicar($idUsuario) {
        if (isset($_FILES['imagen'])) {
            $carpeta = 'C:/xampp/htdocs/Proyecto_Matraka/public/img/imagenesPublicaciones/';
            opendir($carpeta);
            $rutaImagen = 'img/imagenesPublicaciones/' . $_FILES['imagen']['name'];
            $ruta = $carpeta . $_FILES['imagen']['name'];
            if (!empty($_FILES['imagen']['tmp_name'])) {
                copy($_FILES['imagen']['tmp_name'], $ruta);
            } else {
                $rutaImagen = 'sin imagen';
            }
        }
    
        $datos = [
            'iduser' => trim($idUsuario),
            'contenido' => trim($_POST['contenido']),
            'foto' => $rutaImagen
        ];
    
        // Instancia de Blockchain
        $blockchain = new Blockchain('blockchain.json');
    
        // Agregar los datos como un nuevo bloque
        $blockchain->addBlock($datos);
    
        if ($this->publicar->publicar($datos)) {
            redireccion('/home');
        } else {
            echo 'Algo ocurrió';
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
                // Si se elimina correctamente, continuar con la siguiente iteración
                continue;
            } else {
                // Si algo sale mal, puedes agregar un log o mensaje para los comentarios que no se eliminan
                echo 'Error al eliminar comentario con ID: ' . $comentario->idcomentario;
            }
        }
    
        // Ahora, eliminar la publicación
        if ($this->publicar->eliminarPublicacion($publicacion)) {
            // Si la publicación se elimina correctamente, eliminar la imagen
            unlink(('C:/xampp/htdocs/Proyecto_Matraka/public/' . $publicacion->fotoPublicacion));
            
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

    
    public function cambiarEstado()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idPublicacion = $_POST['id_publicacion'];
            $nuevoEstado = $_POST['nuevo_estado'];
    
            if (!empty($idPublicacion) && !empty($nuevoEstado)) {
                // Llamamos al modelo para cambiar el estado
                if ($this->publicar->cambiarEstadoPublicacion($idPublicacion, $nuevoEstado)) {
                    $_SESSION['success'] = 'Estado de la publicación actualizado.';
                } else {
                    $_SESSION['error'] = 'Error al actualizar el estado de la publicación.';
                }
            } else {
                $_SESSION['error'] = 'Datos incompletos para actualizar el estado.';
            }
        }
    
        // Usamos la variable de sesión para redirigir al perfil correcto
        if (isset($_SESSION['perfil_usuario'])) {
            // Redirigimos al mismo perfil
            header("Location: " . URL_PROJECT . "/perfil/index/" . $_SESSION['perfil_usuario']);
            exit();
        } else {
            // Si no hay sesión de perfil, redirigimos al home
            header("Location: " . URL_PROJECT . "/home");
            exit();
        }
    }
    

}
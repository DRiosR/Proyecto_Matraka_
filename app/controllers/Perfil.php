<?php
class Perfil extends Controller
{
  public function __construct()
  {
    $this->perfil = $this->model('perfilUsuario');
    $this->usuario = $this->model('usuario');
    $this->publicaciones = $this->model('publicar');

  }

  public function index($user)
  {
    if (isset(($_SESSION['logueado']))) {
      $datosUsuario = $this->usuario->getUsuario($user);
      $datosPerfil = $this->usuario->getPerfil($datosUsuario->idusuario);
      $publicacionesUsuario = $this->perfil->obtenerPublicacionesPorUsuario($datosUsuario->idusuario);
      $comentarios = $this->publicaciones->getComentarios();
      $informacionComentarios = $this->publicaciones->getInformacionComentarios($comentarios);

      $datos = [
        'perfil' => $datosPerfil,
        'usuario' => $datosUsuario,
        'comentarios' => $informacionComentarios,
        'publicaciones' => $publicacionesUsuario
        
      ];

      $this->view('pages/perfil/perfil', $datos);
    }
  }

  public function cambiarImagen()
  {
    // Usamos la ruta relativa en lugar de una ruta absoluta para evitar problemas en Azure.
    $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/public/img/imagenesPerfil/';

    // Aseguramos que la carpeta exista y si no, la creamos
    if (!is_dir($carpeta)) {
      mkdir($carpeta, 0777, true);
    }

    // Definimos la ruta donde se almacenará la imagen
    $rutaImagen = 'img/imagenesPerfil/' . $_FILES['imagen']['name'];
    $ruta = $carpeta . $_FILES['imagen']['name'];

    // Movemos el archivo cargado a la carpeta de destino
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {

      // Obtenemos los datos para guardar en la base de datos
      $datos = [
        'idusuario' => trim($_POST['id_user']),
        'ruta' => $rutaImagen
      ];

      // Obtenemos la imagen actual del perfil y la eliminamos
      $imagenActual = $this->usuario->getPerfil($datos['idusuario']);
      if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $imagenActual->idFoto)) {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $imagenActual->idFoto);
      }

      // Actualizamos la foto en la base de datos
      if ($this->perfil->editarFoto($datos)) {
        $_SESSION['idFoto'] = $rutaImagen;
        redireccion('/home');
      } else {
        echo 'El perfil no se ha guardado';
      }
    } else {
      echo 'Error al cargar la imagen';
    }
  }
  
}



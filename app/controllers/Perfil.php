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

    $carpeta = 'C:/xampp/htdocs/Proyecto_Matraka/public/img/imagenesPerfil/';
    opendir($carpeta);
    $rutaImagen = 'img/imagenesPerfil/' . $_FILES['imagen']['name'];
    $ruta = $carpeta . $_FILES['imagen']['name'];
    copy($_FILES['imagen']['tmp_name'], $ruta);

    $datos = [
      'idusuario' => trim($_POST['id_user']),
      'ruta' => $rutaImagen
    ];

    $imagenActual = $this->usuario->getPerfil($datos['idusuario']);
    unlink('C:/xampp/htdocs/Proyecto_Matraka/public/' . $imagenActual->idFoto);

    $this->view('', $datos);
    if ($this->perfil->editarFoto($datos)) {
      $_SESSION['idFoto'] = $rutaImagen;

      redireccion('/home');
    } else {
      echo 'El prefil no se a guardado';
    }
  }
  
}



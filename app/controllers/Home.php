<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->usuario = $this->model('usuario');
        $this->publicaciones = $this->model('publicar');

    }

    public function index()
    {

        if (isset($_SESSION['logueado'])) {
            $datosUsuarios = $this->usuario->getUsuario($_SESSION['usuario']);
            $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);
            $datosPublicaciones = $this->publicaciones->getPublicaciones();

            $comentarios = $this->publicaciones->getComentarios();

            $informacionComentarios = $this->publicaciones->getInformacionComentarios($comentarios);

            $cantidadPublicaciones = $this->publicaciones->getCantidadPublicaciones($_SESSION['logueado']);

            if ($datosPerfil) {
                $datosRed = [
                    'usuario' => $datosUsuarios,
                    'perfil' => $datosPerfil,
                    'publicaciones' => $datosPublicaciones,
                    'comentarios' => $informacionComentarios,
                    'cantidadPublicaciones' => $cantidadPublicaciones
                ];

                $this->view('pages/home', $datosRed);
            } else {
                $this->view('pages/perfil/completarPerfil', $_SESSION['logueado']);

            }
        } else {
            redireccion('/home/login');
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datosLogin = [
                'usuario' => trim($_POST['usuario']),
                'contrasena' => trim($_POST['contrasena'])
            ];

            $datosUsuario = $this->usuario->getUsuario($datosLogin['usuario']);
            $datosPerfil = $this->usuario->getPerfil($datosUsuario->idusuario);
            if ($this->usuario->verificarContrasena($datosUsuario, $datosLogin['contrasena'])) {
                $_SESSION['logueado'] = $datosUsuario->idusuario;
                $_SESSION['usuario'] = $datosUsuario->usuario;
                $_SESSION['idFoto'] = $datosPerfil->idFoto;
                redireccion('/home');
            } else {
                $_SESSION['errorLogin'] = 'El usuario o contraseña son incorrectos';
                redireccion('/home');

            }

        } else {
            if (isset($_SESSION['logueado'])) {
                redireccion('/home');
            } else {
                $this->view('/pages/login-register/login');

            }
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datosRegistro = [
                'privilegio' => '2',
                'email' => trim($_POST['email']),
                'usuario' => trim($_POST['usuario']),
                'contrasena' => password_hash(trim($_POST['contrasena']), PASSWORD_DEFAULT),
            ];

            if ($this->usuario->verificarCorreo($datosRegistro)) {
                if ($this->usuario->verificarUsuario($datosRegistro)) {
                    if ($this->usuario->register($datosRegistro)) {
                        $_SESSION['loginComplete'] = 'El registro se a completado, ya puedes iniciar sesion';
                        redireccion('/home');
                    } else {
                    }
                } else {
                    $_SESSION['usuarioError'] = 'El usuario no esta disponible, intenta con otro usuario';
                    $this->view('/pages/login-register/register');
                }
            } else {
                $_SESSION['correoError'] = 'El Correo no esta disponible, intenta con otro usuario';
                $this->view('/pages/login-register/register');
            }

        } else {
            if (isset($_SESSION['logueado'])) {
                redireccion('/home');
            } else {
                $this->view('/pages/login-register/register');

            }
        }
    }

    public function insertarRegistrosPerfil()
    {
        // Define una carpeta dentro de tu proyecto en lugar de una ruta absoluta local.
        // En Azure, puedes guardar las imágenes en un directorio dentro de tu aplicación.
        $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/public/img/imagenesPerfil/';
    
        // Asegúrate de que la carpeta de destino exista.
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0777, true); // Crea la carpeta si no existe
        }
    
        // Define la ruta de la imagen en tu servidor, manteniendo la estructura de carpetas.
        $rutaImagen = 'img/imagenesPerfil/' . $_FILES['imagen']['name'];
        $ruta = $carpeta . $_FILES['imagen']['name'];
    
        // Mueve la imagen al directorio de destino
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
            $datos = [
                'idusuario' => trim($_POST['id_user']),
                'ruta' => $rutaImagen
            ];
    
            // Guarda la ruta en la base de datos
            if ($this->usuario->insertarPerfil($datos)) {
                $_SESSION['idFoto'] = $rutaImagen;
                redireccion('/home');
            } else {
                echo 'El perfil no se ha guardado correctamente';
            }
        } else {
            echo 'Error al cargar la imagen';
        }
    }
    

    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();

        redireccion('/home');
    }

    public function buscar()
    {
        if (isset($_SESSION['logueado'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $busqueda = '%' . trim($_GET['buscar']) . '%';                
                $datosBusqueda = $this->usuario->buscar($busqueda);
                $datosUsuarios = $this->usuario->getUsuario($_SESSION['usuario']);
                $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);

                if ($datosPerfil) {
                    $datosRed = [
                        'usuario' => $datosUsuarios,
                        'perfil' => $datosPerfil,
                        'resultado' => $datosBusqueda
                    ];
                }


                if ($datosBusqueda) {
                    $this->view('pages/busqueda/buscar' , $datosRed);
                } else {
                    redireccion('/home');
                }


            } else {
                redireccion('/home');
            }

        } else {
            redireccion('/home');
        }

    }
}
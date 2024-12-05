<?php

class Home extends Controller
{
    public $usuario;
    public $publicaciones;
    
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
                $_SESSION['privilegio'] = $datosUsuario->idPrivilegio;

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
        $carpeta = 'C:/xampp/htdocs/Proyecto_Matraka/public/img/imagenesPerfil/';
        opendir($carpeta);
        $rutaImagen = 'img/imagenesPerfil/' . $_FILES['imagen']['name'];
        $ruta = $carpeta . $_FILES['imagen']['name'];
        copy($_FILES['imagen']['tmp_name'], $ruta);

        $datos = [
            'idusuario' => trim($_POST['id_user']),
            'ruta' => $rutaImagen
        ];

        if ($this->usuario->insertarPerfil($datos)) {
            $_SESSION['idFoto'] = $rutaImagen;
            redireccion('/home');
        } else {
            echo 'El prefil no se a guardado';
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
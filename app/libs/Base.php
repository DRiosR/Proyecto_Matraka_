<?php
session_start();

class Base
{
    private $host = 'srvgossip.database.windows.net';  // Servidor en Azure
    private $dbname = 'bdGosssip';  // Nombre de la base de datos
    private $user = 'Rios@srvgossip';  // Nombre de usuario en formato correcto
    private $password = 'Moto030804';  // Contraseña

    private $dbh; // Conexión a la base de datos
    private $stmt; // Consultas
    private $error; // Manejo de errores

    public function __construct()
    {
        // DNS para conectarse con sqlsrv
        $dns = "sqlsrv:Server=" . $this->host . ";Database=" . $this->dbname;

        // Opciones de conexión
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Manejo de errores
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Formato de fetch
            PDO::SQLSRV_ATTR_ENCODING => PDO::SQLSRV_ENCODING_UTF8 // Codificación UTF-8
        ];


        $this->dbh = new PDO($dns, $this->user, $this->password, $options);

    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($parametro, $valor, $tipo = NULL)
    {
        if (is_null($tipo)) {
            switch (true) {
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                    break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                    break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                    break;
                default:
                    $tipo = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($parametro, $valor, $tipo);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function registers()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function register()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}

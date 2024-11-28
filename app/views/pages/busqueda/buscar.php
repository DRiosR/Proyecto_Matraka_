<?php
include_once URL_APP . '/views/custom/header.php';
include_once URL_APP . '/views/custom/navbar.php';
?>

<div class="container mt-5"> <!-- Ajuste aquí con `mt-5` para mayor separación -->
    <div class="container-notificaciones-usuario">
        <h4 class="text-center mb-4">Resultados de la Búsqueda</h4>
        <hr>

        <div class="lista-de-usuarios-registrados">
            <?php foreach ($datos['resultado'] as $usuariosRegistrados): ?>
                <div class="elemento-usuario-registrado">
                    <img src="<?php echo URL_PROJECT . '/' . $usuariosRegistrados->idFoto ?>" alt="Foto de usuario"
                        class="image-big-user">
                    <div class="nombre-usuario-registrado">
                        <strong><?php echo $usuariosRegistrados->usuario ?></strong>
                        <br>
                        <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $usuariosRegistrados->usuario?>" class="perfil-enlace">Ver perfil</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php
include_once URL_APP . '/views/custom/footer.php';
?>

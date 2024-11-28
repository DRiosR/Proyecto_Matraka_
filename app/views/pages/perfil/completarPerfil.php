<?php
include_once URL_APP . '/views/custom/header.php';
?>

<div class="completarPerfil">
    <div class="container">
        <div class="container-perfil">
            <h2 class="text-center">Completa tu perfil</h2>
            <h6 class="text-center">Antes de continuar deberás completar tu perfil</h6>
            <hr>
            <div class="content-completar-perfil center">
                <form action="<?php echo URL_PROJECT ?>/home/insertarRegistrosPerfil" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado'] ?>">
                
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="imagen" id="imagen" required>
                            <label class="custom-file-label" for="imagen">Seleccionar una foto</label>
                        </div>
                    </div>
                    <button class="btn-purple btn-block">Registrar datos</button>
                </form>
                <a href="<?php echo URL_PROJECT ?>/home/logout" class="btn btn-danger">Salir</a>

            </div>
        </div>
    </div>
</div>

<?php
include_once URL_APP . '/views/custom/footer.php';
?>
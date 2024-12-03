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
                <form action="<?php echo URL_PROJECT ?>/home/insertarRegistrosPerfil" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado'] ?>">

                    <!-- Vista previa de la foto -->
                    <div class="text-center mb-4">
                        <div class="preview-container">
                            <img id="preview-image" src="#" alt="Vista previa" class="preview-img">
                        </div>
                        <small class="form-text text-muted">Vista previa de la foto seleccionada</small>
                    </div>

                    <!-- Selección de la foto -->
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="imagen" id="imagen" required>
                            <label class="custom-file-label" for="imagen">Seleccionar una foto</label>
                        </div>
                    </div>

                    <!-- Términos y condiciones -->
                    <div class="terms-conditions mt-4"
                        style="border: 2px solid black; padding: 15px; max-height: 300px; overflow-y: auto;">
                        <h4 class="text-center">TÉRMINOS Y CONDICIONES DE USO</h4>
                        <p>
                            Bienvenido a nuestra plataforma. Antes de utilizar esta aplicación, lea detenidamente los
                            siguientes términos y condiciones.
                            Al aceptar estos términos, usted reconoce y se compromete a cumplir con ellos. Si no está de
                            acuerdo con alguna parte de estos términos, no podrá acceder a la aplicación.
                        </p>
                        <p><strong>1. Propósito de la aplicación</strong><br>
                            Esta plataforma está diseñada para que los usuarios puedan reportar actos de nepotismo o
                            corrupción relacionados con la institución UABC Ensenada o su personal.
                            Las publicaciones serán visibles públicamente con el objetivo de fomentar la transparencia y
                            la participación.
                        </p>
                        <p><strong>2. Reglas de uso</strong><br>
                            El usuario se compromete a publicar contenido veraz, relevante y respetuoso.
                            Está prohibido el uso de lenguaje ofensivo, difamatorio, o contenido que infrinja los
                            derechos de otras personas.
                            Las publicaciones deben estar relacionadas exclusivamente con actos de nepotismo o
                            corrupción en la institución UABC.
                            El uso indebido de la plataforma puede resultar en la suspensión o eliminación de su cuenta.
                        </p>
                        <p><strong>3. Publicidad de las publicaciones</strong><br>
                            Todas las publicaciones realizadas en la plataforma serán visibles para todos los usuarios.
                            Al realizar una publicación, usted acepta que el contenido será público y podrá ser
                            comentado o compartido por otros usuarios dentro de la plataforma.
                        </p>
                        <p><strong>4. Responsabilidad del usuario</strong><br>
                            El usuario asume total responsabilidad por el contenido publicado y por las consecuencias
                            legales derivadas de información falsa, inapropiada o que afecte negativamente a terceros.
                            La plataforma no será responsable de daños o perjuicios ocasionados por el uso de los datos
                            o publicaciones por parte de terceros.
                        </p>
                        <p><strong>5. Política de datos</strong><br>
                            Los datos personales proporcionados al registrarse serán utilizados únicamente para
                            administrar su cuenta.
                            La plataforma no compartirá su información personal con terceros sin su consentimiento,
                            excepto cuando sea requerido por ley.
                        </p>
                        <p><strong>6. Modificaciones</strong><br>
                            Nos reservamos el derecho de actualizar o modificar estos términos y condiciones en
                            cualquier momento. Cualquier cambio será comunicado a través de la plataforma, y su uso
                            continuado implicará la aceptación de los mismos.
                        </p>
                        <p><strong>7. Aceptación de los términos</strong><br>
                            Al marcar la casilla de verificación "He leído y acepto los términos y condiciones", usted
                            confirma haber leído, entendido y aceptado los presentes términos y condiciones.
                        </p>


                    </div>

                    <!-- Checkbox de aceptación -->
                    <div class="form-group d-flex align-items-center mt-3">
                        <input type="checkbox" id="accept-checkbox" style="margin-right: 10px;">
                        <label for="accept-checkbox" class="m-0">He leído y acepto los términos y condiciones</label>
                    </div>

                    <!-- Botón de registro -->
                    <button id="submit-button" type="submit" class="btn btn-purple btn-block" disabled>Registrar
                        datos</button>
                </form>
                <a href="<?php echo URL_PROJECT ?>/home/logout" class="btn btn-danger mt-3">Salir</a>
            </div>
        </div>
    </div>
</div>

<!-- Estilo -->
<style>
    .preview-container {
        position: relative;
        margin: auto;
        width: 150px;
        height: 150px;
        border: 2px solid #ddd;
        border-radius: 50%;
        overflow: hidden;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
        /* Ocultar hasta que se cargue una imagen */
    }
</style>

<script src="<?php echo URL_PROJECT; ?>/public/js/completarperfil.js"></script>

<?php
include_once URL_APP . '/views/custom/footer.php';
?>
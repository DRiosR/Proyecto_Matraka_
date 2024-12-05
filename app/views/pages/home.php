<?php
include_once URL_APP . '/views/custom/header.php';
include_once URL_APP . '/views/custom/navbar.php';

?>

<div class="container container_home">
    <div class="row">

        <!-- Profile Column -->
        <div class="col-md-3">
            <div class="card custom-profile-card text-center">
                <div class="custom-background-usuario"></div>
                <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->idFoto ?>"
                    class="rounded-circle custom-profile-image" alt="Profile Image">
                <div class="custom-card-body">
                    <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>"
                        class="text-decoration-none">
                        <h5 class="card-title"><?php echo $datos['usuario']->usuario; ?></h5>
                    </a>

                    <!-- División -->
                    <div class="custom-division-line"></div>

                    <!-- Estadísticas de publicaciones -->
                    <div class="custom-tabla-estadisticas">
                        <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>"
                            class="stats-text">
                            <span class="stats-number">
                                <?php echo isset($datos['cantidadPublicaciones']) ? $datos['cantidadPublicaciones'] : 0; ?>
                            </span>
                            Denuncias
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Column for Posting -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card mt-4">
                    <div class="card-body">
                        <form
                            action="<?php echo URL_PROJECT ?>/Publicaciones/publicar/<?php echo $datos['usuario']->idusuario ?>"
                            method="POST" enctype="multipart/form-data">
                            <div class="d-flex align-items-start mb-3 position-relative">
                                <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>">
                                    <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->idFoto ?>"
                                        class="rounded-circle me-3" alt="">
                                </a>
                                <textarea class="form-control" name="contenido" id="contenido"
                                    placeholder="Denuncia tu caso " required maxlength="2000"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = '¿Qué estás pensando?'"
                                    oninput="const texto = this.value; const charCount = texto.length; const wordCount = texto.trim().split(/\s+/).filter(w => w).length; document.getElementById('charCount').textContent = `${wordCount} palabras, ${charCount} / 2000 caracteres`;"></textarea>
                                <span id="charCount" class="char-count">0 palabras, 0 / 2000 caracteres</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="btn btn-light">
                                    <i class="fas fa-image"></i> Subir archivo
                                    <input type="file" name="imagen" id="imagen" hidden
                                        onchange="document.getElementById('nombreArchivo').textContent = this.files[0] ? this.files[0].name : ''; document.getElementById('quitarArchivo').style.display = this.files[0] ? 'inline-block' : 'none';">
                                </label>
                                <span id="nombreArchivo" class="file-name"></span>
                                <span id="quitarArchivo" class="remove-file-btn"
                                    onclick="document.getElementById('imagen').value = ''; document.getElementById('nombreArchivo').textContent = ''; this.style.display = 'none';">
                                    <span class="remove-icon">×</span>
                                </span>
                            </div>

                            <!-- Mensaje de advertencia y aceptación -->
                            <div class="form-group d-flex align-items-center mt-3">
                                <input type="checkbox" id="accept-checkbox" required style="margin-right: 10px;">
                                <label for="accept-checkbox" class="m-0">
                                    Soy consciente de que esta publicación puede hacer y que he leído y
                                    acepto los <a href="javascript:void(0);" id="terms-link"
                                        style="text-decoration: underline;">términos y condiciones</a>.
                                </label>
                            </div>

                            <!-- Botón de publicación -->
                            <button type="submit" class="btn btn-primary" id="submit-button" disabled>Publicar</button>
                        </form>

                        <!-- Modal de términos y condiciones -->
                        <div id="terms-modal"
                            style="display:none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5); z-index: 1000; padding-top: 50px;">
                            <div style="background: white; margin: auto; padding: 20px; width: 80%; max-width: 600px;">
                                <h4 class="text-center">TÉRMINOS Y CONDICIONES DE USO</h4>
                                <p>
                                    Recuerde que sus denuncias tienen un gran impacto y serán tomadas en cuenta. Si su
                                    denuncia está basada en hechos verídicos y no en difamación, su contribución será
                                    valiosa para la comunidad. Sin embargo, si se determina que su publicación tiene
                                    fines difamatorios o carece de fundamento, podrá ser sancionada de acuerdo con lo
                                    estipulado en los términos de uso.
                                </p>
                                <div class="terms-scroll">
                                    <p><strong>1. Propósito de la aplicación</strong><br>
                                        Esta plataforma está diseñada para que los usuarios puedan reportar actos de
                                        nepotismo o corrupción relacionados con la institución UABC Ensenada o su
                                        personal.
                                        Las publicaciones serán visibles públicamente con el objetivo de fomentar la
                                        transparencia y la participación.
                                    </p>
                                    <p><strong>2. Reglas de uso</strong><br>
                                        El usuario se compromete a publicar contenido veraz, relevante y respetuoso.
                                        Está prohibido el uso de lenguaje ofensivo, difamatorio, o contenido que
                                        infrinja los derechos de otras personas.
                                        Las publicaciones deben estar relacionadas exclusivamente con actos de nepotismo
                                        o corrupción en la institución UABC.
                                        El uso indebido de la plataforma puede resultar en la suspensión o eliminación
                                        de su cuenta.
                                    </p>
                                    <p><strong>3. Publicidad de las publicaciones</strong><br>
                                        Todas las publicaciones realizadas en la plataforma serán visibles para todos
                                        los usuarios.
                                        Al realizar una publicación, usted acepta que el contenido será público y podrá
                                        ser comentado o compartido por otros usuarios dentro de la plataforma.
                                    </p>
                                    <p><strong>4. Responsabilidad del usuario</strong><br>
                                        El usuario asume total responsabilidad por el contenido publicado y por las
                                        consecuencias legales derivadas de información falsa, inapropiada o que afecte
                                        negativamente a terceros.
                                        La plataforma no será responsable de daños o perjuicios ocasionados por el uso
                                        de los datos o publicaciones por parte de terceros.
                                    </p>
                                    <p><strong>5. Política de datos</strong><br>
                                        Los datos personales proporcionados al registrarse serán utilizados únicamente
                                        para administrar su cuenta.
                                        La plataforma no compartirá su información personal con terceros sin su
                                        consentimiento, excepto cuando sea requerido por ley.
                                    </p>
                                    <p><strong>6. Modificaciones</strong><br>
                                        Nos reservamos el derecho de actualizar o modificar estos términos y condiciones
                                        en cualquier momento. Cualquier cambio será comunicado a través de la
                                        plataforma, y su uso continuado implicará la aceptación de los mismos.
                                    </p>
                                    <p><strong>7. Aceptación de los términos</strong><br>
                                        Al marcar la casilla de verificación "He leído y acepto los términos y
                                        condiciones", usted confirma haber leído, entendido y aceptado los presentes
                                        términos y condiciones.
                                    </p>
                                </div>


                                <button onclick="closeTermsModal()" class="btn btn-secondary">Cerrar</button>
                            </div>
                        </div>

                    </div>
                </div>

                <?php
                // Ordenar las publicaciones por fecha, de más reciente a más antigua
                usort($datos['publicaciones'], function ($a, $b) {
                    return strtotime($b->fechaPublicacion) - strtotime($a->fechaPublicacion);
                });
                ?>
</div>
                <?php foreach ($datos['publicaciones'] as $datosPublicacion): ?>
                    <div class="container-usuarios-publicaciones">


                        <!-- Sección de información del usuario -->
                        <div class="usuario-publicaciones-top"
                            style="display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center;">
                                <img src="<?php echo URL_PROJECT . '/' . $datosPublicacion->idFoto ?>" alt=""
                                    class="image-border"
                                    style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; border-radius: 50%;">

                                <div class="informacion-usuario-publico">
                                    <h6 class="mb-0" style="margin: 0;">
                                        <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datosPublicacion->usuario ?>"
                                            style="text-decoration: none; color: #333;">
                                            <?php echo ucwords($datosPublicacion->usuario) ?>
                                        </a>
                                    </h6>
                                </div>
                            </div>

                            <span style="color: #888; font-size: 0.9em;">
                                <?php
                                $fecha = new DateTime($datosPublicacion->fechaPublicacion);
                                echo $fecha->format('Y-m-d H:i'); // Año-mes-día Hora:minuto
                                ?>
                            </span>

                        </div>

                        <!-- Contenido de la publicación -->
                        <div class="contenido-publicacion-usuario"
                            style="margin-top: 10px; padding: 10px; background-color: #ffffff; border: 1px solid #dcdcdc; border-radius: 8px; text-align: justify;">
                            <p class="mb-1"
                                style="margin: 0; color: #333; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
                                <?php echo $datosPublicacion->contenidoPublicacion ?>
                            </p>

                            <?php if (!empty($datosPublicacion->fotoPublicacion)): ?>
                                <img src="<?php echo URL_PROJECT . '/' . $datosPublicacion->fotoPublicacion ?>" alt=""
                                    class="imagen-publicacion-usuario"
                                    style="max-width: 100%; max-height: 500px; width: auto; height: auto; border-radius: 8px; margin-top: 10px;">
                            <?php endif; ?>
                        </div>
                        <!-- Estado de la publicación -->
                        <div class="estado-publicacion" style="margin-top: 10px;">
                            <span class="badge" id="estadoPublicacion" style="background-color: 
        <?php
        // Convertir a minúsculas para comparación
        $estado = strtolower(trim($datosPublicacion->estadoPublicacion));
        if ($estado === 'sin revision') {
            echo '#f8a400'; // Naranja suave
        } elseif ($estado === 'en revision') {
            echo '#5bc0de'; // Azul suave
        } elseif ($estado === 'revisado') {
            echo '#28a745'; // Verde suave
        } else {
            echo '#6c757d'; // Gris claro
        }
        ?>; color: white;">
                                <?php echo ucwords(str_replace('_', ' ', $datosPublicacion->estadoPublicacion)); ?>
                            </span>
                        </div>

                        <!-- Cambiar Estado de la Publicación -->
                        <?php if (isset($_SESSION['privilegio']) && $_SESSION['privilegio'] == 1): ?>
                            <div class="cambiar-estado" style="margin-top: 10px;">
                                <form action="<?php echo URL_PROJECT ?>/publicaciones/cambiarEstado" method="POST">
                                    <input type="hidden" name="id_publicacion"
                                        value="<?php echo $datosPublicacion->idpublicacion; ?>">
                                    <select name="nuevo_estado" class="form-select" onchange="this.form.submit();">
                                        <option value="sin revision" <?php echo (strtolower(trim($datosPublicacion->estadoPublicacion)) === 'sin revision') ? 'selected' : ''; ?>>Sin Revisión</option>
                                        <option value="en revision" <?php echo (strtolower(trim($datosPublicacion->estadoPublicacion)) === 'en revision') ? 'selected' : ''; ?>>En Revisión</option>
                                        <option value="revisado" <?php echo (strtolower(trim($datosPublicacion->estadoPublicacion)) === 'revisado') ? 'selected' : ''; ?>>Revisado</option>
                                    </select>
                                </form>
                            </div>
                        <?php endif; ?>



                        <!-- Hacer comenatarios de Publicaciones -->
                        <div class="acciones-comentarios">
                            <!-- Formulario de comentarios -->
                            <div class="formulario-comentarios">
                                <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->idFoto ?>" alt=""
                                    class="image-border rounded-circle">
                                <form action="<?php echo URL_PROJECT ?>/publicaciones/comentar" method="POST">
                                    <input type="hidden" name="iduser" value="<?php echo $datos['usuario']->idusuario ?>">
                                    <input type="hidden" name="idpublicacion"
                                        value="<?php echo $datosPublicacion->idpublicacion ?>">

                                    <textarea class="form-comentario-usuario" name="comentario"
                                        placeholder="Si te ha pasado algo similar, comenta y apoya la denuncia compartiendo tu experiencia."
                                        required></textarea>
                                    <button class="btn btn-purple" type="submit">Comentar</button>
                                </form>
                            </div>

                            <!-- Botón de eliminar (solo para el propietario de la publicación) -->
                            <?php if ($datosPublicacion->idusuario == $_SESSION['logueado']): ?>
                                <div class="acciones-publicacion-usuario">
                                    <a href="<?php echo URL_PROJECT ?>/publicaciones/eliminar/<?php echo $datosPublicacion->idpublicacion ?>"
                                        class="eliminar-icono-comentar">
                                        <i class="far fa-trash-alt"></i> Eliminar
                                    </a>
                                </div>
                            <?php endif ?>
                        </div>

                        <?php

                        // Organizar los comentarios por fecha
                        usort($datos['comentarios'], function ($a, $b) {
                            return strtotime($b->fechaComentario) - strtotime($a->fechaComentario);
                        });

                        // Agrupar comentarios por publicación
                        $comentariosPorPublicacion = [];
                        foreach ($datos['comentarios'] as $datosComentarios) {
                            if ($datosComentarios->idPublicacion == $datosPublicacion->idpublicacion) {
                                $comentariosPorPublicacion[] = $datosComentarios;
                            }
                        }

                        // Verificar si hay más de 3 comentarios
                        $hayMasDeTresComentarios = count($comentariosPorPublicacion) > 3;
                        ?>


                        <!-- Cada publicación tiene su propio bloque de comentarios -->
                        <div id="comentarios_<?php echo $datosPublicacion->idpublicacion; ?>">
                            <?php if (count($comentariosPorPublicacion) > 0): ?>
                                <!-- Botón Mostrar/Ocultar Comentarios -->
                                <button id="mostrarComentariosBtn_<?php echo $datosPublicacion->idpublicacion; ?>"
                                    onclick="toggleComentarios(<?php echo $datosPublicacion->idpublicacion; ?>)">
                                    Mostrar comentarios
                                </button>
                            <?php endif; ?>

                            <div id="comentariosContenedor_<?php echo $datosPublicacion->idpublicacion; ?>"
                                style="display: none;">
                                <?php
                                // Mostrar solo los primeros 3 comentarios inicialmente
                                $comentariosVisibles = array_slice($comentariosPorPublicacion, 0, 3);
                                foreach ($comentariosVisibles as $datosComentarios): ?>
                                    <div class="comentario">
                                        <div class="comentario-header">
                                            <img src="<?php echo URL_PROJECT . '/' . $datosComentarios->idFoto; ?>"
                                                alt="Imagen de perfil">
                                            <div class="comentario-info">
                                                <a
                                                    href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datosComentarios->usuario; ?>">
                                                    <?php echo htmlspecialchars($datosComentarios->usuario); ?>
                                                </a>
                                                <span><?php echo date("Y-m-d H:i:s", strtotime($datosComentarios->fechaComentario)); ?></span>
                                                <?php if ($datosComentarios->iduser == $_SESSION['logueado']): ?>
                                                    <a href="<?php echo URL_PROJECT ?>/publicaciones/eliminarComentario/<?php echo $datosComentarios->idcomentario; ?>"
                                                        class="eliminar-icono">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>

                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="comentario-texto">
                                            <strong>Comentario</strong>
                                            <div>
                                                <?php echo htmlspecialchars($datosComentarios->contenidoComentario); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Contenedor para los comentarios adicionales que se mostrarán cuando se presione el botón -->
                                <div id="comentariosAdicionales_<?php echo $datosPublicacion->idpublicacion; ?>"
                                    style="display: none;">
                                    <?php
                                    // Mostrar los comentarios restantes
                                    $comentariosRestantes = array_slice($comentariosPorPublicacion, 3);
                                    foreach ($comentariosRestantes as $comentarioRestante): ?>
                                        <div class="comentario">
                                            <div class="comentario-header">
                                                <img src="<?php echo URL_PROJECT . '/' . $comentarioRestante->idFoto; ?>"
                                                    alt="Imagen de perfil">
                                                <div class="comentario-info">
                                                    <a
                                                        href="<?php echo URL_PROJECT ?>/perfil/<?php echo $comentarioRestante->usuario; ?>">
                                                        <?php echo htmlspecialchars($comentarioRestante->usuario); ?>
                                                    </a>
                                                    <span><?php echo date("Y-m-d H:i:s", strtotime($comentarioRestante->fechaComentario)); ?></span>
                                                    <?php if ($comentarioRestante->iduser == $_SESSION['logueado']): ?>
                                                        <a href="<?php echo URL_PROJECT ?>/publicaciones/eliminarComentario/<?php echo $comentarioRestante->idcomentario ?>"
                                                            class="eliminar-icono">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    <?php endif ?>
                                                </div>
                                            </div>

                                            <div class="comentario-texto">
                                                <strong>Comentario</strong>
                                                <div>
                                                    <?php echo htmlspecialchars($comentarioRestante->contenidoComentario); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Botón para mostrar más comentarios -->
                                <?php if ($hayMasDeTresComentarios): ?>
                                    <button id="verMasBtn_<?php echo $datosPublicacion->idpublicacion; ?>"
                                        onclick="mostrarMasComentarios(<?php echo $datosPublicacion->idpublicacion; ?>)">
                                        Mostrar más comentarios
                                    </button>

                                    <!-- Botón para mostrar menos comentarios -->
                                    <button id="mostrarMenosBtn_<?php echo $datosPublicacion->idpublicacion; ?>"
                                        onclick="mostrarMenosComentarios(<?php echo $datosPublicacion->idpublicacion; ?>)"
                                        style="display: none;">
                                        Mostrar menos comentarios
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                <?php endforeach ?>

            </div>
        </div>


        <!-- Extra Column (Events or Additional Content) -->
        <div class="col-md-3">
            <div class="">
                                    
            </div>
        </div>
    </div>
</div>


<script src="<?php echo URL_PROJECT; ?>/public/js/comentarios.js"></script>
<script src="<?php echo URL_PROJECT; ?>/public/js/Publicar.js"></script>


<?php
include_once URL_APP . '/views/custom/footer.php';
?>
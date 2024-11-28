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
                        <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>" class="stats-text">
                            <span class="stats-number">
                                <?php echo isset($datos['cantidadPublicaciones']) ? $datos['cantidadPublicaciones'] : 0; ?>
                            </span>
                            Publicaciones
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
                                    placeholder="¿Comenta lo que viste?" required maxlength="2000"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = '¿Qué estás pensando?'"
                                    oninput="const texto = this.value; const charCount = texto.length; const wordCount = texto.trim().split(/\s+/).filter(w => w).length; document.getElementById('charCount').textContent = `${wordCount} palabras, ${charCount} / 2000 caracteres`;"></textarea>
                                <span id="charCount" class="char-count">0 palabras, 0 / 2000 caracteres</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
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
                                <button type="submit" class="btn btn-primary">Publicar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                // Ordenar las publicaciones por fecha, de más reciente a más antigua
                usort($datos['publicaciones'], function ($a, $b) {
                    return strtotime($b->fechaPublicacion) - strtotime($a->fechaPublicacion);
                });
                ?>

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

                            <span
                                style="color: #888; font-size: 0.9em;"><?php echo $datosPublicacion->fechaPublicacion ?></span>
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
                                        placeholder="Agregar un comentario" required></textarea>
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


<?php
include_once URL_APP . '/views/custom/footer.php';
?>
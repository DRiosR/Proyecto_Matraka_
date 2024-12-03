<?php

include_once URL_APP . '/views/custom/header.php';
include_once URL_APP . '/views/custom/navbar.php';
?>


<div class="perfil-container-usuario">
    <div class="imagen-header-perfil-usuario">
        <img src="<?php echo URL_PROJECT ?>/img/imagen_de_fondo.jpg" class="imagen-portada-perfil" alt="">
    </div>
    <div class="container-header-usuario">
        <div class="container">
            <div class="row">
                <!-- Columna de la foto de perfil -->
                <div class="col-md-4">
                    <div class="datos-perfil-usuario">
                        <img src="<?php echo URL_PROJECT ?>/<?php echo $datos['perfil']->idFoto ?>"
                            class="imagen-perfil-usuario" alt="">
                        <?php if ($datos['usuario']->idusuario == $_SESSION['logueado']): ?>
                            <div class="imagen-perfil-cambiar">
                                <form action="<?php echo URL_PROJECT ?>/perfil/cambiarImagen" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="input-file">
                                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado'] ?>">
                                        <input type="file" name="imagen" id="imagen" accept="image/*" style="display: none;"
                                            onchange="this.form.submit()">
                                        <button type="button" class="btn-change-image"
                                            onclick="document.getElementById('imagen').click();">Editar</button>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                        <div class="datos-personales-usuario">
                            <h3><?php echo ucwords($datos['usuario']->usuario) ?></h3>

                        </div>
                    </div>
                </div>

                <!-- Columna del formulario de publicación -->
                <?php if ($datos['usuario']->idusuario == $_SESSION['logueado']): ?>
                    <div class="col-md-8">
                        <div class="card mt-4-post">
                            <div class="card-body-post">
                                <form
                                    action="<?php echo URL_PROJECT ?>/Publicaciones/publicar/<?php echo $datos['usuario']->idusuario ?>"
                                    method="POST" enctype="multipart/form-data">
                                    <div class="d-flex align-items-start mb-3 position-relative">
                                        <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>">
                                            <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->idFoto ?>"
                                                class="rounded-circle me-3 post-avatar" alt="">
                                        </a>
                                        <textarea class="form-control post-textarea custom-textarea" name="contenido"
                                            id="contenido" placeholder="¿Comenta lo que viste?" required maxlength="2000"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = '¿Qué estás pensando?'"
                                            oninput="const texto = this.value; const charCount = texto.length; const wordCount = texto.trim().split(/\s+/).filter(w => w).length; document.getElementById('charCount').textContent = `${wordCount} palabras, ${charCount} / 2000 caracteres`;"></textarea>
                                        <span id="charCount" class="post-char-count">0 palabras, 0 / 2000 caracteres</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="btn btn-light post-upload-btn">
                                            <i class="fas fa-image"></i> Subir archivo
                                            <input type="file" name="imagen" id="imagen" hidden
                                                onchange="document.getElementById('nombreArchivo').textContent = this.files[0] ? this.files[0].name : ''; document.getElementById('quitarArchivo').style.display = this.files[0] ? 'inline-block' : 'none';">
                                        </label>
                                        <span id="nombreArchivo" class="post-file-name"></span>
                                        <span id="quitarArchivo" class="post-remove-file-btn"
                                            onclick="document.getElementById('imagen').value = ''; document.getElementById('nombreArchivo').textContent = ''; this.style.display = 'none';">
                                            <span class="remove-icon">×</span>
                                        </span>
                                        <button type="submit" class="btn btn-primary post-submit-btn">Publicar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>




            </div>
        </div>
    </div>
</div>

<div class="col-md-6-perfil">
    <div class="card mb-3">
        <?php
        // Ordenar las publicaciones por fecha, de más reciente a más antigua
        usort($datos['publicaciones'], function ($a, $b) {
            return strtotime($b->fechaPublicacion) - strtotime($a->fechaPublicacion);
        });
        ?>

        <?php if (count($datos['publicaciones']) > 0): ?>
            <?php foreach ($datos['publicaciones'] as $datosPublicacion): ?>
                <div class="container-usuarios-publicaciones">

                    <!-- Sección de información del usuario -->
                    <div class="usuario-publicaciones-top"
                        style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center;">
                            <img src="<?php echo URL_PROJECT . '/' . $datosPublicacion->idFoto ?>" alt="" class="image-border"
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
                        <span style="color: #888; font-size: 0.9em;"><?php echo $datosPublicacion->fechaPublicacion ?></span>
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
                                <input type="hidden" name="id_publicacion" value="<?php echo $datosPublicacion->idpublicacion; ?>">
                                <select name="nuevo_estado" class="form-select" onchange="this.form.submit();">
                                    <option value="sin revision" <?php echo (strtolower(trim($datosPublicacion->estadoPublicacion)) === 'sin revision') ? 'selected' : ''; ?>>Sin Revisión</option>
                                    <option value="en revision" <?php echo (strtolower(trim($datosPublicacion->estadoPublicacion)) === 'en revision') ? 'selected' : ''; ?>>En Revisión</option>
                                    <option value="revisado" <?php echo (strtolower(trim($datosPublicacion->estadoPublicacion)) === 'revisado') ? 'selected' : ''; ?>>
                                        Revisada</option>
                                </select>
                            </form>
                        </div>
                    <?php endif; ?>


                    <!-- Hacer comentarios de Publicaciones -->
                    <div class="acciones-comentarios">
                        <div class="formulario-comentarios">
                            <!-- Mostrar foto del usuario logueado -->
                            <?php if (isset($_SESSION['idFoto']) && !empty($_SESSION['idFoto'])): ?>
                                <img src="<?php echo URL_PROJECT . '/' . $_SESSION['idFoto']; ?>" alt="Imagen de perfil"
                                    class="image-border rounded-circle">
                            <?php else: ?>
                                <!-- Si no tiene foto, mostrar una imagen predeterminada -->
                                <img src="<?php echo URL_PROJECT; ?>/path/to/default/image.jpg"
                                    alt="Imagen de perfil predeterminada" class="image-border rounded-circle">
                            <?php endif; ?>

                            <form action="<?php echo URL_PROJECT ?>/publicaciones/comentar" method="POST">
                                <input type="hidden" name="iduser" value="<?php echo $_SESSION['logueado']; ?>">
                                <input type="hidden" name="idpublicacion"
                                    value="<?php echo $datosPublicacion->idpublicacion ?>">
                                <textarea class="form-comentario-usuario" name="comentario" placeholder="Agregar un comentario"
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

                    <div id="comentarios_<?php echo $datosPublicacion->idpublicacion; ?>">
                        <?php if (count($comentariosPorPublicacion) > 0): ?>
                            <button id="mostrarComentariosBtn_<?php echo $datosPublicacion->idpublicacion; ?>"
                                onclick="toggleComentarios(<?php echo $datosPublicacion->idpublicacion; ?>)">
                                Mostrar comentarios
                            </button>
                        <?php endif; ?>

                        <div id="comentariosContenedor_<?php echo $datosPublicacion->idpublicacion; ?>" style="display: none;">
                            <?php
                            // Mostrar solo los primeros 3 comentarios inicialmente
                            $comentariosVisibles = array_slice($comentariosPorPublicacion, 0, 3);
                            foreach ($comentariosVisibles as $datosComentarios): ?>
                                <div class="comentario">
                                    <div class="comentario-header">
                                        <img src="<?php echo URL_PROJECT . '/' . $datosComentarios->idFoto; ?>"
                                            alt="Imagen de perfil">
                                        <div class="comentario-info">
                                            <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datosComentarios->usuario; ?>">
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
                                                    <a href="<?php echo URL_PROJECT ?>/publicaciones/eliminarComentario/<?php echo $comentarioRestante->idcomentario; ?>"
                                                        class="eliminar-icono">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                <?php endif; ?>
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

                            <?php if ($hayMasDeTresComentarios): ?>
                                <button id="verMasBtn_<?php echo $datosPublicacion->idpublicacion; ?>"
                                    onclick="mostrarMasComentarios(<?php echo $datosPublicacion->idpublicacion; ?>)"
                                    style="display: block;">
                                    Ver más comentarios
                                </button>
                                <button id="mostrarMenosBtn_<?php echo $datosPublicacion->idpublicacion; ?>"
                                    onclick="mostrarMenosComentarios(<?php echo $datosPublicacion->idpublicacion; ?>)"
                                    style="display: none;">
                                    Ver menos comentarios
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>

            <p class="no-posts">No se encontraron publicaciones de este usuario.</p>
            <style>
                .no-posts {
                    text-align: center;
                    /* Centra el texto */
                    font-size: 1.2rem;
                    /* Tamaño de fuente un poco más grande */
                    color: #555;
                    /* Color de texto gris suave */
                    background-color: #85c1e9;
                    /* Fondo gris claro */
                    padding: 15px;
                    /* Espaciado alrededor del texto */
                    border-radius: 8px;
                    /* Bordes redondeados */
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    /* Sombra sutil */
                    max-width: 600px;
                    /* Ancho máximo para que no se extienda demasiado */
                    margin: 20px auto;
                    /* Centrar el bloque en la página */
                    font-family: 'Arial', sans-serif;
                    /* Tipografía clara y moderna */
                }
            </style>
        <?php endif; ?>
    </div>
</div>


<script src="<?php echo URL_PROJECT; ?>/public/js/comentarios.js"></script>

<?php

include_once URL_APP . '/views/custom/footer.php';

?>
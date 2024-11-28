<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <!-- Logo de la marca -->
      <a class="navbar-brand" href="<?php echo URL_PROJECT ?>/home">
        <img src="<?php echo URL_PROJECT ?>/img/gPP.png" height="30" alt="Logo" loading="lazy" />
      </a>

      <!-- Botón de toggle para vista móvil -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <!-- Contenedor colapsable -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Enlaces a la izquierda -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo URL_PROJECT ?>/home">Home</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Noticias</a>
          </li> -->
          <!-- <li class="nav-item">
          <a class="nav-link" href="#">Movies</a>
        </li> -->
        </ul>

        <!-- Formulario de búsqueda -->
        <form action="<?php echo URL_PROJECT ?>/home/buscar" method="GET" class="d-flex input-group w-auto">
          <input name="buscar" type="search" class="form-control" placeholder="Buscar Usuario" aria-label="Search" />
          <button class="btn btn-outline-primary" type="submit" style="padding: .45rem 1.5rem .35rem;">
            Buscar
          </button>
        </form>

        <!-- Menú de perfil con imagen y opción de Salir -->
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">

              <!-- Verifica si la foto del usuario logueado está almacenada en la sesión -->
              <?php if (isset($_SESSION['idFoto']) && !empty($_SESSION['idFoto'])): ?>
                <img src="<?php echo URL_PROJECT . '/' . $_SESSION['idFoto']; ?>" alt="Imagen de perfil"
                  class="image-border rounded-circle" style="width: 30px; height: 30px;">
              <?php else: ?>
                <!-- Si no tiene foto, mostrar imagen predeterminada -->
                <img src="<?php echo URL_PROJECT; ?>/path/to/default/image.jpg" alt="Imagen de perfil predeterminada"
                  class="image-border rounded-circle" style="width: 30px; height: 30px;">
              <?php endif; ?>

            </a>

            <ul class="dropdown-menu dropdown-menu-end p-1" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item"
                  href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>">Mi Perfil</a></li>
              <!-- <li><a class="dropdown-item" href="#">Settings</a></li> -->
              <li><a class="dropdown-item" href="<?php echo URL_PROJECT; ?>/home/logout">Salir</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Fin del Navbar -->

  <!-- Font Awesome para los íconos -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
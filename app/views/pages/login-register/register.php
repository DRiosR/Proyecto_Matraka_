<?php

include_once URL_APP . '/views/custom/header.php';


?>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <a class="registro underlineHover" href="<?php echo URL_PROJECT ?>/home/login"> Iniciar Sesion </a>
    <h2 class="active">Registrarte </h2>
    <!-- Alerta de usuario repetido -->
    <?php if (isset($_SESSION['usuarioError'])): ?>
      <div class="alert alert-warning alert-dismissible fade show " role="alert">
        <?php echo $_SESSION['usuarioError'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset($_SESSION['usuarioError']); endif ?>
    <!-- Alerta de correo repetido -->
    <?php if (isset($_SESSION['correoError'])): ?>
      <div class="alert alert-warning alert-dismissible fade show " role="alert">
        <?php echo $_SESSION['correoError'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset($_SESSION['correoError']); endif ?>
    <!-- Icon -->
    <div class="fadeIn first">
      <img src="https://cdn.computerhoy.com/sites/navi.axelspringer.es/public/media/image/2019/02/inc.jpg?tf=1200x900"
        id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action=" <?php echo URL_PROJECT ?>/home/register" method="POST">
      <input type="email" pattern=".+@uabc.edu.mx" id="email" class="fadeIn second textbox" name="email" placeholder="example@uabc.edu.mx" required>
      <input type="text" id="Usuario" class="fadeIn third" name="usuario" placeholder="Usuario Anonimo" required>
      <input type="password" id="password" class="fadeIn fourth" name="contrasena" placeholder="Contraseña" required>
      <input type="submit" class="fadeIn five" value="Registrate">
    </form>
  

  </div>
</div>

<?php

include_once URL_APP . '/views/custom/footer.php';

?>
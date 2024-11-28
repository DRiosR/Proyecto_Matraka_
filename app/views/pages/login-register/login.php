<?php

include_once URL_APP . '/views/custom/header.php';

?>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Iniciar Sesion </h2>
    <a class="registro underlineHover" href="<?php echo URL_PROJECT?>/home/register"> Registrarte </a>
       <!-- Alerta de error en login -->
    <?php if (isset($_SESSION['errorLogin'])): ?>
      <div class="alert alert-danger alert-dismissible fade show " role="alert">
        <?php echo $_SESSION['errorLogin'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset($_SESSION['errorLogin']); endif ?>
    <!-- Alerta de sesion exitosa -->
    <?php if (isset($_SESSION['loginComplete'])): ?>
      <div class="alert alert-success alert-dismissible fade show " role="alert">
        <?php echo $_SESSION['loginComplete'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset($_SESSION['loginComplete']); endif ?>
    <!-- Icon -->
    <div class="fadeIn first">
      <img src="https://cdn-icons-png.freepik.com/512/6463/6463397.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action=" <?php echo URL_PROJECT ?>/home/login" method="POST">
      <input type="text" id="usuario" class="fadeIn second" name="usuario" placeholder="Usuario" required>
      <input type="password" id="contrasena" class="fadeIn third" name="contrasena" placeholder="Contraseña" required>
      <input type="submit" class="fadeIn fourth" value="Iniciar Sesion">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <!-- <a class="underlineHover" href="#">Olvidaste tu Contraseña?</a> -->
    </div>

  </div>

</div>
<?

include_once URL_APP . '/views/custom/footer.php';

?>
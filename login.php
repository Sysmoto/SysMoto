<?php 

require_once 'funciones/conexion.php';
$MiConexion=ConexionBD();

$Mensaje='';
if (!empty($_POST['BotonLogin'])) {

    require_once 'funciones/login.php';
    $UsuarioLogueado = DatosLogin($_POST['username'], $_POST['password'], $MiConexion);

    //la consulta con la BD para que encuentre un usuario registrado con el usuario y clave brindados
    if ( !empty($UsuarioLogueado)) {
       // $Mensaje ='ok! ya puedes ingresar';
        session_start();
      //print_r($_SESSION);
       //generar los valores del usuario (esto va a venir de mi BD)
       $_SESSION['ID']     =   $UsuarioLogueado['IdUsuario'];
       $_SESSION['Usuario']     =   $UsuarioLogueado['USUARIO'];
        $_SESSION['Usuario_Nombre']     =   $UsuarioLogueado['NOMBRE'];
        $_SESSION['Usuario_Apellido']   =   $UsuarioLogueado['APELLIDO'];
        $_SESSION['Usuario_Nivel']      =   $UsuarioLogueado['NIVEL'];
         $_SESSION['Usuario_Nivel_Id']      =   $UsuarioLogueado['IDNIVEL'];
        $_SESSION['Usuario_Img']        =   $UsuarioLogueado['IMAGEN'];
        $_SESSION['Usuario_Saludo']        =   $UsuarioLogueado['SALUDO'];
        $_SESSION['Usuario_Email']        =   $UsuarioLogueado['EMAIL'];
        if ($UsuarioLogueado['ACTIVO']==0) {
            $Mensaje ='Ud. no se encuentra activo en el sistema.';
        }else {
            header('Location: index.php');
            exit;
        }

    }else {
        $Mensaje='Datos incorrectos, ingresa nuevamente.';
    }

}
?>

<!DOCTYPE html>


<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/sysmoto_v0/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>SysMoto - Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/sysmoto_v0/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/sysmoto_v0/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/sysmoto_v0/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/sysmoto_v0/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/sysmoto_v0/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/sysmoto_v0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/sysmoto_v0/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="/sysmoto_v0/assets/vendor/js/helpers.js"></script>

    
    <script src="/sysmoto_v0/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                  <img src="/sysmoto_v0/assets/img/logo/logo2.png"  width="70%" height="70%">
                      
                      <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                          <g id="Icon" transform="translate(27.000000, 15.000000)">
                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                              <mask id="mask-2" fill="white">
                                <use xlink:href="#path-1"></use>
                              </mask>
                              <use fill="#696cff" xlink:href="#path-1"></use>
                              <g id="Path-3" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-3"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                              </g>
                              <g id="Path-4" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-4"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                              </g>
                            </g>
                            <g
                              id="Triangle"
                              transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                            >
                              <use fill="#696cff" xlink:href="#path-5"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </span>
                  
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">¡Bienvenido a SysMoto!</h4>
              <p class="mb-4">El sistema del motoquero</p>

              <form id="formAuthentication" class="mb-3" method="POST">
              <?php 
              
              if (!empty ($Mensaje)) { ?>
              <div class="alert alert-warning alert-dismissable">
                  <?php echo $Mensaje ; ?>
              </div>
              <?php } ?>
              
                <div class="mb-3">
                  <label for="email" class="form-label">Usuario</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="username"
                    placeholder="Use su usuario"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Contraseña</label>
                    
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit" value="Login" name="BotonLogin" >Ingresar</button>
                </div>
              </form>

              
            </div>
          </div> <div class="buy-now">
     <div class="btn btn-danger btn-buy-now">Autores: Benitez.Bonamino.Reverdito</div>
    </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->
   
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/sysmoto_v0/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/sysmoto_v0/assets/vendor/libs/popper/popper.js"></script>
    <script src="/sysmoto_v0/assets/vendor/js/bootstrap.js"></script>
    <script src="/sysmoto_v0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/sysmoto_v0/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/sysmoto_v0/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>

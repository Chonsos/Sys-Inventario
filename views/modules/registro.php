<?php

if (isset($_SESSION["usuarioRol"]) && isset($_SESSION["sesionIniciada"])) {
   if ($_SESSION["sesionIniciada"]) {
      if ($_SESSION["usuarioRol"] == 'admin') {
         // echo 'bggggggg';
      } else if ($_SESSION["usuarioRol"] == 'registrador') {
         echo '<script>
		  window.location.href = "accesoDenegadoRegistroUsuarios";
		</script>';
      }
   } else {
      echo '<script>
	   window.location.href = "ingresar";
	 </script>';
   }
} else {
   echo '<script>
	   window.location.href = "ingresar";
	 </script>';
}

$registrarUsuario = new MvcController();
$registrarUsuario->registroUsuarioController();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Registro</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <!-- <link rel="icon" href="images/fevicon.png" type="image/png" /> -->
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="css/style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="css/responsive.css" />
   <!-- color css -->
   <link rel="stylesheet" href="../../css/color_2.css" />
   <!-- select bootstrap -->
   <link rel="stylesheet" href="css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="css/perfect-scrollbar.css" />
   <!-- custom css -->
   <!-- <link rel="stylesheet" href="css/custom.css" /> -->
   <!-- calendar file css -->
   <!-- <link rel="stylesheet" href="js/semantic.min.css" /> -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="inner_page login">
   <?php include "navegacion.php"; ?>
   <div id="content">
      <div class="topbar">
         <nav class="navbar navbar-expand-lg navbar-light">
            <div class="full">
               <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
               <div class="logo_section">
                  <img class="img-responsive" src="images/logo/cleanLogo.png" alt="#" />
               </div>
               <div class="right_topbar">
                  <div class="icon_info">
                     <a style="color: white; position:absolute; top: 20px; right: 30px;" href="salir"><i class="fa fa-sign-out"></i></a>
                  </div>
               </div>
            </div>
         </nav>
      </div>
      <div class="full_container">

         <div class="container">
            <div class="center verticle_center full_height">

               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" style="object-fit: cover;" src="images/logo/cleanLogo.png" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     <form method="post">
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Usuario:</label>
                              <input type="text" class="usernameValidation" name="nombre" />
                           </div>
                           <div class="field">
                              <label class="label_field">Contraseña:</label>
                              <input type="password" name="password" />
                           </div>
                           <div class="field">
                              <label class="label_field">Email:</label>
                              <input type="email" name="email" />
                           </div>
                           <label style="display: flex; justify-content: center; align-items: center" for="usuarios">Elije el rol del usuario:</label>
                           <div style="text-align: center;">
                              <select style="text-align: center;" name="rol">
                                 <option value="admin">Admin</option>
                                 <option value="registrador">Registrador</option>
                              </select>
                           </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button type="submit" class="main_bt" style="display: flex; justify-content: center; align-items: center">Registrar usuario</button>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- jQuery -->
   <script src="js/jquery.min.js"></script>
   <script src="ajax/jquery-3.6.0.js"></script>
   <script src="ajax/ajax.js?v=4.0"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <!-- wow animation -->
   <script src="js/animate.js"></script>
   <!-- select country -->
   <script src="js/bootstrap-select.js"></script>
   <!-- nice scrollbar -->
   <script src="js/perfect-scrollbar.min.js"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="js/custom.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

<?php

if (isset($_GET["action"])) {
   if ($_GET["action"] == "registro_error") {
      echo '<script>
   				swal("Registro fallido!", "Fallo en el proceso, intento de nuevo", "error");
            </script>';
   } else if ($_GET["action"] == "registro_error_invalido") {
      echo '<script>
				swal("Registro fallido!", "No cumple con los estandares de credenciales", "error")
					.then(() => {
  						swal("Tome en nota lo siguiente", "Cumpla con los estandares de credenciales (Nombre: 5 digitos en adelante - Contraseña: 8 digitos en adelante, utilizando por lo menos una mayuscula e igual numeros, debe ingresar un rol para el usuario)", "info");
					});
			</script>
			   ';
   } else if ($_GET["action"] == "registro_error_vacio") {
      echo '<script>
			  swal("Registro fallido!", "Todos los campos deben ir correctamente llenos", "error")
		  </script>
			 ';
   }
}
?>
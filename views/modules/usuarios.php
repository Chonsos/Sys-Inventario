<?php

if (isset($_SESSION["usuarioRol"]) && isset($_SESSION["sesionIniciada"])) {
   if ($_SESSION["sesionIniciada"]) {
      if ($_SESSION["usuarioRol"] == 'admin') {
         // echo 'bggggggg';
      } else if ($_SESSION["usuarioRol"] == 'registrador') {
         echo '<script>
         window.location.href = "accesoDenegadoUsuarios";
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
   <title>Seccion de Usuarios</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <link rel="icon" href="images/fevicon.png" type="image/png" />
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="css/style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="css/responsive.css" />
   <!-- color css -->
   <link rel="stylesheet" href="css/colors.css" />
   <!-- select bootstrap -->
   <link rel="stylesheet" href="css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="css/perfect-scrollbar.css" />
   <!-- custom css -->
   <link rel="stylesheet" href="css/custom.css" />
   <!-- calendar file css -->
   <!-- <link rel="stylesheet" href="js/semantic.min.css" /> -->
   <!-- include the style -->
   <!-- <link rel="stylesheet" href="../../js/alertifyjs/css/alertify.min.css" /> -->
   <!-- include a theme -->
   <!-- <link rel="stylesheet" href="../../js/alertifyjs/css/themes/default.min.css" /> -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="inner_page contact_page">
   <div class="full_container">
      <div class="inner_container">
         <!-- Sidebar  -->
         <?php include "navegacion.php"; ?>
         <!-- end sidebar -->
         <!-- right content -->
         <div id="content">
            <!-- topbar -->
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
            <!-- end topbar -->
            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Seccion de usuarios</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="row column1">
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Usuarios registrados en el sistema</h2>
                              </div>
                           </div>
                           <div class="full price_table padding_infor_info">
                              <div class="row">
                                 <!-- column contact -->
                                 <?php
                                 $ingresar = new MvcController();
                                 $ingresar->vistaUsuariosController();
                                 $borrarUsuarios = new MvcController();
                                 $borrarUsuarios->borrarUsuarioController();
                                 ?>
                                 <!-- end column contact blog -->
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end row -->
                  </div>
                  <!-- footer -->
                  <div class="container-fluid">

                  </div>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
   </div>
   <script src="../../js/alertifyjs/alertify.min.js"></script>
   <!-- jQuery -->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <!-- wow animation -->
   <script src="js/animate.js"></script>
   <!-- select country -->
   <script src="js/bootstrap-select.js"></script>
   <!-- owl carousel -->
   <script src="js/owl.carousel.js"></script>
   <!-- chart js -->
   <script src="js/Chart.min.js"></script>
   <script src="js/Chart.bundle.min.js"></script>
   <script src="js/utils.js"></script>
   <script src="js/analyser.js"></script>
   <!-- nice scrollbar -->
   <script src="js/perfect-scrollbar.min.js"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="js/custom.js"></script>
   <!-- calendar file css -->
   <script src="js/semantic.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- <script></script> -->
</body>

</html>

<?php

if (isset($_GET["action"])) {
   if ($_GET["action"] == "actualizado_ok") {
      echo '<script>
   				swal("Actualizacion completada!", "El usuario se actualizo correctamente!", "success");
                 </script>';
   } else if ($_GET["action"] == "actualizado_error") {
      echo '<script>
   				swal("Actualizacion fallida!", "El usuario no se actualizo correctamente!", "error");
                 </script>';
   } else if ($_GET["action"] == "actualizado_error_invalido") {
      echo '<script>
				swal("Actualizacion fallida!", "No cumple con los estandares para actualizar un usuario", "error")
					.then(() => {
  						swal("Tome en nota lo siguiente", "Cumpla con los estandares de credenciales (Nombre: 5 digitos en adelante - Contraseña: 8 digitos en adelante, utilizando por lo menos una mayuscula e igual numeros, debe ingresar un rol para el usuario)", "info");
					});
			</script>';
   } else if ($_GET["action"] == "actualizado_error_vacio") {
      echo '<script>
   				swal("Actualizacion fallida!", "Todos los campos deben ir con informacion!", "error");
                 </script>';
   } else if ($_GET["action"] == "obtenerIdUpdate_error_invalido") {
      echo '<script>
   				swal("Hubo un problema al obtener el ID del usuario!", "Intente de nuevo!", "error");
                 </script>';
   } else if ($_GET["action"] == "obtenerIdUpdate_error_vacio") {
      echo '<script>
   				swal("No se obtuvo ningun ID!", "Intente de nuevo!", "error");
                 </script>';
   } else if ($_GET["action"] == "eliminado_ok") {
      echo '<script>
   				swal("Usuario eliminado!", "El usuario se elimino correctamente!", "success");
                 </script>';
   } else if ($_GET["action"] == "eliminado_error") {
      echo '<script>
   				swal("Usuario no eliminado!", "El usuario no se elimino correctamente, intente de nuevo!", "error");
                 </script>';
   } else if ($_GET["action"] == "eliminarIdUsuario_error_invalido") {
      echo '<script>
   				swal("Usuario no eliminado!", "Hubo un error al eliminar al intentar obtener el ID, intente de nuevo!", "error");
                 </script>';
   } else if ($_GET["action"] == "eliminarIdUsuario_error_vacio") {
      echo '<script>
   				swal("Usuario no eliminado!", "Hubo un error al eliminar debido que no existe el ID, intente de nuevo!", "error");
                 </script>';
   } 
}
?>
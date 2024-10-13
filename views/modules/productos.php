<?php

if (isset($_SESSION["usuarioRol"]) && isset($_SESSION["sesionIniciada"])) {
   if ($_SESSION["sesionIniciada"]) {
      if ($_SESSION["usuarioRol"] == 'admin') {
         
      } else if ($_SESSION["usuarioRol"] == 'registrador') {
         
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

$mostrarProductos = new MvcController();
$borrarProducto = new MvcController();

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
   <title>Seccion de Productos</title>
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
   <style>
      .input {


         position: absolute;

         left: 585px;

         top: 12px;

         font-size: 1.5em;


         background: linear-gradient(21deg, #10abff, #1beabd);


         padding: 3px;


         display: inline-block;


         border-radius: 9999em;


         *:not(span) {
            position: relative;
            display: inherit;
            border-radius: inherit;
            margin: 0;
            border: none;
            outline: none;
            padding: 0 .325em;
            z-index: 1;


            &:focus+span {
               opacity: 1;
               transform: scale(1);
            }
         }


         span {
            transform: scale(.993, .94);
            transition: transform .5s, opacity .25s;
            opacity: 0;

            position: absolute;
            z-index: 0;
            margin: 4px;
            left: 0px;
            top: 0;
            right: 0;
            bottom: 0;
            border-radius: inherit;
            pointer-events: none;


            box-shadow: inset 0 0 0 3px #fff,
               0 0 0 4px #fff,
               3px -3px 30px #1beabd,
               -3px 3px 30px #10abff;
         }

      }

      input {
         font-family: inherit;
         line-height: inherit;
         color: #2e3750;
         min-width: 12em;
      }

   </style>
</head>

<body class="inner_page price_table">
   <div class="full_container">
      <div class="inner_container">
         <?php include "navegacion.php" ?>
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
                     <!-- <div class="field"> -->
                     <!-- <p> -->
                     <div class="field">
                        <span class="input">
                           <input type="text" name="buscarProducto" id="buscador" placeholder="Buscar producto">
                           <span></span>
                        </span>
                        <!-- </p> -->
                     </div>
                     <div class="right_topbar">
                        <div class="icon_info">
                           <!-- <ul> -->

                           <a style="color: white; position:absolute; top: 20px; right: 30px;" href="salir"><i class="fa fa-sign-out"></i></a> 
                           <!-- <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                                 <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                 <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li> -->
                           <!-- </ul> -->
                           <!-- <ul class="user_profile_dd">
                                 <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="images/layout_img/user_img.jpg" alt="#" /><span class="name_user"> <?php echo ' ' . $_SESSION["nombre"] . ' '; ?> </span></a> 
                                    <div class="dropdown-menu">
 
                                       <a class="dropdown-item" href="salir"><span>Cerrar sesion</span> <i class="fa fa-sign-out"></i></a>
                                    </div>
                                 </li>
                              </ul> -->
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
                           <h2>Seccion de productos</h2>

                        </div>
                     </div>

                  </div>
                  <!-- row -->
                  <div class="row column1 muestraNormal">
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Productos registrados</h2>
                              </div>
                              <div style="display: flex; justify-content: right; align-items: center;">
                                 <a style=" margin-right:30px" href="models/fpdf/reportePDF.php">
                                    <button type="button" class="btn btn-danger btn-xs">
                                       <i class="fa fa-file-pdf-o"> </i>
                                    </button>
                                 </a>

                                 <a href="models/reporteExcel.php">
                                    <button type="button" class="btn btn-success btn-xs">
                                       <i class="fa fa-file-excel-o"> </i>
                                    </button>
                                 </a>
                              </div>
                           </div>
                           <div class="full price_table padding_infor_info">
                              <div class="row">

                                 <!-- column price -->
                                 <?php $mostrarProductos->mostrarProductosController();
                                 $borrarProducto->borrarProductoController();
                                 ?>
                              </div>

                              <!-- end column -->
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row column1 muestraTemporal">
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Productos registrados</h2>
                              </div>
                           </div>
                           <div class="full price_table padding_infor_info">



                              <div class="row" id="datos">

                              </div>
                              <!-- end column-->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end row -->
            </div>
         </div>
         <!-- end dashboard inner -->
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
   <!-- <script src="../../js/alertifyjs/alertify.min.js"></script> -->
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- <script></script> -->
</body>

</html>

<?php

if (isset($_GET["action"])) {
   if ($_GET["action"] == "ingresar_ok") {
      echo '<script>
   				swal("Bienvenido: ' . $_SESSION["nombre"] . '", "Ingresaste correctamente!", "success");
                 </script>';
   } else if ($_GET["action"] == "registrarProducto_ok") {
      echo '<script>
   				swal("Registro correcto!", "El producto se registro correctamente!", "success");
                 </script>';
   } else if ($_GET["action"] == "productoActualizado_ok") {
      echo '<script>
   				swal("Actualizacion completa!", "El producto no se actualizo correctamente!", "success");
                 </script>';
   } else if ($_GET["action"] == "productoActualizado_error") {
      echo '<script>
				swal("Actualizacion fallida!", "No se pudo actualizar el producto, intente de nuevo", "error")
			</script>';
   } else if ($_GET["action"] == "productoActualizado_error_invalido") {
      echo '<script>
   				swal("Actualizacion fallida!", "No cumple con los estandares para actualizar un producto", "error")
					.then(() => {
  						swal("Tome en nota lo siguiente", "Cumpla con los estandares de como (Codigo del producto: 3 a 4 digitos - Nombre: 4 digitos en adelante, Descripcion: 4 digitos en adelante, Stock: de 0 a 10000, Precio: de 100 a 10.000)", "info");
					});
                 </script>';
   } else if ($_GET["action"] == "productoActualizado_error_vacio") {
      echo '<script>
   				swal("Actualizacion fallida!", "Todos los campos deben ir con informacion!", "error");
                 </script>';
   } else if ($_GET["action"] == "obtenerIdUpdateProducto_error_invalido") {
      echo '<script>
   				swal("Hubo un problema al obtener el ID del producto!", "Intente de nuevo!", "error");
                 </script>';
   } else if ($_GET["action"] == "obtenerIdUpdateProducto_error_vacio") {
      echo '<script>
   				swal("No se obtuvo ningun ID!", "Intente de nuevo!", "error");
                 </script>';
   } else if ($_GET["action"] == "productoEliminado_ok") {
      echo '<script>
   				swal("Producto eliminado!", "El producto se elimino correctamente!", "success");
                 </script>';
   } else if ($_GET["action"] == "productoEliminado_error") {
      echo '<script>
   				swal("Producto no eliminado!", "El producto no se elimino correctamente, intente de nuevo!", "error");
                 </script>';
   } else if ($_GET["action"] == "productoEliminado_invalido") {
      echo '<script>
   				swal("Producto no eliminado!", "Hubo un error al eliminar al intentar obtener el ID, intente de nuevo!", "error");
                 </script>';
   } else if ($_GET["action"] == "productoEliminado_error_vacio") {
      echo '<script>
   				swal("Producto no eliminado!", "Hubo un error al eliminar debido que no existe el ID, intente de nuevo!", "error");
                 </script>';
   } else if ($_GET["action"] == "accesoDenegadoUsuarios") {
      echo '<script>
   				swal("Acceso Denegado!", "Usted no tiene permiso de estar aqui!", "error");
                 </script>';
   } else if ($_GET["action"] == "accesoDenegadoRegistroUsuarios") {
      echo '<script>
   				swal("Acceso Denegado!", "Usted no tiene permiso de estar aqui!", "error");
                 </script>';
   } else if ($_GET["action"] == "accesoDenegadoEditarUsuarios") {
      echo '<script>
   				swal("Acceso Denegado!", "Usted no tiene permiso de estar aqui!", "error");
                 </script>';
   } 
}
?>
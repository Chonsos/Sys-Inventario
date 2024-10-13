<?php
if (isset($_GET["action"]) && isset($_SESSION["usuarioRol"])) {
    if ($_SESSION["usuarioRol"] == "admin") {
        if (
            $_GET["action"] == "usuarios" || $_GET["action"] == "productos" || $_GET["action"] == "registro" || $_GET["action"] == "registro_ok"
            || $_GET["action"] == "registro_error" || $_GET["action"] == "registro_error_invalido" || $_GET["action"] == "registro_error_vacio"
            || $_GET["action"] == "ingresar_ok" || $_GET["action"] == "actualizado_ok" || $_GET["action"] == "actualizado_error"
            || $_GET["action"] == "actualizado_error_vacio" || $_GET["action"] == "actualizado_error_invalido"
            || $_GET["action"] == "obtenerIdUpdate_error_invalido" || $_GET["action"] == "obtenerIdUpdate_error_vacio"
            || $_GET["action"] == "eliminado_ok" || $_GET["action"] == "eliminado_error"
            || $_GET["action"] == "eliminarIdUsuario_error_invalido"  || $_GET["action"] == "eliminarIdUsuario_error_vacio"
            || $_GET["action"] == "registrarProducto" || $_GET["action"] == "registrarProducto_ok" || $_GET["action"] == "registrarProducto_error"
            || $_GET["action"] == "registrarProducto_error_invalido" || $_GET["action"] == "registrarProducto_error_vacio"
            || $_GET["action"] == "productoActualizado_ok" || $_GET["action"] == "productoActualizado_error" || $_GET["action"] == "productoActualizado_invalido"
            || $_GET["action"] == "productoActualizado_error_vacio" || $_GET["action"] == "obtenerIdUpdateEmpleado_error_invalido" || $_GET["action"] == "violacionEditarEmpleados"
            || $_GET["action"] == "obtenerIdUpdateEmpleado_error_vacio" || $_GET["action"] == "productoEliminado_ok"
            || $_GET["action"] == "productoEliminado_error"  || $_GET["action"] == "productoEliminado_error_invalido"
            || $_GET["action"] == "productoEliminado_error_vacio" || $_GET["action"] == "violacionEliminarEmpleados" || $_GET["action"] == "editar"
        ) {
            echo '
            <nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section">
                        <img class="logo_icon img-responsive" src="images/logo/cleanLogo.png" alt="#" />
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="images/logo/iconLogin.png" alt="#" /></div>
                        <div class="user_info">
                           <h6>'. $_SESSION["nombre"] .'</h6>
                           <p><span class="online_animation"></span> En linea</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>General</h4>
                  <ul class="list-unstyled components">
                     <li class="active">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-dashboard yellow_color"></i> <span>Seccion de Usuarios</span></a>
                        <ul class="collapse list-unstyled" id="dashboard">
                           <li>
                              <a href="usuarios">> <span>Ver usuarios</span></a>
                           </li>
                           <li>
                              <a href="registro">> <span>Registrar a un usuario</span></a>
                           </li>
                        </ul>
                     </li>
                     
                     <li>
                        <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>Seccion de Productos</span></a>
                        <ul class="collapse list-unstyled" id="element">
                           <li><a href="productos">> <span>Ver productos</span></a></li>
                           <li><a href="registrarProducto">> <span>Registrar un producto</span></a></li>
                        </ul>
                     </li>                                                     
                  </ul>
               </div>
            </nav>
        ';
        }
    } else if ($_SESSION["usuarioRol"] == "registrador") {
        if (
            $_GET["action"] == "ingresar_ok" || $_GET["action"] == "productos" || $_GET["action"] == "registrarProducto" || $_GET["action"] == "registrarProducto_ok" || $_GET["action"] == "registrarProducto_error"
            || $_GET["action"] == "registrarProducto_error_invalido" || $_GET["action"] == "registrarProducto_error_vacio"
            || $_GET["action"] == "productoActualizado_ok" || $_GET["action"] == "productoActualizado_error" || $_GET["action"] == "productoActualizado_invalido"
            || $_GET["action"] == "productoActualizado_error_vacio" || $_GET["action"] == "obtenerIdUpdateEmpleado_error_invalido" 
            || $_GET["action"] == "obtenerIdUpdateEmpleado_error_vacio" || $_GET["action"] == "productoEliminado_ok"
            || $_GET["action"] == "productoEliminado_error"  || $_GET["action"] == "productoEliminado_error_invalido"
            || $_GET["action"] == "productoEliminado_error_vacio" || $_GET["action"] == "accesoDenegadoUsuarios"  || $_GET["action"] == "accesoDenegadoEditarUsuarios" || $_GET["action"] == "accesoDenegadoRegistroUsuarios"
            || $_GET["action"] == "editar"
        ) {
            echo '
               <nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section">
                        <img class="logo_icon img-responsive" src="images/logo/cleanLogo.png" alt="#" />
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="images/logo/iconLogin.png" alt="#" /></div>
                        <div class="user_info">
                           <h6>'. $_SESSION["nombre"] .'</h6>
                           <p><span class="online_animation"></span> En linea</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>General</h4>
                  <ul class="list-unstyled components"> 
                     <li>
                        <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>Seccion de Productos</span></a>
                        <ul class="collapse list-unstyled" id="element">
                           <li><a href="productos">> <span>Ver productos</span></a></li>
                           <li><a href="registrarProducto">> <span>Registrar un producto</span></a></li>
                        </ul>
                     </li>                                                     
                  </ul>
               </div>
            </nav>
        ';
        }
    }
}
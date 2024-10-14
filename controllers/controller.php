<?php

class MvcController
{

    #LLAMADA A LA PLANTILLA
    #-------------------------------------

    static public function pagina()
    {
        include "views/template.php";
    }

    #ENLACES
    #-------------------------------------

    public static function enlacesPaginasController()
    {
        if (isset($_GET['action'])) {
            $enlaces = $_GET['action'];
        } else {
            $enlaces = "index";
        }

        $respuesta = Paginas::enlacesPaginasModel($enlaces);

        include $respuesta;
    }

    # Registro Usuarios

    public static function registroUsuarioController()
    {
        if (
            isset($_POST["nombre"]) && isset($_POST["password"]) &&
            isset($_POST["email"]) && isset($_POST["rol"])
        ) {

            if (!empty($_POST["nombre"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["rol"])) {

                if (
                    preg_match('/^[A-Za-z0-9\-\_\.]{3,20}$/', $_POST["nombre"]) &&
                    preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/', $_POST["password"]) &&
                    preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $_POST["email"]) &&
                    preg_match('/^[A-Za-z0-9\-\_\.]{3,20}$/', $_POST["rol"])
                ) {

                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                    $datos = array(
                        "nombre" => $_POST["nombre"],
                        "password" => $password,
                        "email" => $_POST["email"],
                        "rol" => $_POST["rol"],
                    );

                    $_SESSION["user"] = $_POST["nombre"];

                    $respuesta = Datos::registroUsuarioModel($datos, "usuarios");

                    if ($respuesta == "success") {
                        echo '<script>
                                        window.location.href = "registro_ok";
                                      </script>';
                    } else {
                        echo '<script>
                                        window.location.href = "registro_error";
                                      </script>';
                    }
                } else {
                    echo '<script>
                                    window.location.href = "registro_error_invalido";
                                    </script>';
                }
            } else {
                echo '<script>
                                window.location.href = "registro_error_vacio";
                              </script>';
            }
        }
    }

    # Ver usuarios
    public static function vistaUsuariosController()
    {

        $respuesta = Datos::vistaUsuariosModel("usuarios");

        foreach ($respuesta as $key => $value) {
            echo '
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 profile_details margin_bottom_30">
                    <div class="contact_blog">
                        <h4 class="brief">Rol: ' . $value["rol"] . '</h4>
                            <div class="contact_inner">
                                <div class="left">
                                    <h3>' . $value["nombre"] . '</h3>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-envelope-o"></i> : ' . $value["email"] . '</li>
                                     </ul>
                                </div>            
                                <div class="bottom_list">
                                    <div class="right_button">
                                    <a href="editar&idEditar=' . $value["id"] . '"> 
                                        <button type="button" class="btn btn-warning btn-xs"> <i class="fa fa-edit"></i> 
                                            
                                        </button>
                                    </a>
                                    <a href="usuarios&idBorrar=' . $value["id"] . '"> 
                                        <button type="button" class="btn btn-danger btn-xs">
                                            <i class="fa fa-eraser"> </i> 
                                        </button>
                                    </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                    ';
        }
    }

    #Eliminar usuarios

    public static function borrarUsuarioController()
    {

        if (isset($_GET["idBorrar"]) && isset($_SESSION["sesionIniciada"]) && isset($_SESSION["usuarioRol"]) && $_SESSION["usuarioRol"] == "admin") {

            if (!empty($_GET["idBorrar"])) {

                if (preg_match('/^[0-9]{1,20}$/', $_GET["idBorrar"])) {

                    $datos = $_GET["idBorrar"];

                    $respuesta = Datos::borrarUsuarioModel($datos, "usuarios");

                    if ($respuesta == "success") {
                        $_SESSION["user"] = "";
                        echo '<script>
                                     window.location.href = "eliminado_ok";
                                  </script>';
                    } else {
                        echo '<script>
                                     window.location.href = "eliminado_error";
                                  </script>';
                    }
                } else {
                    echo '<script>
                                window.location.href = "eliminarIdUsuario_error_invalido";
                              </script>';
                }
            } else {
                echo '<script>
                           window.location.href = "eliminarIdUsuario_error_invalido";
                          </script>';
            }
        }
    }

    #ObtenerId Usuarios Editar
    public static function editarUsuarioController()
    {

        if (isset($_GET["idEditar"])) {

            if (!empty($_GET["idEditar"])) {

                if (preg_match('/^[0-9]{1,20}$/', $_GET["idEditar"])) {

                    $datos = $_GET["idEditar"];

                    $respuesta = Datos::editarUsuarioModel($datos, "usuarios");

                    echo '
                    <input type="hidden" name="id" value="' . $respuesta["id"] . '" required>
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Usuario:</label>
                              <input type="text" value="' . $respuesta["nombre"] . '" name="nombre"/>
                           </div>
                           <div class="field">
                              <label class="label_field">Contraseña:</label>
                              <input type="password" name="password"/>
                           </div>
						   <div class="field">
                              <label class="label_field">Email:</label>
                              <input type="email" value="' . $respuesta["email"] . '" name="email"/>
                           </div>
						   <label style="display: flex; justify-content: center; align-items: center" for="usuarios">Elije el rol del usuario:</label>
						   <div style="text-align: center;">
							<select style="text-align: center;" name="rol">
                            <option value="' . $respuesta["rol"] . '">Marque esta opcion, si no desea cambiar el rol</option>
								<option value="admin">Admin</option>
								<option value="registrador">Registrador</option>
							</select>
							</div>
                           <div class="field margin_0">
                           <h4 style="display: flex; justify-content: right; align-items: center; top:99px;" class="brief">Rol asignado: ' . $respuesta["rol"] . '</h4>
                              <label class="label_field hidden">hidden label</label>
                              <button type="submit" class="main_bt" style="display: flex; justify-content: center; align-items: center">Editar usuario</button>
                           </div>
                        </fieldset>                                                        
                                 ';
                } else {
                    echo '<script>
                               window.location.href = "obtenerIdUpdate_error_invalido";
                              </script>';
                }
            } else {
                echo '<script>
                           window.location.href = "obtenerIdUpdate_error_vacio";
                          </script>';
            }
        }
    }

    # Actualizar Usuario
    public static function actualizarUsuarioController()
    {

        if (
            isset($_POST["id"]) && isset($_POST["nombre"]) &&
            isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["rol"])
        ) {

            if (!empty($_POST["id"]) && !empty($_POST["nombre"]) && empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["rol"])) {

                $datos = $_GET["idEditar"];
                $respuesta = Datos::editarUsuarioModel($datos, "usuarios");
                // $_POST["password"] = $respuesta["password"];

                if (
                    preg_match('/^[0-9]{1,20}$/', $_POST["id"]) &&
                    preg_match('/^[A-Za-z0-9\-\_\.\s]{3,20}$/', $_POST["nombre"]) &&
                    preg_match('/^[A-Za-z\/\.\$]*$/', $_POST["password"]) &&
                    preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $_POST["email"]) &&
                    preg_match('/^[A-Za-z0-9\-\_\.]{3,20}$/', $_POST["rol"])
                ) {

                    // $password = password_hash($respuesta["password"], PASSWORD_DEFAULT);

                    $datos = array(
                        "id" => $_POST["id"],
                        "nombre" => $_POST["nombre"],
                        "password" =>  $respuesta["password"],
                        "email" => $_POST["email"],
                        "rol" => $_POST["rol"],
                    );

                    $respuesta = Datos::actualizarUsuarioModel($datos, "usuarios");

                    if ($respuesta == "success") {
                        echo '<script>
                                           window.location.href = "actualizado_ok";
                                          </script>';
                    } else {
                        echo '<script>
                                           window.location.href = "actualizado_error";
                                          </script>';
                    }
                } else {
                    echo '<script>
                                   window.location.href = "actualizado_error_invalido";
                                  </script>';
                }
            } else if (!empty($_POST["id"]) && !empty($_POST["nombre"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["rol"])) {

                if (
                    preg_match('/^[0-9]{1,20}$/', $_POST["id"]) &&
                    preg_match('/^[A-Za-z0-9\-\_\.\s]{3,20}$/', $_POST["nombre"]) &&
                    preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/', $_POST["password"]) &&
                    preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $_POST["email"]) &&
                    preg_match('/^[A-Za-z0-9\-\_\.]{3,20}$/', $_POST["rol"])
                ) {

                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                    $datos = array(
                        "id" => $_POST["id"],
                        "nombre" => $_POST["nombre"],
                        "password" => $password,
                        "email" => $_POST["email"],
                        "rol" => $_POST["rol"],
                    );

                    $respuesta = Datos::actualizarUsuarioModel($datos, "usuarios");

                    if ($respuesta == "success") {
                        echo '<script>
                                           window.location.href = "actualizado_ok";
                                          </script>';
                    } else {
                        echo '<script>
                                           window.location.href = "actualizado_error";
                                          </script>';
                    }
                } else {
                    echo '<script>
                                   window.location.href = "actualizado_error_invalido";
                                  </script>';
                }
            } else {
                echo '<script>
                               window.location.href = "actualizado_error_vacio";
                              </script>';
            }
        }
    }

    # Ingresar Usuario ya registrado
    public static function ingresarUsuarioController()
    {

        if (isset($_POST["nombre"]) && isset($_POST["password"])) {

            if (!empty($_POST["nombre"]) && !empty($_POST["password"])) {

                if (
                    preg_match('/^[A-Za-z0-9\-\_\.]{5,20}$/', $_POST["nombre"]) &&
                    preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/', $_POST["password"])
                ) {

                    $password = $_POST["password"];

                    $datos = array(
                        "nombre" => $_POST["nombre"],
                        "password" => $password,
                    );

                    $respuesta = Datos::ingresarUsuarioModel($datos, "usuarios");

                    if (
                        $respuesta["nombre"] == $datos["nombre"]
                        && password_verify($password, $respuesta["password"])
                    ) {

                        $_SESSION["id_usuario"] = $respuesta["id"];
                        $_SESSION["usuarioRol"] = $respuesta["rol"];
                        $_SESSION["sesionIniciada"] = true;
                        $_SESSION["nombre"] = $datos["nombre"];

                        echo '<script>
                                       window.location.href = "ingresar_ok";
                                      </script>';
                    } else {
                        echo '<script>
                                       window.location.href = "ingresar_error";
                                      </script>';
                    }
                } else {
                    echo '<script>
                               window.location.href = "ingresar_error_invalido";
                              </script>';
                }
            } else {
                echo '<script>
                           window.location.href = "ingresar_error_vacio";
                          </script>';
            }
        }
    }

    # Validar existencia de un nombre (AJAX)
    public static function validarUsuarioController($datos)
    {
        $respuesta = 0;
        if (!empty($datos)) {
            if (preg_match('/^[A-Za-z0-9\-\_\.]{3,20}$/', $datos)) {

                $respuesta = Datos::validarUsuarioModel($datos);
                if ($respuesta[0] > 0) {
                    $respuesta = 1;
                } else {
                    $respuesta = 0;
                }
            }
        }
        return $respuesta;
    }

    ///////////////////////////////////////////////////
    // Parte de los productos \\
    //////////////////////////////////////////////////

    # Registrar un producto
    public static function registrarProductoController()
    {

        if (
            isset($_POST["codigoProducto"]) && isset($_POST["nombreProducto"]) &&
            isset($_POST["descripcion"]) && isset($_POST["stock"])
            && isset($_POST["precio"]) && isset($_SESSION["id_usuario"])
        ) {

            if (
                !empty($_POST["codigoProducto"]) && !empty($_POST["nombreProducto"])
                && !empty($_POST["descripcion"]) && !empty($_POST["stock"] || empty($_POST["stock"]))
                && !empty($_POST["precio"]) && !empty($_SESSION["id_usuario"])
            ) {

                if (
                    preg_match('/^[A-Za-z0-9\s\-\_\.\()]{3,4}$/', $_POST["codigoProducto"]) &&
                    preg_match('/^[A-Za-z0-9\s]{3,100}$/', $_POST["nombreProducto"]) &&
                    preg_match('/^[A-Za-z0-9\s\-\_\.\()\,\%#]{2,100}$/', $_POST["descripcion"]) &&
                    preg_match('/^[A-Za-z0-9\s\-\_\.\()\,]{0,10000}$/', $_POST["stock"]) &&
                    preg_match('/^[A-Za-z0-9\s]{1,10000}$/', $_POST["precio"]) &&
                    preg_match('/^[0-9]{1,20}$/', $_SESSION["id_usuario"])
                ) {

                    $datos = array(
                        "codigoProducto" => $_POST["codigoProducto"],
                        "nombreProducto" => $_POST["nombreProducto"],
                        "descripcion" => $_POST["descripcion"],
                        "stock" => $_POST["stock"],
                        "precio" => $_POST["precio"],
                        "id_usuario" => $_SESSION["id_usuario"],
                    );

                    $respuesta = Datos::registrarProductoModel($datos, "inventario");

                    if ($respuesta == "success") {
                        echo '<script>
                                        window.location.href = "registrarProducto_ok";
                                      </script>';
                    } else {
                        echo '<script>
                                        window.location.href = "registrarProducto_error";
                                      </script>';
                    }
                } else {
                    echo '<script>
                                    window.location.href = "registrarProducto_error_invalido";
                                    </script>';
                }
            } else {
                echo '<script>
                                window.location.href = "registrarProducto_error_vacio";
                              </script>';
            }
        }
    }

    # Mostrar los productos
    public static function mostrarProductosController()
    {

        $respuesta = Datos::mostrarProductosModel("inventario");

        foreach ($respuesta as $key => $value) {
            echo '
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="table_price full">
                    <div class="inner_table_price">
                        <div class="price_table_head blue1_bg">
                            <h2>Codigo: ' . $value["codigoProducto"] . '</h2>
                        </div>
                        <div class="price_table_inner">
                            <div class="cont_table_price_blog">
                                <p class="blue1_color">Producto: ' . $value["nombreProducto"] . '</p>
                            </div>
                            <div class="cont_table_price">
                                <ul>
                                    <li>Descripcion: ' . $value["descripcion"] . '</li>
                                    <li>Stock: ' . $value["stock"] . '</li>
                                    <li>Precio: ' . $value["precio"] . '</li>
                                </ul>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: center; align-items: center" class="bottom_list">
                            <div class="right_button">
                                <a href="editar&idEditarProducto=' . $value["id"] . '"> 
                                    <button type="button" class="btn btn-warning btn-xs"> <i class="fa fa-edit"></i> 
                                    </button>
                                </a>
                                <a href="productos&idBorrar=' . $value["id"] . '"> 
                                    <button type="button" class="btn btn-danger btn-xs">
                                        <i class="fa fa-eraser"> </i> 
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    ';
        }
    }

    # Traer la vista para editar a un producto
    public static function editarProductoController()
    {

        if (isset($_GET["idEditarProducto"])) {

            if (!empty($_GET["idEditarProducto"])) {

                if (preg_match('/^[0-9]{1,20}$/', $_GET["idEditarProducto"])) {

                    $datos = $_GET["idEditarProducto"];

                    $respuesta = Datos::editarProductoModel($datos, "inventario");
                    echo '
                        <input type="hidden" name="id" value="' . $respuesta["id"] . '" required> 

                        <fieldset>
                           <div class="field">
                              <label class="label_field">Codigo del producto:</label>
                              <input type="text" name="codigoProducto" value="' . $respuesta["codigoProducto"] . '"/>
                           </div>
                           <div class="field">
                              <label class="label_field">Nombre del producto:</label>
                              <input type="text" name="nombreProducto" value="' . $respuesta["nombreProducto"] . '"/>
                           </div>
						   <div class="field">
                              <label class="label_field">Descripcion:</label>
                              <input type="text" name="descripcion" value="' . $respuesta["descripcion"] . '"/>
                           </div>
						   <div class="field">
                              <label class="label_field">Stock:</label>
                              <input type="number" min="0" name="stock" value="' . $respuesta["stock"] . '"/>
                           </div>
						   <div class="field">
                              <label class="label_field">Precio:</label>
                              <input type="text" min="0" max="1000" name="precio" value="' . $respuesta["precio"] . '"/>
                           </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button type="submit" class="main_bt" style="display: flex; justify-content: center; align-items: center">Editar producto</button>
                           </div>
                        </fieldset>       
                                 ';
                } else {
                    echo '<script>
                               window.location.href = "obtenerIdUpdateProducto_error_invalido";
                              </script>';
                }
            } else {
                echo '<script>
                           window.location.href = "obtenerIdUpdateProducto_error_vacio";
                          </script>';
            }
        }
    }

    # Actualizar un producto
    public static function actualizarProductoController()
    {

        if (
            isset($_POST["id"]) && isset($_POST["codigoProducto"]) && isset($_POST["nombreProducto"]) &&
            isset($_POST["descripcion"]) && isset($_POST["stock"])
            && isset($_POST["precio"])
        ) {

            if (
                !empty($_POST["id"]) && !empty($_POST["codigoProducto"]) && !empty($_POST["nombreProducto"])
                && !empty($_POST["descripcion"]) && !empty($_POST["stock"]) || empty($_POST["stock"])
                && !empty($_POST["precio"])
            ) {

                if (
                    preg_match('/^[0-9]{1,20}$/', $_POST["id"]) &&
                    preg_match('/^[A-Za-z0-9\s\-\_\.\()]{3,4}$/', $_POST["codigoProducto"]) &&
                    preg_match('/^[A-Za-z0-9\s]{3,100}$/', $_POST["nombreProducto"]) &&
                    preg_match('/^[A-Za-z0-9\s\-\_\.\()\,\%#]{2,100}$/', $_POST["descripcion"]) &&
                    preg_match('/^[A-Za-z0-9\s\-\_\.\()\,]{0,10000}$/', $_POST["stock"]) &&
                    preg_match('/^[A-Za-z0-9\s]{1,10000}$/', $_POST["precio"])
                ) {


                    $datos = array(
                        "id" => $_POST["id"],
                        "codigoProducto" => $_POST["codigoProducto"],
                        "nombreProducto" => $_POST["nombreProducto"],
                        "descripcion" => $_POST["descripcion"],
                        "stock" => $_POST["stock"],
                        "precio" => $_POST["precio"],
                    );

                    $respuesta = Datos::actualizarProductoModel($datos, "inventario");

                    if ($respuesta == "success") {
                        echo '<script>
                                           window.location.href = "productoActualizado_ok";
                                          </script>';
                    } else {
                        echo '<script>
                                           window.location.href = "productoActualizado_error";
                                          </script>';
                    }
                } else {
                    echo '<script>
                                   window.location.href = "productoActualizado_error_invalido";
                                  </script>';
                }
            } else {
                echo '<script>
                               window.location.href = "productoActualizado_error_vacio";
                              </script>';
            }
        }
    }

    # Borrar un producto
    public static function borrarProductoController()
    {

        if (isset($_GET["idBorrar"])) {

            if (!empty($_GET["idBorrar"])) {

                if (preg_match('/^[0-9]{1,20}$/', $_GET["idBorrar"])) {

                    $datos = $_GET["idBorrar"];

                    $respuesta = Datos::borrarProductoModel($datos, "inventario");

                    if ($respuesta == "success") {
                        echo '<script>
                                     window.location.href = "productoEliminado_ok";
                                  </script>';
                    } else {
                        echo '<script>
                                     window.location.href = "productoEliminado_error";
                                  </script>';
                    }
                } else {
                    echo '<script>
                                window.location.href = "productoEliminado_invalido";
                              </script>';
                }
            } else {
                echo '<script>
                           window.location.href = "productoEliminado_error_vacio";
                          </script>';
            }
        }
    }
}
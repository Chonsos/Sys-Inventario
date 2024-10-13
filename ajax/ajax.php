<?php

require_once "../controllers/controller.php";
require_once "../models/crud.php";
require_once "../models/conexion.php";

class Ajax
{

    public $validar_usuario;
    public $validar_email;

    public function validarUsuarioAjax()
    {
        $datos = $this->validar_usuario;

        $respuesta = MvcController::validarUsuarioController($datos);
        //  $respuesta = "Success";

        echo $respuesta;
    }
    // public function validarEmailAjax()
    // {
    //     $datos = $this->validar_email;

    //     $respuesta = MvcController::validarEmailController($datos);
    //     // $respuesta = "Success";

    //     echo $respuesta;
    // }
}

if (isset($_POST["nombre"])) {
    $a = new Ajax();
    $a->validar_usuario = $_POST["nombre"];
    $a->validarUsuarioAjax();
}

// if (isset($_POST["email"])) {
//     $a = new Ajax();
//     $a->validar_email = $_POST["email"];
//     $a->validarEmailAjax();
// }

if (isset($_FILES["file"])) {

    if (!empty($_FILES["file"])) {

        if (is_uploaded_file($_FILES["file"]["tmp_name"])) {

            $dir_destino = "../uploads/";

            $tamano = $_FILES["file"]["size"];

            $tipo = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

            $nombre = $_FILES["file"]["name"];

            $destino = $dir_destino . $nombre;

            if ($tipo != "jpg" && $tipo != "jpeg" && $tipo != "png" && $tipo != "gif") {

                echo "300";
            } else if ($tamano > 26214400) {

                echo "301";
            } else {

                move_uploaded_file($_FILES["file"]["tmp_name"], $destino);

                echo $destino;
            }
        } else {

            echo "302";
        }
    } else {

        echo "303";
    }
}



$link = mysqli_connect('localhost', 'root', '', 'dbcleanexpert');



if (isset($_POST['buscar'])) {

    $buscar = $_POST['buscar'];

    if (!empty($buscar)) {

    $query = "SELECT * FROM inventario WHERE codigoProducto LIKE '$buscar%' 

    OR nombreProducto LIKE '$buscar%'

    OR descripcion LIKE '$buscar%' 

    OR stock LIKE '$buscar%'

    OR precio LIKE '$buscar%' ";

        $respuesta = mysqli_query($link, $query);

        if (!$respuesta) {
            die('Error en la consulta' . mysqli_error($link));
        }

        $conve_json = array();
    
        while ($espacio = mysqli_fetch_array($respuesta)) {

            $conve_json[] = array(

                'id' => $espacio["id"],

                'codigoProducto' => $espacio["codigoProducto"],

                'nombreProducto' => $espacio["nombreProducto"],

                'descripcion' => $espacio["descripcion"],

                'stock' => $espacio["stock"],

                'precio' => $espacio["precio"]
            );
        }

        $conve_jsonstring = json_encode($conve_json);

        echo $conve_jsonstring;
    }
}

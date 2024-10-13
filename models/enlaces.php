<?php

class Paginas
{

	static public function enlacesPaginasModel($enlaces)
	{

		switch ($enlaces) {
			case "ingresar":
			case "usuarios":
			case "editar":
			case "salir":
			case "registrarProducto":
			case "productos":
			case "registro":
				$module =  "views/modules/" . $enlaces . ".php";
				break;
			case "index":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "registro_ok":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "registro_error":
				$module =  "views/modules/registro.php";
				break;
				//////////////////////////////////////
			case "registro_error_invalido":
				$module =  "views/modules/registro.php";
				break;
				//////////////////////////////////////
			case "registro_error_vacio":
				$module =  "views/modules/registro.php";
				break;
				//////////////////////////////////////
			case "eliminado_ok":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "eliminado_error":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "eliminarIdUsuario_error_invalido":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "eliminarIdUsuario_error_vacio":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "actualizado_ok":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "actualizado_error":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "actualizado_error_vacio":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "actualizado_error_invalido":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "obtenerIdUpdate_error_invalido":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "obtenerIdUpdate_error_vacio":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "ingresar_ok":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "ingresar_error":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "ingresar_error_invalido":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "ingresar_error_vacio":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "registrarProducto_ok":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "registrarProducto_error":
				$module =  "views/modules/registrarProducto.php";
				break;
				//////////////////////////////////////
			case "registrarProducto_error_invalido":
				$module =  "views/modules/registrarProducto.php";
				break;
				//////////////////////////////////////
			case "registrarProducto_error_vacio":
				$module =  "views/modules/registrarProducto.php";
				break;
				//////////////////////////////////////
			case "productoActualizado_ok":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "productoActualizado_error":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "productoActualizado_error_invalido":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "productoActualizado_error_vacio":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "productoEliminado_ok":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "productoEliminado_error":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "productoEliminado_error_invalido":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "productoEliminado_error_vacio":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "error_salir":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "accesoDenegadoRegistroUsuarios":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "accesoDenegadoUsuarios":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "accesoDenegadoEditarUsuarios":
				$module =  "views/modules/productos.php";
				break;
				//////////////////////////////////////
			case "reporteExcel":
				$module =  "models/reporteExcel.php";
				break;
				//////////////////////////////////////
			case "reportePDF":
				$module =  "../fpdf/reportePDF.php";
				break;
			default:
				$module =  "views/modules/ingresar.php";
				break;
		}
		return $module;
	}
}

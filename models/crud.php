<?php

require_once "conexion.php";

class Datos extends Conexion
{

    # Registrar Usuarios
    public static function registroUsuarioModel($datos, $tabla)
    {
        $stnt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, password, email, rol) VALUES (:nombre, :password, :email, :rol)");
        $stnt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stnt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stnt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stnt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);

        if ($stnt->execute()) {
            return "success";
        } else {
            $stnt->errorInfo();
        }
    }

    # Cargar usuarios en la vista
    public static function vistaUsuariosModel($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id, nombre, email, rol FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    # Borrar un usuario
    public static function borrarUsuarioModel($datos, $tabla)
    {
        $stnt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stnt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stnt->execute()) {
            return "success";
        } else {
            return $stnt->errorInfo();
        }
    }

    # Traer una vista para editar un usuario
    public static function editarUsuarioModel($datos, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id, nombre, password, email, rol FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    # Actualizar un usuario
    public static function actualizarUsuarioModel($datos, $tabla)
    {
        $stnt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, email = :email, rol = :rol WHERE id = :id");
        $stnt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stnt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stnt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stnt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stnt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);

        if ($stnt->execute()) {
            return "success";
        } else {
            $stnt->errorInfo();
        }
    }

    # Validar ingreso de un usuario
    public static function ingresarUsuarioModel($datos, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id, nombre, password, rol FROM $tabla WHERE nombre = :nombre");
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    # Validar en caso de coincidencias de un usuario (AJAX) (Nombre)
    public static function validarUsuarioModel($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT count(nombre) FROM usuarios WHERE nombre = :nombre");
        $stmt->bindParam(":nombre", $datos, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    # Validar en caso de coincidencias de un usuario (AJAX) (Email)
    // public static function validarEmailModel($datos)
    // {
    //     $stmt = Conexion::conectar()->prepare("SELECT count(email) FROM usuarios WHERE email = :email");
    //     $stmt->bindParam(":email", $datos, PDO::PARAM_STR);
    //     $stmt->execute();
    //     return $stmt->fetch();
    // }


    ///////////////////////////////////////////////////
    // Parte de los productos \\
    //////////////////////////////////////////////////

    # Registrar un producto
    public static function registrarProductoModel($datos, $tabla)
    {
        $stnt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigoProducto, nombreProducto, descripcion, stock, precio, id_usuario) VALUES (:codigoProducto, :nombreProducto, :descripcion, :stock, :precio, :id_usuario)");
        $stnt->bindParam(":codigoProducto", $datos["codigoProducto"], PDO::PARAM_STR);
        $stnt->bindParam(":nombreProducto", $datos["nombreProducto"], PDO::PARAM_STR);
        $stnt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stnt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
        $stnt->bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
        $stnt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);


        if ($stnt->execute()) {
            return "success";
        } else {
            $stnt->errorInfo();
        }
    }

    # Mostrar los productos
    public static function mostrarProductosModel($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id, codigoProducto, nombreProducto, descripcion, stock, precio FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    # Traer vista para editar un producto
    public static function editarProductoModel($datos, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id, codigoProducto, nombreProducto, descripcion, stock, precio FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    # Actualizar un producto
    public static function actualizarProductoModel($datos, $tabla)
    {
        $stnt = Conexion::conectar()->prepare("UPDATE $tabla SET codigoProducto = :codigoProducto, nombreProducto = :nombreProducto, descripcion = :descripcion, stock = :stock, precio = :precio WHERE id = :id");
        $stnt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stnt->bindParam(":codigoProducto", $datos["codigoProducto"], PDO::PARAM_STR);
        $stnt->bindParam(":nombreProducto", $datos["nombreProducto"], PDO::PARAM_STR);
        $stnt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stnt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
        $stnt->bindParam(":precio", $datos["precio"], PDO::PARAM_INT);

        if ($stnt->execute()) {
            return "success";
        } else {
            $stnt->errorInfo();
        }
    }

    # Borrar un producto
    public static function borrarProductoModel($datos, $tabla)
    {
        $stnt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stnt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stnt->execute()) {
            return "success";
        } else {
            return $stnt->errorInfo();
        }
    }
}


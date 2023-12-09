<?php
require_once('../Models/cls_usuario.model.php');
$usuarios = new Clase_Usuarios;
switch ($_GET["op"]) {
    case 'todos':
        $datos = array(); //defino un arreglo
        $datos = $usuarios->todos(); //llamo al modelo de usuarios e invoco al procedimiento todos y almaceno en una variable
        while ($fila = mysqli_fetch_assoc($datos)) { //recorro el arreglo de datos
            $todos[] = $fila;
        }
        echo json_encode($todos); //devuelvo el arreglo en formato json
        break;
    case "uno":
        $UsuarioId = $_POST["UsuarioId"]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $usuarios->uno($UsuarioId); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        $uno = mysqli_fetch_assoc($datos); //recorro el arreglo de datos
        echo json_encode($uno); //devuelvo el arreglo en formato json
        break;
    case 'insertar':
        $cedula = $_POST["cedula"];
        $Nombres = $_POST["Nombres"];
        $Apellidos = $_POST["Apellidos"];
        $Telefono = $_POST["Telefono"];
        $contrasenia = $_POST["contrasenia"];
        $correo = $_POST["correo"];
        $Rol = $_POST["Rol"];

        $datos = array(); //defino un arreglo
        $datos = $usuarios->insertar($cedula, $Nombres, $Apellidos, $Telefono, $correo, $contrasenia,  $Rol); //llamo al modelo de usuarios e invoco al procedimiento insertar
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'actualizar':
        $UsuarioId = $_POST["UsuarioId"];
        $cedula = $_POST["cedula"];
        $Nombres = $_POST["Nombres"];
        $Apellidos = $_POST["Apellidos"];
        $Telefono = $_POST["Telefono"];
        $contrasenia = $_POST["contrasenia"];
        $correo = $_POST["correo"];
        $Rol = $_POST["Rol"];

        $datos = array(); //defino un arreglo
        $datos = $usuarios->actualizar($UsuarioId, $cedula, $Nombres, $Apellidos, $Telefono, $contrasenia, $correo, $Rol); //llamo al modelo de usuarios e invoco al procedimiento actual
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'eliminar':
        $UsuarioId = $_POST["UsuarioId"]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $usuarios->eliminar($UsuarioId); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'actualizar_contrasenia':
        $UsuarioId = $_POST["UsuarioId"];
        $contrasenia = $_POST["contrasenia"];
        $datos = array(); //defino un arreglo
        $datos = $usuarios->actualizar_contrasenia($UsuarioId, $contrasenia); //llamo al modelo de usuarios e invoco al procedimiento actual
        echo json_encode($datos);
        break;
        case 'login':
            $correo = $_POST["correo"];
            $contrasenia = $_POST["contrasenia"];
            if (empty($correo) || empty($contrasenia)) {
                header("Location:../login.php?op=1"); //llenar datos vacios
                exit();
            }
            try {
                $datos = array(); // defino un arreglo
                $datos = $usuarios->login($correo, $contrasenia); // almaceno en el arreglo la información de la base de datos
                $respuesta = mysqli_fetch_assoc($datos); // declaro una variable "respuesta" para usar los valores que trae
                if (is_array($respuesta) and count($respuesta) > 0) {  // comparar si la variable "respuesta" tiene datos y es un arreglo
                    // poner variables de sesión y controlar accesos
                    //$respuesta -> trae toda la información del usuario
                    session_start();
                    if (password_verify($contrasenia, $respuesta["contrasenia"])) {  // comparar la contraseña de la base con la contraseña que ingresó el usuario
                        $_SESSION['Nombres']  = $respuesta["Nombres"];
                        $_SESSION['Apellidos'] = $respuesta["Apellidos"];
                        $_SESSION['correo']    = $respuesta["correo"];
                        $_SESSION['Rol']       = $respuesta["Rol"];
                        $_SESSION['UsuarioId'] = $respuesta["UsuarioId"];
                        header("Location:../views/index.php");
                    } else {
                        header("Location:../login.php?op=2"); // el usuario o la contraseña son incorrectos
                        exit();
                    }
                } else {
                    header("Location:../login.php?op=2"); // el usuario o la contraseña son incorrectos
                    exit();
                }
            } catch (\Throwable $th) {
                echo json_encode($th->getMessage());
                header("Location:../login.php?op=3"); // no se qué error escribir, es para capturar un error de código
            }
            break;
       
    case "cedula_repetida":
        $cedula = $_POST["cedula"];
        $datos = array(); //defino un arreglo
        $datos = $usuarios->cedula_repetida($cedula); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        $uno = mysqli_fetch_assoc($datos); //recorro el arreglo de datos
        echo json_encode($uno); //devuelvo el arreglo en formato json
        break;
    case "verifica_correo":
        $correo = $_POST["correo"];
        $datos = array(); //defino un arreglo
        $datos = $usuarios->verifica_correo($correo); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        $uno = mysqli_fetch_assoc($datos); //recorro el arreglo de datos
        echo json_encode($uno); //devuelvo el arreglo en formato json
        break;
}
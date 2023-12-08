<?php
require_once('../Models/cls_computadoras.model.php');
$lavadoras = new Clase_Computadoras;
switch ($_GET["op"]) {
    case 'todos':
        $datos = array(); //defino un arreglo
        $datos = $computadoras->todos(); //llamo al modelo de usuarios e invoco al procedimiento todos y almaceno en una variable
        while ($fila = mysqli_fetch_assoc($datos)) { //recorro el arreglo de datos
            $todos[] = $fila; 
        }
        echo json_encode($todos); //devuelvo el arreglo en formato json
        break;
    case "uno":
        $computadoraId = $_POST["computadoraId"]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $computadoras->uno($computadoraId); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        $uno = mysqli_fetch_assoc($datos); //recorro el arreglo de datos
        echo json_encode($uno); //devuelvo el arreglo en formato json
        break;
    case 'insertar':
        $tipocomputadora = $_POST["tipocomputadora"];
        $modelo = $_POST["modelo"];
        $nserie = $_POST["nserie"];
        $marca = $_POST["marca"];
        $precio= $_POST["precio"];
        $datos = array(); //defino un arreglo
        $datos = $computadoras->insertar($tipocomputadora, $modelo, $nserie, $marca,  $precio); //llamo al modelo de usuarios e invoco al procedimiento insertar
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'actualizar':
        $computadoraId = $_POST["computadoraId"];
        $tipocomputadora = $_POST["tipocomputadora"];
        $modelo = $_POST["modelo"];
        $nserie = $_POST["nserie"];
        $marca = $_POST["marca"];
        $precio= $_POST["precio"];
        $datos = array(); //defino un arreglo
        $datos = $computadoras->actualizar($computadoraId, $tipocomputadora, $modelo, $nserie, $marca,  $precio); //llamo al modelo de usuarios e invoco al procedimiento insertar
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'eliminar':
        $computadoraId = $_POST["computadoraId"]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $computadoras->eliminar($computadoraId); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
}

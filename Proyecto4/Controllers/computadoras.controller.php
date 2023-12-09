<?php
require_once('../Models/cls_computadoras.model.php');

$computadoras = new Clase_Computadoras;

if (isset($_GET["op"])) {
    switch ($_GET["op"]) {
        case 'todos':
            $datos = $computadoras->todos();
            $todos = [];
            while ($fila = mysqli_fetch_assoc($datos)) {
                $todos[] = $fila;
            }
            echo json_encode($todos);
            break;
        case "uno":
            if (isset($_POST["computadoraId"])) {
                $computadoraId = $_POST["computadoraId"];
                $datos = $computadoras->uno($computadoraId);
                $uno = mysqli_fetch_assoc($datos);
                echo json_encode($uno);
            } else {
                echo json_encode(["error" => "Falta el parámetro 'computadoraId'"]);
            }
            break;
        case 'insertar':
            if (isset($_POST["tipocomputadora"]) && isset($_POST["modelo"]) && isset($_POST["nserie"]) && isset($_POST["marca"]) && isset($_POST["precio"])) {
                $tipocomputadora = $_POST["tipocomputadora"];
                $modelo = $_POST["modelo"];
                $nserie = $_POST["nserie"];
                $marca = $_POST["marca"];
                $precio = $_POST["precio"];
                $datos = $computadoras->insertar($tipocomputadora, $modelo, $nserie, $marca, $precio);
                echo json_encode($datos);
            } else {
                echo json_encode(["error" => "Faltan parámetros necesarios"]);
            }
            break;
        case 'actualizar':
            if (isset($_POST["computadoraId"]) && isset($_POST["tipocomputadora"]) && isset($_POST["modelo"]) && isset($_POST["nserie"]) && isset($_POST["marca"]) && isset($_POST["precio"])) {
                $computadoraId = $_POST["computadoraId"];
                $tipocomputadora = $_POST["tipocomputadora"];
                $modelo = $_POST["modelo"];
                $nserie = $_POST["nserie"];
                $marca = $_POST["marca"];
                $precio = $_POST["precio"];
                $datos = $computadoras->actualizar($computadoraId, $tipocomputadora, $modelo, $nserie, $marca, $precio);
                echo json_encode($datos);
            } else {
                echo json_encode(["error" => "Faltan parámetros necesarios"]);
            }
            break;
        case 'eliminar':
            if (isset($_POST["computadoraId"])) {
                $computadoraId = $_POST["computadoraId"];
                $datos = $computadoras->eliminar($computadoraId);
                echo json_encode($datos);
            } else {
                echo json_encode(["error" => "Falta el parámetro 'computadoraId'"]);
            }
            break;
        default:
            echo json_encode(["error" => "Operación no válida"]);
            break;
    }
} else {
    echo json_encode(["error" => "Falta el parámetro 'op'"]);
}

<?php

require 'datos.php';


function validaCampos()
{
    //Comprobamos que todos los campos se han rellenado
    $obligatorios = ["Nombre", "Apellido", "DNI"];
    $errores = [];

    foreach ($obligatorios as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $errores[] = $campo . " es un campo obligatorio";
        }
    }
    return $errores;
}

function buscarUsuario($nombre, $apellido)
{
    $valido = false;
    foreach (USUARIOS as $usuario) {
        if ($usuario['nombre'] == $nombre && $usuario['apellido'] == $apellido)
            $valido = true;
    };
    return $valido;
}

function validaDni($dni)
{
    //VALIDACIONES DNI
    $numerosDni = intval($dni);
    $letraDni = strtoupper(substr($dni, -1));
    $error = "CORRECTA";
    $errores = [];
    $letras = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];

    $letraDivision = $letras[$numerosDni % 23];
    if (strlen($dni) != 9) {
        $error = "CON ERRORES";
        $errores[] = "ERROR. El DNI debe tener ocho números y una letra";
    } elseif ($letraDni != $letraDivision) {
        $error = "CON ERRORES";
        $errores[] = "La letra del DNI no es correcta. Deberia ser la letra: " . $letraDivision;
    }
    return array(
        "error" => $error,
        "errores" => $errores
    );
}

function validaFechas($fecha, $duracion)
{
    $fechaActual = new DateTime();
    $fechaInicio = new DateTime($fecha);

    //Valida que la fecha de inicio de reserva no es anterior a la fecha actual
    if ($fechaInicio < $fechaActual) {
        $error = "CON ERRORES";
        $errores[] = "ERROR. Debes introducir una fecha de inicio de alquiler valida";
    }
    //Valida que la duración es un número entre 1 y 30
    elseif ($duracion < 1 || $duracion > 30) {
        $error = "CON ERRORES";
        $errores[] = "ERROR. La duracion debe estar entre 1 y 30 dias";
    } else {
        $error = "CORRECTA";
        $errores = [];
    }

    return array(
        "error" => $error,
        "errores" => $errores
    );
}

function validaReserva($coche, $fechaInicio, $duracion,)
{
    //Si es todo es correcto, calculamos la fecha de fin
    $fechaInicio = new DateTime($fechaInicio);
    $fechaFinal = $fechaInicio->modify("+$duracion days");
    //$fecha = $fechaInicio->format('d-m-Y');

    $disponible = false;
    foreach (COCHES as $car) {
        if ($car["modelo"] === $coche) {
            if ($car["disponible"] === true) {
                $disponible = true;
                break;
            }
        }
    }


    return $disponible;
}

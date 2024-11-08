<!DOCTYPE html>
<html lang='es'>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Ficha alquiler</title>
    <style>
        form {
            background-color: gray;
            width: 30%;
            margin: auto;
            padding: 10px;

        }

        #resul {
            background-color: white;
            height: 20px;
            width: 350px;
        }

        #categ {
            color: white;
        }

        input {
            height: 20px;
            width: 250px;
        }

        h2 {
            color: white
        }
    </style>
</head>

<body>
    <form action="index.php" method="get">
        <h2>FICHA DE ALQUILER</h2>
        <?php

        require 'funciones.php';

        //valida que los campos esten completados
        $errores =  validaCampos();

        //Añadimos a las variables el valor de cada campo del formulario
        $nombre = $_POST['Nombre'];
        $apellido = $_POST['Apellido'];
        $dni = $_POST['DNI'];
        $coche = $_POST['Coche'];
        $fecha = $_POST['Fecha_alquiler'];
        $dias = $_POST['Dias'];
        $error  = "CORRECTA";

        //Si no hay errores procedemos a las validaciones
        if (empty($errores)) {

            if (!buscarUsuario($nombre, $apellido)) {
                $errores['usuario'] = "ERROR. El usuario no existe.";
            }

            $resultadoDni = validaDni($dni);
            if ($resultadoDni["error"] == "CON ERRORES") {
                $errores['dni'] = $resultadoDni["errores"];
            }

            $resultadoFecha = validaFechas($fecha, $dias);
            if ($resultadoFecha["error"] == "CON ERRORES") {
                $errores['fecha'] = $resultadoFecha["errores"];
            }

            if (!validaReserva($coche, $fecha, $dias)) {
                $errores['reserva'] = "ERROR. El coche no está disponible en las fechas requeridas.";
            }
        }

        ?>
        <form name="input" action="index.php" method="post">
            <h2><?php echo $error ?></h2>
            <br />
            <?php

            //Si hay errores los muestra. Si no hay errores la reserva es valida.
            if (empty($errores)) {
                echo "<p id='categ'>Nombre completo</p><p id='resul'>$nombre $apellido</p><br />";
                echo "<p id='categ'>Vehículo reservado</p><p id='resul'>$coche</p><br />";

                echo "<img src='imagenes/{$coche}.jpg' alt='Imagen del coche' width='300'>";
            } else {
                echo "<h2 class='error'>Reserva No Válida</h2>";

                //Recorre el array de errores para pintarlos. Comprueba si el mensaje es un array para recorrerlo
                foreach ($errores as $error) {
                    if (is_array($error)) {
                        foreach ($error as $mensaje) {
                            echo "<p style='color:red;'>$mensaje</p>";
                        }
                    } else {
                        echo "<p style='color:red;'>$error</p>";
                    }
                }
            }

            ?>
            <br />
            <button type="submit" value="Volver" href="indes.php">VOLVER</button>
        </form>

    </form>
</body>

</html>
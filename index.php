<!DOCTYPE html>
<html lang='es'>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Ficha alquier</title>
    <style>
        form {
            background-color: gray;
            width: 30%;
            margin: auto;
            padding: 10px;

        }

        input {
            height: 20px;
            width: 250px;
        }
    </style>
</head>

<body>
    <form name="input" action="valida.php" method="post">
        <h2> Ficha de alquiler</h2>
        <p style=color:white>Nombre </p><input type="text" name="Nombre" /><br />
        <p style=color:white>Apellido </p> <input type="text" name="Apellido" /><br />
        <p style=color:white>DNI </p><input type="text" name="DNI" /><br />
        <p style=color:white>Modelo vehiculo </p><select name="Coche">
            <option value="Lancia Stratos">Lancia Stratos</option>
            <option value="Audi Quattro">Audi Quattro</option>
            <option value="Ford Escort RS1800">Ford Escort RS 1800</option>
            <option value="Subaru Impreza 555">Subaru Impreza 555</option>
        </select><br />
        <p style=color:white>Fecha Alquiler </p><input type="date" name="Fecha_alquiler" /><br />
        <p style=color:white>Duracion de la reserva (Dias) </p><input type="number" name="Dias" /><br />

        <br />
        <input type="submit" value="Enviar" />
    </form>
</body>

</html>
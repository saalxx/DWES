<?php


namespace AP33\Views;

class ListadoTareas
{
    public function displayTareas($result)
    {
        echo "<!doctype html>
            <html lang='es'>
            <head>
                <meta charset='utf-8'>
                <title>Tabla de registros</title>
            </head>
            <body>
            
            <h1>Registros</h1>
              
            <table border='1'>
            <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Fecha de creiacion</th>
                        <th>Fecha de vencimiento</th>
                    </tr>
            </thead>
            <tbody>";
        foreach ($result as $row) {
            echo "
                    <tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["titulo"] . "</td>
                        <td>" . $row["descripcion"] . "</td>
                        <td>" . $row["fecha_creacion"] . "</td>
                        <td>" . $row["fecha_vencimiento"] . "</td>
                    </tr>

            ";
        }
        echo "
            </tbody>
            </table>
            </body>
            </html>";
    }
}
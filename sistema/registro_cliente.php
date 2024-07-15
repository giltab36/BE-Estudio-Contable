<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../db.php";

// Función para manejar el registro de clientes
/* function registrarCliente($conection)
{
    $alert = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_cliente'])) {
        // Recolectar datos del formulario
        $carpeta = $_POST['carpeta'];
        $f_cliente = $_POST['f_cliente'];
        $ruc = $_POST['ruc'];
        $dv = $_POST['dv'];
        $nombre = $_POST['nombre'];
        $fantasia = $_POST['fantasia'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        // Preparar la consulta SQL para insertar datos del cliente
        $query = "INSERT INTO cliente (carpeta, f_cliente, ruc, dv, nombre, fantasia, telefono, direccion)
                  VALUES ('$carpeta', '$f_cliente', '$ruc', '$dv', '$nombre', '$fantasia', '$telefono', '$direccion')";

        // Ejecutar la consulta
        if (mysqli_query($conection, $query)) {
            $alert = "Cliente registrado correctamente.";
        } else {
            $alert = "Error al registrar el cliente: " . mysqli_error($conection);
        }
    }
    return $alert;
}

// Obtener las obligaciones registradas previamente
function obtenerObligaciones($conection)
{
    $query = "SELECT * FROM tipo_obligacion";
    $result = mysqli_query($conection, $query);

    $obligaciones = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $obligaciones[] = $row;
    }
    return $obligaciones;
}

// Llamar a las funciones correspondientes
$alert_cliente = registrarCliente($conection);
$obligaciones = obtenerObligaciones($conection); */

mysqli_close($conection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "include/script.php"; ?>
    <title>Registrar Cliente</title>
</head>

<body>
    <?php include "include/nav.php"; ?>
    <section class="dashboard">
        <h1 class="user_new"><i class="fa-solid fa-user-plus"></i> Clientes</h1>
        <hr class="hr">
        <div class="container">
            <div class="left_side">

                <!-- Formulario de registro de cliente -->
                <div class="form_register_client">
                    <div class="alerta"><?php //echo $alert_cliente; ?></div>

                    <form class="form_client" action="" method="POST">
                        <input type="hidden" name="registrar_cliente" value="1">
                        <label class="lb_client_1" for="carpeta">CARPETA:</label>
                        <label class="lb_client_2" for="f_cliente">CLIENTE DESDE:</label>
                        <label class="lb_client_3" for="ruc">RUC:</label>
                        <label class="lb_client_4" for="dv">DV:</label>
                        <br>
                        <input class="in_client_1" type="number" name="carpeta" id="carpeta" placeholder="N° Carpeta">
                        <input class="in_client_2" type="date" name="f_cliente" id="f_cliente">
                        <input class="in_client_3" type="number" name="ruc" id="ruc" placeholder="N° de Documento">
                        <input class="in_client_4" type="number" name="dv" id="dv" placeholder="dv">
                        <br>
                        <br>
                        <label class="lb_client_5" for="nombre">NOMBRE Y APELLIDO:</label>
                        <label class="lb_client_6" for="fantasia">NOMBRE DE FANTASÍA:</label>
                        <br>
                        <input class="in_client_5" type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
                        <input class="in_client_6" type="text" name="fantasia" id="fantasia" placeholder="Nombre de Fantasía">
                        <br>
                        <br>
                        <label class="lb_client_7" for="telefono">TELEFONO:</label>
                        <br>
                        <input class="in_client_7" type="text" inputmode="numeric" name="telefono" id="telefono" placeholder="N° de Teléfono">
                        <br>
                        <br>
                        <label class="lb_client_8" for="direccion">DIRECCION:</label>
                        <br>
                        <input class="in_client_8" type="text" name="direccion" id="direccion" placeholder="Dirección">
                        <button type="submit" class="btn_option colur1"><i class="fa-regular fa-floppy-disk"></i><b> Registrar</b></button>
                    </form>

                    <!-- Lista de obligaciones temporales -->
                    <div class="obligaciones_list">
                        <h1 class="obligaciones_new"><i class="fa-solid fa-user-plus"></i> Obligaciones</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">Obligaciones</th>
                                    <th scope="col">Importe</th>
                                    <th scope="col">Vencimiento</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="lista_obligaciones_temporales">
                            </tbody>
                        </table>
                        <button id="btn_mostrar_formulario" class="btn_obli"><i class="fa-solid fa-plus"></i> Añadir Obligación</button>
                    </div>
                    <button type="submit" class="btn_option colur2"><i class="fa-regular fa-floppy-disk"></i><b> Eliminar</b></button>
                </div>
            </div>

            <!-- Lista de clientes -->
            <div class="right_side">
                <div class="client_list_box">
                    <div class="form_search">
                        <input class="input_search" type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                        <button type="submit" class="btn_search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Carpeta</th>
                                    <th>Nombre</th>
                                    <th>RUC</th>
                                    <th>DV</th>
                                    <th>Teléfono</th>
                                </tr>
                            </thead>
                        </table>
                    </h2>
                    <?php
                    // Consulta para obtener los datos de los clientes
                    $query = mysqli_query($conection, "SELECT * FROM cliente WHERE estatus = 1");
                    mysqli_close($conection);
                    $result = mysqli_num_rows($query);

                    // Comprueba si hay resultados y los muestra
                    if ($result > 0) {
                    ?>
                        <?php
                        $index = 1;
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <div class="scrollable-container-client">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['carpeta']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $row['ruc']; ?></td>
                                            <td><?php echo $row['dv']; ?></td>
                                            <td><?php echo $row['telefono']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <table>
                            <tbody>
                                <tr>
                                    <td style="text-align: center;">No se encontraron registros</td>
                                </tr>
                            </tbody>
                        </table>
                    <?php
                    } ?>
                </div>
            </div>
        </div>

        <!-- Formulario emergente para añadir obligación -->
        <div id="formularioObligacion" class="modal">
            <div class="modal-content">
                <span id="btn_cerrar_formulario" class="close">&times;</span>
                <h2>Añadir Obligación</h2>
                <div class="alerta" id="alerta_obligacion"></div>
                <form id="form_agregar_obligacion">
                    <label for="obligacion">Tipo de Obligación:</label>
                    <select name="obligacion" id="obligacion">
                        <?php foreach ($obligaciones as $obligacion) : ?>
                            <option value="<?php echo $obligacion['id']; ?>"><?php echo $obligacion['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="monto">Importe:</label>
                    <input type="number" name="monto" id="monto" placeholder="Importe">
                    <label for="vencimiento">Vencimiento:</label>
                    <input type="date" name="vencimiento" id="vencimiento">
                    <!-- <input type="hidden" name="cliente_id" id="cliente_id" value="1"> --> <!-- Ejemplo de ID de cliente -->
                    <button type="button" id="btn_agregar_obligacion" class="btn_option colur1"><i class="fa-regular fa-floppy-disk"></i><b> Añadir</b></button>
                </form>
            </div>
        </div>
    </section>

</body>

</html>
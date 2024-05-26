<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
/* include "../db.php";

if (!empty($_POST)) {
    $alert = '';
    if (/* empty($_POST['nombre']) || empty($_POST['username']) /* || empty($_POST['correo'])  || empty($_POST['clave']) || empty($_POST['rol'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        /* $idusuario = $_POST['id']; <= para la auditoria 
        $nombre = $_POST['nombre'];
        $user = $_POST['username'];
        $email = $_POST['correo'];
        $pass = md5($_POST['clave']);
        $rol = $_POST['rol'];

        $query = mysqli_query($conection, "SELECT * FROM user WHERE username = '$user' /* OR correo = '$email' ");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El correo o el usuario ya existe.</p>';
        } else {
            if (empty($_POST['nombre'])) {
                $query_insert = mysqli_query($conection, "INSERT INTO user (username, correo, clave, rol) VALUE ('$user', '$email', '$pass', '$rol')");
            } elseif (empty($_POST['correo'])) {
                $query_insert = mysqli_query($conection, "INSERT INTO user (nombre, username, clave, rol) VALUE ('$nombre', '$user', '$pass', '$rol')");
            } elseif (empty($_POST['correo']) || empty($_POST['correo'])) {
                $query_insert = mysqli_query($conection, "INSERT INTO user (username, clave, rol) VALUE ('$user', '$pass', '$rol')");
            } else {
                $query_insert = mysqli_query($conection, "INSERT INTO user (nombre, username, correo, clave, rol) VALUE ('$nombre', '$user', '$email', '$pass', '$rol')");
            }
            /* $query_insert = mysqli_query($conection, "INSERT INTO user (nombre, username, correo, clave, rol) VALUE ('$nombre', '$user', '$email', '$pass', '$rol')"); 

            if ($query_insert) {
                $alert = '<p class="msg_save">Usuario creado correctamente.</p>';
            } else {
                $alert = '<p class="msg_error">Error al crear el usuario.</p>';
            }
        }
    }
} */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "include/script.php"; ?>
    <title>Registrar Usuario</title>
</head>

<body>
    <?php include "include/nav.php"; ?>
    <section class="dashboard">
        <h1 class="user_new"><i class="fa-solid fa-user-plus"></i> Clientes</h1>
        <hr class="hr">
        <div class="container">
            <div class="form_register_client">
                <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>

                <form class="form_client" action="" method="POST">

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
                    <input class="in_client_5" type="number" name="nombre" id="nombre" placeholder="Nombre Completo">
                    <input class="in_client_6" type="number" name="fantasia" id="fantasia" placeholder="Nombre de Fantasía">
                    <br>
                    <br>
                    <label class="lb_client_7" for="telefono">TELEFONO:</label>
                    <br>
                    <input class="in_client_7" type="text" inputmode="numeric" name="telefono" id="telefono" placeholder="N° de Teléfono">
                    <br>
                    <br>
                    <label class="lb_client_8" for="direccion">DIRECCION:</label>
                    <br>
                    <input class="in_client_8" type="number" name="direccion" id="direccion" placeholder="Dirección">

                </form>

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
                        <tbody>
                            <tr>
                                <td>IRP</td>
                                <td>100.000</td>
                                <td>17/05</td>
                                <td><button class="btn_obli"><i class="fa-solid fa-plus"></i></button></td>
                            </tr>
                            <tr>
                                <td>IVA</td>
                                <td>100.000</td>
                                <td>17/05</td>
                                <td><button class="btn_obli"><i class="fa-solid fa-plus"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="" class="btn_option colur1"><i class="fa-regular fa-floppy-disk"></i><b> Nuevo</b></button>
                <button type="submit" class="btn_option colur1"><i class="fa-regular fa-floppy-disk"></i><b> Registrar</b></button>
                <button type="submit" class="btn_option colur2"><i class="fa-regular fa-floppy-disk"></i><b> Eliminar</b></button>
            </div>

            <div class="client_list">
                <div class="form_search">
                    <input class="input_search" type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                    <button type="submit" class="btn_search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
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
                    <tbody>
                        <tr>
                            <td>120</td>
                            <td>Juan Garcete</td>
                            <td>7.524.156</td>
                            <td>5</td>
                            <td>0972545645</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>
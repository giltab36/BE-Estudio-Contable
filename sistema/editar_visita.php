<?php
session_start();

include "../db.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['cliente']) || empty($_POST['atendido']) || empty($_POST['comentario'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {
        $id_visita = $_POST['id'];
        $cliente = mysqli_real_escape_string($conection, $_POST['cliente']);
        $atendido = mysqli_real_escape_string($conection, $_POST['atendido']);
        $comentario = mysqli_real_escape_string($conection, $_POST['comentario']);

        $sql_update = mysqli_query($conection, "UPDATE recep_visita SET cliente = '$cliente', atendido = '$atendido', comentario = '$comentario' WHERE id = $id_visita");

        if ($sql_update) {
            $alert = '<p class="msg_save">Registro editado correctamente.</p>';
        } else {
            $alert = '<p class="msg_error">Error al editar el registro.</p>';
        }
    }
}

//Mostras datos
if (empty($_REQUEST['id'])) {
    header('Location: lista_visita.php');
    mysqli_close($conection);
    exit;
}

$idrv = mysqli_real_escape_string($conection, $_REQUEST['id']);
$sql = mysqli_query($conection, "SELECT rv.id, rv.cliente, rv.atendido, rv.comentario, (rv.id_user) AS iduser, (u.id) AS user_id FROM recep_visita rv INNER JOIN user u ON rv.id_user = u.id WHERE rv.id = $idrv AND state = 1");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header('Location: lista_visita.php');
    mysqli_close($conection);
    exit;
} else {
    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $idrv = $data['id'];
        $cliente = $data['cliente'];
        $atendido = $data['atendido'];
        $comentario = $data['comentario'];
        $iduser = $data['iduser'];
    }

    $query_rol = mysqli_query($conection, "SELECT * FROM user");
    $result_rol = mysqli_num_rows($query_rol);

    if ($result_rol > 0) {
        while ($rol = mysqli_fetch_array($query_rol)) {
            $selected = ($rol['id'] == $iduser) ? 'selected' : '';
            $option .= '<option value="' . $rol['id'] . '" ' . $selected . '>' . $rol['nombre'] . '</option>';
        }
    }
}
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
        <div class="form_register_user">
            <h1 class="user_new"><i class="fa-solid fa-user-plus"></i> Editar Visita</h1>
            <hr class="hr">
            <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form class="form_user" action="" method="POST">

                <input type="hidden" name="id" value="<?php echo $idrv; ?>">

                <label class="lb_user" for="cliente">Cliente:</label>
                <input class="in_user" type="text" name="cliente" id="cliente" value="<?php echo $cliente; ?>">

                <label class="lb_user" for="atendido">Atendido por:</label>
                <?php
                $query_rol = mysqli_query($conection, "SELECT * FROM user");
                $result_rol = mysqli_num_rows($query_rol);
                ?>
                <select name="atendido" id="atendido">
                    <?php
                    echo $option;
                    if ($result_rol > 0) {
                        while ($rol = mysqli_fetch_array($query_rol)) {
                            echo '<option value="' . $rol["id"] . '">' . $rol["nombre"] . '</option>';
                        }
                    }
                    ?>
                </select>

                <label class="lb_user" for="comentario">Comentario:</label>
                <textarea class="in_user comentario" type="text" name="comentario" id="comentario"><?php echo $comentario; ?></textarea>

                <input class="in_user" type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $_SESSION['idUser']; ?>">
                <button type="submit" class="btn_save"><i class="fa-regular fa-floppy-disk"></i> Registrar</button>

            </form>

        </div>
    </section>

    <?php
    mysqli_close($conection);
    include "include/footer.php";
    ?>
</body>

</html>
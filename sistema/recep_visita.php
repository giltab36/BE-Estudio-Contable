<?php
session_start();

include "../db.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['cliente']) || empty($_POST['atendido']) || empty($_POST['comentario'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $usuario_id = $_SESSION['idUser'];
        $nombre = $_POST['cliente'];
        $atendido = $_POST['atendido'];
        $comentario = $_POST['comentario'];


        $query_insert = mysqli_query($conection, "INSERT INTO recep_visita (cliente, atendido, comentario, id_user) VALUE ('$nombre', '$atendido', '$comentario', '$usuario_id')");

        if ($query_insert) {
            $alert = '<p class="msg_save">Registro creado correctamente.</p>';
        } else {
            $alert = '<p class="msg_error">Error al crear el registro.</p>';
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
            <h1 class="user_new"><i class="fa-solid fa-user-plus"></i> Registrar Visita</h1>
            <hr class="hr">
            <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form class="form_user" action="" method="POST">

                <label class="lb_user" for="cliente">Cliente:</label>
                <input class="in_user" type="text" name="cliente" id="cliente" placeholder="Nombre Completo">

                <label class="lb_user" for="atendido">Antedido por:</label>
                <?php
                $query_rol = mysqli_query($conection, "SELECT * FROM user WHERE id != 1");
                mysqli_close($conection);
                $result_rol = mysqli_num_rows($query_rol);
                ?>

                <select name="atendido" id="id">
                    <?php
                    if ($result_rol > 0) {
                        while ($rol = mysqli_fetch_array($query_rol)) {
                    ?>
                            <option value="<?php echo $rol["id"] ?>"><?php echo $rol["nombre"] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <label class="lb_user" for="comentario">Comentario:</label>
                <textarea class="in_user comentario" type="text" name="comentario" id="comentario" placeholder="Escriba un comentario"></textarea>
                <input class="in_user" type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $_SESSION['idUser']; ?>">
                <button type="submit" class="btn_save"><i class="fa-regular fa-floppy-disk"></i> Registrar</button>

            </form>

        </div>
    </section>



    <?php
    include "include/footer.php";
    ?>
</body>

</html>
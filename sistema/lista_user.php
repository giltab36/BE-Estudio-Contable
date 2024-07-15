<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

// Supongamos que ya tienes una conexión a la base de datos establecida en $conn
include "../db.php";

// Consulta para obtener los datos de los usuarios
$query = mysqli_query($conection, "SELECT u.id AS userid, u.nombre, u.username, u.correo, r.nombre AS n_rol FROM user u INNER JOIN rol r ON u.rol = r.id WHERE u.id != 1 ORDER BY u.id DESC");
mysqli_close($conection);
$result = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "include/script.php"; ?>
    <title>Listado Visitas</title>
</head>

<body>
    <?php include "include/nav.php"; ?>
    <section class="dashboard">
        <header>
            <h1>Listado de Usuarios</h1>
        </header>
        <main>
            <div class="scrollable-container">

                <?php
                // Comprueba si hay resultados y los muestra
                if ($result > 0) {
                ?>
                    <ul class="user-list">
                        <?php
                        $index = 1;
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <li class="user-item" value="<?php echo $row['userid']; ?>">
                                <div class="user-info">
                                    <h2>Nombre: <?php echo $row['nombre']; ?></h2>
                                    <p>Usuario: <?php echo $row['username']; ?></p>
                                    <?php if (empty($row['correo'])) { ?>
                                        <p>Correo: No posee correo</p>
                                    <?php } else { ?>
                                        <p>Correo: <?php echo $row['correo']; ?></p>
                                    <?php } ?>
                                    <p>Rol: <?php echo $row['n_rol']; ?></p>
                                </div>
                                <div class="user-actions">
                                    <button class="btn_edit" onclick="location.href='editar.php?userid=<?php echo $row['userid']; ?>'">Editar</button>
                                    <button class="btn_delete" onclick="location.href='eliminar.php?userid=<?php echo $row['userid']; ?>'">Eliminar</button>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    <?php
                } else {
                    ?>
                        <li style="text-align: center;" class="user-item">
                            <h2>NO HAY DATOS REGISTRADOS</h2>
                            <p>Desea regitrar algun dato?</p>
                            <p><button class="btn_new"><a class="link_new" href="./registro_usuario.php">Registrar</a></button></p>
                        </li>
                    <?php
                }
                    ?>
                    </ul>
            </div>
        </main>
    </section>
</body>

</html>
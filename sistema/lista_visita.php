<?php
session_start();

// Supongamos que ya tienes una conexión a la base de datos establecida en $conn
include "../db.php";

// Consulta para obtener los datos de los clientes
$query = mysqli_query($conection, "SELECT rv.id AS recepcion, rv.cliente, u1.nombre AS atendido_por, u2.username AS registrado_por, DATE_FORMAT(rv.fecha, '%d/%m/%Y') as fecha, DATE_FORMAT(rv.fecha,'%H:%i:%s') as hora, rv.comentario FROM recep_visita rv
                                    INNER JOIN user u1 ON rv.atendido = u1.id
                                    INNER JOIN user u2 ON rv.id_user = u2.id 
                                    ORDER BY rv.fecha DESC");
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
            <h1>Listado de Visitas</h1>
        </header>
        <main>
            <div class="scrollable-container">
                <?php
                // Comprueba si hay resultados y los muestra
                if ($result > 0) {
                ?>
                    <ul class="client-list">
                        <?php
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <li class="client-item">
                                <div class="client-info">
                                    <h2>Cliente: <?php echo $row['cliente'] ?></h2>
                                    <p>Atendido por: <?php echo $row['atendido_por'] ?></p>
                                    <p>Fecha: <?php echo $row['fecha'] ?></p>
                                    <p>Comentario: <?php echo $row['comentario'] ?></p>
                                    <p>Usuario: <?php echo $row['registrado_por'] ?></p>
                                    <input type="hidden" value="<?php echo $row['recepcion']; ?>">
                                </div>
                                <div class="edit-button">
                                    <a class="btn_edit" href="editar_visita.php?id=<?php echo $row['recepcion'] ?>"> Editar</a>
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
                            <p><button class="btn_new"><a class="link_new" href="./recep_visita.php">Registrar</a></button></p>
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
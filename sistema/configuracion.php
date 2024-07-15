<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

include "../db.php";

//	Datos de la Empresa
$nit = '';
$dv = '';
$nombreEmpresa = '';
$razonSocial = '';
$telEmpresa = '';
$emailEmpresa = '';
$dirEmpresa = '';

$query_empresa = mysqli_query($conection, "SELECT * FROM configuracion");
$row_empesa = mysqli_num_rows($query_empresa);

if ($row_empesa > 0) {
    while ($arrayInfoEmpresa  = mysqli_fetch_assoc($query_empresa)) {
        $nit = $arrayInfoEmpresa['ruc'];
        $dv = $arrayInfoEmpresa['dv'];
        $nombreEmpresa = $arrayInfoEmpresa['nombre'];
        $razonSocial = $arrayInfoEmpresa['razon_social'];;
        $telEmpresa = $arrayInfoEmpresa['telefono'];
        $emailEmpresa = $arrayInfoEmpresa['email'];
        $dirEmpresa = $arrayInfoEmpresa['direccion'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "include/script.php"; ?>
    <title>Configuracion</title>
</head>

<body>
    <?php include "include/nav.php"; ?>
    <section class="dashboard">
        <div class="conatinerDataEmpresa">
            <div class="logoEmpresa">
                <img src="../img/16.png">
            </div>
            <h3>Datos del Sistema</h3>
            <form method="POST" name="formEmpresa" id="formEmpresa">
                <input type="hidden" name="action" value="updateDataEmpresa">
                <div>
                    <label class=".label">Ruc:</label>
                    <input class="input" type="text" name="txtRuc" id="txtRuc" placeholder="Ruc de la empresa" value="<?php echo $nit ?>" required>
                </div>
                <div>
                    <label class=".label">Derivacion:</label>
                    <input class="input" type="text" name="txtDv" id="txtDv" placeholder="Numero de derivacion" value="<?php echo $dv ?>" required>
                </div>
                <div>
                    <label class=".label">Nombre del Sistema:</label>
                    <input class="input" type="text" name="txtNombre" id="txtNombre" placeholder="Nombre de la empresa" value="<?php echo $nombreEmpresa ?>" required>
                </div>
                <div>
                    <label class=".label">Razon Social:</label>
                    <input class="input" type="text" name="txtRSocial" id="txtRSocial" placeholder="Razon social" value="<?php echo $razonSocial ?>" required>
                </div>
                <div>
                    <label class=".label">Teléfono:</label>
                    <input class="input" type="text" name="txtTelEmpresa" id="txtTelEmpresa" placeholder="Número de teléfono" value="<?php echo $telEmpresa ?>" required>
                </div>
                <div>
                    <label class=".label">Correo electrónico:</label>
                    <input class="input" type="email" name="txtEmailEmpresa" id="txtEmailEmpresa" placeholdera="Correo electrónico" value="<?php echo $emailEmpresa ?>" required>
                </div>
                <div>
                    <label class=".label">Direccion:</label>
                    <input class="input" type="text" name="txtDirEmpresa" id="txtDirEmpresa" placeholdera="Direccion" value="<?php echo $dirEmpresa ?>" required>
                </div>
                <div class="alertFormEmrpresa" style="display: none;"></div>
                <div>
                    <button type="submit" class="btn_save btnChangePass"><i class="far fa-save fa-lg"></i> Guardar datos</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>
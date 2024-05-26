<?php
include "../db.php";
session_start();

if (!empty($_POST)) {
    //  Actualizar datos de la Empresa
    if ($_POST['action'] == 'updateDataEmpresa') {
        if (empty($_POST['txtRuc']) ||(empty($_POST['txtDv']) || empty($_POST['txtNombre']) || empty($_POST['txtTelEmpresa'])) || empty($_POST['txtEmailEmpresa']) || empty($_POST['txtDirEmpresa'])) {
            $code = '1';
            $msg = "Todos los campos son obligatorios";
        } else {
            $intNit = $_POST['txtRuc'];
            $intDv = $_POST['txtDv'];
            $strNombre = $_POST['txtNombre'];
            $strRSocial = $_POST['txtRSocial'];
            $intTel = $_POST['txtTelEmpresa'];
            $strEmail = $_POST['txtEmailEmpresa'];
            $strDir = $_POST['txtDirEmpresa'];

            $queryUpd = mysqli_query($conection, "UPDATE configuracion SET ruc = '$intNit', dv = '$intDv', nombre = '$strNombre', razon_social = '$strRSocial', telefono = '$intTel', email = '$strEmail', direccion = '$strDir' WHERE id = 1");
            mysqli_close($conection);

            if ($queryUpd) {
                $code = '00';
                $msg = "Datos actualizados correctamente.";
            } else {
                $code = '2';
                $msg = "Error al actualizar los datos.";
            }
        }
        $array_data = array('cod' => $code, 'msg' => $msg);
        echo json_encode($array_data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
exit;

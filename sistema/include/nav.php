<?php

if (empty($_SESSION['active'])) {
    header('location: ../');
}

include "../db.php";

//	Datos de la Empresa
$nombreEmpresa = '';

$query_empresa = mysqli_query($conection, "SELECT * FROM configuracion");
$row_empesa = mysqli_num_rows($query_empresa);

if ($row_empesa > 0) {
    while ($arrayInfoEmpresa  = mysqli_fetch_assoc($query_empresa)) {
        $nombreEmpresa = $arrayInfoEmpresa['nombre'];
    }
}

?>

<div class="sidebar close">
    <div class="logo-details">
        <img src="img/logo_be.png" alt="logo">
        <span class="logo_name"><?php echo $nombreEmpresa ?></span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="index.php">
                <i class="bx bx-grid-alt"></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="index.php">Dashboard</a></li>
            </ul>
        </li>
        <li>
            <a href="recep_visita.php">
                <i class='bx bxs-user-rectangle'></i>
                <span class="link_name">Visitas</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="recep_visita.php">Visitas</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class="bx bx-collection"></i>
                    <span class="link_name">Registro de Doc. IRP</span>
                </a>
                <i class="bx bxs-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Registro de Doc. IRP</a></li>
                <li><a href="recibido_irp.php">Doc. Recibido</a></li>
                <li><a href="caja_irp.php">Contenido en Caja</a></li>
                <li><a href="extras_irp.php">Cargas Extras</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class="bx bx-collection"></i>
                    <span class="link_name">Registro de Doc. IVA</span>
                </a>
                <i class="bx bxs-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Registro de Doc. IVA</a></li>
                <li><a href="recibido_iva.php">Doc. Recibido</a></li>
                <li><a href="caja_iva.php">Contenido en Caja</a></li>
            </ul>
        </li>
        <li>
            <a href="lista_visita.php">
                <i class='bx bx-list-ul'></i>
                <span class="link_name">Lista de Visitas</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="lista_visita.php">Lista de Visitas</a></li>
            </ul>
        </li>
        <?php if ($_SESSION['rol'] == 1) { ?>
            <li>
                <a href="lista_user.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="link_name">Lista de Usuarios</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="lista_user.php">Lista de Usuarios</a></li>
                </ul>
            </li>
            <li>
                <a href="registro_cliente.php">
                    <i class='bx bxs-user-plus'></i>
                    <span class="link_name">Clientes</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="registro_cliente.php">Clientes</a></li>
                </ul>
            </li>
            <li>
                <a href="registro_usuario.php">
                    <i class='bx bxs-user-plus'></i>
                    <span class="link_name">Usuarios</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="registro_usuario.php">Usuarios</a></li>
                </ul>
            </li>
            <li>
                <a href="configuracion.php">
                    <i class="bx bx-cog"></i>
                    <span class="link_name">Configuración</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="configuracion.php">Configuración</a></li>
                </ul>
            </li>
        <?php } ?>
    </ul>
    <div class="profile-details">
        <div class="profile-content">
            <img src="img/user.png" alt="profile">
        </div>
        <div class="name-job">
            <div class="profile_name"><?php echo $_SESSION['Nuser'] ?></div>
            <div class="job"><?php echo $_SESSION['Nrol'] ?></div>
        </div>
        <a href="salir.php">
            <i class="bx bx-log-out"></i>
        </a>
    </div>
</div>

<section class="home-section">
    <div class="home-content">
        <i class="bx bxs-chevron-right arrow_menu"></i>
        <p style="margin-left: 50px;" class="fecha">Paraguay, <?php echo fechaC(); ?></p>
        <span class="text"></span>
    </div>
</section>

<script>
    let arrow = document.querySelectorAll('.arrow');
    for (let i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener('click', (e) => {
            let arrowParent = e.target.parentElement.parentElement;
            console.log(arrowParent);
            arrowParent.classList.toggle('showMenu');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const arrowMenu = document.querySelector('.home-section .home-content i.arrow_menu');

        arrowMenu.addEventListener('click', function() {
            arrowMenu.classList.toggle('rotated');
        });
    });

    let sidebar = document.querySelector('.sidebar');

    let sidebarBtn = document.querySelector('.bxs-chevron-right');
    sidebarBtn.addEventListener('click', () => {
        sidebar.classList.toggle('close');
    })
</script>
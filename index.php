<?php

$alert = '';

session_start();

if (!empty($_SESSION['active'])) {
    header('location: sistema/');
    exit();
}

if (!empty($_POST)) {
    if (empty($_POST['username']) || empty($_POST['clave'])) {
        $alert = "Ingrese su nombre de usuario y su clave";
    } else {
        require_once "db.php";

        $user = mysqli_real_escape_string($conection, $_POST['username']);
        $pass = mysqli_real_escape_string($conection, $_POST['clave']);

        $query = mysqli_query($conection, "SELECT u.id, u.nombre, u.username, u.clave, u.state, u.rol, r.nombre AS n_rol 
                                            FROM user u
                                            INNER JOIN rol r ON u.rol = r.id
                                            WHERE u.username = '$user' AND u.state = 1");
        mysqli_close($conection);
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            $data = mysqli_fetch_array($query);

            if (password_verify($pass, $data['clave'])) {
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['id'];
                $_SESSION['Nuser'] = $data['nombre'];
                $_SESSION['user'] = $data['username'];
                $_SESSION['rol'] = $data['rol'];
                $_SESSION['Nrol'] = $data['n_rol'];

                header('location: sistema/');
                exit();
            } else {
                $alert = "El usuario o la clave son incorrectos";
                session_destroy();
            }
        } else {
            $alert = "El usuario o la clave son incorrectos";
            session_destroy();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="img/16.png" sizes="16x16">
    <title>BE Estudio Contable</title>
</head>

<body style="background: url('./img/1.webp') no-repeat; background-size: cover; background-position: center; height: 100%;">
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <p><img src="img/16.png" alt=""></p>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="#" class="link active"></a></li>
                    <li><a href="#" class="link"></a></li>
                    <li><a href="#" class="link"></a></li>
                    <li><a href="#" class="link"></a></li>
                </ul>
            </div>
            <div class="nav-button">
                <a class="be" for=""><b>BE Estudio Contable </b></a>
                <!-- <button class="btn white-btn" id="loginBtn" onclick="login()">Iniciar sesión</button> -->
                <!-- <button class="btn" id="registerBtn" onclick="register()">Registrarse</button> -->
            </div>
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>

        <!----------------------------- Form box ----------------------------------->
        <div class="form-box">

            <!------------------- login form -------------------------->

            <div class="login-container" id="login">
                <form action="" method="post">
                    <div class="top">
                        <!-- <span>¿No tienes una cuenta? <a href="#" onclick="register()">Registrarse</a></span> -->
                        <header>Iniciar Sesión</header>
                        <div class="alert" style="color: red;"><b><?php echo isset($alert) ? $alert : ''; ?></b></div>
                    </div>
                    <div class="input-box">
                        <input type="text" name="username" class="input-field" placeholder="Usuario o correo">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="clave" class="input-field" placeholder="Contraseña">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Acceder">
                    </div>
                    <div class="two-col">
                        <!-- <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Acuérdate de mí</label>
                    </div> -->
                        <div class="two">
                            <label><a href="#">¿Has olvidado tu contraseña?</a></label>
                        </div>
                    </div>
                </form>
            </div>

            <!------------------- registration form -------------------------->
            <!-- <div class="register-container" id="register">
                <div class="top">
                    <span>¿Tienes una cuenta? <a href="#" onclick="login()">Acceder</a></span>
                    <header>Registrarse</header>
                </div>
                <div class="two-forms">
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Nombre">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Apellido">
                        <i class="bx bx-user"></i>
                    </div>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Correo electronico">
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" placeholder="Contraseña">
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Register">
                </div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="register-check">
                        <label for="register-check"> Acuérdate de mí</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Terminos y Condiciones</a></label>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


            <!-- <script>
                function myMenuFunction() {
                    var i = document.getElementById("navMenu");

                    if (i.className === "nav-menu") {
                        i.className += " responsive";
                    } else {
                        i.className = "nav-menu";
                    }
                }
            </script> -->

            <script>
                var a = document.getElementById("loginBtn");
                var b = document.getElementById("registerBtn");
                var x = document.getElementById("login");
                var y = document.getElementById("register");

                function login() {
                    x.style.left = "4px";
                    y.style.right = "-520px";
                    a.className += " white-btn";
                    b.className = "btn";
                    x.style.opacity = 1;
                    y.style.opacity = 0;
                }

                function register() {
                    x.style.left = "-510px";
                    y.style.right = "5px";
                    a.className = "btn";
                    b.className += " white-btn";
                    x.style.opacity = 0;
                    y.style.opacity = 1;
                }
            </script>

</body>

</html>
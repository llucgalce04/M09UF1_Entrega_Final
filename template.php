<?php
session_start();

function openHTML($title)
{
    if (session_status() == PHP_SESSION_NONE && session_id() == '') {
        session_start();
    }
    
    $login_url = "login.php";
    $login_text = "Login";

    if (isset($_SESSION["id_user"])) {
        $login_url = "logout.php";
        $login_text = "Logout";
    }

    echo <<<EOD
<!DOCTYPE html>
<html>
<head>
<title>{$title}</title>
<link rel="stylesheet" type="text/css" href="estilo1.css">
</head>
<body>

<header>
    <h1>{$title}</h1>
    <nav>
        <ul>
            <li><a href="index.php">Portada</a></li>
            <li><a href="about.php">Sobre Masao</a></li>
            <li><a href="contact.php">Contacto</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="{$login_url}">{$login_text}</a></li>
        </ul>
    </nav>
</header>

<main>
EOD;

    if (isset($_SESSION["id_user"])) {
        $id_user = $_SESSION["id_user"];
        $conn = mysqli_connect("localhost", "masao", "masao", "masaoweb");

 	$sql = "SELECT COUNT(*) AS total FROM user_admins WHERE id_user = $id_user";
    	$result = mysqli_query($conn, $sql);
    	$row = mysqli_fetch_assoc($result);
    	$is_admin = $row["total"] > 0;
    	if ($is_admin) {
        echo "<p>Bienvenido, Admin.</p>";
    }

        $sql = "SELECT name FROM users WHERE id_user = $id_user";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $user_name = $row["name"];
        mysqli_close($conn);
        echo "<p>Hola {$user_name}</p>";
    }
}

function closeHTML()
{
    echo <<<EOD
</main>

<footer>

</footer>

</body>
</html>
EOD;
}
?>

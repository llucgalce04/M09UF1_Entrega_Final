<?php

if (!isset($_POST["email"]) or !isset($_POST["password"])) {
	die("Error 1: Envía el formulario completo");
}

$email = $_POST["email"];
$password = $_POST["password"];

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	die("Error 2: El correo electrónico no es válido");
}

if (strlen($_POST["password"]) < 6) {
	die("Error 3: La contraseña debe tener al menos 6 caracteres");
}

function validar_contrasena($password) {
	$caracteres_especiales = ['.', '\\', '_', '&'];
	$contiene_caracter_especial = false;
	for ($i = 0; $i < strlen($password); $i++) {
		if (in_array($password[$i], $caracteres_especiales)) {
			$contiene_caracter_especial = true;
		break;
		}
	}

	if (!$contiene_caracter_especial) {
		return false;
	}

	return true;
}

if (!validar_contrasena($password)) {
	die("ERROR 3.5: La contraseña debe contener al menos un carácter especial \".\_&\"");
}


function user_exists($email, $password) {
$conn = mysqli_connect("localhost", "masao", "masao", "masaoweb");

if (!$conn) {
	die("Error de conexión a la base de datos.");
}

$query = <<<EOD
SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}';
EOD;

	$result = $conn->query($query);

	if ($result && $result->num_rows > 0) {
		return true;
	} else {
		return false;
	}

	$conn->close();
	EOD;
}

if (user_exists($email, $password)) {
	$conn = mysqli_connect("localhost", "masao", "masao", "masaoweb");
	$query = <<<EOD
	SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}';
	EOD;
	$result = $conn->query($query);
	$user = $result->fetch_assoc();

	session_start();
	$_SESSION["id_user"] = $user["id_user"];

	header("Location: index.php");
	exit();
} else {
	die("Error al loguear al usuario.");
	header("Location: login.php");
}

?>

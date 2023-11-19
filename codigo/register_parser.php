<?php

if (!isset($_POST["name"]) or !isset($_POST["email"]) or !isset($_POST["password"]) or !isset($_POST["repassword"])) {
	die("Error 1: Envía el formulario completo");
}

$name = addslashes($_POST["name"]);
$password = $_POST["password"];

if (strlen($_POST["name"]) < 3) {
	die("Error 2: El nombre debe tener al menos 3 caracteres");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	die("Error 3: El correo electrónico no es válido");
}

if (strlen($_POST["password"]) < 6) {
	die("Error 4: La contraseña debe tener al menos 6 caracteres");
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

if ($_POST["password"] != $_POST["repassword"]) {
	die("Error 5: Las contraseñas no coinciden");
}

$conn = mysqli_connect("localhost", "masao", "masao", "masaoweb");

if (!$conn) {
	die("Error de conexión a la base de datos.");
}

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

$query = <<<EOD
INSERT INTO users (name, email, password) VALUES('{$name}', '{$email}', '{$password}');
EOD;

$result = mysqli_query($conn, $query);

if (!$result) {
	die("Error al registrar al usuario.");
}

header("Location: login.php");
exit();

?>

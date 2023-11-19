<?php

if (!isset($_POST["name"]) or !isset($_POST["email"]) or !isset($_POST["phone"]) or !isset($_POST["comment"])) {
	die("Error 1: Envía el formulario completo");
}

$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);
$comment = trim($_POST["comment"]);

$name = htmlspecialchars($name);
$email = htmlspecialchars($email);
$phone = htmlspecialchars($phone);
$comment = htmlspecialchars($comment);

if (strlen($name) < 2) {
	die("Error 2: El nombre debe tener al menos 2 caracteres");
}

if (strlen($email) < 6) {
	die("Error 3: El crrreo electrónico debe tener al menos 6 caracteres");
}

$email = addslashes($email);

if ($email != $_POST["email"]){
	die("Error 3.5: El correo tiene comillas");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	die("Error 4: El correo electrónico no es válido");
}

if (strlen($phone) < 9 or (strlen($phone) > 16)) {
	die("Error 5: Teléfono roto");
}

$phone = addslashes($phone);

if ($phone != $_POST["phone"]){
	die("Error 5.5: Teléfono con comillas");
}

if (strlen($comment) < 4) {
	die("Error: Comentario mas largo porfa");
}

$comment = addslashes($_POST["comment"]);

print_r($_POST);

$conn = mysqli_connect("localhost", "masao", "masao", "masaoweb");

$query = <<<EOD
INSERT INTO comments (name, email, phone, comment)
VALUES('{$name}', '{$email}', '{$phone}', '{$comment}');
EOD;

$conn->query($query);

header("Location: contact.php");
exit();

?>

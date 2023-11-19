<?php
session_start();

if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$conn = mysqli_connect("localhost", "masao", "masao", "masaoweb");

$query = "SELECT * FROM user_admins WHERE id_user = {$_SESSION['id_user']}";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
	require("template.php");
	openHTML("Publicar Blog");

	echo <<<EOD
	<form method="post" action="admin_parser.php">
		<h2>Nueva entrada de blog</h2>
		<p><label for="title">Título:</label><input type="text" name="title" id="title" /></p>
		<p><label for="text_entry">Texto:</label><textarea name="text_entry" id="text_entry"></textarea></p>
		<p><input type="submit" value="Agregar entrada" /></p>
	</form>
	EOD;

	closeHTML();
} else {
	header("Location: blog.php");
	exit;
}

mysqli_close($conn);
?>


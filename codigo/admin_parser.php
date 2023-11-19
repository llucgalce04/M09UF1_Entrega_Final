<?php
session_start();

if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = $_POST['title'];
	$text_entry = $_POST['text_entry'];

	$conn = mysqli_connect("localhost", "masao", "masao", "masaoweb");

	$query = "INSERT INTO blog (title, text_entry, date_created, user_id) VALUES (?, ?, NOW(), ?)";

	$stmt = mysqli_prepare($conn, $query);
	mysqli_stmt_bind_param($stmt, "ssi", $title, $text_entry, $_SESSION['id_user']);

	if (mysqli_stmt_execute($stmt)) {
		header("Location: admin.php?success=1");
		exit;
	} else {
		header("Location: admin.php?error=1");
		exit;
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
?>


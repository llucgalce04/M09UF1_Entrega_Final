<?php

if (!isset($_POST["uuid_comment"])){
	die("Error 1: Formulario no enviado");
} else {
$uuid_comment = $_POST["uuid_comment"];
}

if ($uuid_comment <= 0){
	die("Error 2: Comentario incorrecti");
}

session_start();

if (!isset($_SESSION["id_user"])){
	die("Error 3: Usuario no identificado");
}

$id_user = intval($_SESSION["id_user"]);
if ($id_user <= 0){
	die("Error 4: Usuario no existe");
}
$conn = mysqli_connect("localhost", "masao", "masao", "masaoweb");
$sql = "SELECT COUNT(*) AS total FROM user_admins WHERE id_user = $id_user";
    	$result = mysqli_query($conn, $sql);
    	$row = mysqli_fetch_assoc($result);
  	$is_admin = $row["total"] > 0;

    	if ($is_admin) {
		$query = "DELETE FROM comments WHERE uuid_comment='$uuid_comment'";
		$conn->query($query);
	}

header("Location: contact.php");
exit();
?>



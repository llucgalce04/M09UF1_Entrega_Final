<?php
if (session_status() == PHP_SESSION_NONE && session_id() == '') {
    session_start();
}
require("template.php");


openHTML("Blog de Masao");

$conn = mysqli_connect("localhost", "masao", "masao", "masaoweb");

$query = <<<EOD
SELECT title, text_entry, date_created FROM blog ORDER BY date_created DESC;
EOD;

$result = $conn->query($query);

if (!$result) {
	die("Error en la consulta: " . mysqli_error($conn));
}

echo "<section>";

while ($data = $result->fetch_assoc()) {
	echo "<article>";
	echo "<h2>" . $data["title"] . "</h2>";
	echo "<p>Date: " . $data["date_created"] . "</p>";
	echo "<p>" . $data["text_entry"] . "</p>";
	echo "</article>";
}

echo "</section>";

echo '<a href="admin.php"><button>Publicar un Blog</button></a>';

echo '<link rel="stylesheet" type="text/css" href="estilo1.css">';

echo <<<EOD

<style>
button {
	border: none;
	outline: none;
	background-color: cyan; 
	padding: 10px 20px;
	font-size: 12px;
	font-weight: 700;
	color: #fff;
	border-radius: 5px;
	transition: all ease 0.1s;
	box-shadow: 0px 5px 0px 0px darkcyan;
	float: left; 
  }
  
  button:active {
	transform: translateY(5px);
	box-shadow: 0px 0px 0px 0px darkcyan;
  }
  
  
  </style>

EOD;

mysqli_close($conn);

closeHTML();
?>


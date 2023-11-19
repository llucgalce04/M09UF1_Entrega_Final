<?php
require("template.php");

openHTML("Contacta con Masao");

echo <<<EOD
<link rel="stylesheet" href="estilo1.css">
<head>
<meta charset="UTF-8">
</head>

<h2>Formulario de contacto</h2>

<form class="contact-form" method="post" action="contact_parser.php">
  <p><label for="name">Nombre:</label><input type="text" name="name" id="name" /></p>
  <p><label for="email">e-mail:</label><input type="email" name="email" id="email" /></p>
  <p><label for="phone">Teléfono:</label><input type="text" name="phone" id="phone" /></p>
  <p><label for="comment">Comentario:</label><textarea name="comment" id="comment"></textarea></p>
  <p><input type="submit" value="Enviar comentario" /></p>
</form>

EOD;

$conn = mysqli_connect("localhost", "masao", "masao", "masaoweb");

$query = <<<EOD
SELECT * FROM comments ORDER BY id_comment DESC;
EOD;

$result = $conn->query($query);

echo "<aside>";

while($data = $result->fetch_assoc()){
	echo <<<EOD
<section class="user-info">
	<div class="image-left">
		<img src="masao1.jpg" alt="Imagen Izquierda">
	</div>
	<ul>
		<li>Date: {$data["date"]}</li>
		<li>Name: {$data["name"]}</li>
		<li>e-mail: {$data["email"]}</li>
		<li>Phone: {$data["phone"]}</li>
		<li>Comment: {$data["comment"]}</li>
	</ul>
	<div class="image-right">
	<img src="masao.gif" alt="Imagen Derecha">
	</div>
</section>

EOD;
}

echo "</aside>";

closeHTML();
?>

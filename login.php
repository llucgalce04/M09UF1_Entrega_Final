<?php
require("template.php");

openHTML("Login de Masaoweb!");

echo <<<EOD

<form method="POST" action="login_parser.php">
<h2>Login</h2>
<p><label for="login_email">e-mail:</label><input type="email" name="email" id="login_email" /></p>
<p><label for="login_passwd">Password:</label><input type="password" name="password" id="login_password"/></p>
<p><input type="submit" name="login" value="Iniciar sesión"/></p>
</form>

<form method="POST" action="register_parser.php">
<h2>Registro</h2>
<p><label for="register_name">Name:</label><input type="text" name="name" id="register_name" /></p>
<p><label for="register_email">e-mail:</label><input type="email" name="email" id="register_email" /></p>
<p><label for="register_passwd">Password:</label><input type="password" name="password" id="register_passwd"/></p>
<p><label for="register_repasswd">Password:</label><input type="password" name="repassword" id="register_repasswd"/></p>
<p><input type="submit" value="Registrar-se"/></p>
</form>

EOD;

closeHTML();
?>

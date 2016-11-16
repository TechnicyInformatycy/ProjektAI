<?php
error_reporting(E_ALL ^ E_WARNING);
include("./config/configmysql.php");
$powiadominie="
<center>
	<img src='https://cdn2.iconfinder.com/data/icons/computer-icons/100/PC2_go-27-512.png'/>
	<h2>Brak Połaczenia z baza dnaych</h2>
	<h3>Prosze spróbowac ponowonie jeśli błąd się wyświetla zgłoiś się do Administratora</h3>
</center>
";
$MYSQLLINK = mysqli_connect($configmysql['host'], $configmysql['login'], $configmysql['haslo'],$configmysql['baza']);
if (!$MYSQLLINK) {
	echo($powiadominie);
}
?>
<?php
/*
Zaplanowane Sesje:
ChatZalogowany - true,false  - czy zalogowany
ChatNick - String - nick uzyktownika
ChatIdUser - String - id uzyktownika
*/
require("include/mysql.php");
require("config/config.php");
session_start();
if(!isset($_SESSION["ChatZalogowany"])){
	header("Location: loguj.php");
}
?>
<?php
require("include/mysql.php");
require("config/config.php");
session_start();
$wiadomosc = $_POST['wiad'];
$zmiennaok = mysqli_query($MYSQLLINK,"INSERT INTO chat_message (idusera,wiadomosc,data) VALUES('".$_SESSION["ChatIdUser"]."','".$wiadomosc."','".date('d-m-Y')."');");
if($zmiennaok){
	echo "1";
}else{
	echo "Wiadomosc nie została wysłana";
}
?>
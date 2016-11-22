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
$dzisiaj=getdate();
$dzientygodnia=getdate()['wday'];
$dnitygodnia=array("ZerowyDzienTyg","poniedziałek","wtorek","środa","czwartek","piątek","sobota","niedziela");
$data=date("d.m.y");
$czas=date("h:i a");
if(isset($_GET["action"])){
	if($_GET["action"]="logout"){
		unset($_SESSION["ChatZalogowany"]);
		unset($_SESSION["ChatNick"]);
		unset($_SESSION["ChatIdUser"]);
		session_destroy();
		header("Location: loguj.php");
	}
}
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo($config['StronaNazwa'])?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
<style type="text/css">

.btn2{
  width: 18vh;
  height: 5vh;
  text-align: center;
  padding: 6px 0;
  font-size: 2vh;
  line-height: 1.428571429;
  border-radius: 10px;
}





body {
  padding-top: 0;
  font-size: 12px;
  color: #777;
  background: #f9f9f9;
  font-family: 'Open Sans',sans-serif;
  margin-top:20px;
}

.bg-white {
  background-color: #fff;
}

.friend-list {
  list-style: none;
margin-left: -40px;
}

.friend-list li {
  border-bottom: 1px solid #eee;
}

.friend-list li a img {
  float: left;
  width: 45px;
  height: 45px;
  margin-right: 0px;
}

 .friend-list li a {
  position: relative;
  display: block;
  padding: 10px;
  transition: all .2s ease;
  -webkit-transition: all .2s ease;
  -moz-transition: all .2s ease;
  -ms-transition: all .2s ease;
  -o-transition: all .2s ease;
}

.friend-list li.active a {
  background-color: #f1f5fc;
}

.friend-list li a .friend-name, 
.friend-list li a .friend-name:hover {
  color: #777;
}

.friend-list li a .last-message {
  width: 65%;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

.friend-list li a .time {
  position: absolute;
  top: 10px;
  right: 8px;
}

small, .small {
  font-size: 85%;
}

.friend-list li a .chat-alert {
  position: absolute;
  right: 8px;
  top: 27px;
  font-size: 10px;
  padding: 3px 5px;
  
}

.chat-message {
  padding: 60px 20px 115px;
}

.chat {
    list-style: none;
    margin: 0;
	overflow:scroll;
	height:75vh;
	width:100vh;
	padding-right:2vh;
}

.chat-message{
    background: #f9f9f9; 
	
}

.chat li img {
  width: 45px;
  height: 45px;
  border-radius: 50em;
  -moz-border-radius: 50em;
  -webkit-border-radius: 50em;
}

img {
  max-width: 100%;
}

.chat-body {
  padding-bottom: 20px;
  
}

.chat li.left .chat-body {
  margin-left: 70px;
  background-color: #fff;
}

.chat li .chat-body {
  position: relative;
  font-size: 11px;
  padding: 10px;
  border: 1px solid #f1f5fc;
  box-shadow: 0 1px 1px rgba(0,0,0,.05);
  -moz-box-shadow: 0 1px 1px rgba(0,0,0,.05);
  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
}

.chat li .chat-body .header {
  padding-bottom: 5px;
  border-bottom: 1px solid #f1f5fc;
}

.chat li .chat-body p {
  margin: 0;
}

.chat li.left .chat-body:before {
  position: absolute;
  top: 10px;
  left: -8px;
  display: inline-block;
  background: #fff;
  width: 16px;
  height: 16px;
  border-top: 1px solid #f1f5fc;
  border-left: 1px solid #f1f5fc;
  content: '';
  transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
  -moz-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
}

.chat li.right .chat-body:before {
  position: absolute;
  top: 10px;
  right: -8px;
  display: inline-block;
  background: #fff;
  width: 16px;
  height: 16px;
  border-top: 1px solid #f1f5fc;
  border-right: 1px solid #f1f5fc;
  content: '';
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
}

.chat li {
  margin: 15px 0;
}

.chat li.right .chat-body {
  margin-right: 70px;
  background-color: #fff;
  
}

.chat-box {
  position: fixed;
  bottom: 0;
  left: 444px;
  right: 0;
  padding: 15px;
  border-top: 1px solid #eee;
  transition: all .5s ease;
  -webkit-transition: all .5s ease;
  -moz-transition: all .5s ease;
  -ms-transition: all .5s ease;
  -o-transition: all .5s ease;
}

.primary-font {
  color: #3c8dbc;
}

a:hover, a:active, a:focus {
  text-decoration: none;
  outline: 0;
}
</style>

  </head>
  <body>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippet">
    <div class="row">
		<div class="col-md-4 bg-white ">
            <div class=" row border-bottom padding-sm" style="height: 40px;">
            	
            </div>
            
            <!-- =============================================================== -->
            <!-- member list -->
            <ul class="friend-list">
                <li class="active bounceInDown">	
                		<div class="friend-name">	
                		
							<font size="5.5px">Dane konta: </font><br><br>
							<strong>Nazwa użytkownika:  <?php echo $_SESSION["ChatNick"]; ?> </strong><br>
							<strong>Mail:  <?php 
							$query = mysqli_fetch_assoc(mysqli_query($MYSQLLINK,"SELECT email FROM chat_account WHERE login='".$_SESSION["ChatNick"]."';"));
							echo($query['email']);
							?> </strong><br><br>
							<strong><?php 	echo $dnitygodnia[getdate()['wday']].", ".$data."<br>"."Godzina: ".$czas; ?></strong>
							
							
                		</div>


                </li><br><br>
                <li>
                	<br><br><br>
                		<div class="friend-name">
                		<a href="index.php?action=logout"><button type="button" class="btn btn-danger btn2">Wyloguj się</button><br><br></a>
						<button type="button" class="btn btn-warning btn2">Zresetuj hasło</button><br>
							
							
                		</div>
   
                	
                </li>         
            </ul>
		</div>
        
        <!--=========================================================-->
        <!-- selected chat -->
    	<div class="col-md-8 bg-white ">
            <div class="chat-message">
                <ul class="chat">
                   <?php
						$danewiad = mysqli_query($MYSQLLINK,"SELECT idusera,wiadomosc,data FROM chat_message");	
						while($wiad = mysqli_fetch_assoc($danewiad)){
							$user = mysqli_fetch_assoc(mysqli_query($MYSQLLINK,"SELECT login,avatar FROM chat_account WHERE id='".$wiad["idusera"]."'"));
							if($_SESSION["ChatNick"]==$user['login']){
								echo '
								<li class="right clearfix">
									<span class="chat-img pull-right">
										<img src="'.$user["avatar"].'" alt="User Avatar">
									</span>
									<div class="chat-body clearfix">
										<div class="header">
											<strong class="primary-font">'.$user["login"].'</strong>
											<small class="pull-right text-muted"><i class="fa fa-clock-o"></i>'.$wiad["data"].'</small>
										</div>
										<p>
											'.$wiad["wiadomosc"].' 
										</p>
									</div>
								</li>  	
								';
							}else{
								echo '
								<li class="left clearfix">
									<span class="chat-img pull-left">
										<img src="'.$user["avatar"].'" alt="User Avatar">
									</span>
									<div class="chat-body clearfix">
										<div class="header">
											<strong class="primary-font">'.$user["login"].'</strong>
											<small class="pull-right text-muted"><i class="fa fa-clock-o"></i>'.$wiad["data"].'</small>
										</div>
										<p>
											'.$wiad["wiadomosc"].' 
										</p>
									</div>
								</li>  	
								';
							}
						}
						?>                   
                </ul>
            </div>
            <div class="chat-box bg-white">
            	<div class="input-group">
				    <span class="input-group-btn">
            			<button class="btn btn-success no-rounded" type="button" onclick="SenWiad()">Wyślij</button>
            		</span>
            		<input class="form-control border no-shadow no-rounded" id="imputwiad" name="imputwiad" placeholder="Twoja wiadomość">
            	</div><!-- /input-group -->	
            </div>            
		</div>        
	</div>
</div>	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script>
	function SenWiad(){
		var wiadomosc = $("#imputwiad").val();
			$.post(
				"sendwiad.php",
				{
					wiad: wiadomosc
				},
				function(data){
					if(data="1"){
						//odswiez diva
					}else{
						alert(data);
					}
				}
			);
	}
	</script>
  </body>
</html>


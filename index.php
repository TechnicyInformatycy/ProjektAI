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
.blue { background: blue }
.grey { background: grey }
.chats-row { height: 100vh; }
.chats-row div { 
    height: 50%;
    border: 1px solid #ddd;
    padding: 0px; 
	
}

.list-group-item {
    border: none;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    
}
.list-group-item:first-child {
    border-top: none;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
	
}


.current-chat { 
    height: 100vh; 
    border: 1px solid #ddd;
	
}

.chat-toolbar-row {
    background-color: #f5f5f5;
}

.chat-toolbar {
    margin-top: 10px;
    margin-bottom: 10px;
	
}

.current-chat-area {
    padding-top: 10px;
    overflow: auto;
    height: 85vh;
	background-color:#dbdde0;
	
}

.current-chat-footer {
    position: absolute;
    bottom: 0;
    
}

</style>
<script>
$( document ).ready(function() {
    $( ".chat-request" ).click(function(e) {
      e.preventDefault();
      $('.open-request').html('Matthew Townsen - TeamSupport').removeClass('open-request')
      $(this).html('<p>Nazwa:  Matthew Townsen</p>' +
                       '<p>Email:  mtownsen@teamsupport.com</p>' +
                       '<p>Czas:  <?php 		echo $dnitygodnia[getdate()['wday']].", ".$data."<br>"."Godzina: ".$czas; ?></p>' +
                       '<p>Wiadomość:  It\'s all broken</p>' +
                       '<button class="btn btn-default">Potwierdź</button>')
                       .addClass('open-request');
    });
});
</script>

  </head>
  <body>
<div class="container-fluid">
    <div class="row">
		<div class="col-md-3">
        	 <div class="row chats-row">		
				<a href="#" class="list-group-item open-request">
				<b><p>Nazwa:  Matthew Townsen</p>
				<p>Email:  mtownsen@teamsupport.com</p>
				<p>Czas:  <?php 		echo $dnitygodnia[getdate()['wday']].", ".$data."<br>"."Godzina: ".$czas; ?></p>
				<p>Wiadomość:  It's all broken</p></b>
				<a href="index.php?action=logout"><button class="btn btn-danger">Wyloguj</button></a>
				<button class="btn btn-default">Zmień Hasło</button>
				</a>
        	 </div>
		</div>
        <div class="col-md-9 current-chat">
            <div class="row chat-toolbar-row">
                <div class="col-sm-12">
                </div>
            </div>
            <div class="row current-chat-area">
                <div class="col-md-12">
                      <ul class="media-list">
						<?php
						$danewiad = mysqli_query($MYSQLLINK,"SELECT idusera,wiadomosc,data FROM chat_message");	
						while($wiad = mysqli_fetch_assoc($danewiad)){
							$user = mysqli_fetch_assoc(mysqli_query($MYSQLLINK,"SELECT login,avatar FROM chat_account WHERE id='".$wiad["idusera"]."'"));
							echo '
						<li class="media">
                            <div class="media-body">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle " width="50px" height="50px" src="'.$user["avatar"].'">
                                    </a>
                                    <div class="media-body">
                                        '.$wiad["wiadomosc"] .'
                                        <br>
                                       <small class="text-muted">'.$user["login"].' |'.$wiad["data"] .'</small>
                                        <hr>
                                    </div>
                                </div>
        
                            </div>
                        </li>	
							';
						}
						?>
                    </ul>  
                </div>
            </div>
            <div class="row current-chat-footer">
            <div class="panel-footer">
                <div class="input-group">
                  <input type="text" class="form-control">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Wyślij wiadomość</button>
                  </span>
                </div>
                </div>
            </div>
		</div>
	</div>
</div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


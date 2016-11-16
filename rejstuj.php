<?php
require("include/mysql.php");
require("config/config.php");
session_start();
if(isset($_SESSION["ChatZalogowany"])){
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="pl_PL">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo($config['StronaNazwa']); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="styles/login.css">
  </head>
  <body>
  <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <img class="profile-img" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                    alt="">
                <form method="POST" class="form-signin">
                <input type="login" name="relogin"  class="form-control" placeholder="Login" value="<?php if(isset($_POST['rejstracja'])){echo $_POST['relogin'];} ?>" required autofocus><br/>
                <input type="password" name ="rassword" class="form-control" placeholder="Hasło" required>
				<input type="password" name ="repasswordv2" class="form-control" placeholder="Powtórz hasło" required><br/>
				<input type="email" name="reemail"  class="form-control" placeholder="Email" value="<?php if(isset($_POST['rejstracja'])){echo $_POST['reemail'];} ?>"  required autofocus><br/>
                <button name="rejstracja" class="btn btn-lg btn-primary btn-block" type="submit">
                   Zarejestruj się</button>
                </form>
            </div>
			<?php
			RejstracjaDoStr();
			?>	
        </div>
    </div>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	Wykonanie <?php echo($config['StopkaAutor']); ?>
 </body>
</html>
<?php
function RejstracjaDoStr(){
	global $MYSQLLINK;
if(isset($_POST['rejstracja'])){
	$login=$_POST['relogin'];
	$haslo=$_POST['rassword'];
	$haslo2=$_POST['repasswordv2'];
	$email=$_POST['reemail'];
	$logincheck = mysqli_num_rows(mysqli_query($MYSQLLINK,"SELECT login FROM chat_account WHERE login='".$login."';"));
	$emailcheck = mysqli_num_rows(mysqli_query($MYSQLLINK,"SELECT email FROM chat_account WHERE email='".$email."';"));

	$stackpowiad="";
	if($logincheck>0){
		$stackpowiad=$stackpowiad."Ten login jest już zajęty <br>";
	}
	if($emailcheck>0){
		$stackpowiad=$stackpowiad."Ten Email jest już zajęty <br>";
	}
	if($haslo!=$haslo2){
		$stackpowiad=$stackpowiad."Hasła się nie zdadzają <br>";
	}
	if($stackpowiad!=""){
		SetKomunikat("danger","W folumarzu istnieją nastepujace błedy:<br> ".$stackpowiad);
	}else{
		$empzm = mysqli_query($MYSQLLINK,"INSERT INTO chat_account (login, email, haslo) VALUES('$login','$email','".md5($haslo)."');");
		if($empzm){
			SetKomunikat("success","Rejstracja przebiegła pomyslnie.Prosze czekać aż administrator aktywuje twoje konto ");
			header('Refresh: 2; url=index.php');
		}else{
			SetKomunikat("danger","Wystąpił dziwny bląd ,prosze odsierzyć strone i spróbowac ponownie.Jesli błąd sie powtórzy prosze zgłośic go do administratora");
		}
	}
}
}
/*
Typy komunikatów
success
info
warning
danger
*/
function SetKomunikat($typ='info',$wiad){
echo '
<div class="alert alert-'.$typ.' alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	'.$wiad.'
</div>';
}
?>
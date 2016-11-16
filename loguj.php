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
                <input type="login" name="login"  class="form-control" placeholder="Login" value="<?php if(isset($_POST['logowanie'])){echo $_POST['login'];} ?>" required autofocus>
                <input type="password" name ="haslo" class="form-control" placeholder="Hasło" required>
                <button name="logowanie" class="btn btn-lg btn-primary btn-block" type="submit">
                   Zaloguj</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Zapamietaj Mnie
                </label>
				<br>
                </form>
            </div>
            <a href="rejstuj.php" class="text-center new-account">Stwórz konto</a>
			<a href="passrecovery.php" class="text-center new-account">Zapomniałem hasła</a>
			<?php
			LogowanieDoStr();
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
function LogowanieDoStr(){
	global $MYSQLLINK;
if(isset($_POST['logowanie'])){
	$nick = $_POST['login'];
	$haslo = $_POST['haslo'];
	$quarry = mysqli_query($MYSQLLINK,"SELECT id,login,aktywny FROM chat_account WHERE login='".$nick."' AND haslo='".md5($haslo)."' ;");
	$con=mysqli_num_rows($quarry);
	$mysqldan = mysqli_fetch_assoc($quarry);
	if($con>0){
		if($mysqldan['aktywny']==false){
			SetKomunikat("success","Gratulacje zalogowano poprawnie.Lecz twoje konto nie jest aktywowane");
		}else{
			SetKomunikat("success","Gratulacje zalogowano poprawnie");
			$_SESSION["ChatZalogowany"]=true;
			$_SESSION["ChatNick"]=$mysqldan['login'];
			$_SESSION["ChatIdUser"]=$mysqldan['id'];
			header('Refresh: 1; url=index.php');
		}
	}else{
		SetKomunikat("danger","Niestety błędne dane :(");
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
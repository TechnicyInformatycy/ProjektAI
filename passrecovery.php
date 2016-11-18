<?php
require("include/mysql.php");
require("config/config.php");
session_start();
if(isset($_SESSION["ChatZalogowany"])){
	header("Location: index.php");
}
if(isset($_GET["data"])){
	$zminck=base64_decode ($_GET["data"]);
	$str = $config["StronaNazwa"];
	$sto = $config["StopkaAutor"];
	echo('
	<html lang="pl_PL">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.$str.'</title>
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
				Zamiana hasła dla nicku '.$zminck.'
                <form method="POST" class="form-signin">
				<input type="password" name="resthas"  class="form-control" placeholder="Hasło" required autofocus><br/>
				<input type="password" name="resthas2"  class="form-control" placeholder="Powtórz hasło" required autofocus><br/>
                <button name="resthasf" class="btn btn-lg btn-primary btn-block" type="submit">
                   Zmien haslo</button>
                </form>
            </div>');
			RecoverPassDoStrrest();
			echo('
        </div>
    </div>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	Wykonanie '.$sto.'
 </body>
</html>
	');
	return;
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
				<input type="email" name="recemail"  class="form-control" placeholder="Email" value="<?php if(isset($_POST['recovepass'])){echo $_POST['recemail'];} ?>"  required autofocus><br/>
                <button name="recovepass" class="btn btn-lg btn-primary btn-block" type="submit">
                   Przypomnij</button>
                </form>
            </div>
			<?php
			RecoverPassDoStr();
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
function RecoverPassDoStr(){
	global $MYSQLLINK;
if(isset($_POST['recovepass'])){
	$email=$_POST['recemail'];
	$logincheck =mysqli_num_rows(mysqli_query($MYSQLLINK,"SELECT login FROM chat_account WHERE email='".$email."';"));
	$login = mysqli_fetch_assoc(mysqli_query($MYSQLLINK,"SELECT login FROM chat_account WHERE email='".$email."';"));
	if($logincheck>0){
		mail($email, "Chat przypomninie HASŁA", base64_encode ($login['login']));
		SetKomunikat("success","Wysłano Email z przypomnieniem hasła");
	}else{
		SetKomunikat("danger","Niestety takiego emaila nie ma w naszej bazie danych");
	}
}
}

function RecoverPassDoStrrest(){
	global $MYSQLLINK;
if(isset($_POST['resthasf'])){
	$pas1=$_POST['resthas'];
	$pas2=$_POST['resthas2'];
	$nick=base64_decode ($_GET["data"]);
	if($pas1==$pas2){
		mysqli_query($MYSQLLINK,"UPDATE chat_account set haslo='".md5($pas1)."'WHERE login='".$nick."';");
		SetKomunikat("success","Zmieniono hasło");
	}else{
		SetKomunikat("danger","Hasła sie nie zgadzają");
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
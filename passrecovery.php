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
		mail($email, "Chat przypomninie HASŁA", "Tajne Hasło");
		SetKomunikat("success","Wysłano Email z przypomnieniem hasła");
	}else{
		SetKomunikat("danger","Niestety takiego emaila nie ma w naszej bazie danych");
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
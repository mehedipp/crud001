<?php 
session_start([
'cookie_lifetime'=>300, //5 minutes
]);

$error = false;
if(isset($_POST['username']) && isset($_POST['password'])){
	if($_POST['username'] == 'admin' && sha1($_POST['password']) == 'ee3f7d52ca341c51c694af9288701f4ce43be0ad'){
		$_SESSION['loggedin'] = true;
	}else{
		$error = true;
		$_SESSION['loggedin'] = false;
	}
}

if(isset($_POST['logout'])){
	$_SESSION['loggedin'] = false;
	session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Form Practice</title>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic"> <!-- https://milligram.io -->
	<link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
	<link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
<style>
	body{
		margin-top:30px;
	}
</style>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="column column-60 column-offset-20">
				<h2>Simple Auth Example</h2>
			</div>
		</div>
		<div class="row">
			<div class="column column-60 column-offset-20">
				<?php
					if(true == $_SESSION['loggedin']){
						echo "Hello Admin, Welcome";
					}else{
						echo "Hello Stanger, Login Below";
					}
				?>
			</div>
		</div>
		<div class="row" style="...">
			<div class="column column-60 column-offset-20">
				<?php
					if($error){
						echo "<blockquote>Wrong username or Password ! Try again.</blockquote>";
					}
					if($_SESSION['loggedin'] == false):
				?>
				<form method="POST">
					<label for="username">Username</label>
					<input type="text" name="username" id="username">
					<label for="password">Password</label>
					<input type="password" name="password" id="password">
					<button type="sumbit" class="button-primary" name="submit">Log In</button>
				</form>

				<?php
					else:
				?>
				<form action="auth.php" method="POST">
					<input type="hidden" name="logout" value="1">
					<button type="sumbit" class="button-primary" name="submit">Log Out</button>
				</form>
				<?php
					endif;
				?>
<!-- 				<form action="auth.php" method="POST">
					<input type="hidden" name="logout" value="1">
					<button type="sumbit" class="button-primary" name="submit">Log Out</button>
				</form> -->

			</div>
		</div>
	</div>
</body>
</html>
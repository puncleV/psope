<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Optional theme -->
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="../bootstrap/js/jquery-1.11.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<title>Печать документов</title>
</head>
<body>
<div class="panel-body">
	<?php
		include("connect.php");

		if (isset($_POST['login'], $_POST['password'])) {
				$result = mysqli_query($idb, "SELECT * FROM `users` WHERE `login` = '".$_POST['login']."' AND `password` = '".$_POST['password']."'");
			    if ($result->num_rows){
			    	$row = $result->fetch_row();
			    	$_SESSION['id'] = $row [0];
			    	$_SESSION['fullName'] = $row [1];
			    	$_SESSION['group'] = $row [2] == 1 ? "admin" : "user";
			    	$_SESSION['page'] = 0;
			    }else{
			     	errMsg("Пароль или адрес неверны");
			    }
		}elseif (isset($_POST['logout'])) {
			session_destroy();
			header( 'Location: index.php', true, 301 );
		}

		if(isset($_SESSION['group'])){
			echo '<form target="index.php" method="POST">';
			echo '<div class="form-group">';
			echo '<input id="aboutInput" type="hidden" class="form-control" name="logout" value="logout"></input>';
			echo '</div>';
			echo '<button type="submit" class="btn btn-default">Выйти</button>';
			echo '</form>';
			include(  $_SESSION["group"] . "/" . $_SESSION["group"] . ".php");
		}else{
			include("login.php");
		}
	?>
	</div>
</body>
</html>
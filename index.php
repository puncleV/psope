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
		if(isset($_SESSION['group']) && !isset($_POST['logout'])){
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
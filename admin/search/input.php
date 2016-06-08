<div class="panel panel-primary">
    <div class="panel-heading">Поиск</div>
    <div class="panel-body">
		<?php
			if(isset($_GET['page']))
				$_SESSION['page'] = $_GET['page'];
			switch ($_SESSION['page']) {
				case 0:
					$sFile = "user";
					break;
				case 1:
					$sFile = "group";
					break;
				default:
					$sFile = "user";
					break;
			}
			echo '<ul class="nav nav-tabs">';
			echo '<li role="presentation" class="' . ($_SESSION['page'] == 0 ? "active" : "") .'"><a href="index.php?&page=0">Поиск по имени</a></li>';
			echo '<li role="presentation" class="' . ($_SESSION['page'] == 1 ? "active" : "") .'"><a href="index.php?&page=1">Поиск по группе</a></li>';
			echo '</ul>';

			include($sFile . ".php");
		?>

    </div>
</div>

<div class="panel panel-info">
    <div class="panel-heading">Информация о пользователях</div>
    <div class="panel-body">
		<?php
			if(isset($_GET['page_1']))
				$_SESSION['page_1'] = $_GET['page_1'];
			switch ($_SESSION['page_1']) {
				case 0:
					$sFile = "history";
					break;
				case 1:
					$sFile = "requests";
					break;
				case 2:
					$sFile = "search/results";
					break;
				case 3:
					$sFile = "quotas";
					break;
				default:
					$sFile = "history";
					break;
			}

			echo '<ul class="nav nav-tabs">';
			echo '<li role="presentation" class="' . ($_SESSION['page_1'] == 0 ? "active" : "") .'"><a href="index.php?&page_1=0">История печати</a></li>';
			echo '<li role="presentation" class="' . ($_SESSION['page_1'] == 1 ? "active" : "") .'"><a href="index.php?&page_1=1">Запросы на доп.печать <span class="badge">228</span></a></li>';
			echo '<li role="presentation" class="' . ($_SESSION['page_1'] == 2 ? "active" : "") .'"><a href="index.php?&page_1=2">Результаты поиска</a></li>';
			echo '<li role="presentation" class="' . ($_SESSION['page_1'] == 3 ? "active" : "") .'"><a href="index.php?&page_1=3">Квоты</a></li>';
			echo '</ul>';

			include($sFile . ".php");
		?>
    </div>
</div>

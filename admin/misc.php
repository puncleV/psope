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
			$countRequest = mysqli_query($idb, "SELECT COUNT(*) FROM `quotarequest` WHERE `approved` = 0 ");
			$requestsQuant = $countRequest->fetch_row()[0];
			echo '<ul class="nav nav-tabs">';
			echo '<li role="presentation" class="' . ($_SESSION['page_1'] == 0 ? "active" : "") .'"><a href="index.php?&page_1=0">История печати</a></li>';
			echo '<li role="presentation" class="' . ($_SESSION['page_1'] == 1 ? "active" : "") .'"><a href="index.php?&page_1=1">Запросы на доп.печать <span class="badge">' . $requestsQuant . '</span></a></li>';
			if(isset($_SESSION['gsearch']) || isset($_SESSION['usearch'])){
				if($_SESSION['gsearch']){
					$isql = mysqli_query($idb, "SELECT `group_name` FROM `groups` WHERE `group_id` = " . $_SESSION['gsearch']);
				}elseif ($_SESSION['usearch']) {
					$isql = mysqli_query($idb, "SELECT `full_name` FROM `users` WHERE `user_id` = " . $_SESSION['usearch']);
				}
				$searchName = $isql->fetch_row()[0];
				echo '<li role="presentation" class="' . ($_SESSION['page_1'] == 2 ? "active" : "") .'"><a href="index.php?&page_1=2">Результаты поиска <span class="label label-info">' . $searchName . '</span></a></li>';
			}else{
				echo '<li role="presentation" class="' . ($_SESSION['page_1'] == 2 ? "active" : "") .'"><a href="index.php?&page_1=2">Результаты поиска</a></li>';
			}
			echo '<li role="presentation" class="' . ($_SESSION['page_1'] == 3 ? "active" : "") .'"><a href="index.php?&page_1=3">Квоты</a></li>';
			echo '</ul>';

			include($sFile . ".php");
		?>
    </div>
</div>

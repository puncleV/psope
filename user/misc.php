<div class="panel panel-info">
    <div class="panel-heading">Информация обо мне</div>
    <div class="panel-body">
		<?php
		if(isset($_GET['page']))
			$_SESSION['page'] = $_GET['page'];
			if($_SESSION['page'] == 0){
				$sFile = "history";
			}else{
				$sFile = "quotas";
			}
			echo '<ul class="nav nav-tabs">';
			echo	'<li role="presentation" class="' . ($_SESSION['page'] == 0 ? "active" : "") .'"><a href="index.php?&page=0">История печати</a></li>';
			echo	'<li role="presentation" class="' . ($_SESSION['page'] == 1 ? "active" : "") .'"><a href="index.php?&page=1">Квоты <span class="label ' . ($isPrintDisabled ? "label-danger" : "label-info") . '">' . ($isPrintDisabled ? "Не осталось" : $allPrintQuota - $usedPrintQuota ). '</span></a></li>';
			echo '</ul>';

			include($sFile . ".php");
		?>
    </div>
</div>

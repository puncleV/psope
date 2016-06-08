<div class="panel panel-info">
    <div class="panel-heading">Информация о пользователях</div>
    <div class="panel-body">
    	<ul class="nav nav-tabs">
			<li role="presentation" class="active"><a href="#">История печати</a></li>
			<li role="presentation"><a href="#">Запросы на доп.печать <span class="badge">228</span></a></li>
			<li role="presentation"><a href="#">Результаты поиска</a></li>
		</ul>
		<?php
			include("admin-story.php");
			include("admin-requests.php");
			include("admin-search-results.php");
		?>
    </div>
</div>

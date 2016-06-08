<div class="panel panel-info">
    <div class="panel-heading">Информация обо мне</div>
    <div class="panel-body">
    	<ul class="nav nav-tabs">
			<li role="presentation" class="active"><a href="#">История печати</a></li>
			<li role="presentation"><a href="#">Квоты <span class="label label-danger">Не осталось</span></a></li>
		</ul>
		<?php
			include("history.php");
			include("quotas.php");
		?>
    </div>
</div>

<?php
	if(isset($_POST['gquotaset'])){
		$isql = mysqli_query($idb, "UPDATE `quotas` SET `all_quota` = " . $_POST['gquotaset'] );
	}elseif ($_POST['gquotareset']) {
		$isql = mysqli_query($idb, "UPDATE `quotas` SET `used_quota` = 0");
	}
?>
<div class="panel-body">
	<form class="form-inline" method="POST">
	  <div class="form-group">
	    <label for="gquotaset">Установить квоту всем </label>
	    <input type="text" class="form-control" id="gquotaset" placeholder="общая квота" name="gquotaset">
	  </div>
	  <button type="submit" class="btn btn-default">Установить</button>
	</form>
	<form class="form" method="POST">
	  <div class="form-group">
	    <input type="hidden" class="form-control" id="gquotareset" name="gquotareset">
	  </div>
	  <button type="submit" class="btn btn-default">Сбросить все использованные квоты</button>
	</form>
</div>
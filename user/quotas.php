<div class="panel-body">
	<div style="width:210px">
		<p style="text-align:justify">Всего: <?php echo $allPrintQuota;?><br>
		Использовано: <?php echo $usedPrintQuota;?><br>
		Осталось: <?php echo $allPrintQuota - $usedPrintQuota;?><br>
		Запрошено: <?php echo $requestedQuota ? $requestedQuota : "0"; ?> </p>
		<form class="navbar-form navbar-left" method="POST">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Дополнительные квоты" name="quota">
		</div>
		<button type="submit" class="btn btn-default">Запросить</button>
	</form>
	</div>
	
</div>
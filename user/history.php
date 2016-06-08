<div class="panel-body">
	<table class="table">
		<thead>
			<td>Документ</td>
			<td>Время печати</td>
			<td>Размер файла</td>
			<td>Статус</td>
		</thead>
		<tbody>
		<?php
			$result = mysqli_query($idb, "SELECT * FROM `prints` WHERE `user_id` = '".$_SESSION['id']."'");
		 	if( $result->num_rows ){
		 		$rows = $result->fetch_all();
		 		foreach ($rows as $oRow) {
	 				$fileInfo = mysqli_query($idb, "SELECT * FROM `files` WHERE `file_id` = '".$oRow[4]."'");
					$fileRow = $fileInfo->fetch_row();
					echo "<tr>";
					echo "<td>" . $fileRow[1] . "</td>";
					echo "<td>" . $oRow[2] . "</td>";
					echo "<td>" . $fileRow[3] . "</td>";
					echo "<td>" . ( $oRow[3] == NULL ? "В ожидании" : "Распечатан") . "</td>";
					echo "</tr>";
		 		}
		 	}else{
				echo "<p>Нет загруженных файлов</p>";
			}
		?>
		</tbody>
	</table>
	<nav>
		<ul class="pagination">
			<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
			<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
		</ul>
	</nav>
</div>
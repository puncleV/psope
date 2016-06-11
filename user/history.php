<div class="panel-body">
	<table class="table">
		<thead>
			<td>Документ</td>
			<td>Желаемое время печати</td>
			<td>Количество страниц</td>
			<td>Статус</td>
		</thead>
		<tbody>
		<?php
			if(isset($_GET['pag'])){
				$page = $_GET['pag'] - 1;
			}else{
				$page = 0;
			}
			$result = mysqli_query($idb, "SELECT * FROM `files` WHERE `user_id` = '".$_SESSION['id']."' LIMIT " . $page * 10 . "," . 10);
		 	if( $result->num_rows ){
		 		$rows = $result->fetch_all();
		 		foreach ($rows as $oRow) {
					echo "<tr>";
					echo "<td>" . $oRow[2] . "</td>";
					echo "<td>" . $oRow[4] . "</td>";
					echo "<td>" . $oRow[5] . "</td>";
					if(!$isPrintDisabled){
						echo "<td>" . ( $oRow[7] == 0 ? "<form method='POST'><input type='hidden' name='printme' value=" . $oRow[0] . "><input type='submit' value='Печать'></form>" : "Распечатан") . "</td>";
					}else{
						echo "<td>" . ( $oRow[7] == 0 ? "Превышен лимит" : "Распечатан") . "</td>";
					}
					echo "</tr>";
		 		}
		 	}else{
				echo "<p>Нет загруженных файлов</p>";
			}
		?>
		</tbody>
	</table>
	<nav>
		<?php
			$countRequest = mysqli_query($idb, "SELECT COUNT(*) FROM `files` WHERE `user_id` = '" . $_SESSION['id'] . "'");
			$filesCount = $countRequest->fetch_row()[0];
			if( $filesCount > 10){
				$pagesCount = ceil($filesCount / 10);
				printPaginator($pagesCount, $currentPage);
			}
		?>
	</nav>
</div>
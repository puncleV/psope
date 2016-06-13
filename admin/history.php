<div class="panel-body">
	<table class="table">
		<thead>
			<td>ФИО студента</td>
			<td>Группа</td>
			<td>Документ</td>
			<td>Время печати</td>
			<td>Количество страниц</td>
		</thead>
		<tbody>	
		<?php
			if(isset($_GET['pag'])){
				$page = $_GET['pag'] - 1;
			}else{
				$page = 0;
			}
			$result = mysqli_query($idb, "SELECT * FROM `files` WHERE `status` = 1 LIMIT " . $page * $ROWSBYPAGE . "," . $ROWSBYPAGE);
		 	if( $result->num_rows ){
		 		$rows = $result->fetch_all();

		 		foreach ($rows as $oRow) {
		 			$isql = mysqli_query($idb, "SELECT * FROM `users` WHERE `user_id` = " . $oRow[1]);
		 			$userInfo = $isql->fetch_row();
		 			$isql = mysqli_query($idb, "SELECT `group_name` FROM `groups` WHERE `group_id` = " . $userInfo[2] );
		 			$groupName = $isql->fetch_row()[0];
					echo "<tr>";
					echo "<td><a href='?page_1=2&usearch=".$userInfo[0]."'>" . $userInfo[1] . "</a></td>";
					echo "<td><a href='?page_1=2&gsearch=".$userInfo[2]."'>" . $groupName . "</a></td>";
					echo "<td>" . $oRow[2] . "</td>";
					echo "<td>" . $oRow[9] . "</td>";
					echo "<td>" . $oRow[5] . "</td>";
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
			$countRequest = mysqli_query($idb, "SELECT COUNT(*) FROM `files` WHERE `status` = 1");
			$rowsQuant = $countRequest->fetch_row()[0];
			if( $rowsQuant > $ROWSBYPAGE){
				$pagesCount = ceil($rowsQuant / $ROWSBYPAGE);
				printPaginator($pagesCount, $currentPage);
			}
		?>
	</nav>
</div>
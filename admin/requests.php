<div class="panel-body">
	<table class="table">
		<thead>
			<td>ФИО студента</td>
			<td>Группа</td>
			<td>Время</td>
			<td>Причина</td>
			<td>Количество</td>
			<td>Решение</td>
		</thead>
		<tbody>
			<?php
				if(isset($_GET['pag'])){
					$page = $_GET['pag'] - 1;
				}else{
					$page = 0;
				}
				$result = mysqli_query($idb, "SELECT * FROM `quotarequest` ORDER BY `approved`, `request_date` LIMIT " . $page * 10 . "," . 10);
			 	if( $result->num_rows ){
			 		$rows = $result->fetch_all();
			 		foreach ($rows as $oRow) {
			 			$isql = mysqli_query($idb, "SELECT * FROM `users` WHERE `user_id` = '" . $oRow[0] . "'");
			 			$userRow = $isql->fetch_row();
			 			$isql = mysqli_query($idb, "SELECT `group_name` FROM `groups` WHERE `group_id` = " . $userRow[2] );
		 				$groupName = $isql->fetch_row()[0];
						echo "<tr>";
						echo "<td>" . $userRow[1] . "</td>";
						echo "<td>" . $groupName . "</td>";
						echo "<td>" . $oRow[1] . "</td>";
						echo "<td>" . $oRow[3] . "</td>";
						echo "<td>" . $oRow[2] . "</td>";
						echo "<td>" . ( $oRow[4] == 0 ? "<form method='POST'><input type='hidden' name='approve' value=" . $userRow[0] . "><input type='hidden' name='count' value=" . $oRow[2] . "><input type='submit' value='Одобрить'></form>" : "Одобрено") . "</td>";
						echo "</tr>";
			 		}
			 	}else{
					echo "<p>Нет загруженных файлов</p>";
				}
			?>
			<!-- <tr>
				<td>Смеяхов Шуткан Марвартдинович</td>
				<td>443</td>
				<td>Атчислено</td>
				<td>Количество</td>
				<td>Одобрить</td>
			</tr> -->
		</tbody>
	</table>
	<nav>
		<?php
			$countRequest = mysqli_query($idb, "SELECT COUNT(*) FROM `quotarequest` ");
			$requestsQuant = $countRequest->fetch_row()[0];
			if( $requestsQuant > 10){
				$pagesCount = ceil($requestsQuant / 10);
				printPaginator($pagesCount, $currentPage);
			}
		?>
	</nav>
</div>
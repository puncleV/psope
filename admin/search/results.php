<div class="panel-body">
		<?php 
			if(isset($_SESSION['gsearch']) || isset($_SESSION['usearch'])){
				if(isset($_SESSION['usearch'])){
					echo '<table class="table">
						<thead>
							<td>ФИО студента</td>
							<td>Группа</td>
							<td>Документ</td>
							<td>Время печати</td>
							<td>Количество страниц</td>
						</thead>
						<tbody>';
					if(isset($_GET['pag'])){
						$page = $_GET['pag'] - 1;
					}else{
						$page = 0;
					}
					$countRequest = mysqli_query($idb, "SELECT COUNT(*) FROM `files` WHERE `user_id` = " . $_SESSION['usearch']);
					$isql = mysqli_query($idb, "SELECT * FROM `users` WHERE `user_id` = " . $_SESSION['usearch']);
					$userInfo = $isql->fetch_row();
					$isql = mysqli_query($idb, "SELECT `group_name` FROM `groups` WHERE `group_id` = " . $userInfo[2] );
		 			$groupName = $isql->fetch_row()[0];
					$isql = mysqli_query($idb, "SELECT * FROM `files` WHERE `user_id` = " . $_SESSION['usearch'] . " LIMIT " . $page * 10 . "," . 10);
					if( $isql->num_rows ){
				 		$rows = $isql->fetch_all();
				 		foreach ($rows as $oRow) {
							echo "<tr>";
							echo "<td>" . $userInfo[1] . "</a></td>";
							echo "<td>" . $groupName . "</a></td>";
							echo "<td>" . $oRow[2] . "</td>";
							echo "<td>" . $oRow[9] . "</td>";
							echo "<td>" . $oRow[5] . "</td>";
							echo "</tr>";
				 		}
				 	}else{
						echo "<p>Нет загруженных файлов</p>";
					}
				}else{
					echo '<form class="form-inline" method="POST">
						  <div class="form-group">
						    <label for="quotasSet"> Группа ' . $searchName . '</label>
						    <input type="text" class="form-control" id="quotasSet" name="quotaset" placeholder="Установить квоту">
						  </div>
						  <button type="submit" class="btn btn-default">Установить</button>
						</form>';
					echo '<table class="table">
						<thead>
							<td>ФИО студента</td>
							<td>Квота: использованно\всего</td>
							<td>Всего распечатано</td>
						</thead>
						<tbody>';
					if(isset($_GET['pag'])){
						$page = $_GET['pag'] - 1;
					}else{
						$page = 0;
					}
					$isql = mysqli_query($idb, "SELECT * FROM `users` WHERE `group_id` = " . $_SESSION['gsearch']);
					$usersInfo = $isql->fetch_all();
					foreach ($usersInfo as $userRow) {
						$isql = mysqli_query($idb, "SELECT * FROM `quotas` WHERE `user_id` = " . $userRow[0]);
						$userQuota = $isql->fetch_row();
						echo "<tr>";
						echo "<td>" . $userRow[1] . "</td>";
						echo "<td>" . $userQuota[2] . "/" . $userQuota[1] . "</td>";
						echo "<td>" . $userQuota[3] . "</td>";
						echo "</tr>";
			 		}
					// $isql = mysqli_query($idb, "SELECT * FROM `files` WHERE `user_id` = " . $_SESSION['usearch'] . " LIMIT " . $page * 10 . "," . 10);
					// if( $isql->num_rows ){
				 // 		$rows = $isql->fetch_all();
				 // 		foreach ($rows as $oRow) {
					// 		echo "<tr>";
					// 		echo "<td>" . $userInfo[1] . "</a></td>";
					// 		echo "<td>" . $userInfo[5] . "</a></td>";
					// 		echo "<td>" . $oRow[2] . "</td>";
					// 		echo "<td>" . $oRow[9] . "</td>";
					// 		echo "<td>" . $oRow[5] . "</td>";
					// 		echo "</tr>";
				 // 		}
				 // 	}else{
					// 	echo "<p>Нет загруженных файлов</p>";
					// }
				}
				echo '</tbody>
					</table>';
			}else{
				echo "Здесь будет выводиться результат поиска";
			}
		?>

	<nav>
		<?php
			$rowsQuant = $countRequest->fetch_row()[0];
			if( $rowsQuant > 10){
				$pagesCount = ceil($rowsQuant / 10);
				printPaginator($pagesCount, $currentPage);
			}
		?>
	</nav>
</div>
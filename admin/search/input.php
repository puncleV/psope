<div class="panel panel-primary">
    <div class="panel-heading">Поиск</div>
    <div class="panel-body">
		<?php
			if(isset($_GET['page']))
				$_SESSION['page'] = $_GET['page'];
			switch ($_SESSION['page']) {
				case 0:
					$sFile = "user";
					break;
				case 1:
					$sFile = "group";
					break;
				default:
					$sFile = "user";
					break;
			}
			echo '<ul class="nav nav-tabs">';
			echo '<li role="presentation" class="' . ($_SESSION['page'] == 0 ? "active" : "") .'"><a href="index.php?&page=0">Поиск по имени</a></li>';
			echo '<li role="presentation" class="' . ($_SESSION['page'] == 1 ? "active" : "") .'"><a href="index.php?&page=1">Поиск по группе</a></li>';
			echo '</ul>';
			include($sFile . ".php");
			if(isset($_POST['searchgroup'])){
				$_SESSION['searchgroup'] = $_POST['searchgroup'];
				unset($_SESSION['searchname']);
			}elseif (isset($_POST['searchname'])) {
				$_SESSION['searchname'] = $_POST['searchname'];
				unset($_SESSION['searchgroup']);
			}
			if(isset($_SESSION['searchgroup'])){
				$isql = mysqli_query($idb, "SELECT * FROM `groups` WHERE LOWER(`group_name`) REGEXP \"" . strtolower($_SESSION['searchgroup']) . "\"");
				$rows = $isql->fetch_all();
				echo "<table class='table table-striped'>
						<thead>
							<td>#</td>
							<td>Название группы</td>
						</thead>
						<tbody>";
				for ($i=0; $i < count($rows) ; $i++) { 
					echo "<tr>
								<td>".$i."</td>
								<td><a href='?page_1=2&gsearch=" . $rows[$i][0] . "'>".$rows[$i][1]."</a></td>
						  </tr>";
				}

				echo "
						</tbody>
					</table>
				";
			}elseif(isset($_SESSION['searchname'])){
				$isql = mysqli_query($idb, "SELECT * FROM `users` WHERE LOWER(`full_name`) REGEXP \"" . strtolower($_SESSION['searchname']) . "\"");
				echo mysqli_error($idb);
				$rows = $isql->fetch_all();
				echo "<table class='table table-striped'>
						<thead>
							<td>#</td>
							<td>Имя студента</td>
							<td>Группа</td>
						</thead>
						<tbody>";
				for ($i=0; $i < count($rows) ; $i++) { 
					$isql = mysqli_query($idb, "SELECT `group_name` FROM `groups` WHERE `group_id` = " .  $rows[$i][2]);
					$groupName=$isql->fetch_row()[0];
					echo "<tr>
								<td>".$i."</td>
								<td><a href='?page_1=2&usearch=" . $rows[$i][0] . "'>".$rows[$i][1]."</a></td>
								<td><a href='?page_1=2&gsearch=" . $rows[$i][2] . "'>".$groupName."</a></td>
						  </tr>";
				}
				echo "
						</tbody>
					</table>
				";
			}

		?>

    </div>
</div>

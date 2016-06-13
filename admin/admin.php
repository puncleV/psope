<?php
	if(isset($_GET['gsearch'])){
		$_SESSION['gsearch'] = $_GET['gsearch'];
		unset($_SESSION['usearch']);
	}
	if(isset($_GET['usearch'])){
		$_SESSION['usearch'] = $_GET['usearch'];
		unset($_SESSION['gsearch']);
	}
	if(isset($_POST['approve'])){
		$isql = mysqli_query($idb, "SELECT * FROM `quotas` WHERE `user_id` = " . $_POST['approve']);
		$quotaRow = $isql->fetch_row();
		if($quotaRow[2] < $_POST['count']){
			$newQuota = 0;
		}else{
			$newQuota = $quotaRow[2] - $_POST['count'];
		}
		$isql = mysqli_query($idb, "UPDATE `quotas` SET `used_quota` =  " . $newQuota . " WHERE `user_id` = " . $_POST['approve']);
		$isql = mysqli_query($idb, "UPDATE `quotarequest` SET `approved` = 1 WHERE `user_id` = '" . $_POST['approve'] . "'");
	}
	include("search/input.php");
	include("misc.php");
?>

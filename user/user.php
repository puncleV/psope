<?php
	  if(isset($_POST['quota'])){
	    $isql = mysqli_query($idb, "SELECT COUNT(*) FROM `quotarequest` WHERE `user_id` = '" . $_SESSION['id'] . "'");
	    if($isql->fetch_row()[0] == 0){
	      $quotaRequest = mysqli_query($idb, "INSERT INTO `quotarequest` (user_id, count, reason) VALUES ('" . $_SESSION['id'] . "','" . $_POST['quota'] . "', '" . $_POST['reason'] . "')");
	    }else{
	      $quotaRequest = mysqli_query($idb, "UPDATE `quotarequest` SET `user_id` = '" . $_SESSION['id'] . "', `count` = '" . $_POST['quota'] . "', `request_date` = CURRENT_TIMESTAMP , `reason` = '" . $_POST['reason'] . "'WHERE `user_id` = '" . $_SESSION['id'] . "'");
	    }
	  }
	  
	  if(isset($_SESSION['id'])){
	    $isql = mysqli_query($idb, "SELECT * FROM `quotas` WHERE `user_id`='" . $_SESSION['id'] . "'");
	    $quotaRow = $isql->fetch_row();
	    $allPrintQuota = $quotaRow[1];
	    $usedPrintQuota = $quotaRow[2];
	    if($allPrintQuota == $usedPrintQuota)
	      $isPrintDisabled = true;
	    $requestedQuotas = mysqli_query($idb, "SELECT * FROM `quotarequest` WHERE `user_id`='" . $_SESSION['id'] . "'");
	    $requestRow = $requestedQuotas->fetch_row();
	    $requestedQuota = $requestRow[2];
	  }
   // Проверяем загружен ли файл
	if(isset($_FILES["fileName"])){
		$uploaddir = $uploadDirPath;

		if(is_uploaded_file($_FILES["fileName"]["tmp_name"]))
		{
			$lastId = mysqli_query($idb, "SELECT MAX(`file_id`) FROM `files`");
			if($lastId){
				$fileId = $lastId->fetch_row()[0] + 1;
			}else{
				$fileId = 1;
			}
			
			$uploadfile = $uploaddir .  $_SESSION['id'] . "_" . $fileId . "_" . basename($_FILES['fileName']['name']);
			
			if(move_uploaded_file($_FILES["fileName"]["tmp_name"], $uploadfile)){
				exec("DIR=$uploaddir unoconv -f pdf '$uploadfile'");
				// exec("DIR=$uploaddir rm '$uploadfile'");
				$fileName = substr(basename($_FILES['fileName']['name']), 0, strrpos(basename($_FILES['fileName']['name']), ".")) . ".pdf";

				$f = fopen(  $uploaddir . $_SESSION['id'] . "_" . $fileId . "_" . $fileName, "r");
				while(!feof($f)) {
				  $line = fgets($f,255);
				  if (preg_match('/\/Count [0-9]+/', $line, $matches)){
				    preg_match('/[0-9]+/',$matches[0], $matches2);
				    if ($count<$matches2[0]) $count=$matches2[0]; 
				  } 
				}
				fclose($f);
				$insertFile = mysqli_query($idb, "INSERT INTO `files` (user_id, file_type, file_name, page_count, path, description, desiredTime) VALUES ('".$_SESSION['id']."','".$_FILES["fileName"]["type"]."','".$fileName."','".$count."','".$uploaddir . $_SESSION['id'] . "_" . $fileId . "_" . $fileName."','".$_POST["fileDescription"]."','" . $_POST["dateTime"] . "')");
		 		gracMsg("Файл успешно загружен");
		 	}
		 	else{
		 		errMsg("Ошибка сохранения файла");
		 	}
		} else {
		  errMsg("Ошибка загрузки файла");
		}
	}

	if(isset($_POST['printme'])){
		$fileInfo = mysqli_query($idb, "SELECT * FROM `files` WHERE `file_id`='" . $_POST['printme'] . "'");
		$fileRow = $fileInfo->fetch_row();
		if($fileRow[7] == 0){
			if($fileRow[5] <= ($allPrintQuota - $usedPrintQuota)){
				$usedPrintQuota += $fileRow[5];
				exec("lp -U $printerUsername " . $fileRow[6]);
				$isql = mysqli_query($idb, "UPDATE `files` SET `status` = 1, `fact_time` = CURRENT_TIMESTAMP WHERE `file_id` = '" . $fileRow[0] . "'");
				$isql = mysqli_query($idb, "UPDATE `quotas` SET `used_quota` = " . $usedPrintQuota . ", `all_quota` = `all_quota` + " . $fileRow[5]);
				if($allPrintQuota == $usedPrintQuota)
      				$isPrintDisabled = true;
				gracMsg("Печать начата");
			}else{
				errMsg("Не хватает квоты");
			}
		}
	}
	include("download.php");
	include("misc.php");
?>

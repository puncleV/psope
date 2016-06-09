<?php
   // Проверяем загружен ли файл
	if(isset($_FILES["fileName"])){
		$uploaddir = '/var/www/html/psope/files/';

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
				$insertFile = mysqli_query($idb, "INSERT INTO `files` (file_type, file_name, page_count, path, description) VALUES ('".$_FILES["fileName"]["type"]."','".$fileName."','".$count."','".$uploaddir . $_SESSION['id'] . "_" . $fileId . "_" . $fileName."','".$_POST["fileDescription"]."')");
				$insertPrint = mysqli_query($idb, "INSERT INTO `prints` (user_id, desired_time, file_id) VALUES ('".$_SESSION['id']."','".$_POST["dateTime"]."','".$fileId."')");
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
		//var_dump($fileInfo->fetch_row());
		$filePath = $fileInfo->fetch_row()[4];
		exec("nohup lp -U dart " . $filePath . " &");
	}
	include("download.php");
	include("misc.php");
?>

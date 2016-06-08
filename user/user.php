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
			

			$insertFile = mysqli_query($idb, "INSERT INTO `files` (file_type, file_name, size, path, description) VALUES ('".$_FILES["fileName"]["type"]."','".$_FILES['fileName']['name']."','".$_FILES["fileName"]["size"]."','".$uploadfile."','".$_POST["fileDescription"]."')");

			$insertPrint = mysqli_query($idb, "INSERT INTO `prints` (user_id, desired_time, file_id) VALUES ('".$_SESSION['id']."','".$_POST["dateTime"]."','".$fileId."')");

		 	if(move_uploaded_file($_FILES["fileName"]["tmp_name"], $uploadfile)){
		 		gracMsg("Файл успешно загружен");
		 	}
		 	else{
		 		errMsg("Ошибка сохранения файла");
		 	}
		} else {
		  errMsg("Ошибка загрузки файла");
		}
	}
	include("download.php");
	include("misc.php");
?>

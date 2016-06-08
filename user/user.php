<?php
   // Проверяем загружен ли файл
	if(isset($_FILES["fileName"])){
		$uploaddir = '/var/www/html/psope/files/';

		if(is_uploaded_file($_FILES["fileName"]["tmp_name"]))
		{
			$lastId = mysqli_query($idb, "SELECT MAX(`file_id`) FROM `files`");
			if($lastId){
				$fileId = $lastId->fetch_row()[0];
				$uploadfile = $uploaddir .  $_SESSION['id'] . "_" . $fileId . "_" . basename($_FILES['fileName']['name']);
			}else{
				$uploadfile = $uploaddir .  $_SESSION['id'] . "_" . "1" . "_" . basename($_FILES['fileName']['name']);
			}
			$insertFile = mysqli_query($idb, "INSERT INTO `files` (file_type, size, path) VALUES ('".$_FILES["fileName"]["type"]."','".$_FILES["fileName"]["size"]."','".$uploadfile."')");
			var_dump($uploadfile);
			
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

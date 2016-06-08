 <?php
  $dbhost = "localhost"; // Имя хоста БД
  $dbusername = "root"; // Пользователь БД
  $dbpass = "1734"; // Пароль к базе
  
  /* Подключение к серверу MySQL */ 
  $idb = mysqli_connect( 
              $dbhost,  /* Хост, к которому мы подключаемся */ 
              $dbusername,       /* Имя пользователя */ 
              $dbpass,   /* Используемый пароль */ 
              'print');     /* База данных для запросов по умолчанию */ 

  if (!$idb) { 
	     printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
	     exit; 
 	}
	session_start();
?>
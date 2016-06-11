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
  function errMsg($mystr){
    echo '<div class="alert alert-dismissable alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Неудача! </strong>'.$mystr.', попробуйте еще раз!
                      </div>
                      ';
  }
  function gracMsg($mystr){
    echo '<div class="alert alert-dismissable alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Успех! </strong>'.$mystr.', удачи!
                      </div>
                      ';
  }
  function printPaginator($pagesCount, $currentPage){
    echo '<ul class="pagination">
            <li class="' . ((isset($_GET['pag']) && $_GET['pag'] == 1|| !isset($_GET['pag'])) ? "disabled" : "" ). '"><a href="?pag=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
    for ($i=1; $i <= $pagesCount; $i++) { 
      echo '<li class="' . ((isset($_GET['pag']) && $_GET['pag'] == $i || !isset($_GET['pag']) && $i ==1) ? "active" : "" ). '"><a href="?pag=' . $i . '">' . $i . '</a></li>';
    }
    echo '<li class="' . ((isset($_GET['pag']) && $_GET['pag'] == $pagesCount) ? "disabled" : "" ). '"><a href="?pag='.$pagesCount.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        </ul>';
  }
	session_start();
?>
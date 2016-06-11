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
  if(isset($_POST['quota'])){
    $isql = mysqli_query($idb, "SELECT COUNT(*) FROM `quotarequest` WHERE `user_id` = '" . $_SESSION['id'] . "'");
    if($isql->fetch_row()[0] == 0){
      $quotaRequest = mysqli_query($idb, "INSERT INTO `quotarequest` (user_id, count) VALUES ('" . $_SESSION['id'] . "','" . $_POST['quota'] . "')");
    }else{
      $quotaRequest = mysqli_query($idb, "UPDATE `quotarequest` SET `user_id` = '" . $_SESSION['id'] . "', `count` = '" . $_POST['quota'] . "', `request_date` = CURRENT_TIMESTAMP WHERE `user_id` = '" . $_SESSION['id'] . "'");
    }
    echo mysqli_error($idb);
    var_dump($quotaRequest);
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
?>
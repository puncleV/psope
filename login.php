<div class="panel panel-primary">
    <div class="panel-heading">Вход</div>
    <div class="panel-body">
        <div class="row">
		 	<div class="col-lg-6">
		 		<?php
					include("connect.php");
					if (isset($_POST['login'])) {
						$_SESSION['group'] = $_POST['login'];
						header( 'Location: index.php', true, 301 );
					}elseif (isset($_POST['logout'])) {
						session_destroy();
						header( 'Location: index.php', true, 301 );
						die();
					}
				?>
				<form method="POST">
					<div class="form-group">
						<label for="aboutInput">Логин</label>
						<input id="aboutInput" class="form-control" name="login"></input>
					</div>
					<button type="submit" class="btn btn-default">войти</button>
				</form>
			</div>
		</div>
    </div>
</div>

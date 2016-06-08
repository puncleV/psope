<div class="panel panel-primary">
    <div class="panel-heading">Вход</div>
    <div class="panel-body">
        <div class="row">
		 	<div class="col-lg-6">
		 		<?php
					include("connect.php");
					if (isset($_GET['login'])) {
						$_SESSION['group'] = $_GET['login'];
						header( 'Location: index.php', true, 301 );
					}elseif (isset($_GET['logout'])) {
						session_destroy();
						header( 'Location: index.php', true, 301 );
						die();
					}
				?>
				<form>
					<div class="form-group">
						<label for="aboutInput">группа юзеров</label>
						<input id="aboutInput" class="form-control" name="login"></input>
					</div>
					<button type="submit" class="btn btn-default">войти</button>
				</form>
				<form target="index.php">
					<div class="form-group">
						<input id="aboutInput" type="hidden" class="form-control" name="logout" value="logout"></input>
					</div>
					<button type="submit" class="btn btn-default">выйти</button>
				</form>
			</div>
		</div>
    </div>
</div>

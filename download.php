<div class="panel panel-primary">
    <div class="panel-heading">Загрузка файла на печать</div>
    <div class="panel-body">
        <div class="row">
		 	<div class="col-lg-6">
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="aboutInput">Описание документа</label>
						<textarea id="aboutInput" class="form-control" rows="3" required name="fileDescription"></textarea>
					</div>
					<div class="form-group">
						<label for="dateInput">Время печати:</label>
						<input type="datetime-local" id="dateInput" required="true" name="dateTime">
						<p class="help-block">Выберите предпочитаемое время для печати.</p>
					</div>
					<div class="form-group">
						<label for="fileInput">Файл для печати</label>
						<input type="file" id="fileInput" accept="application/msword, application/vnd.oasis.opendocument.text, text/richtext, application/pdf" required="true" name="fileName">
						<p class="help-block">Поддерживаемые форматы: pdf, rtf, odt, doc[x] </p>
					</div>
					<button type="submit" class="btn btn-default">Загрузить</button>
				</form>
			</div>
		</div>
    </div>
</div>
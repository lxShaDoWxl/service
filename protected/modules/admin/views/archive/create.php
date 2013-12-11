<h2>Добавить Издание</h2> <br/>
<form method="post" action="<?= CHtml::normalizeUrl(array('archive/save','id'=>'new'))?>" enctype="multipart/form-data">

	<table class="step-right">
		<tr>
			<td><strong>Название:</strong></td>
			<td><input class="input wide" name="title" type="text" required id="name"></td>
			<td></td>
		</tr>
		<tr>
			<td><strong>Издательство:</strong></td>
			<td>
				<select name="status">
					<option value="1">РБК</option>
					<option value="2">Бизнес & Власть</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><strong>Номер:</strong></td>
			<td><input class="input" name="number" type="text" value="0" required></td>
			<td class='validation-error' id="email-error"></td>
		</tr>
		<tr>
			<td><strong>Дата:</strong></td>
			<td><input class="tcal input wide" name="date" type="date" required id="date" value=''></td>
			<td></td>
		</tr>
		<tr>
			<td><strong>Издание:</strong></td>
			<td>
				<input type="file" name="file">
			</td>
		</tr>
		<tr>
			<td><strong>Короткое описание:</strong></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3">
				<textarea class="input wide" name="body"></textarea>
			</td>
		</tr>
		<tr>
			<td><strong>Изображение:</strong></td>
			<td>
				<div class="image-drop dropzone"></div>
			</td>
			<td><input class="input" name="img" type="hidden" id="img"></td>

		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" value="Создать" class="btn-green save-btn" id="submit"></td>
		</tr>
	</table>

</form>

<script type="text/javascript">

	var newFileNames = {};
	$("div.image-drop").dropzone({
		url: "<?php echo CHtml::normalizeUrl(array('archive/uploadIcon', 'f'=>'books'))?>" ,
		addRemoveLinks: true,
		uploadMultiple : false,
		success: function(data, response) {
			$("#img").val(response);

			newFileNames[data.name] = response;
		},
		maxFilesize : 3,
		init: function() {
			var dz = this
			this.on("removedfile", function(data) {
				delete newFileNames[data.name];
				f = $("#img").val();
				for (var key in newFileNames) {
					$("#img").val(newFileNames[key]);
				}
				if (f == $("#img").val()) $("#img").val("");
			});
		}
	});
</script>
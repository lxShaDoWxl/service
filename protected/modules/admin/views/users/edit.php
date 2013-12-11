<h2>Редактировать пользователя</h2><br/>
<div class="tabulation" data-id="tabs-1">
	<a class="element active" data-id="tab-1">Основное</a>
	<a class="element" data-id="tab-2">Изображение</a>
</div>
<div class="scrollable">
	<div class="tabs" id="tabs-1">

		<div class="tab active" id="tab-1">
			<form action="<?php echo CHtml::normalizeUrl(array('users/save', 'id'=> ($users)?$users->id:'new'))?>" method="POST">
				<table>
					<tbody>
					<tr>
						<td>Имя:</td>
						<td><input type="text" class="input" name="name" value="<?= ($users)?$users->name:''?>"  id="name"></td>
					</tr>
					<tr>
						<td>Почта:</td>
						<td><input type="text" class="input" name="mail" value="<?= ($users)?$users->mail:''?>"  id="mail"></td>
					</tr>
					<tr>
						<td>Должность:</td>
						<td><input type="text" class="input" name="position" value="<?= ($users)?$users->position:'' ?>" id="position"></td>
					</tr>
					<tr>
						<td>Компания:</td>
						<td><input type="text" class="input" name="company" value="<?= ($users)?$users->company:'' ?>" id="company"></td>
					</tr>
					<tr>
						<td>Телефон:</td>
						<td><input type="text" class="input" name="phone" value="<?= ($users)?$users->phone:'' ?>" id="phone"></td>
					</tr>
					<tr>
						<td>Новый Пароль:</td>
						<td><input type="text" class="input" name="newpassword" id="newpassword"></td>
					</tr>
					<tr>
						<td>Привилегии:</td>
						<td><select name="privileges">
								<option value="0" <?=($users)?($users->privileges==0)?'selected':'':'' ?> >Пользователь</option>
								<option value="77" <?= ($users)?($users->privileges==77)?'selected':'':'' ?> >Эксперт</option>
								<option value="100" <?= ($users)?($users->privileges==100)?'selected':'':'' ?> >Администратор</option>
							</select></td>
					</tr>
					<tr>
						<td>О пользователи:</td>
						<td><textarea name="body" id="body"><?=($users)?$users->body:''?></textarea></td>
					</tr>

					</tbody>
				</table>
		</div>
		<div class="tab" id="tab-2">
				<div class="step-right">
					<strong>Изображение:</strong>
					<div class="images images-sortable">

						<div class="image">
							<div class="icon100"><img src="<?= $this->baseUrl . ($users)?$users->img():'' ?>" class="round100"></div>
							<div class="image-remove"> <a class="btn-red delete-image" data-id="<?= ($users)?$users->id:'' ?>">Удалить</a> </div>
						</div>

					</div>

					<h4>Добавить изображение:</h4>
					<div class="image-drop dropzone"></div>
					<input class="input" name="img" type="hidden" id="img" value="<?php ($users)?$users->img():'' ?>">
				</div>



		</div>
		<input type="submit" value="Сохранить" class="btn-green" id="submit">
		</form>
	</div>

</div>
<script type="text/javascript">


	var editor;
	$(function() {
		editor = CKEDITOR.replace( 'body',
			{
				filebrowserBrowseUrl :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserImageBrowseUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserFlashBrowseUrl :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserUploadUrl  :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
				filebrowserImageUploadUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
				filebrowserFlashUploadUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
				width: 600
			});

		$('.popup-outer').click(function() {
			editor.destroy();
		});
		$('.tabulation .element').click(function() {
			$('.tabulation .element').removeClass('active');
			$(this).addClass('active');
			$('#' + $(this).parent().data('id') + ' > .tab').hide();
			$('#' + $(this).data('id')).show();

		});

		$('.images-sortable').sortable({update : function() {
			var ord = 0;
			$('.images').children().each(function() {
				$('.order', $(this)).val(ord);
				ord++;
			});
		}});

		$('.delete-image').click(function() {
			$("#d-" + $(this).data('id')).val(1);
			$(this).parent().parent().fadeOut(400);
		});

		$('.autofill').keyup(function( ) {
			var count = 0;
			var current_value = $(this).val();
			$('#av-' + $(this).attr('id')).children().each(function() {
				if ($(this).html().toLowerCase().indexOf(current_value.toLowerCase()) != -1) {
					$(this).show();
					count++;
				} else {
					$(this).hide();
				}
			});
			if (count > 0) {
				$('#av-' + $(this).attr('id')).show();
			};
		});
		$(".autofill-values > .element").click(function() {
			$("#" + $(this).data('id')).val($(this).html());
			$(this).parent().hide();
		});
		$('html').click(function() {
			$('.autofill-values').hide();
			console.log('ok');
		});
		$('.autofill-holder').click(function(e) {
			e.stopPropagation();
		});
	});

	var newFileNames = {};
	$("div.image-drop").dropzone({
		url: "<?= CHtml::normalizeUrl(array('page/uploadIcon', 'f'=>'users'))?>" ,
		addRemoveLinks: true,
		uploadMultiple : false,
		success: function(data, response) {
			$("#img").val(response);
			$("#imgs_url").val($("#imgs_url").val() + ',' + response);
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

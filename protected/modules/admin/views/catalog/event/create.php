<h2>Добавить Мероприятие</h2>
<br>
<div class="scrollable">
	<div class="tabulation" data-id="tabs-1">
		<a class="element active" data-id="tab-1">Основное</a>
		<a class="element" data-id="tab-2">Изображения</a>
	</div>
	<div class="tabs" id="tabs-1">
		<div class="tab active" id="tab-1">
			<form method="post" action=" <?= CHtml::normalizeUrl(array('catalog/saveEvent','id'=>'new'))?>" class="modal">
				<table class="step-right">
					<tr>
						<td><strong>Название:</strong></td>
						<td><input class="input wide" name="title" type="text" required id="title"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Состояние:</strong></td>
						<td>
							<select name="type">
								<option value="1"  selected >Анонс</option>
								<option value="0" >Отчёт</option>

							</select>
						</td>
					</tr>
					<tr>
						<td><strong>Дата:</strong></td>
						<td><input class="input" name="date" type="datetime-local" required id="date"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Место проведения:</strong></td>
						<td><input class="input wide" name="place" type="text" required id="title"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Видимый:</strong></td>
						<td>
							<select class="switch" name="isVisible">
								<option value="0">1</option>
								<option value="1" selected>0</option>
							</select>
						</td>
						<td class='validation-error' id="email-error"></td>
					</tr>
					<tr>
						<td><strong>Короткое описание:</strong></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">
							<textarea name="small_description" class="input wide"></textarea>
						</td>
					</tr>
					<tr>
						<td><strong>Полное описание:</strong></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">
							<textarea class="input wide" name="full_description"></textarea>
						</td>
					</tr>
					<tr>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
		</div>
		<div class="tab" id="tab-2">
			<div class="step-right">
				<strong>Изображения:</strong>
				<div class="images images-sortable">
				</div>

				<h4>Добавить изображения:</h4>
				<div class="image-drop dropzone"></div>
				<input class="input" name="img" type="hidden" id="img_url">
			</div>
		</div>

	</div>
	<input type="submit" value="Создать" class="btn-green save-btn" id="submit">
	</form>
</div>
</div>

<script type="text/javascript">
	var editor;
	$(function() {
		editor = CKEDITOR.replace( 'full_description',
			{
				filebrowserBrowseUrl :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserImageBrowseUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserFlashBrowseUrl :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserUploadUrl  :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
				filebrowserImageUploadUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
				filebrowserFlashUploadUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
				width: 598
			});
		$('.popup-outer').click(function() {
			editor.destroy();
		});
		var num = 0;
		var switchID = 0;
		$('.switch', '.modal').each(function() {
			$(this).attr('data-id', switchID);
			console.log($(this).val());
			temp = "";
			leftSpace = "";
			if ($(this).val() == 1) {
				temp = " true";
				leftSpace = "style='left: 1em;'"
			};
			$(this).after("<div class='switcher"+temp+"' data-id='"+switchID+"' data-state='1'><div class='toggle' "+leftSpace+"></div></div>");
			$(this).hide();

			switchID++;
		});
		$('.tabulation .element').click(function() {
			$('.tabulation .element').removeClass('active');
			$(this).addClass('active');
			$('#' + $(this).parent().data('id') + ' > .tab').hide();
			$('#' + $(this).data('id')).show();

		});
		$('.switcher', '.modal').click(function() {
			$(this).toggleClass('true');


			if($(this).hasClass('true')) {
				$('.toggle', $(this)).animate({'left' : '1em'}, 200);
				$('.switch[data-id="'+$(this).data('id')+'"]').val(1);
			} else {
				$('.toggle', $(this)).animate({'left': '0em'}, 200);
				$('.switch[data-id="'+$(this).data('id')+'"]').val(0);
			}
			console.log($('.switch[data-id="'+$(this).data('id')+'"]').val());
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
		url: "<?php echo CHtml::normalizeUrl(array('catalog/uploadIcon', 'f'=>'events'))?>" ,
		addRemoveLinks: true,
		uploadMultiple : false,
		success: function(data, response) {
			$("#img_url").val(response);

			newFileNames[data.name] = response;
		},
		maxFilesize : 3,
		init: function() {
			var dz = this
			this.on("removedfile", function(data) {
				delete newFileNames[data.name];

				f = $("#img_url").val();
				for (var key in newFileNames) {

					$("#img_url").val(newFileNames[key]);
				}
				if (f == $("#img_url").val()) $("#img_url").val("");
			});
		}
	});

	// $("div.images-drop").dropzone();
</script>

<h2>Добавить Вакансию</h2>

<br>

<div class="scrollable">
	<form method="post" action="<?php echo CHtml::normalizeUrl(array('page/saveJob', 'id'=>(isset($job))?$job->id:''))?>" class="modal">
		<table class="step-right">
			<tr>
				<td><strong>Название:</strong></td>
				<td><input class="input wide" name="name" type="text" required id="title" value='<?=(isset($job))?$job->name:''?>'></td>
				<td></td>
			</tr>
			<tr>
				<td><strong>Описание:</strong></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3">
					<textarea class="input wide" name="body"><?=(isset($job))?$job->body:''?></textarea>
				</td>
			</tr>
			<tr>
				<td><strong>Видимость:</strong></td>
				<td>
					<select class="switch" name="isVisible">
						<option value="0" <?=(isset($job))?($job->isVisible==0)?'selected':'':''?>>1</option>
						<option value="1" <?=(isset($job))?($job->isVisible==1)?'selected':'':'selected'?> >0</option>
					</select>
				</td>
				<td class='validation-error' id="email-error"></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" value="Сохранить" class="btn-green" id="submit"></td>
			</tr>
		</table>

	</form>
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
</script>

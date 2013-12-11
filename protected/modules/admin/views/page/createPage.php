<h2>Создать страницу</h2><br/>
<form action="<?php echo CHtml::normalizeUrl(array('page/savePage', 'id'=> ''))?>" method="POST">
<table>
	<tbody>
		<tr>
			<td>Заголовок:</td>
			<td><input type="text" class="input" name="title" required id="name"></td>
		</tr>
		<tr>
			<td>URL в адресной строке:</td>
			<td><input type="text" class="input" name="url" id="url"></td>
		</tr>
		<tr>
			<td>Контент:</td>
			<td></td>
		</tr>
        <tr>
            <td colspan="3">
                <textarea name="body" class="input wide"></textarea>
            </td>
        </tr>
	</tbody>
</table>
	<input type="submit" class="btn-green" value="Сохранить"/>
</form>
<script type="text/javascript">

	var editor;
	$(function(){
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
		/*$("#name").on("keyup", function() {
			$("#url").val($('#name').val().translit())
		});*/
	});
</script>
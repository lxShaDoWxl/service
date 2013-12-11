<h2><?= $settings->title ?></h2>
<br>
<div class="scrollable">
	<form action="<?php echo CHtml::normalizeUrl(array('settings/save', 'id'=>$settings->id))?>" method="POST" enctype="multipart/form-data">
	    <h5>Значение</h5>
		<?php if ($settings->type == "textarea"): ?>
		<textarea name="value" id="value-<?= $settings->id ?>"><?= $settings->value ?></textarea>
		<?php elseif($settings->type == "text"): ?>			
		<input type="text" class="input wide" name="value" value="<?= $settings->value ?>">
		<?php elseif ($settings->type == "image"): ?>
		<img src="<?= $this->baseUrl . $settings->value ?>" height="100">
		<br>
		<input type="file" name="file">
        <br>
		<?php endif ?>
		<br>
		<input class="btn-green" value="Сохранить" type="submit">
	</form>
</div>

<?php if ($settings->type == "textarea"): ?>
<script type="text/javascript">
	var editor;
	$(function() {
			editor = CKEDITOR.replace( 'value-<?= $settings->id ?>',
	                {
	                    filebrowserBrowseUrl :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
	                    filebrowserImageBrowseUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
	                    filebrowserFlashBrowseUrl :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
						filebrowserUploadUrl  :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
						filebrowserImageUploadUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
						filebrowserFlashUploadUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
					});
			$('.popup-outer').click(
				function() {
					editor.destroy();
				});
	});

</script>	
<?php endif ?>

<h2>Редактировать страницу</h2><br/>
    <div class="tabulation" data-id="tabs-1">
        <a class="element active" data-id="tab-1">Основное</a>
    </div>
<div class="scrollable">



    <div class="tabs" id="tabs-1">

        <div class="tab active" id="tab-1">
<form action="<?php echo CHtml::normalizeUrl(array('page/savePage', 'id'=> $page->id))?>" method="POST">
<table>
	<tbody>
		<tr>
			<td>Заголовок:</td>
			<td><input type="text" class="input" name="title" value="<?= $page->title?>" required id="title"></td>
		</tr>
		<tr>
			<td>URL в адресной строке:</td>
			<td><input type="text" class="input" name="url" value="<?= $page->url ?>" id="url"></td>
		</tr>
		<tr>
			<td>Контент:</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3">
				<textarea name="body" class="input wide"><?= $page->body ?></textarea>
			</td>
		</tr>

	</tbody>
</table>
	<input type="submit" class="btn-green" value="Сохранить"/>
</form>
        </div>

    </div>

</div>
<script type="text/javascript">

	var editor;
    var editor_en;
	$(function(){
		editor = CKEDITOR.replace( 'body',
	                {
	                   /* filebrowserBrowseUrl :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
	                    filebrowserImageBrowseUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
	                    filebrowserFlashBrowseUrl :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/connector.php',
						filebrowserUploadUrl  :'<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
						filebrowserImageUploadUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
						filebrowserFlashUploadUrl : '<?= $this->baseUrl ?>/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash',*/
						width: 598
					});


		$('.popup-outer').click(function() {
			editor.destroy();
		});
		/*$("#name").on("keyup", function() {
			$("#url").val($('#name').val().translit())
		});*/
        $('.tabulation .element').click(function() {
            $('.tabulation .element').removeClass('active');
            $(this).addClass('active');
            $('#' + $(this).parent().data('id') + ' > .tab').hide();
            $('#' + $(this).data('id')).show();

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

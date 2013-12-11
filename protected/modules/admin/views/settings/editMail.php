<h2>Изменить <?= $mail->title ?></h2>
<br>
<form action="<?php echo CHtml::normalizeUrl(array('settings/editMailTemplate', 'action'=>'save', 'id'=>$mail->id))?>" method="POST">
    <table>
        <tbody>
        <tr>
            <td>Тема сообщения:</td>
            <td><input type="text" class="input" name="mail_title" required id="name" value="<?= $mail->mail_title ?>"></td>
        </tr>
		<tr>
			<td>Справочник:</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<b>{name}</b> - Имя пользователя<br>
				<b>{mail}</b>  - Электронный адрес пользователя<br>
				<b>{body}</b>  - Сообщение<br>
				<b>{name_expert}</b>  - Имя эксперта<br>
				<b>{mail_expert}</b>  - Электронный адрес эксперта<br>
			</td>
			<td></td>
		</tr>
        <tr>
            <td>Текст сообщения:</td>
            <td></td>
        </tr>

        <tr>
            <td colspan="3">
                <textarea name="body" class="input wide"><?= $mail->body ?></textarea>
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
                width: '100%'
            });

        $('.popup-outer').click(function() {
            editor.destroy();
        });
        /*$("#name").on("keyup", function() {
         $("#url").val($('#name').val().translit())
         });*/
    });
</script>
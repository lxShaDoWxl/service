<h2>Изменить Статью</h2>

<br>

<div class="scrollable">
    <div class="tabulation" data-id="tabs-1">
        <a class="element active" data-id="tab-1">Основное</a>
        <a class="element" data-id="tab-2">Изображения</a>
		<a class="element" data-id="tab-3">EN</a>
		<a class="element" data-id="tab-4">KZ</a>
    </div>
    <div class="tabs" id="tabs-1">
        <div class="tab active" id="tab-1">
            <form method="post" action="<?= CHtml::normalizeUrl(array('catalog/savearticle','id'=>$item->id))?>" class="modal">
                <table class="step-right">
                    <tr>
                        <td><strong>Название:</strong></td>
                        <td><input class="input wide" name="title" type="text" required id="title" value="<?= $item->title ?>"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Категория</strong></td>
                        <td><select name="cid">
                                <? foreach($cats as $cat): ?>
                                <option value="<?= $cat->id ?>" <?= ($item->cid == $cat->id)?" selected":"" ?>><?= $cat->title ?></option>
                                <? endforeach ?>
                            </select></td>
                        <td></td>
                    </tr>
					<tr>
						<td><strong>Автор</strong></td>
						<td><select name="author">
								<option value="">Нет</option>
								<? foreach($authors as $author): ?>
									<option value="<?= $author->id ?>" <?= ($item->author == $author->id)?" selected":"" ?>><?= $author->name ?></option>
								<? endforeach ?>
							</select></td>
						<td></td>
					</tr>
                    <tr>
                        <td><strong>Видимый:</strong></td>
                        <td>
                            <select class="switch" name="isVisible">
                                <option value="0" <?= ($item->isVisible == "0")?" selected":"" ?>>1</option>
                                <option value="1" <?= ($item->isVisible == "1")?" selected":"" ?>>0</option>
                            </select>
                        </td>
                        <td class='validation-error' id="email-error"></td>
                    </tr>
					<tr>
						<td><strong>Журнал:</strong></td>
						<td>
							<select name="archive">
								<option value="" >Нет</option>
								<? foreach($archives as $archive): ?>
									<option value="<?=$archive->id?>" <?=(isset($item->bookArticle->book_id) && $item->bookArticle->book_id==$archive->id)?'selected':''?> ><?=$archive->stats().' №'.$archive->number;?></option>
								<? endforeach ?>
							</select>
						</td>
					</tr>
                    <tr>
                        <td><strong>Дата:</strong></td>
                        <td><input class="input" name="date" type="date" required id="date" value="<?= $item->date ?>"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Короткое описание:</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea name="small_description" class="input wide"><?= $item->small_description ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Полное описание:</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea class="input wide" name="full_description"><?= $item->full_description ?></textarea>
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
                    <?php foreach ($item->itemImages as $key => $value): ?>
                        <div class="image">
                            <div class="icon100"><img src="<?= $this->baseUrl . $value->img_url ?>" class="round100"></div>
                            <div class="image-remove"> <a class="btn-red delete-image" data-id="<?= $value->id ?>">Удалить</a> </div>
                            <input type="hidden" name="images[<?= $value->id ?>][position]" class="order" value="<?= $value->position ?>">
                            <input type="hidden" name="images[<?= $value->id ?>][is_deleted]" value="0" id="d-<?= $value->id ?>">
                        </div>
                    <?php endforeach ?>
                </div>

                <h4>Добавить изображения:</h4>
                <div class="image-drop dropzone"></div>
                <input class="input" name="img_url" type="hidden" id="img_url">
                <input class="input" name="imgs_url" type="hidden" id="imgs_url" required>
            </div>
        </div>
		<div class="tab" id="tab-3">
			<table class="step-right">
				<tr>
					<td><strong>Название:</strong></td>
					<td><input class="input wide" name="title_en" type="text" id="title" value="<?= $item->title_en ?>"></td>
					<td></td>
				</tr>
				<tr>
					<td><strong>Короткое описание:</strong></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="small_description_en" class="input wide"><?= $item->small_description_en ?></textarea>
					</td>
				</tr>
				<tr>
					<td><strong>Полное описание:</strong></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea class="input wide" name="full_description_en"><?= $item->full_description_en ?></textarea>
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
		<div class="tab" id="tab-4">
			<table class="step-right">
				<tr>
					<td><strong>Название:</strong></td>
					<td><input class="input wide" name="title_kz" type="text" id="title" value="<?= $item->title_kz ?>"></td>
					<td></td>
				</tr>
				<tr>
					<td><strong>Короткое описание:</strong></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="small_description_kz" class="input wide"><?= $item->small_description_kz ?></textarea>
					</td>
				</tr>
				<tr>
					<td><strong>Полное описание:</strong></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea class="input wide" name="full_description_kz"><?= $item->full_description_kz ?></textarea>
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
        <input type="submit" value="Сохранить" class="btn-green save-btn" id="submit">
        </form>
    </div>
</div>

<script type="text/javascript">
    var editor;
	var editor_en;
	var editor_kz
    $(function() {
        editor = CKEDITOR.replace( 'full_description',
            {
				filebrowserBrowseUrl :'/js/ckeditor/filemanager/browser/default/browser.html?Connector=/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserImageBrowseUrl : '/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserFlashBrowseUrl :'/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserUploadUrl  :'/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
				filebrowserImageUploadUrl : '/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
				filebrowserFlashUploadUrl : '/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
				width: '100%'
            });
		editor_en = CKEDITOR.replace( 'full_description_en',
			{
				filebrowserBrowseUrl :'/js/ckeditor/filemanager/browser/default/browser.html?Connector=/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserImageBrowseUrl : '/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserFlashBrowseUrl :'/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserUploadUrl  :'/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
				filebrowserImageUploadUrl : '/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
				filebrowserFlashUploadUrl : '/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
				width: '100%'
			});
		editor_kz = CKEDITOR.replace( 'full_description_kz',
			{
				filebrowserBrowseUrl :'/js/ckeditor/filemanager/browser/default/browser.html?Connector=/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserImageBrowseUrl : '/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserFlashBrowseUrl :'/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=/js/ckeditor/filemanager/connectors/php/connector.php',
				filebrowserUploadUrl  :'/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
				filebrowserImageUploadUrl : '/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
				filebrowserFlashUploadUrl : '/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
				width: '100%'
			});
		$('.popup-outer').click(function() {
			editor.destroy();
			editor_kz.destroy();
			editor_en.destroy();

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
    var newFileNames = {};
    $("div.image-drop").dropzone({
        url: "<?php echo CHtml::normalizeUrl(array('page/uploadIcon', 'f'=>'item'))?>" ,
        addRemoveLinks: true,
        uploadMultiple : false,
        success: function(data, response) {
            $("#img_url").val(response);
            $("#imgs_url").val($("#imgs_url").val() + ',' + response);
            newFileNames[data.name] = response;
        },
        maxFilesize : 3,
        init: function() {
            var dz = this
            this.on("removedfile", function(data) {
                delete newFileNames[data.name];
                $("#img_urls").val("");
                f = $("#img_url").val();
                for (var key in newFileNames) {
                    $("#img_urls").val($("#img_urls").val() + ',' + newFileNames[key]);
                    $("#img_url").val(newFileNames[key]);
                }
                if (f == $("#img_url").val()) $("#img_url").val("");
            });
        }
    });

    // $("div.images-drop").dropzone();
</script>

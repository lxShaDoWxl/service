<h2>Изменение Мероприятия</h2>
<br>
<form method="post" action=" <?= CHtml::normalizeUrl(array('catalog/saveEvent','id'=>$event->id))?>" class="modal">

<div class="scrollable">
	<div class="tabulation" data-id="tabs-1">
		<a class="element active" data-id="tab-1">Основное</a>
		<a class="element" data-id="tab-2">Изображения</a>
		<a class="element" data-id="tab-3">Отчёт</a>
	</div>
	<div class="tabs" id="tabs-1">
		<div class="tab active" id="tab-1">
				<table class="step-right">
					<tr>
						<td><strong>Название:</strong></td>
						<td><input class="input wide" name="title" type="text" required id="title" value="<?=$event->title?>"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Состояние:</strong></td>
						<td>
							<select name="type">
								<option value="1" <?=($event->type==1)?'selected':''?> >Анонс</option>
								<option value="0" <?=($event->type==0)?'selected':''?> >Отчёт</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><strong>Дата:</strong></td>
						<td><input class="input" name="date" type="datetime-local" required id="date" value="<?=$event->date?>"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Место проведения:</strong></td>
						<td><input class="input wide" name="place" type="text" required id="title" value="<?=$event->place?>"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Видимый:</strong></td>
						<td>
							<select class="switch" name="isVisible">
								<option value="0" <?=($event->isVisible==0)?'selected':''?>>1</option>
								<option value="1" <?=($event->isVisible==1)?'selected':''?>>0</option>
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
							<textarea name="small_description" class="input wide"><?=$event->small_description?></textarea>
						</td>
					</tr>
					<tr>
						<td><strong>Полное описание:</strong></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">
							<textarea class="input wide" name="full_description"><?=$event->full_description?></textarea>
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
					<div class="image">
						<div class="icon100"><img src="<?= $this->baseUrl . $event->img ?>" class="round100"></div>
						<div class="image-remove"> <a class="btn-red delete-image" data-id="<?= $event->id ?>">Удалить</a> </div>
					</div>
				</div>

				<h4>Добавить изображения:</h4>
				<div class="image-drop dropzone"></div>
				<input class="input" name="img" type="hidden" id="img_url" value="<?=$event->img?>">
			</div>
		</div>
		<div class="tab" id="tab-3">
			<div class="step-right">
				<strong>Изображения:</strong>
				<div class="images images-sortable media">
					<?php foreach ($event->eventMedias as $key => $value): ?>
						<? if($value->type=='video')continue;?>
						<div class="image">
							<div class="icon100"><img src="<?= $this->baseUrl . $value->url ?>" class="round100"></div>
							<div class="image-remove"> <a class="btn-red delete-image-media" data-id="<?= $value->id ?>">Удалить</a> </div>
							<input type="hidden" name="images[<?= $value->id ?>][is_deleted]" value="0" id="d-<?= $value->id ?>">
						</div>
					<?php endforeach ?>
				</div>
				<h4>Добавить изображение:</h4>
				<div class="image-drop2 dropzone"></div>
				<input class="input" name="image" type="hidden" id="img" >
				<input class="input" name="images" type="hidden" id="imgs_url" >
			</div>
				<table class="step-right">
					<tr>
						<td><strong>Ссылка на Youtube:</strong></td>
						<td id="urls_youtub">
							<input class="input wide" name="video[new][0]" type="text"  id="title"><a href="#" class="websymbol" id="add_youtub" style="text-decoration: none;">Â</a>
							<? if ($event->eventMedias): ?>
								<? foreach($event->eventMedias as $value): ?>
									<? if($value->type=='img')continue;?>
								    <input class="input wide" name="video[old][<?= $value->id ?>]" type="text"  id="title" value="<?= $value->url ?>">
								<? endforeach ?>
							<? endif ?>
						</td>
						<td></td>
					</tr>
					<tr >
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
		</div>
	</div>
	<input type="submit" value="Сохранить" class="btn-green save-btn" id="submit">

</div>
</div>
</form>
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
		var index=1;
		$('#urls_youtub').on('click', '#add_youtub', function(e){
			e.preventDefault();
			$(this).after('<input class="input wide" name="video[new]['+index+']" type="text"  id="title">');
			index++;
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

		$('.delete-image-media').click(function() {
			$("#d-" + $(this).data('id')).val(1);
			Images('del',$(this).data('id'),'')
			$(this).parent().parent().fadeOut(400);
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
	var newFileNames2 = {};
	$("div.image-drop2").dropzone({
		url: "<?php echo CHtml::normalizeUrl(array('catalog/uploadIcon', 'f'=>'events'))?>" ,
		addRemoveLinks: true,
		uploadMultiple : false,
		success: function(data, response) {
			$("#img").val(response);
			$("#imgs_url").val($("#imgs_url").val() + ',' + response);
			Images('add','new',response)
			newFileNames[data.name] = response;
		},
		maxFilesize : 3,
		init: function() {
			var dz = this
			this.on("removedfile", function(data) {
				delete newFileNames[data.name];
				$("#img_urls").val("");
				f = $("#img").val();
				for (var key in newFileNames) {
					$("#img_urls").val($("#img_urls").val() + ',' + newFileNames[key]);
					$("#img_url").val(newFileNames[key]);

				}
				if (f == $("#img").val()) $("#img").val("");
			});
		}
	});
	function Images(e, id, url){
		jQuery.ajax({
			'type':'POST',
			'data':{'id':id,'action':e,'url':url, 'id_event':<?=$event->id?>},
			'success':function(data){

			},
			'url':'<?= CHtml::normalizeUrl(array('catalog/eventMedia'))?>',
			'cache':false
		});
	}
	// $("div.images-drop").dropzone();
</script>

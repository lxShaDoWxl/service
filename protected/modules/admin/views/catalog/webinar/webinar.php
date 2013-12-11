<h2>Вебинар</h2>

<br>

<div class="scrollable">
	<div class="tabulation" data-id="tabs-1">
		<a class="element active" data-id="tab-1">Основное</a>
		<a class="element" data-id="tab-2">Преподователи</a>
	</div>
	<div class="tabs" id="tabs-1">
		<div class="tab active" id="tab-1">
			<form method="post" action=" <?= CHtml::normalizeUrl(array('catalog/saveWebinar','id'=>isset($item)?$item->id:'new'))?>" class="modal">

				<table class="step-right">
					<tr>
						<td><strong>Название:</strong></td>
						<td><input class="input wide" name="item[title]" type="text" required id="title" value="<?=isset($item)?$item->title:''?>"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Ссылка:</strong></td>
						<td><input class="input wide" name="item[url]" type="text" required id="url" value="<?=isset($item)?$item->url:''?>"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Цена проведения (0-беспланое):</strong></td>
						<td><input class="input" name="item[price]" type="text" required id="price" value="<?=isset($item)?$item->price:''?>"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Видимый:</strong></td>
						<td>
							<select class="switch" name="item[isVisible]">
								<option value="0" <?=isset($item)?($item->isVisible==0)?'selected':'':''?>">1</option>
								<option value="1" <?=isset($item)?($item->isVisible==1)?'selected':'':'selected'?>>0</option>
							</select>
						</td>
						<td class='validation-error' id="email-error"></td>
					</tr>
					<tr>
						<td><strong>Дата начала:</strong></td>
						<td><input class="input" name="item[date_start]" type="date" required id="date_start" value="<?=isset($item)?$item->date_start:''?>"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Дата конца:</strong></td>
						<td><input class="input" name="item[date_end]" type="date" required id="date_end" value="<?=isset($item)?$item->date_end:''?>"></td>
						<td></td>
					</tr>
					<tr>
						<? if(isset($item)){$time=explode('-',$item->time); echo 'c '.$time[0].' до '.$time[1];}?>
						<td><strong>Время проведения:</strong></td>
						<td>с <input class="input " name="time[0]" type="time" required id="time" value="<?=isset($time)?$time[0]:''?>">
						 до <input class="input " name="time[1]" type="time" required id="time" value="<?=isset($time)?$time[1]:''?>">
						</td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Описание:</strong></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">
							<textarea name="item[body]" class="input wide"><?=isset($item)?$item->body:''?></textarea>
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
			<table class="step-right">
				<tr>
					<td><strong>Эксперты:</strong></td>
					<td>
						<select name="experts[]" class='items'   multiple>
								<? foreach ($experts as $expert): ?>
									<? if (isset($item)): ?>
										<? if ($expert->connectWebinars(array('condition' => '`id_webinar`=:id', 'params' => array(':id' => $item->id)))): ?>
											<option value="<?= $expert->id ?>" selected><?= $expert->name ?></option>
										<? else: ?>
											<option value="<?= $expert->id ?>"><?= $expert->name ?></option>
										<? endif; ?>
									<? else: ?>
										<option value="<?= $expert->id ?>"><?= $expert->name ?></option>
									<? endif ?>
								<? endforeach ?>

						</select>
					</td>
					<td></td>
				</tr>
			</table>
		</div>
		<input type="hidden" name="item[id_theme]" value="<?=isset($item)?$item->id_theme:$id_theme?>">
		<input type="submit" value="Сохранение" class="btn-green save-btn" id="submit">
		</form>
	</div>
</div>

<script type="text/javascript">
	var editor;
	$(function() {
		$('.items').chosen();
		$('#price').bind("change keyup input click", function() {
			if (this.value.match(/[^0-9]/g)) {
				this.value = this.value.replace(/[^0-9]/g, '');
			}
		});
		editor = CKEDITOR.replace( 'item[body]',
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
	// $("div.images-drop").dropzone();
</script>

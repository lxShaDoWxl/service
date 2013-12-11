<h2>Изменить Баннер</h2>

<br>

<div class="scrollable">
	<div class="tabulation" data-id="tabs-1">
		<a class="element active" data-id="tab-1">Основное</a>
		<a class="element" data-id="tab-2">Изображения</a>
	</div>
	<div class="tabs" id="tabs-1">
		<div class="tab active" id="tab-1">
			<form method="post" action=" <?= CHtml::normalizeUrl(array('catalog/saveBanner','id'=> $banner->id))?>" class="modal">
				<table class="step-right">
					<tr>
						<td><strong>Ссылка:</strong></td>
						<td><input class="input wide" name="url" type="text" required id="title" value="<?=$banner->url?>"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Позиция</strong></td>
						<td><select name="position">
								<option value="620x130" <?=($banner->position=='620x130')?'selected':''?> >620x130 Внутри контента</option>
								<option value="240x400" <?=($banner->position=='240x400')?'selected':''?>>240x400 Правый банер</option>
								<option value="940x90_1" <?=($banner->position=='940x90_1')?'selected':''?>>940x90 Верхний</option>
								<option value="940x90_2" <?=($banner->position=='940x90_2')?'selected':''?>>940x90 Нижний</option>
							</select>
						</td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Дата начала:</strong></td>
						<td><input class="input wide" name="date_start" type="date" required id="date" value="<?=$banner->date_start?>"></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Дата конца:</strong></td>
						<td><input class="input wide" name="date_end" type="date" required id="date" value="<?=$banner->date_end?>"></td>
						<td></td>
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
						<div class="icon100"><img src="<?= $this->baseUrl . $banner->img ?>" class="round100"></div>
						<div class="image-remove"> <a class="btn-red delete-image" data-id="<?= $banner->id ?>">Удалить</a> </div>
					</div>
				</div>

				<h4>Добавить изображения:</h4>
				<div class="image-drop dropzone"></div>
				<input class="input" name="img" type="hidden" id="img_url" value="<?=$banner->img?>">
			</div>
		</div>

	</div>
	<input type="submit" value="Сохранить" class="btn-green save-btn" id="submit">
	</form>
</div>
</div>


<script type="text/javascript">

	$(function() {

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
		$('.autofill-holder').click(function(e) {
			e.stopPropagation();
		});
	});

	var newFileNames = {};
	$("div.image-drop").dropzone({
		url: "<?php echo CHtml::normalizeUrl(array('catalog/uploadIcon', 'f'=>'banner'))?>" ,
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

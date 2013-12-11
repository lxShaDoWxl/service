<h2>Редактировать Издание</h2> <br/>
<form method="post" action="<?= CHtml::normalizeUrl(array('archive/save','id'=>$archive->id))?>" enctype="multipart/form-data">

	<table class="step-right">
		<tr>
			<td><strong>Название:</strong></td>
			<td><input class="input wide" name="title" type="text" required id="name" value="<?=$archive->title?>"></td>
			<td></td>
		</tr>
		<tr>
			<td><strong>Издательство:</strong></td>
			<td>
				<select name="status">
					<option value="1" <?=($archive->status==1)?'selected':''?>>РБК</option>
					<option value="2" <?=($archive->status==2)?'selected':''?>>Бизнес & Власть</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><strong>Номер:</strong></td>
			<td><input class="input" name="number" type="text" required value="<?=$archive->number?>"></td>
			<td class='validation-error' id="email-error"></td>
		</tr>
		<tr>
			<td><strong>Дата:</strong></td>
			<td><input class="tcal input wide" name="date" type="date" required id="date" value='<?=$archive->date?>'></td>
			<td></td>
		</tr>
		<tr>
			<td><strong>Издание:</strong></td>
			<td>
				<input type="file" name="file">
			</td>
		</tr>
		<tr>
			<td><strong>Короткое описание:</strong></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3">
				<textarea class="input wide" name="body"><?=$archive->body?></textarea>
			</td>
		</tr>
		<tr>
			<td><strong>Изображение:</strong></td>
			<td>
				<div class="images images-sortable">

					<div class="image">
						<div class="icon100"><img src="<?= $this->baseUrl . $archive->img ?>" class="round100"></div>
						<div class="image-remove"> <a class="btn-red delete-image" data-id="<?= $archive->id ?>">Удалить</a> </div>
					</div>

				</div>
				<h4>Добавить изображение:</h4>
				<div class="image-drop dropzone"></div>
				<input class="input" name="img" type="hidden" id="img" value="<?php echo $archive->img ?>">
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" value="Сохранить" class="btn-green save-btn" id="submit"></td>
		</tr>
	</table>

</form>

<script type="text/javascript">
	$(function() {

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
		url: "<?php echo CHtml::normalizeUrl(array('archive/uploadIcon', 'f'=>'books'))?>" ,
		addRemoveLinks: true,
		uploadMultiple : false,
		success: function(data, response) {
			$("#img").val(response);

			newFileNames[data.name] = response;
		},
		maxFilesize : 3,
		init: function() {
			var dz = this
			this.on("removedfile", function(data) {
				delete newFileNames[data.name];
				f = $("#img").val();
				for (var key in newFileNames) {
					$("#img").val(newFileNames[key]);
				}
				if (f == $("#img").val()) $("#img").val("");
			});
		}
	});
</script>
<h2>Просмотр Вопроса</h2>
<br>
<div class="scrollable">
	<div class="tabulation" data-id="tabs-1">
		<a class="element active" data-id="tab-1">Вопрос</a>
		<a class="element" data-id="tab-2">Ответ</a>
	</div>
	<div class="tabs" id="tabs-1">
		<div class="tab active" id="tab-1">
			<form method="post" action=" <?= CHtml::normalizeUrl(array('quest/saveQuest','id'=>$quest->id))?>" class="modal">
				<table class="step-right">
					<tr>
						<td><strong>Тема вопроса:</strong></td>
						<td>
							<select name="id_theme">
								<? foreach($quest_themes as $quest_theme): ?>
									<option value="<?=$quest_theme->id?>" <?=($quest->id_theme==$quest_theme->id)?'selected':''?> ><?=$quest_theme->name;?></option>
								<? endforeach ?>
							</select>
						</td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Автор:</strong></td>
						<td><label><?=(isset($quest->idUser->name))?$quest->idUser->name:$quest->user_name ?></label></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>E-Mail Автора:</strong></td>
						<td><label><?=(isset($quest->idUser->mail))?$quest->idUser->mail:$quest->user_mail ?></label></td>
						<td></td>
					</tr>
					<tr>

						<td><strong>Кому адресован:</strong></td>
						<td>
							<select name="id_expert">
								<? foreach($experts as $expert): ?>
									<option value="<?=$expert->id?>" <?=($expert->id==$quest->id_expert)?'selected':''?> ><?=$expert->name;?></option>
								<? endforeach ?>
							</select>
						</td>
						<td class='validation-error' id="email-error"></td>
					</tr>
					<tr>
						<td><strong>Дата:</strong></td>
						<td><label><?=Yii::app()->dateFormatter->format('d MMMM yyyy в HH:mm', $quest->date )?></label></td>
						<td></td>
					</tr><tr>
						<td><strong>Дата ответа:</strong></td>
						<td><label><?= ($quest->date_answer)?(Yii::app()->dateFormatter->format('d MMMM yyyy HH:mm', $quest->date_answer)):''?></label></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Вопрос:</strong></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">
							<textarea name="body" class="input wide"><?=$quest->body?></textarea>
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
					<td id="loader" class="websymbol"><input type="submit"  style="position: static;left: inherit;top: inherit;" value="Отправить ответ" class="btn-green" data-id="<?=$quest->id?>" id="send_answer"></td>
				</tr>
				<tr>
					<td><strong>Ответ:</strong></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="answer" class="input wide" id="answer-<?=$quest->id?>"><?=($quest->answer)?$quest->answer:''?></textarea>
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


	</div>
	<input type="submit" value="Сохранить" class="btn-green save-btn" id="submit">
	</form>
</div>
</div>

<script type="text/javascript">
	var editor;
	$(function() {
		$('.scrollable').on('click', '#send_answer', function(e){
			e.preventDefault();
			var idobj=$('#answer-'+$(this).data('id'))
			loader();
			$.ajax({
				url: '<?= CHtml::normalizeUrl(array('quest/send'))?>',
				data: {
					id: $(this).data('id'),
					answer:editor.getData()
				},
				dataType: 'json',
				type: 'POST',
				success: function() {
					humane.log('Отправленно');
					clearTimeout(t);
					$('#loader').html('<input type="submit"  style="position: static;left: inherit;top: inherit;" value="Отправить ответ" class="btn-green" data-id="<?=$quest->id?>" id="send_answer">');
				},
				error:function(error) {
					humane.log(error.responseText);
					clearTimeout(t);
					$('#loader').html('<input type="submit"  style="position: static;left: inherit;top: inherit;" value="Отправить ответ" class="btn-green" data-id="<?=$quest->id?>" id="send_answer">');

				}
			})
		});

		editor = CKEDITOR.replace( 'answer',
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
		url: "<?php echo CHtml::normalizeUrl(array('catalog/uploadIcon', 'f'=>'debats'))?>" ,
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

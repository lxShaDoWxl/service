<h2>Добавить в верхнее меню</h2><br/>
<form action="<?php echo CHtml::normalizeUrl(array('settings/saveToMenu', 'id'=>isset($menu)?$menu->id:"new"))?>" method="POST" class="modal">
<table>
	<tbody>
		<tr>
			<td>Заголовок:</td>
			<td><input type="text" class="input wide" name="title" value="<?= isset($menu)?$menu->title:"" ?>" required id="name"></td>
		</tr>
        <?php if (isset($menu)) {?>
		<tr>
			<td><strong>Видимость:</strong></td>
			<td>
                <select class="switch" name="active">
                    <option value="0"<?= ($menu->active == "0")?" selected":"" ?>>0</option>
                    <option value="1"<?= ($menu->active == "1")?" selected":"" ?>>1</option>
                </select>
            </td>
		</tr>
        <?php } ?>
		<tr>
			<td>
				<strong>Url:</strong>
			</td>
			<td><input type="text" name="url" value="<?= isset($menu)?$menu->url:"" ?>" class="input"></td>
		</tr>
        <tr>
            <td>
                <strong>Позиция:</strong>
            </td>
            <td><input type="text" name="position" value="<?= isset($menu)?$menu->position:"" ?>" class="input">
                <input type="hidden" name="location" value="<?= isset($menu)?$menu->location:"header" ?>" class="input">
                <input type="hidden" name="img_url" value="<?= isset($menu)?$menu->img_url:"" ?>" class="input"></td>
        </tr>

	</tbody>
</table>
	<input type="submit" class="btn-green" value="Сохранить"/>
</form>
<script type="text/javascript">
	$(function(){
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

    $('.tabulation .element').click(function() {
        $('.tabulation .element').removeClass('active');
        $(this).addClass('active');
        $('#' + $(this).parent().data('id') + ' > .tab').hide();
        $('#' + $(this).data('id')).show();

    });
    /*
		var newFileNames = {};
		$("div.image-drop").dropzone({ 
			url: "<?= $this->baseUrl ?>/admin/catalog/uploadIcon/f/item" , 
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
		});*/
	});
</script>

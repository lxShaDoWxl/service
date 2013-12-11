<h2>Изменить Слайдер</h2>

<br>

<div class="scrollable">
    <div class="tab" id="tab-3">
        <form method="post" action="<?php echo CHtml::normalizeUrl(array('settings/slider', 'action'=>'save', 'id'=>$s->id))?>" class="modal">
            <table>
                <tbody>
                <tr>
                    <td>Ссылка:</td>
                    <td><input type="text" class="input wide" name="url" value="<?= $s->url ?>"></td>
                </tr>
                <tr>
                    <td>Позиция:</td>
                    <td><input type="text" class="input" name="position"  value="<?= $s->position ?>"></td>
                </tr>
                <tr>
                    <td>
                        <div class="step-right">
                            <?php if($s->img ==true) { ?>
                            <strong>Изображение:</strong>
                            <div class="images images-sortable">
                                <div class="image">
                                    <div class="icon100"><img src="<?= $this->baseUrl . $s->img ?>" class="round100"></div>
                                    <div class="image-remove"> <a class="btn-red delete-image" data-id="<?= $s->id ?>">Удалить</a> </div>
                                </div>
                            </div>
                            <?php } ?>
                            <h4>Добавить изображение:</h4>
                            <div class="image-drop dropzone"></div>
                            <input class="input" name="img" type="hidden" id="img"  value="<?=$s->img ?>">
                            <input class="input" name="imgs_url" type="hidden" id="imgs_url" required>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>



            <input type="submit" value="Сохранить" class="btn-green" id="submit">
        </form>
    </div>
</div>

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
        url: "<?php echo CHtml::normalizeUrl(array('settings/uploadIcon', 'f'=>'slider'))?>" ,
        addRemoveLinks: true,
        uploadMultiple : false,
        success: function(data, response) {
            $("#img").val(response);
            $("#imgs_url").val($("#imgs_url").val() + ',' + response);
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
                    $("#img").val(newFileNames[key]);
                }
                if (f == $("#img").val()) $("#img").val("");
            });
        }
    });

    // $("div.images-drop").dropzone();
</script>

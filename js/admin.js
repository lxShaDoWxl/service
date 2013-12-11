$(document).ready(function() {
        $('.commentl_box').on('dblclick', '.editable', function(){
        $(this).attr("contenteditable", "true");
        return false;
        });

    $(document).click(function(e) {
            if ($(e.target).hasClass("editable") || ($(e.target).parents(".editable").size() > 0)) {
            return;
            }
        var el = $("[contenteditable]");
        if (el.size()) {

            var val = el.html();
            if (el.attr("preprocess") == 'br2nl') {
            //T_T
            val = val.split("\r\n").join("").split("\n").join("").split("<br>").join("\n").split("<br/>").join("\n");
            }
        var field= el.data('field');
        var fields = {};
        fields[field]=val

        $.ajax({
            url: '/site/save',
            data: {
            fields: fields,
            model:el.data('model'),
            pk:el.data("pk")
            },
        dataType: 'json',
        type: 'POST',
        success: function() {
            humane.log('Сохранено');
            }
        })
        }
        el.removeAttr("contenteditable");
    });
    $.fn.setCursorPosition = function(pos) {
        this.each(function(index, elem) {
            if (elem.setSelectionRange) {
                elem.setSelectionRange(pos, pos);
            } else if (elem.createTextRange) {
                var range = elem.createTextRange();
                range.collapse(true);
                range.moveEnd('character', pos);
                range.moveStart('character', pos);
                range.select();
            }
        });
        return this;
    };

    $('.commentl_box').on('click', '.action-edit', function(e){
        var el = $(this).parent().prev("p");
        el.attr("contenteditable", "true").focus();
       // el.setSelectionRange(el.value.length,el.value.length);
        return false;
    });

    $('.commentl_box').on('click', '.action-del', function(){
        var isConfirmed = confirm('Вы уверены?');
        if (isConfirmed) {
            $.ajax({
                url: '/site/del',
                data: {
                    model:$(this).parent().prev("p").data('model'),
                    pk:$(this).parent().prev("p").data("pk")
                },
                dataType: 'json',
                type: 'POST',
                success: function() {
                    humane.log('Удалено');
                    location.reload();
                }
            })
        }

    });
});

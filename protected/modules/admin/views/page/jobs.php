<table class="table">
    <div class="search">
        <a href="" class="btn-green ajax-load" data-page="<?php echo CHtml::normalizeUrl(array('page/createJob')) ?>"> + Добавить вакансию</a>
    </div>
    <thead>
    <td>Название</td>
    <td>Видимость</td>
    <td>Операции</td>
    </thead>
    <tbody>
    <?php foreach ($jobs as $job): ?>
        <tr>
            <td><?php echo $job->name?></td>
            <td class="skip" style="text-align: center;">
                <select class="ajax-switch" data-id="<?= $job->id ?>">
                    <option value="1"<?= ($job->isVisible)?" selected":"" ?>></option>
                    <option value="0"<?= (!$job->isVisible)?" selected":"" ?>></option>
                </select>
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-green icon ajax-load" href="#edit" data-page="<?php echo CHtml::normalizeUrl(array('page/editJob', 'id'=>$job->id)) ?>">i</a>
                    <a class="btn btn-green icon confirm-delete" href="<?php echo CHtml::normalizeUrl(array('page/deletedJob', 'id'=>$job->id)) ?> ">g</a>
                </div>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<script type="text/javascript">
    $(function() {
        var ajaxSwitchID = 0;
        $('.ajax-switch').each(function() {
            $(this).attr('data-sid', ajaxSwitchID);
            temp = "";
            leftSpace = "";
            if ($(this).val() == 1) {
                temp = " true";
                leftSpace = "style='left: 1em;'"
            };
            $(this).after("<div class='ajax-switcher"+temp+"' data-sid='"+ajaxSwitchID+"' data-state='1'><div class='toggle' "+leftSpace+"></div></div>");
            $(this).hide();

            ajaxSwitchID++;
        });
        $('.ajax-switcher').click(function() {
            $(this).toggleClass('true');

            var thisSwitch = $('.ajax-switch[data-sid="'+$(this).data('sid')+'"]');
            if($(this).hasClass('true')) {
                $('.toggle', $(this)).animate({'left' : '1em'}, 200);
                thisSwitch.val(1);
            } else {
                $('.toggle', $(this)).animate({'left': '0em'}, 200);
                thisSwitch.val(0);
            }
            $.ajax({
                type: "GET",
                url: "<?= CHtml::normalizeUrl(array('page/statusJob'));?>",
                data:{id:$(thisSwitch).data('id'), status:$(thisSwitch).val()}

        });
        });
    });
</script>

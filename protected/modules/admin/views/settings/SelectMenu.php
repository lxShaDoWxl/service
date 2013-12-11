<style>
    #sortable {
        list-style-type: none;
    }
    #sortable li {
        margin: 2px;
        padding: 4px;
        border: 1px solid #e3e3e3;
        background-color: seagreen;
        border-radius: 5px;
        color: #ffffff;
        cursor:n-resize;
    }
</style>
<h2>Изменение позиции меню</h2><br/>
<form action="<?php echo CHtml::normalizeUrl(array('settings/SaveSelect', 'location'=>$location))?>" method="POST">
    <table>
        <tbody>
        <tr>
            <td><ul id="sortable">
                    <?php
                    $i=1;
                    foreach($items as $item) { ?>
                    <li id="<?php echo $item->id ?>"><?php echo $item->title ?>
                     <input type="hidden" class="<?php echo $item->id ?>" name="<?php echo $item->id ?>" value="<?php echo $i ?>"></li>
                    <?php $i++; } ?>
                </ul></td>

        </tr>
        </tbody>
    </table>
    <input type="submit" class="btn-green" value="Сохранить"/>
</form>
<script type="text/javascript">
    $(function(){
            $('#sortable').sortable({

                update: function() {
                    var stringDiv = "";
                    $("#sortable").children().each(function(i) {
                        var li = $(this);
                        var classes="."+li.attr("id");
                        $(classes).val(i+1);
                    });

                   /* $.ajax({

                        type: "POST",
                        url: "<?php echo CHtml::normalizeUrl(array('settings/SaveSelect'))?>",
                        data: stringDiv

                    });*/
                }
            });
            $( "#sortable" ).disableSelection();
        });
</script>

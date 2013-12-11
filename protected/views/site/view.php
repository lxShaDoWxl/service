<?php $this->beginContent('//layouts/catalogMenu'); ?>
<?php $this->endContent(); ?>
<div class="main-box">
    <div class="main-t"></div>
    <div class="main-c">
        <div class="frame">
            <?php  $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->bread,
                'htmlOptions'=>array('class'=>'breadcrumbs'),
                'tagName'=>'ul',
                'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
                'inactiveLinkTemplate'=>'<li>{label}</li>',
                'homeLink'=>'<li><a href="'.Yii::app()->homeUrl.'">главная</a></li>',
                'separator'=>''
            )); ?>
            <h1><?= $page->title ?><span><?= $page->under_title ?></span></h1>
            <section class="content">
                <div class='text_page' style="height: 670px;overflow: hidden;">
                    <div class='scroll_text' style="height: 100%;">
                        <?= $page->body ?>
                    </div>
                </div>
                <div class="btns" id="text_btns">
                    <a href="#" class="btn-bottom">bottom</a>
                    <a href="#" class="btn-top disabled">top</a>
                </div>
            </section>
        </div>
    </div>
    <div class="main-b"></div>
</div>
</div>
</section>
<script type="text/javascript">


    $(document).ready(function(){
        if($('.scroll_text').height = $('.text_page').height){
            $('#text_btns').hide();
        }


        $('.btn-bottom').click(function(event){
            event.preventDefault();
//Необходимо прокрутить в конец страницы
            $('.btn-top').removeClass('disabled');
            var scroll=$('.text_page').scrollTop();
            $('.text_page').animate({'scrollTop':scroll+150}, function(){

                if($('.text_page').scrollTop()==($('.scroll_text').height()-$('.text_page').height()+21)) {
                    $('.btn-bottom').addClass('disabled');
                    console.log($('.text_page').scrollTop());
                }
            });

        });
        $('.btn-top').click(function(event){
            event.preventDefault();
//Необходимо прокрутить в конец страницы
            $('.btn-bottom').removeClass('disabled');
            var scroll=$('.text_page').scrollTop();
            $('.text_page').animate({'scrollTop':scroll-150},function(){

                if($('.text_page').scrollTop()==0) {
                    $('.btn-top').addClass('disabled');
                    console.log($('.text_page').scrollTop());
                }
            });
        });
    });

</script>
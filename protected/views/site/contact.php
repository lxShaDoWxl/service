<?php $this->beginContent('//layouts/catalogMenu'); ?>
<?php $this->endContent(); ?>
<script type="text/javascript">

    function AjaxCallback(){
        jQuery.ajax({
            url:     "<?=CHtml::normalizeUrl(array('site/contact')); ?>", //Адрес подгружаемой страницы
            type:     "POST", //Тип запроса
            dataType: "html", //Тип данных
            data: jQuery("#contact-form").serialize(),
            success: function(data){
                if(data){
                    alert('Вашe сообщение успешно отправлено')
                    location.reload()
                } else{
                    alert('Проверти правильность ваших данных')

                }
            },
            error: function() {
                alert('Ошибка')
            }
        });

    }


</script>
        <div class="main-box">
            <div class="main-t"></div>
            <div class="main-c">
                <div class="frame">
                    <ul class="breadcrumbs">
                        <li><a href="/">главная</a></li>
                        <li>контакты</li>
                    </ul>
                    <h1>Контакты</h1>
                    <div id="map" class="map-holder" style="width:100%; height: 422px;">
                    </div>

                    <script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU&coordorder=longlat" type="text/javascript"></script>
                    <script type="text/javascript">
                        ymaps.ready(init);
                        var myMap;

                        // Создаем собственную метку

                        function init(){
                            myMap = new ymaps.Map ("map", {
                                center: [<?php echo Settings::get('ymap')->value; ?>],
                                zoom: 16,
                                type: 'yandex#map',
                                autoFitToViewport: 'ifNull'
                            });

                            myMap.controls
                                .add('smallZoomControl', {right: 5, top: 75})
                                .add('typeSelector')
                                .add('mapTools');
                            metka = new ymaps.Placemark([<?= Settings::get('ymap')->value; ?>],{
                                balloonContent: '<?= Settings::get('ymap_text')->value;; ?>'},{
                              //  iconImageHref:'/img/metka.png',
                               // iconImageSize: [34, 48]
                                // Смещение левого верхнего угла иконки относительно
                                // её "ножки" (точки привязки).
                                // iconImageOffset: [-3, -42]


                            });
                            myMap.geoObjects.add(metka);
                        }

                    </script>
                    <div class="contacts-box">
                        <div class="contact-us">
                            <span class="phone"><?= Settings::get('phone')->value?></span>
                            <span class="title"><span>Свяжитесь с нами удобным для вас способом</span></span>
                            <div class="cols">
                                <?= Settings::get('cols')->value; ?>

                            </div>
                        </div>
                        <dl class="details">
                            <?= Settings::get('details')->value; ?>

                        </dl>
                    </div>
                    <a href="#popup" class="feedback btn-request">Обратная связь</a>
                </div>
            </div>
            <div class="main-b"></div>
        </div>
    </div>
</section>
<div class="modal" id="popup">
    <div class="main-box">
        <div class="main-t"></div>
        <div class="main-c">
            <div class="frame">
                <ul class="breadcrumbs">
                    <li><a href="#">главная</a></li>
                    <li><a href="/">контакты</a></li>
                    <li>форма обраьной связи</li>
                </ul>
                <h1>Форма обратной связи</h1>

                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'contact-form',

                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                        ),
                        'htmlOptions'=>array(
                            'class'=>'feedback-form',
                        )
                    )); ?>
                    <fieldset>
                        <div class="row">
                            <input type="text" class="text" name="name" placeholder="Иванов Петр Сергеевич" />
                        </div>
                        <div class="row">
                            <input type="text" class="text" name="mail"  placeholder="Введите Ваш Email" />
                        </div>
                        <div class="row">
                            <input type="text" class="text" name="phone"  placeholder="Введите Ваш телефон" />
                        </div>
                        <div class="row">
                            <input type="text" class="text" name="message"  placeholder="Оставьте ваше сообщение" />
                        </div>
                        <div class="divider"></div>
                        <div class="row">

                            <?php echo $form->textField($model,'verifyCode', array('class'=>'text text-small')); ?>
                            <div class="image">
                                <?php $this->widget('CCaptcha'); ?>
                            </div>
                            <em class="note">Введите код указанный на картинке</em>
                        </div>
                        <input class="submit" onclick="AjaxCallback();"/>
                    </fieldset>
                <?php $this->endWidget(); ?>
                <a href="#" class="close">закрыть</a>
            </div>
        </div>
        <div class="main-b"></div>
    </div>
</div>
/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306_copy
Source Server Version : 50169
Source Host           : 10.0.0.77:3306
Source Database       : and

Target Server Type    : MYSQL
Target Server Version : 50169
File Encoding         : 65001

Date: 2013-12-11 09:45:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `answer_comment_debat`
-- ----------------------------
DROP TABLE IF EXISTS `answer_comment_debat`;
CREATE TABLE `answer_comment_debat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_debat_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_debat_id` (`comment_debat_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `answer_comment_debat_ibfk_1` FOREIGN KEY (`comment_debat_id`) REFERENCES `comments_debat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `answer_comment_debat_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of answer_comment_debat
-- ----------------------------

-- ----------------------------
-- Table structure for `banner`
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `date_start` varchar(255) NOT NULL,
  `date_end` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banner
-- ----------------------------

-- ----------------------------
-- Table structure for `banner_stat`
-- ----------------------------
DROP TABLE IF EXISTS `banner_stat`;
CREATE TABLE `banner_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_banner` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_banner` (`id_banner`),
  CONSTRAINT `banner_stat_ibfk_1` FOREIGN KEY (`id_banner`) REFERENCES `banner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banner_stat
-- ----------------------------

-- ----------------------------
-- Table structure for `book`
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `body` text,
  `number` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES ('1', '/userfiles/books/xrss_b&v_39_rus.pdfd20131115171000.pdf', 'Президент страны ругает банки за то, что те снижают кредитование МСБ. Есть выход - власти нужно первой сделать шаг и предоставить коммерческим банкам Казахстана часть денег Нацфонда.', '39 (471)', 'Деньги каждому нужны', '2012-11-15', '/userfiles/books/x30414d20131115170802.jpg', '2');
INSERT INTO `book` VALUES ('2', '/userfiles/books/xrss_b&v_38_rus.pdfd20131115171336.pdf', 'Паника на корабле еще не красила ни один экипаж. Ведь это говорит о том, что ситуация вышла из-под контроля. Тем не менее что-то подобное мы наблюдали на этой неделе в Астане.', '38 (470)', 'Почти «Титаник»', '2013-11-08', '/userfiles/books/x36873d20131115171227.jpg', '2');
INSERT INTO `book` VALUES ('3', '/userfiles/books/xbv_3_web.pdfd20131115221558.pdf', 'краткое описание', '3 (435)', 'Ох уж этот ненасытный «слон»!', '2013-02-01', '/userfiles/books/x22928d20131115221530.jpg', '2');
INSERT INTO `book` VALUES ('4', '/userfiles/books/x1367478334_599.pdfd20131118111136.pdf', 'Январь оказался на редкость насыщенным на события месяцем. Президент позаботился о том, чтобы после сытного праздничного стола у казахстанцев было много пищи для размышлений.', '01-02', 'Каковы перспективы 2013 года', '2013-02-08', '/userfiles/books/x85058d20131118111022.jpg', '1');
INSERT INTO `book` VALUES ('5', '/userfiles/books/x1367477918_162.pdfd20131118121557.pdf', 'Что если мы стоим на пороге очередного потребительского бума? Конечно, на фоне общемировой нестабильности наше «бум!» звучит чуть ли не издевательски. Но все-таки есть сигналы.', '03', 'Государственно-частное партнерство: Эффективный тандем', '2013-03-29', '/userfiles/books/x8272d20131118121526.jpg', '1');
INSERT INTO `book` VALUES ('6', '/userfiles/books/x05.pdfd20131118122601.pdf', 'Мы стоим на пороге появления в Казахстане такого явления, как социальное предпринимательство. К подобным мыслям подталкивает стечение нескольких обстоятельств.', '05', 'Читайте, завидуйте, я гражданин...', '2013-05-29', '/userfiles/books/x27727d20131118122444.jpg', '1');
INSERT INTO `book` VALUES ('7', '/userfiles/books/xRBK_#6(2) (2).pdfd20131118163620.pdf', 'Нефтяники, металлурги, парикмахеры, брокеры, слесари, юристы, торговцы и многие другие, кто занимается бизнесом, в одночасье должны оказаться в одной большой семье под названием Национальная палата предпринимателей (НПП). Равные среди равных? Или кто-то будет «равнее»?', '06', 'На наших слабостях крепчают бизнесы', '2013-06-29', '/userfiles/books/x24016d20131118163614.jpg', '1');
INSERT INTO `book` VALUES ('8', '/userfiles/books/xRBK_#7-8_preview_spreads.pdfd20131118163843.pdf', 'Какие ассоциации навевают сланцы? Приятные... Особенно в августе —\r\nна ум сразу приходит пляж, забившийся песочек щекочет пятки, теплый\r\nбриз обдувает ступни. Ах, сланцы, великое изобретение — и по берегу\r\nв них, и по полосе прибоя... «Эй, эй! Вернись на землю — в свой душный\r\nофис, к флипчартам и экономическим прогнозам, — голос министра\r\nэнергетики США Эрнеста Мониса превращает прекрасный мираж в суро-\r\nвую действительность. — Я о других сланцах говорю!»', '07-08', 'Куда приводят мечты?', '2013-08-15', '/userfiles/books/x28692d20131118163838.jpg', '1');
INSERT INTO `book` VALUES ('9', '/userfiles/books/xrss_b&v_37_rus.pdfd20131118165430.pdf', 'Сколько бы ни стоили углеводороды, а одной нефтью сыт не будешь, равно как и природным газом не надышишься, решили инвесторы.', '37 (469)', 'Докопались', '2013-11-01', '/userfiles/books/x88898d20131118165425.jpg', '2');
INSERT INTO `book` VALUES ('10', '/userfiles/books/xb&v_#32_web.pdfd20131118165750.pdf', 'О госкапитализме говорили во вторник на форуме К3 в Алматы. О том, что чиновники, словно небожители (никто их толком не видит, но все точно знают, что они есть), решают судьбу экономики. И если люди-предприниматели хотят дождя для своих полей, то нет смысла молиться богам. Не Средневековье, поди, на дворе.', '32 (464)', 'Прогноз на завтра - дождь', '2013-09-27', '/userfiles/books/x53285d20131118170041.jpg', '2');
INSERT INTO `book` VALUES ('11', '/userfiles/books/xrss_b&v_31_rus.pdfd20131118170309.pdf', 'Чаще обычного в последнее время стала обсуждаться тема гражданского общества. Тем самым развивающиеся страны пытаются подтянуться до уровня развитых государств. Исключением не стал и Казахстан, ведь гражданское самосознание свидетельствует о взрослении общества.\r\nОднако пока у нас, как в том анекдоте: «Гражданское общество – это когда граждане общаются, а правовое государство – когда государство право».', '31 (463)', 'Аллергия на серость', '2013-09-20', '/userfiles/books/x72437d20131118170304.jpg', '2');
INSERT INTO `book` VALUES ('12', '/userfiles/books/xrss_b&v_30_rus (1).pdfd20131118170527.pdf', 'Крупные экономики мира стремятся получать больше денег от крупных корпораций. Им на последней встрече G20 была отведена роль важных источников налоговых платежей. Станет ли подобное приоритетом и для стран за пределами G-20?', '30 (462)', 'Большие решают', '2013-09-13', '/userfiles/books/x79918d20131118170519.jpg', '2');
INSERT INTO `book` VALUES ('13', '/userfiles/books/xrss_b&v29_rus (8).pdfd20131118170733.pdf', 'Кодекс предпринимателей предстоит разработать правительству до конца этого года. По словам Нурсултана Назарбаева, это будет своего рода конституция нашего бизнеса. В ней закрепят базовые принципы деятельности казахстанского предпринимательства и взаимодействия с государством.', '29 (461)', 'Всем - в бизнес-класс!', '2013-09-06', '/userfiles/books/x33542d20131118170730.jpg', '2');
INSERT INTO `book` VALUES ('14', '/userfiles/books/xrss_b&v_28.pdfd20131118170924.pdf', 'Тюремщик разносит баланду. Налил супа заключенному, тот смотрит в миску и говорит: «Мне мясо положено». «Положено — ешь», — отвечает тюремщик. «Так ведь не положено», — удивляется заключенный. «Не положено — не ешь», — равнодушно отвечает тюремщик.', '28 (460)', 'Право на выходной', '2013-08-29', '/userfiles/books/x63972d20131118170921.jpg', '2');
INSERT INTO `book` VALUES ('15', '/userfiles/books/xrss_b&v_27 (1).pdfd20131118171119.pdf', 'Малый бизнес в Казахстане напоминает Гулливера в стране великанов. Имея\r\nпотенциал роста, он теряется на фоне средних и крупных компаний. Это создает неравные условия для развития предпринимательства в стране и несет риски для развития экономики.', '27 (459)', 'Крохи для крохи', '2013-08-23', '/userfiles/books/x22301d20131118171113.jpg', '2');
INSERT INTO `book` VALUES ('16', '/userfiles/books/xrss_b&v26 (1).pdfd20131118171311.pdf', '«Без меня меня женили». Это выражение так и напрашивается к прошедшим недавно выборам глав местных органов власти. Инициатива вроде бы хорошая, а вот уверенности — сложится или не сложится взаимодействие населения с новым акимом — почему-то нет.', '26 (458)', 'Женитьбу бальзамировали', '2013-08-16', '/userfiles/books/x34712d20131118171308.jpg', '2');
INSERT INTO `book` VALUES ('17', '/userfiles/books/xrss_b&v25(7).pdfd20131118171457.pdf', 'Кто первый встал – того и сланцы! По всей видимости, именно это хотел сказать министр энергетики США Эрнест Монис, когда говорил о грядущих изменениях структуры энергетического рынка. Свои ожидания он связывает с ростом добычи сланцевой нефти и газа.', '25 (457)', 'Достаем сланцы', '2013-08-09', '/userfiles/books/x65419d20131118171454.jpg', '2');
INSERT INTO `book` VALUES ('18', '/userfiles/books/x1373618504_414.pdfd20131119124548.pdf', '«Ты знаешь, все в твоих руках», — почти поют законотворцы нашим гражданам, когда речь заходит о местном самоуправлении. На днях даже были названы даты проведения выборов акимов в областях, которые впервые должны пройти путем консультации с местным сообществом. Вот только первый блин, как говорится... По словам экспертов, населению так и не будет дан шанс напрямую выбирать людей, которым оно доверяет.', '24 (456)', 'Выбирать не приходится', '2013-07-12', '/userfiles/books/x7409d20131119124529.jpg', '2');
INSERT INTO `book` VALUES ('19', '/userfiles/books/x1373178836_37.pdfd20131119155845.pdf', '«Кто-то работает, а кому-то надо наблюдать...» – решило наше государство. А точнее, Министерство экономики и бюджетного планирования, которое озвучило на этой неделе свое предложение значительно сократить количество госпредприятий. Это означает, что у бизнеса появится шанс работать в нормальной рыночной среде, а не тягаться с таким конкурентом, как государство.', '23 (455)', 'Один везет, другому - везет', '2013-07-05', '/userfiles/books/x40686d20131119155839.jpg', '2');
INSERT INTO `book` VALUES ('20', '/userfiles/books/xb&v_#22.pdfd20131119160056.pdf', 'На суде мужчину ругают: как же вам не стыдно, как вы могли ударить жену сковородой по голове? А он: ну вы только представьте – она стоит ко мне спиной, у меня в руке сковородка, как я мог упустить такой благоприятный момент?', '22 (454)', 'За гранью фола', '2013-06-28', '/userfiles/books/x18542d20131119160051.jpg', '2');
INSERT INTO `book` VALUES ('21', '/userfiles/books/x1371797959_761.pdfd20131119160249.pdf', 'В то время как мир ожидает в ближайшие 10 лет рост цен на продукты питания до 40%, аграрный сектор Казахстана, по статистике, растет лишь на 1,1%. Иными словами, казахстанские предприниматели недалеки от того, чтобы упустить свой шанс построить выгодный бизнес.', '21 (453)', 'Кушать продано', '2013-06-21', '/userfiles/books/x80047d20131119160246.jpg', '2');
INSERT INTO `book` VALUES ('22', '/userfiles/books/x1371200211_258.pdfd20131119160429.pdf', 'За год (май 2013 года к маю 2012-го) наибольший рост показали такие отрасли, как торговля, связь и транспорт. Видимо, любимые занятия среднестатистического казахстанца – ездить на такси, делать покупки и неустанно болтать по мобильнику.', '20 (452)', 'Болтаем - разъезжаем - потребляем!', '2013-06-14', '/userfiles/books/x8297d20131119160427.jpg', '2');
INSERT INTO `book` VALUES ('23', '/userfiles/books/x1370858795_768.pdfd20131119160600.pdf', 'В парламент поступил законопроект «О Национальной палате предпринимателей РК». И если раньше в бизнесе каждый дул в свою персональную дуду, то теперь всем придется играть в большом оркестре.', '19 (451)', 'Фальши не будет?', '2013-06-07', '/userfiles/books/x44536d20131119160557.jpg', '2');
INSERT INTO `book` VALUES ('24', '/userfiles/books/x1370858723_956.pdfd20131119160721.pdf', 'Отечественный бизнес все больше обслуживает государство. Все чаще он нанимается подрядчиком к национальным компаниям и их дочерним организациям. Чем грозит нам «тендерная» экономика?', '18 (450)', 'Служанка при дворе', '2013-05-31', '/userfiles/books/x46499d20131119160659.jpg', '2');
INSERT INTO `book` VALUES ('25', '/userfiles/books/x1370858658_592.pdfd20131119160846.pdf', 'Ставшая популярной в Казахстане игра в дочки-матери продолжается по новым правилам. Теперь помимо уже известных игроков в лице «Самрук-Казыны» и ее многочисленных «дочек» в стране появится новый управляющий холдинг – «Байтерек». Ему-то и будут переданы все институты развития и финансовые организации.', '17 (449)', 'Супермама', '2013-05-24', '/userfiles/books/x17167d20131119160824.jpg', '2');
INSERT INTO `book` VALUES ('26', '/userfiles/books/x1370859521_218.pdfd20131119161014.pdf', 'Мы живем не по средствам. Расходы Казахстана растут быстрее доходов. И теперь правительство готово занять на внешних рынках $1 млрд, на что – непонятно.', '16 (448)', 'Разыгрался аппетит?!', '2013-05-17', '/userfiles/books/x38936d20131119160958.jpg', '2');
INSERT INTO `book` VALUES ('27', '/userfiles/books/xb&v_#7.pdfd20131119161459.pdf', 'О том, что деньги утекают как вода, казахстанцы\r\nсегодня могут говорить не только в переносном, но и в прямом смысле, оплачивая коммунальные услуги. Тарифы на все блага цивилизации растут быстрее, чем мы успеваем зарабатывать.', '07 (439)', 'Куда смываются деньги?', '2013-02-28', '/userfiles/books/x50972d20131119161455.jpg', '2');
INSERT INTO `book` VALUES ('28', '/userfiles/books/xrss_rbk_9.pdfd20131119171723.pdf', 'От сервисной экономики к ремонтной? Казахстан мог бы взять на вооружение новую теорию менеджмента, изобретенную британской яхтсменкой\r\nЭллен Макартур. Как минимум посвятить этому ноу-хау один из небольших\r\nстендов под блестящей крышей ЭКСПО-2017. Этакий маленький намек на то,\r\nчто не только альтернативные источники энергии способны спасти мир от\r\nистощения природных ресурсов, но и переход на экономику «циркулирую-\r\nщих продуктов».', '05 (5)', 'Найти отечественное', '2012-09-15', '/userfiles/books/x74787d20131119171710.jpg', '1');
INSERT INTO `book` VALUES ('29', '/userfiles/books/xrss_cs2.pdfd20131120085424.pdf', 'Девять человек будут регулировать денежный поток в $20 млрд. Остается узнать, кто будет открывать и закрывать «золотой» кран.', '04 (436)', 'Водопроводчики', '2013-02-08', '/userfiles/books/x54853d20131120085420.jpg', '2');
INSERT INTO `book` VALUES ('30', '/userfiles/books/xrss_cs4 (2).pdfd20131120085713.pdf', 'Государство и бизнес\r\nищут новые точки соприкосновения. Поводом для надежды на эффективный тандем в этот раз послужили новые формы государственно-частного партнерства, которые были приняты Мажилисом вместе с поправками в законодательство.', '05 (437)', 'Двое в лодке, не считая денег', '2013-02-15', '/userfiles/books/x93805d20131120085711.jpg', '1');
INSERT INTO `book` VALUES ('31', '/userfiles/books/xrss_cs5.pdfd20131120085947.pdf', '«В связи с возможным финансовым кризисом свет в конце туннеля будет отключен в целях экономии электроэнергии». Такие объявления скоро уже не будут удивлять наших граждан. Потому что ситуации из анекдотов все чаще случаются с нами в жизни.', '06 (438)', 'Кому рожать?', '2013-02-22', '/userfiles/books/x25948d20131120085944.jpg', '2');
INSERT INTO `book` VALUES ('32', '/userfiles/books/xrss_cs7.pdfd20131120090153.pdf', 'Женщины стали генератором роста экономики в 2012 году. А все благодаря любви к шопингу и походам по магазинам.', '08 (440)', 'Экономическое чудо с женским лицом', '2013-03-07', '/userfiles/books/x43837d20131120090151.jpg', '2');
INSERT INTO `book` VALUES ('33', '/userfiles/books/xrss_cs8.pdfd20131120090430.pdf', 'Почему государство заинтересовано в эффективности отечественных предпринимателей? Потому что при низкой производительности труда казахстанские компании – плохой плательщик налогов в бюджет. Этот вопрос стал одним из ключевых на вчерашней встрече премьера с бизнесменами.', '09 (441)', 'Народные неумельцы', '2013-03-15', '/userfiles/books/x39104d20131120090428.jpg', '2');
INSERT INTO `book` VALUES ('34', '/userfiles/books/xrss_cs11.pdfd20131120090606.pdf', 'Отрубание пальцев или расстрел коррупционеров, а может, вживление чипов\r\nгосслужащим, чтобы следить за их поведением? Возможно, что-то из этих\r\nпредложений граждан попадет в новый антикоррупционный закон.', '11 (443)', 'Толпотворение', '2013-04-05', '/userfiles/books/x76951d20131120090603.jpg', '2');
INSERT INTO `book` VALUES ('35', '/userfiles/books/xrss_cs12.pdfd20131120090752.pdf', 'Государство и предприниматели-новаторы в трех соснах заблудились. Экономика страны маленькая, а они друг с другом встретиться не могут: стартаперам нужна поддержка, а государству – идеи. И то и другое теоретически есть, а «выхлопа» никакого.', '12 (444)', 'Кто здесь?', '2013-04-12', '/userfiles/books/x78386d20131120090751.jpg', '2');
INSERT INTO `book` VALUES ('36', '/userfiles/books/xrss_cs13.pdfd20131120090943.pdf', 'Сегодня ни одно движение в стране не обходится без участия государства. Такое ощущение, что власть хочет дергать за все ниточки сразу, но даже для того, чтобы быть кукловодом, требуется определенный навык.', '13 (445)', 'В балаган нас приглашают', '2013-04-19', '/userfiles/books/x9777d20131120090941.jpg', '2');
INSERT INTO `book` VALUES ('37', '/userfiles/books/xrss_cs14 (2).pdfd20131120091134.pdf', 'Мощный средний класс – это опора общества. Выступая на этой неделе на заседании Ассамблеи народа Казахстана, Нурсултан Назарбаев обратил внимание на то, что именно средний класс должен стать движущей силой в нашей стране. Скорее всего, так оно и будет. Во-первых, средний класс растет количественно. Во-вторых, растут его ресурсные возможности, а вместе с ними – требования к качеству жизни.', '14 (446)', 'Где опора?', '2013-04-26', '/userfiles/books/x14161d20131120091131.jpg', '2');
INSERT INTO `book` VALUES ('38', '/userfiles/books/xrss_b&v_33_rus.pdfd20131120091332.pdf', 'Руководители главного банка страны меняются, базовые проблемы остаются. Одной из них являются растущие государственные расходы, которые и инфляцию подстегивают, и девальвацию тенге.', '33 (465)', 'Время показать лицо', '2013-10-04', '/userfiles/books/x31053d20131120091328.jpg', '2');
INSERT INTO `book` VALUES ('39', '/userfiles/books/xrss_b&v_34_rus.pdfd20131120091539.pdf', 'Надежды на светлое экономическое будущее порой в нашей стране разбиваются о непонимание того, где мы сегодня оказались. Увидеть подлинную картину сложно без независимого и честного мнения. Редким исключением был Канат Берентаев. Он всегда был независимым, поэтому и высказывания у него часто были критические и справедливые. Какой нам запомнится экономическая ситуация в стране глазами ушедшего из жизни известного казахстанского экономиста?', '34 (466)', 'Независимость не умирает', '2013-10-11', '/userfiles/books/x60461d20131120091537.jpg', '2');
INSERT INTO `book` VALUES ('40', '/userfiles/books/xrss_b&v_35_rus.pdfd20131120091737.pdf', 'Потребительский спрос перестает быть источником экономического роста. Есть потребительский бум, есть колоссальный рост потребительского кредитования, но отечественный производитель от этого практически ничего не получает. Еще бы! Мы ведь привыкли потреблять импортную продукцию. Но если не рост потребления, то что может стать драйвером роста экономики?', '35 (467)', 'Шопинг мимо кассы', '2013-10-18', '/userfiles/books/x32094d20131120091735.jpg', '2');
INSERT INTO `book` VALUES ('41', '/userfiles/books/xrss_b&v_36_rus (1).pdfd20131120091935.pdf', 'Запретный плод в виде взяток и «откатов» в скором времени может перестать быть сладким, как раньше. Нормы проекта нового Уголовного кодекса Казахстана предусматривают пожизненный запрет на государственную службу за совершение коррупционных преступлений.', '36 (468)', 'Сладость не в радость', '2013-10-25', '/userfiles/books/x44221d20131120091932.jpg', '2');
INSERT INTO `book` VALUES ('42', '/userfiles/books/xrss1, 2013.pdfd20131120110141.pdf', 'Регионы заживут по-новому. Будущий год обещает стать для них годом прогресса, обеспечить который предстоит новому ведомству – Министерству регионального развития. Обернется ли этот прогресс сбалансированным развитием регионов? Ответ на этот вопрос «&» искал вместе с экспертами.', '01 (433)', 'Сравниться со столицей', '2013-01-18', '/userfiles/books/x50353d20131120110139.jpg', '2');
INSERT INTO `book` VALUES ('43', '/userfiles/books/xb&v_#2_web.pdfd20131120110330.pdf', 'Взбодрить пенсионный рынок удалось на этой неделе главе нашего государства. Его слова о необходимости создания единого пенсионного фонда застали врасплох игроков пенсионного сектора. Да и что там говорить – самих вкладчиков.', '02 (434)', 'Слиться без экстаза', '2013-01-25', '/userfiles/books/x33460d20131120110324.jpg', '2');
INSERT INTO `book` VALUES ('44', '/userfiles/books/xb&v_#10.pdfd20131120110529.pdf', 'За прошлый год количество российских компаний, работающих в Казахстане, увеличилось на целых 80%. Наблюдая за тем, как они обостряют конкуренцию на нашем поле, поневоле вспоминаешь историю с троянским конем. Нам сделали «подарок» в виде Таможенного союза. Мы открыли границы, образно говоря, ворота собственного города. И радовались победе точно так же, как наивные жители Трои, а ночью «греки захватили город».', '10 (442)', 'Деликатес – в подарок', '2013-03-29', '/userfiles/books/x95601d20131120110458.jpg', '2');
INSERT INTO `book` VALUES ('45', '/userfiles/books/xb&v_#15.pdfd20131120110708.pdf', 'Система косвенных выборов акимов дискредитирует саму идею местного самоуправления.', '15 (447)', 'Кривая схема', '2013-05-03', '/userfiles/books/x96889d20131120110706.jpg', '2');
INSERT INTO `book` VALUES ('46', '/userfiles/books/x40.pdfd20131122094757.pdf', 'Наше правосудие, как в том анекдоте — сытые людоеды судят голодных людоедов за людоедство.', '40 (472)', 'У каждого своя мера', '2013-11-22', '/userfiles/books/x56034d20131122094542.jpg', '2');

-- ----------------------------
-- Table structure for `book_article`
-- ----------------------------
DROP TABLE IF EXISTS `book_article`;
CREATE TABLE `book_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id` (`article_id`) USING BTREE,
  KEY `book_id` (`book_id`),
  CONSTRAINT `book_article_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  CONSTRAINT `book_article_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `catalog` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of book_article
-- ----------------------------
INSERT INTO `book_article` VALUES ('1', '1', '2');
INSERT INTO `book_article` VALUES ('3', '3', '1');

-- ----------------------------
-- Table structure for `catalog`
-- ----------------------------
DROP TABLE IF EXISTS `catalog`;
CREATE TABLE `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `small_description` text NOT NULL,
  `full_description` text NOT NULL,
  `title_kz` varchar(255) DEFAULT NULL,
  `small_description_kz` text,
  `full_description_kz` text,
  `title_en` varchar(255) DEFAULT NULL,
  `small_description_en` text,
  `full_description_en` text,
  `isVisible` tinyint(4) NOT NULL,
  `date` varchar(255) NOT NULL,
  `author` int(11) DEFAULT NULL,
  `view` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `catalog_ibfk_1` (`cid`) USING BTREE,
  KEY `author_id` (`author`) USING BTREE,
  CONSTRAINT `catalog_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `catalog_ibfk_2` FOREIGN KEY (`author`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of catalog
-- ----------------------------
INSERT INTO `catalog` VALUES ('1', '1', 'Почти «Титаник»', 'Паника на корабле не красила еще ни один экипаж. Ведь это говорит о том, что ситуация вышла из-под контроля. Тем не менее  что-то подобное мы наблюдали на этой неделе в Астане.', '<p>Паника на корабле не красила еще ни один экипаж. Ведь это говорит о том, что ситуация вышла из-под контроля. Тем не менее что-то подобное мы наблюдали на этой неделе в Астане.</p>\r\n', null, null, null, null, null, '<p>tets</p>\r\n', '1', '2013-11-12', null, '0');
INSERT INTO `catalog` VALUES ('2', '4', 'Докопались', 'Сколько бы ни стоили углеводороды, а одной нефтью сыт не будешь, равно как и природным газом не надышишься, решили инвесторы.', '<p>Сколько бы ни стоили углеводороды, а одной нефтью сыт не будешь, равно как и природным газом не надышишься, решили инвесторы.</p>\r\n', null, null, null, null, null, null, '1', '2013-12-02', '5', '0');
INSERT INTO `catalog` VALUES ('3', '4', 'Сладость не в радость', 'Запретный плод в виде взяток и «откатов» в скором времени может перестать быть сладким, как раньше. Нормы проекта нового Уголовного кодекса Казахстана предусматривают пожизненный запрет на государственную службу за совершение коррупционных преступлений.', '<p>Запретный плод в виде взяток и &laquo;откатов&raquo; в скором времени может перестать быть сладким, как раньше. Нормы проекта нового Уголовного кодекса Казахстана предусматривают пожизненный запрет на государственную службу за совершение коррупционных преступлений.</p>\r\n', null, null, null, null, null, null, '1', '2013-12-28', '5', '1');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `order` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Политика', '1');
INSERT INTO `category` VALUES ('2', 'Экономика', '2');
INSERT INTO `category` VALUES ('3', 'Культура', '3');
INSERT INTO `category` VALUES ('4', 'Соц. сфера', '4');

-- ----------------------------
-- Table structure for `comment_answer`
-- ----------------------------
DROP TABLE IF EXISTS `comment_answer`;
CREATE TABLE `comment_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comment` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_answer_ibfk_1` (`id_comment`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `comment_answer_ibfk_1` FOREIGN KEY (`id_comment`) REFERENCES `comment_catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_answer_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `comment_catalog`
-- ----------------------------
DROP TABLE IF EXISTS `comment_catalog`;
CREATE TABLE `comment_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `c_catalog` (`catalog_id`),
  KEY `c_author` (`author_id`) USING BTREE,
  CONSTRAINT `c_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `c_catalog` FOREIGN KEY (`catalog_id`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment_catalog
-- ----------------------------
INSERT INTO `comment_catalog` VALUES ('7', '3', '1', '2013-12-04 13:35', 'test');
INSERT INTO `comment_catalog` VALUES ('8', '3', '1', '2013-12-10 19:13', '<script type=\"application/javascript\">\r\n							$(function() {\r\n								$(\'#sub-form\').on(\'click\', \'.send\', function(){\r\n									var item =$(this).parent(1)\r\n									item.toggleClass(\'loader\');\r\n									var html_old =item.html();\r\n									loader(item);\r\n								$.ajax({\r\n									url:  \"<?= CHtml::normalizeUrl(array(\'site/about\',\'url\'=>\'sub\'))?>\",\r\n									type: \"POST\",\r\n									data: jQuery(\'#sub-form\').serialize(),\r\n									async:false,\r\n									success: function(data){\r\n										$(\'#sub-form span.error_reg\').text(\'\');\r\n										$(\'#sub-form  input\').css({\'border\':\'1px solid #DDD\'});\r\n										var json_obj;\r\n										var json=JSON.parse(data);\r\n\r\n										if(!json[\'m\']){\r\n											for ( json_obj in json ) {\r\n												var text=json[json_obj];\r\n												$(\'#\'+json_obj+\' span.error_reg\').text(text);\r\n												$(\'#\'+json_obj+\' input\').css({\'border\':\'1px solid #F76C6C\'});\r\n												loader_end(item, html_old);\r\n											}\r\n										}\r\n										if(json[\'m\']){\r\n											loader_end(item, html_old);\r\n											$(\'#subs_send\').html(\'<p>Спасибо! Вы успешно подписались на нашу электронную рассылку</p>\');\r\n											//document.location.replace(json[\'m\']);\r\n										}\r\n									}\r\n								});\r\n								});\r\n							});\r\n						</script>');
INSERT INTO `comment_catalog` VALUES ('9', '3', '1', '2013-12-10 19:28', '&lt;script type=&quot;application/javascript&quot;&gt;\r\n							$(function() {\r\n								$(&#039;#sub-form&#039;).on(&#039;click&#039;, &#039;.send&#039;, function(){\r\n									var item =$(this).parent(1)\r\n									item.toggleClass(&#039;loader&#039;);\r\n									var html_old =item.html();\r\n									loader(item);\r\n								$.ajax({\r\n									url:  &quot;&lt;?= CHtml::normalizeUrl(array(&#039;site/about&#039;,&#039;url&#039;=&gt;&#039;sub&#039;))?&gt;&quot;,\r\n									type: &quot;POST&quot;,\r\n									data: jQuery(&#039;#sub-form&#039;).serialize(),\r\n									async:false,\r\n									success: function(data){\r\n										$(&#039;#sub-form span.error_reg&#039;).text(&#039;&#039;);\r\n										$(&#039;#sub-form  input&#039;).css({&#039;border&#039;:&#039;1px solid #DDD&#039;});\r\n										var json_obj;\r\n										var json=JSON.parse(data);\r\n\r\n										if(!json[&#039;m&#039;]){\r\n											for ( json_obj in json ) {\r\n												var text=json[json_obj];\r\n												$(&#039;#&#039;+json_obj+&#039; span.error_reg&#039;).text(text);\r\n												$(&#039;#&#039;+json_obj+&#039; input&#039;).css({&#039;border&#039;:&#039;1px solid #F76C6C&#039;});\r\n												loader_end(item, html_old);\r\n											}\r\n										}\r\n										if(json[&#039;m&#039;]){\r\n											loader_end(item, html_old);\r\n											$(&#039;#subs_send&#039;).html(&#039;&lt;p&gt;Спасибо! Вы успешно подписались на нашу электронную рассылку&lt;/p&gt;&#039;);\r\n											//document.location.replace(json[&#039;m&#039;]);\r\n										}\r\n									}\r\n								});\r\n								});\r\n							});\r\n						&lt;/script&gt;');

-- ----------------------------
-- Table structure for `comment_events`
-- ----------------------------
DROP TABLE IF EXISTS `comment_events`;
CREATE TABLE `comment_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `events_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `events_id` (`events_id`),
  CONSTRAINT `comment_events_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_events_ibfk_2` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment_events
-- ----------------------------

-- ----------------------------
-- Table structure for `comment_events_answer`
-- ----------------------------
DROP TABLE IF EXISTS `comment_events_answer`;
CREATE TABLE `comment_events_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `comment_id` (`comment_id`),
  CONSTRAINT `comment_events_answer_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_events_answer_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment_events_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `comments_debat`
-- ----------------------------
DROP TABLE IF EXISTS `comments_debat`;
CREATE TABLE `comments_debat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `debat_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `debat_id` (`debat_id`),
  CONSTRAINT `comments_debat_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_debat_ibfk_2` FOREIGN KEY (`debat_id`) REFERENCES `debats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments_debat
-- ----------------------------

-- ----------------------------
-- Table structure for `connect_debat`
-- ----------------------------
DROP TABLE IF EXISTS `connect_debat`;
CREATE TABLE `connect_debat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_debat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_debat` (`id_debat`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `connect_debat_ibfk_1` FOREIGN KEY (`id_debat`) REFERENCES `debats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `connect_debat_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of connect_debat
-- ----------------------------

-- ----------------------------
-- Table structure for `connect_webinar`
-- ----------------------------
DROP TABLE IF EXISTS `connect_webinar`;
CREATE TABLE `connect_webinar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_webinar` int(11) NOT NULL,
  `id_pred` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pred` (`id_pred`),
  KEY `id_webinar` (`id_webinar`),
  CONSTRAINT `connect_webinar_ibfk_1` FOREIGN KEY (`id_pred`) REFERENCES `users` (`id`),
  CONSTRAINT `connect_webinar_ibfk_2` FOREIGN KEY (`id_webinar`) REFERENCES `webinar` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of connect_webinar
-- ----------------------------
INSERT INTO `connect_webinar` VALUES ('6', '2', '5');

-- ----------------------------
-- Table structure for `debats`
-- ----------------------------
DROP TABLE IF EXISTS `debats`;
CREATE TABLE `debats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `isVisible` tinyint(4) NOT NULL,
  `date_start` varchar(255) NOT NULL,
  `date_end` varchar(255) NOT NULL,
  `view` int(11) DEFAULT '0',
  `img` varchar(255) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of debats
-- ----------------------------

-- ----------------------------
-- Table structure for `event_media`
-- ----------------------------
DROP TABLE IF EXISTS `event_media`;
CREATE TABLE `event_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_event` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_event` (`id_event`),
  CONSTRAINT `event_media_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_media
-- ----------------------------
INSERT INTO `event_media` VALUES ('6', '2', 'img', '/userfiles/events/x46985d20131121095924.jpg', null, null);
INSERT INTO `event_media` VALUES ('7', '2', 'img', '/userfiles/events/x88574d20131121095928.jpg', null, null);
INSERT INTO `event_media` VALUES ('8', '2', 'img', '/userfiles/events/x88574d20131121095934.jpg', null, null);
INSERT INTO `event_media` VALUES ('17', '2', 'video', 'http://www.youtube.com/watch?v=EMlpiey20b8', null, null);
INSERT INTO `event_media` VALUES ('18', '2', 'video', 'http://www.youtube.com/watch?v=EMlpiey20b8', null, null);
INSERT INTO `event_media` VALUES ('19', '2', 'video', 'http://www.youtube.com/watch?v=EMlpiey20b8', null, null);
INSERT INTO `event_media` VALUES ('20', '2', 'video', 'http://www.youtube.com/watch?v=EMlpiey20b8', null, null);
INSERT INTO `event_media` VALUES ('21', '2', 'video', 'http://www.youtube.com/watch?v=EMlpiey20b8', null, null);
INSERT INTO `event_media` VALUES ('22', '2', 'video', 'http://www.youtube.com/watch?v=EMlpiey20b8', null, null);

-- ----------------------------
-- Table structure for `events`
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `small_description` text NOT NULL,
  `full_description` text NOT NULL,
  `isVisible` tinyint(4) DEFAULT '1',
  `date` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `view` int(11) DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of events
-- ----------------------------
INSERT INTO `events` VALUES ('2', 'Премия HR-бренд 2012', 'Первая независимая  ежегодная премия в Казахстане за наиболее успешную работу над репутацией компании как работодателя. А еще это красивейшая церемония награждения проектов победителей с участием ведущих казахстанских и зарубежных специалистов в области HR, а также звезд эстрады.', '<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">Если Вы хотите:</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">&mdash; Создать интернет магазин при минимальных затратах</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">&mdash;&nbsp;</span><span style=\"color:rgb(51, 51, 51); font-size:13px\">Чтобы Ваши посетители становились покупателями</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">&mdash;&nbsp;</span><span style=\"color:rgb(51, 51, 51); font-size:13px\">Узнать о принципах раскрутки интернет магазина в поисковиках</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">&mdash;&nbsp;</span><span style=\"color:rgb(51, 51, 51); font-size:13px\">Узнать &laquo;Почему продавать в интернете выгодно?&raquo;</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">&mdash;&nbsp;</span><span style=\"color:rgb(51, 51, 51); font-size:13px\">Сэкономить время и получить всю необходимую информацию по созданию интернет магазина</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">&nbsp;</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">В таком случае этот семинар для Вас. Семинар проводит Рузанов Борис, директор компании Online Market Service, представитель компании InSales в Казахстане. Он поделится опытом и секретами создания продающего и успешного интернет магазина.</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">&nbsp;</span></p>\r\n\r\n<p><strong>Цель тренинга</strong></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">Целью тренинга является освоение практических инструментов в области результативного стратегического и оперативного управления отделом продаж</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">&nbsp;</span></p>\r\n\r\n<p><strong>Формат мероприятия</strong></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">двухдневный тренинг</span></p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>Аудитория</strong></p>\r\n\r\n<p><span style=\"color:rgb(51, 51, 51); font-size:13px\">Директора предприятий, руководители отделов продаж, коммерческие директора</span></p>\r\n', '1', '2013-10-30T13:50', 'БЦ «Нурлытау»', '/userfiles/events/x8832d20131120112637.jpg', '1', '1');
INSERT INTO `events` VALUES ('7', 'Премия HR-бренд 2012', 'Первая независимая  ежегодная премия в Казахстане за наиболее успешную работу над репутацией компании как работодателя. А еще это красивейшая церемония награждения проектов победителей с участием ведущих казахстанских и зарубежных специалистов в области HR, а также звезд эстрады.', '<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">Если Вы хотите:</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">&mdash; Создать интернет магазин при минимальных затратах</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">&mdash;&nbsp;</span><span style=\"font-size: 13px; color: rgb(51, 51, 51);\">Чтобы Ваши посетители становились покупателями</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">&mdash;&nbsp;</span><span style=\"font-size: 13px; color: rgb(51, 51, 51);\">Узнать о принципах раскрутки интернет магазина в поисковиках</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">&mdash;&nbsp;</span><span style=\"font-size: 13px; color: rgb(51, 51, 51);\">Узнать &laquo;Почему продавать в интернете выгодно?&raquo;</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">&mdash;&nbsp;</span><span style=\"font-size: 13px; color: rgb(51, 51, 51);\">Сэкономить время и получить всю необходимую информацию по созданию интернет магазина</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">&nbsp;</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">В таком случае этот семинар для Вас. Семинар проводит Рузанов Борис, директор компании Online Market Service, представитель компании InSales в Казахстане. Он поделится опытом и секретами создания продающего и успешного интернет магазина.</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">&nbsp;</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; font-weight: bold; color: rgb(51, 51, 51);\">Цель тренинга</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">Целью тренинга является освоение практических инструментов в области результативного стратегического и оперативного управления отделом продаж</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">&nbsp;</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; font-weight: bold; color: rgb(51, 51, 51);\">Формат мероприятия</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">двухдневный тренинг</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; font-weight: bold; color: rgb(51, 51, 51);\">&nbsp;</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; font-weight: bold; color: rgb(51, 51, 51);\">Аудитория</span></p>\r\n<p style=\"margin: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: medium;\">\r\n	<span style=\"font-size: 13px; color: rgb(51, 51, 51);\">Директора предприятий, руководители отделов продаж, коммерческие директора</span></p>\r\n', '1', '2013-11-30T13:50', 'БЦ «Нурлытау»', '/userfiles/events/x87945d20131120155710.jpg', '4', '1');

-- ----------------------------
-- Table structure for `events_main`
-- ----------------------------
DROP TABLE IF EXISTS `events_main`;
CREATE TABLE `events_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `events_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `events_id` (`events_id`),
  CONSTRAINT `events_main_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `events_main_ibfk_2` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of events_main
-- ----------------------------

-- ----------------------------
-- Table structure for `favorites`
-- ----------------------------
DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `favorites_ibfk_1` (`id_article`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of favorites
-- ----------------------------
INSERT INTO `favorites` VALUES ('9', '3', '1');

-- ----------------------------
-- Table structure for `item_image`
-- ----------------------------
DROP TABLE IF EXISTS `item_image`;
CREATE TABLE `item_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `img_url` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `itemImages` (`item_id`),
  CONSTRAINT `itemImages` FOREIGN KEY (`item_id`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item_image
-- ----------------------------
INSERT INTO `item_image` VALUES ('7', 'Сколько бы ни стоили углеводороды, а одной нефтью сыт не будешь, равно как и природным газом не надышишься, решили инвесторы', 'Докопались', '2', '0', '/userfiles/item/x13099d20131112211921.jpg');
INSERT INTO `item_image` VALUES ('8', 'Запретный плод в виде взяток и «откатов» в скором времени может перестать быть сладким, как раньше. Нормы проекта нового Уголовного кодекса Казахстана предусматривают пожизненный запрет на государственную службу за совершение коррупционных преступлений.', 'Сладость не в радость', '3', '0', '/userfiles/item/x87863d20131112212120.jpg');
INSERT INTO `item_image` VALUES ('10', 'Паника на корабле не красила еще ни один экипаж. Ведь это говорит о том, что ситуация вышла из-под контроля. Тем не менее  что-то подобное мы наблюдали на этой неделе в Астане.', 'Почти «Титаник»', '1', '0', '/userfiles/item/x61636d20131129150731.png');

-- ----------------------------
-- Table structure for `jobs`
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `body` text,
  `isVisible` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of jobs
-- ----------------------------
INSERT INTO `jobs` VALUES ('4', '111', '<h3>\r\n	Обязанности:</h3>\r\n<ul>\r\n	<li>\r\n		ведение бухгалтерского и налогового учета в 1:С &quot;Бухгалтерия&quot; в соответствии с действующими законодательными нормами, инструкциями и положениями</li>\r\n	<li>\r\n		контроль работы всех участков бухгалтерского учета: управленческий и бухгалтерский учет, учет денежных средств, учет расчетов с поставщиками и подрядчиками, учет основных средств, учет зарплаты, хозяйственной деятельности организации, работ и услуг и их реализация</li>\r\n	<li>\r\n		налоговый учет: налогообложение, составление и сдача баланса</li>\r\n</ul>\r\n<h3>\r\n	Требования:</h3>\r\n<ul>\r\n	<li>\r\n		высшее образование</li>\r\n	<li>\r\n		опыт работы не менее 5 лет</li>\r\n	<li>\r\n		опыт работы с 1С &nbsp;8.2</li>\r\n	<li>\r\n		знание налогообложения</li>\r\n	<li>\r\n		знание МСФО</li>\r\n	<li>\r\n		умение вести переписку на английском языке</li>\r\n</ul>\r\n<h3>\r\n	Условия:</h3>\r\n<ul>\r\n	<li>\r\n		место работы - Ауезовский район, мкр.Мамыр</li>\r\n	<li>\r\n		Лояльное руководство, дружный коллектив</li>\r\n	<li>\r\n		Компенсация питания</li>\r\n	<li>\r\n		Тип занятости</li>\r\n	<li>\r\n		Полная занятость, полный день</li>\r\n</ul>\r\n', '1');

-- ----------------------------
-- Table structure for `mail_template`
-- ----------------------------
DROP TABLE IF EXISTS `mail_template`;
CREATE TABLE `mail_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `mail_title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mail_template
-- ----------------------------
INSERT INTO `mail_template` VALUES ('1', 'new_quest', 'Оповещение новый вопрос', '<p>\r\n	Номер заказа: {number_order}</p>\r\n<p>\r\n	Заказчик: {name}</p>\r\n<p>\r\n	Адрес: {address}</p>\r\n<p>\r\n	Телефон: {phone}</p>\r\n<p>\r\n	Почта: {mail}</p>\r\n<p>\r\n	Коментарии: {message}</p>\r\n<p>\r\n	Товар:</p>\r\n<p>\r\n	{items}</p>\r\n', 'Новый вопрос');
INSERT INTO `mail_template` VALUES ('2', 'callback', 'Новое сообщение', '<p>\r\n	Отправитель: {name}</p>\r\n<p>\r\n	Телефон: {phone}</p>\r\n<p>\r\n	Почта: {mail}</p>\r\n<p>\r\n	Сообщение: {message}</p>\r\n', 'Новое сообщение');
INSERT INTO `mail_template` VALUES ('3', 'reg', 'Регистрация', '', 'Регистрация');
INSERT INTO `mail_template` VALUES ('4', 'quest_answer', 'Оповщение об ответе', 'ответ', 'Ответ');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', null, '4', 'BUSINESS EVENTS', 'site/events', 'header', '1');
INSERT INTO `menu` VALUES ('2', null, '1', 'СТАТЬИ', 'site/articles', 'header', '1');
INSERT INTO `menu` VALUES ('3', null, '2', 'ДИСКУССИИ', 'site/debates', 'header', '1');
INSERT INTO `menu` VALUES ('4', null, '3', 'ЭКСПЕРТНЫЙ СОВЕТ', 'site/experts', 'header', '1');

-- ----------------------------
-- Table structure for `muser`
-- ----------------------------
DROP TABLE IF EXISTS `muser`;
CREATE TABLE `muser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `privileges` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muser
-- ----------------------------
INSERT INTO `muser` VALUES ('9', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', '---', 'viktor@instinct.kz', '100');

-- ----------------------------
-- Table structure for `page`
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `under_title` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES ('1', 'about', '', 'Об издании', '<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Georgia; font-size: 13px; line-height: 20px;\">&nbsp;- это разнообразие красок и информации, яркость изложения и оригинальный дизайн. Мы занимаемся освещением ключевых событий в экономике, новостей бизнеса, политики и общественной жизни. Задача, которую мы перед собой ставим это предоставление качественной, интересной и полезной информации. Наша цель стать для наших читателей источником новых знаний и вдохновения. Дни, часы, минуты, проведенные с нами это время, проеденное с пользой. Цeлевая аудитория Частные предприниматели, политики, госслужащие, менеджеры национальных компаний и бюджетных организаций, иностранные специалисты, а также студенты, осваивающие рыночные специальности. Распространение: Подписка &laquo;Казпресс&raquo;, &laquo;Казпочта&raquo;, &laquo;Евразия-пресс&raquo; , &laquo;Эврика-пресс&raquo; Розница сеть &laquo;Мир Пресс&raquo; ТЦ &laquo;Квартал&raquo;, ТЦ &laquo;Променад&raquo;, ТЦ &laquo;Ритц Палас&raquo; Информационная поддержка: бизнес &ndash; форумы, конференции, тренинги, выставки На бортах авиакомпании &laquo;Air Astana&raquo;, &laquo;Lufthansa&raquo;, &laquo;Czech Airlines&raquo; В отелях: Rixos, Rahat Palace Hotel, The Dostyk Hotel, Holiday Inn, Premier Alatau Hotel &amp; Business Center В кофейнях: Cafeteria, Marronerosso, Balcon cafeteria В ТРК &laquo;АДК&raquo; ТРК &laquo;Манго&raquo; в кафе-барах кинотеатра Chaplin В автосалонах: AllurAuto, Bentley, Maserati, Mercur, Honda, Caspian Motors, Aster Auto, Astana Motors Toyota Center Almaty, Hyunday Auto Almaty, Автоцентр-Бавария В бизнес-центрах: БЦ &laquo;Нурлы Тау&raquo;, БЦ Global Development, БЦ &laquo;Форум&raquo;, БЦ &laquo;Достар&raquo;, БЦ &laquo;Коктем&raquo;, БЦ &laquo;CDC Center One&raquo; Адресная рассылка Объем: 12 страниц Формат: А2 Цветность: 1,2,3,10,11,12 Периодичность: 1 раз в неделю Собственник газеты: ТОО &laquo;Iскер Медиа&raquo; Свидетельство о постановке на учет СМИ №13612-Г от 20.05.2013 выдано Министерством культуры и информации РК</span></p>\r\n', '/images/img07.jpg');
INSERT INTO `page` VALUES ('4', 'info', '', 'Дополнительные материалы', '<p>\r\n	test</p>\r\n', '');
INSERT INTO `page` VALUES ('6', 'sub', null, 'Подписка', '<p>Информация о том, как подписаться на издание</p>\r\n\r\n<p>Информация о том, как подписаться на издание</p>\r\n', '');

-- ----------------------------
-- Table structure for `question`
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `user_mail` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `id_expert` int(11) NOT NULL,
  `body` text NOT NULL,
  `answer` text,
  `id_theme` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isVisible` tinyint(4) DEFAULT '0',
  `date_answer` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_expert` (`id_expert`),
  KEY `id_theme` (`id_theme`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `question_ibfk_2` FOREIGN KEY (`id_expert`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `question_ibfk_3` FOREIGN KEY (`id_theme`) REFERENCES `question_theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO `question` VALUES ('7', null, 'test@mail.ru', 'test', '1', '123', null, '1', '2013-11-29 20:39:00', '0', null);
INSERT INTO `question` VALUES ('8', null, 'test@mail.ru', 'test', '3', 'tes', null, '1', '2013-12-04 02:03:00', '0', null);
INSERT INTO `question` VALUES ('9', null, 'test@mail.ru', 'test', '1', 'ntrcn', 'test22', '1', '2013-12-04 02:23:00', '0', '2013-12-04 11:10:00');
INSERT INTO `question` VALUES ('10', null, 'test@mail.ru', 'test', '1', 'test', '<p>223</p>\n', '1', '2013-12-04 02:25:00', '0', '2013-12-03 15:51:00');
INSERT INTO `question` VALUES ('11', '1', 'test@mail.ru', 'test', '1', 'testyy', 'test', '1', '2013-12-04 04:39:00', '0', '2013-12-03 20:39:00');
INSERT INTO `question` VALUES ('12', null, 'viktor@instinct.kz', 'test', '5', 'test', '<p>222</p>\n', '2', '2013-12-09 16:11:00', '0', '2013-12-10 10:18:00');

-- ----------------------------
-- Table structure for `question_theme`
-- ----------------------------
DROP TABLE IF EXISTS `question_theme`;
CREATE TABLE `question_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question_theme
-- ----------------------------
INSERT INTO `question_theme` VALUES ('1', 'test11');
INSERT INTO `question_theme` VALUES ('2', 'test');

-- ----------------------------
-- Table structure for `question_theme_expert`
-- ----------------------------
DROP TABLE IF EXISTS `question_theme_expert`;
CREATE TABLE `question_theme_expert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_expert` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_expert` (`id_expert`),
  KEY `id_theme` (`id_theme`),
  CONSTRAINT `question_theme_expert_ibfk_1` FOREIGN KEY (`id_expert`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `question_theme_expert_ibfk_2` FOREIGN KEY (`id_theme`) REFERENCES `question_theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of question_theme_expert
-- ----------------------------
INSERT INTO `question_theme_expert` VALUES ('3', '1', '1');
INSERT INTO `question_theme_expert` VALUES ('4', '3', '2');
INSERT INTO `question_theme_expert` VALUES ('5', '5', '2');

-- ----------------------------
-- Table structure for `seo`
-- ----------------------------
DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(255) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL,
  `id_debats` int(11) DEFAULT NULL,
  `id_events` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_article` (`id_article`) USING BTREE,
  UNIQUE KEY `id_debats` (`id_debats`) USING BTREE,
  UNIQUE KEY `id_events` (`id_events`) USING BTREE,
  CONSTRAINT `seo_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `seo_ibfk_2` FOREIGN KEY (`id_debats`) REFERENCES `debats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `seo_ibfk_3` FOREIGN KEY (`id_events`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seo
-- ----------------------------
INSERT INTO `seo` VALUES ('1', 'index', null, null, null, null, null, 'Главная');
INSERT INTO `seo` VALUES ('2', 'debats', null, null, null, null, null, null);
INSERT INTO `seo` VALUES ('3', 'events', null, null, null, null, null, null);
INSERT INTO `seo` VALUES ('4', 'articles', null, null, null, null, null, null);
INSERT INTO `seo` VALUES ('14', null, '1', null, null, null, null, 'test');
INSERT INTO `seo` VALUES ('15', null, '2', null, null, 'test', null, null);
INSERT INTO `seo` VALUES ('16', null, '3', null, null, null, 'test', null);
INSERT INTO `seo` VALUES ('17', null, null, null, '2', null, null, null);
INSERT INTO `seo` VALUES ('18', null, null, null, '7', null, null, null);

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'Основные', 'image', 'Логотип сайта', 'logo', '0');
INSERT INTO `settings` VALUES ('2', 'Оповещение', 'text', 'E-mail', 'e-mail', 'viktor-09-05@mail.ru');
INSERT INTO `settings` VALUES ('3', 'Карта', 'text', 'Yandex Map', 'ymap', '76.912725,43.236537');
INSERT INTO `settings` VALUES ('4', 'Тексты', 'text', 'Копирайт', 'copyright', '© And.kz Любое использование материалов допускается только при наличии гиперссылки на and.kz');
INSERT INTO `settings` VALUES ('5', 'Карта', 'text', 'Текст на карте', 'ymap_text', '0');
INSERT INTO `settings` VALUES ('6', 'Тексты', 'text', 'Текст футер 1', 'foot_text_1', 'Казахстанское деловое еженедельное издание');

-- ----------------------------
-- Table structure for `subs`
-- ----------------------------
DROP TABLE IF EXISTS `subs`;
CREATE TABLE `subs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of subs
-- ----------------------------
INSERT INTO `subs` VALUES ('2', '1234', 'test@mail.ru');
INSERT INTO `subs` VALUES ('3', '1234', 'test@mail.ru');
INSERT INTO `subs` VALUES ('10', '123', 'qwer@mail.ru');
INSERT INTO `subs` VALUES ('11', 'test', 'viktor@mail.ru');
INSERT INTO `subs` VALUES ('12', 'Виктор', 'tes22t@mail.ru');
INSERT INTO `subs` VALUES ('13', 'еуые', 'ameli@mail.ru');

-- ----------------------------
-- Table structure for `theme_webinar`
-- ----------------------------
DROP TABLE IF EXISTS `theme_webinar`;
CREATE TABLE `theme_webinar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of theme_webinar
-- ----------------------------
INSERT INTO `theme_webinar` VALUES ('2', 'Тестовая тема');
INSERT INTO `theme_webinar` VALUES ('3', '2');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privileges` int(11) DEFAULT '0',
  `body` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Константин Константинополский', 'Журналист', 'ИП Киселёва', '87772441234', 'viktor@instinct.kz', 'e40e4e6ab947537d75c619f3c6f19c8c', '100', '<p>Очень хороший эксперт</p>\r\n');
INSERT INTO `users` VALUES ('2', 'Ксения', null, null, null, 'ksenia.fed@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '100', null);
INSERT INTO `users` VALUES ('3', 'Бот', 'Директор', 'Рога и копыта', '85555555', 'business.resource@yandex.ru', '4c93008615c2d041e33ebac605d14b5b', '77', '<p>Кредитный менеджер банка.</p>\r\n');
INSERT INTO `users` VALUES ('4', 'Борис', null, null, null, 'my101@mail.ru', '10bcb36619495e9f13ef9bb4720004b9', '77', null);
INSERT INTO `users` VALUES ('5', 'Султанбекова Дамели ', 'Менеджер по развитию бизнеса', 'ТОО «Первое кредитное бюро»', null, 'boris@instinct.kz', '10bcb36619495e9f13ef9bb4720004b9', '77', '<p>Хороший кредитор не позволит вам залезть в долги, а хороший заемщик не позволит себе испортить свою кредитную историю. У вас уже есть действующий или закрытый кредит, или вы хотите открыть новую кредитную линию, то вам действительно необходимо знать свою кредитную историю, информация о которой содержится в ТОО &laquo;Первое Кредитное Бюро&raquo;. В этом разделе мы готовы ответить на все вопросы, которые касаются вашего персонального кредитного отчета.</p>\r\n\r\n<p>ТОО &laquo;Первое кредитное бюро&raquo; не является банком или кредитным учреждением и осуществляет деятельностьтолько по централизованному сбору, хранению и процессингу информации, а также формированию кредитных историй и выдаче кредитных отчетов. Вопросы относительно выдачи кредитов не относятся к ПКБ и будут оставлены без ответа.</p>\r\n');

-- ----------------------------
-- Table structure for `users_image`
-- ----------------------------
DROP TABLE IF EXISTS `users_image`;
CREATE TABLE `users_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`) USING BTREE,
  CONSTRAINT `img` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_image
-- ----------------------------
INSERT INTO `users_image` VALUES ('1', '1', '/userfiles/users/x39182d20131115224350.jpg');
INSERT INTO `users_image` VALUES ('2', '4', '/userfiles/users/x92371d20131120113818.jpg');
INSERT INTO `users_image` VALUES ('3', '5', '/userfiles/users/x72096d20131124011306.jpg');

-- ----------------------------
-- Table structure for `webinar`
-- ----------------------------
DROP TABLE IF EXISTS `webinar`;
CREATE TABLE `webinar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `isVisible` tinyint(4) NOT NULL,
  `date_start` varchar(255) NOT NULL,
  `date_end` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  `url` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_theme` (`id_theme`),
  CONSTRAINT `webinar_ibfk_1` FOREIGN KEY (`id_theme`) REFERENCES `theme_webinar` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of webinar
-- ----------------------------
INSERT INTO `webinar` VALUES ('2', 'Построение должностного профиля компетенций', '<p>В настоящее время корпоративным моделям компетенций отводится значимая роль в политике управления персоналом. В одних компаниях профили компетенций используются в качестве прикладных инструментов определенных HR-функций (например, для оценки персонала или для формирования планов развития), в других &ndash; как система прописанных компетенций является ключевой в работе с персоналом. На вебинаре вы узнаете, что именно необходимо учитывать при построении профиля компетенций и о том, как использовать этот инструмент эффективно.</p>\r\n', '1', '2013-12-12', '2013-12-12', '10:10-12:20', '10000', '2', 'test');

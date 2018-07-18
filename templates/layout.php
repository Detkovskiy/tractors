<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css' />
  <link href='https://fonts.googleapis.com/css?family=Cuprum:400,400italic,700,700italic&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css' />

  <?= $meta ?>

  <link rel="stylesheet" type="text/css" href="css/normalize.min.css" media="all" />
  <link rel="stylesheet" type="text/css" href="css/style.min.css" media="all" />
  <link rel="stylesheet" type="text/css" href="css/twentytwenty.css" media="all" />
  <link href="css/jetmenu.css" rel="stylesheet">
  <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
  <script type="text/javascript" src="js/jetmenu.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function(){
      $().jetmenu();
    });
  </script>
  <link rel="shortcut icon" href="img/favicon.png" type="image/png">

  <title><?= $title ?></title>
</head>

<body>

<header>
  <div class="container  container--header">
    <a class="logo">
      <img class="logo__img" src="img/logo.svg" alt="Трактовичкоф - аренда экскаватора погрузчика">
    </a>

    <div class="wrapper__feedback">
      <div class="feedback">
        <a href="tel:+7<?= $contact['tel_code_mobile'] ?><?= str_replace('-', '', $contact['tel']); ?>" class="call-me__phone">
          <span class="call-me__phone--color">+7 (<?= $contact['tel_code_city'] ?>)</span> <?= $contact['tel'] ?>
        </a>
        <a href="mailto:<?= $contact['email'] ?>" class="call-me__email">
          <span class="call-me__email--color"><?= $contact['email'] ?></span>
        </a>
      </div>

      <a class="call-me__callback-toggle" data-index="1">
        ⇄  перезвоните  мне
      </a>
    </div>
  </div>
  <?= $main_menu ?>
</header>

<?= $content ?>

<footer>
  <div class="container  container--footer">
    <!--<ul class="footer__nav">
      <li><a href="#assortment">Техника</a></li>
      <li><a href="#services">Услуги</a></li>
      <li><a href="#price">Прайс</a></li>
      <li><a href="#contacts">Контакты</a></li>
    </ul>-->
    <a href="tel:+7<?= $contact['tel_code_mobile'] ?><?= str_replace('-', '', $contact['tel']); ?>" class="link-tel  link-tel--footer">
      <span class="phone-in-text">+7 (<?= $contact['tel_code_mobile'] ?>) <?= $contact['tel'] ?></span>
    </a>
    <div class="copyright">
      © 2015 - 2017 "Трактовичкоф" аренда экскаватора погрузчика. Все права защищены.
      <p class="copyright__oferta">Обращаем ваше внимание, что данный интернет-сайт носит информационный характер и не является публичной офертой в понимании п.2 ст. 437 Гражданского кодекса Российской Федерации</p>
    </div>
  </div>
</footer>

<div class="modal-callback  hidden">
  <div class="modal-callback__header">
    <span>Заказать звонок</span>
  </div>
  <button class="modal-content-close" type="button" title="Закрыть">Закрыть</button>
  <div  class="form-callback">
    <div id="send-result"></div>
    <div id="error-result"></div>
    <input class="form-callback__input  form-callback__input--name" type="text" name="client-name" id="client-name" placeholder="Ваше имя">
    <input class="form-callback__input  form-callback__input--phone" type="tel" name="client-phone" id="client-phone" placeholder="Номер телефона">
    <input type="button" class="button-form-callback" value="Отправить" onclick="callBack();">
  </div>
  <div class="modal-overlay"></div>
</div>

<div class="modal-order  hidden">
  <div class="modal-order__header">
    <span>Отправить заказ</span>
  </div>
  <button class="modal-order-close" type="button" title="Закрыть">Закрыть</button>
  <div class="form-order">
    <div id="send-result__order"></div>
    <div id="error-result__order"></div>
    <input class="form-order__input  form-order__input--name" type="text" name="order-client-name" id="order-client-name" placeholder="Ваше имя">
    <input class="form-order__input  form-order__input--phone" type="tel" name="order-client-phone" id="order-client-phone" placeholder="Номер телефона">
    <select class="form-order__input  form-order__input--select" id="order-value">
      <option>Volvo BL71</option>
      <option>Komatsu WB97S</option>
      <option>TEREX 970</option>
      <option>CAT 312C</option>
      <option>Hyundai R170</option>
      <option>Ямобур ISUZU</option>
      <option>Камаз 6520</option>
      <option>Пухто</option>
    </select>
    <textarea class="form-order__input  form-order__input--message" rows="5" id="message-order" placeholder="Напишите нам..."></textarea>
    <input type="button" class="button-form-order" value="Отправить" onclick="order();">
  </div>
  <div class="modal-overlay"></div>
</div>

<div class="modal-services  hidden">
  <div class="modal-services__header">
    <span>Отправить заказ</span>
  </div>
  <button class="modal-services-close" type="button" title="Закрыть">Закрыть</button>
  <div class="form-services">
    <div id="send-result__services"></div>
    <div id="error-result__services"></div>
    <input class="form-services__input  form-services__input--name" type="text" name="services-client-name" id="services-client-name" placeholder="Ваше имя">
    <input class="form-services__input  form-services__input--phone" type="tel" name="services-client-phone" id="services-client-phone" placeholder="Номер телефона">
    <textarea class="form-services__input  form-services__input--message" rows="5" id="message-services" placeholder="Напишите нам..."></textarea>
    <input type="button" class="button-form-services" value="Отправить" onclick="services();">
  </div>
  <div class="modal-overlay"></div>
</div>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<link href="css/zozo.tabs.min.css" rel="stylesheet">
<script src="js/input-mask.js"></script>
<script src="js/jquery.event.move.js"></script>
<script src="js/main.js"></script>


<script src="js/zozo.tabs.min.js"></script>
<script>
  jQuery(document).ready(function ($) {
    $("#tabbed-nav3").zozoTabs({
      position: "top-left",
      theme: "crystal",
      rounded: false,
      shadows: true,
      size: "large",
      orientation: "horizontal",
      responsive: true,
      animation: {
        easing: "easeInOutExpo",
        duration: 400,
        effects: "slideH"
      }
    });
  });
</script>
<script src="js/send-mail.js"></script>

<script type="text/javascript" src="path/to/jquery.events.touch.js"></script>
<link rel="stylesheet" href="css/lightcase.css">
<script defer src="js/lightcase.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[data-rel^=lightcase]').lightcase({
      swipe: true
    });
  });
</script>
<!--
<script src="js/jquery.min.js"></script>

<script src="js/jquery.event.move.js"></script>
<script src="js/jquery.twentytwenty.js"></script>

-->
</body>
</html>

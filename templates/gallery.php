<section id="gallery">
  <div class="container">
    <h2><span>Галерея</span></h2>

    <form class="gallery__category-form" action="" method="get">
      <label class="gallery__id">
        <input class="gallery__category  hidden" type="submit" name="id" value="all">Все фото
      </label>
      <label class="gallery__id">
        <input class="gallery__category  hidden" type="submit" name="id" value="1">Земляные работы
      </label>
      <label class="gallery__id">
        <input class="gallery__category  hidden" type="submit" name="id" value="2">Асфальтирование
      </label>
      <label class="gallery__id">
        <input class="gallery__category  hidden" type="submit" name="id" value="3">Благоустройство
      </label>
    </form>

    <div class="gallery__wrapper">


      <?php foreach ($arr_img as $img => $value) : ?>
        <div class="gallery__item">
          <a href="<?= $value['link_lightbox']; ?>" data-rel="lightcase:myCollection:slideshow" title="<?= $value['title']; ?>" data-lc-caption="<?= $value['description']; ?>">
            <div class="gallery__container-img">
              <picture>
                <source media="(min-width: 769px)" srcset="<?=$value['link_img_1x'];?> 1x, <?=$value['link_img_2x'];?> 2x">
                <img class="gallery__img" src="<?=$value['link_mobile_1x'];?>" srcset="<?=$value['link_mobile_2x'];?> 2x" alt="<?= $value['title']; ?>">
              </picture>
            </div>
          </a>
          <div class="gallery__description">
            <h3 class="gallery__title"><?= $value['title']; ?></h3>
            <p class="gallery__text"><?= $value['description']; ?></p>
          </div>
        </div>
      <?php endforeach; ?>



      <!--<div class="gallery__item">
        <a href="img/assortment/cat-312c@2x.png" data-rel="lightcase:myCollection:slideshow">
        <div class="gallery__container-img">
          <picture>
            <source media="(min-width: 769px)" srcset="img/assortment/cat-312c@1x.png 1x, img/assortment/cat-312c@2x.png 2x">
            <img class="gallery__img" src="img/services/arenda-stroitelnoi-techniki@1x-mobile.jpg" srcset="img/services/arenda-stroitelnoi-techniki@2x-mobile.jpg 2x" alt="Аренда строительной техники">
          </picture>
        </div>
        </a>
        <div class="gallery__description">
          <h3 class="gallery__title">Строительство</h3>
          <p class="gallery__text">Экскаватор погрузчик является универсальной строительной техникой, он может решать целый перечень задач, что делает его необходимым помощником на любом строительном объекте. На небольших и стесненных стройплощадках, куда обычная техника не способна пройти, маневренный экскаватор погрузчик эффективно выполнит всю работу.
          </p>
        </div>
      </div>

      <div class="gallery__item">
        <a href="img/assortment/jcb-4cx@2x.png" data-rel="lightcase:myCollection:slideshow">
        <div class="gallery__container-img">
          <picture>
            <source media="(min-width: 769px)" srcset="img/assortment/jcb-4cx@1x.png 1x, img/assortment/jcb-4cx@2x.png 2x">
            <img class="gallery__img" src="img/services/arenda-stroitelnoi-techniki@1x-mobile.jpg" srcset="img/services/arenda-stroitelnoi-techniki@2x-mobile.jpg 2x" alt="Аренда строительной техники">
          </picture>
        </div>
        </a>
        <div class="gallery__description">
          <h3 class="gallery__title">Строительство</h3>
          <p class="gallery__text">Экскаватор погрузчик является универсальной строительной техникой, он может решать целый перечень задач, что делает его необходимым помощником на любом строительном объекте. На небольших и стесненных стройплощадках, куда обычная техника не способна пройти, маневренный экскаватор погрузчик эффективно выполнит всю работу.
          </p>
        </div>
      </div>-->


    </div>

    <?php if ($page_count > 1) : ?>
      <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a href="gallery.php?page=<?= $current_page - 1; ?><?= isset($_GET['id']) ? '&id=' . $_GET['id'] : '' ; ?>"><?= isset($_GET['page']) && ($_GET['page'] == 1) || !isset($_GET['page']) ? '' : 'Назад' ; ?></a></li>
        <?php foreach ($pages as $page) : ?>
          <li class="pagination-item <?= ($page == $current_page) ? 'pagination-item-active' : '' ;?> ">
            <a href="gallery.php?page=<?= $page; ?><?= isset($_GET['id']) ? '&id=' . $_GET['id'] : '' ; ?>"><?= $page; ?></a>
          </li>
        <?php endforeach; ?>
        <li class="pagination-item pagination-item-next"><a href="gallery.php?page=<?= $current_page + 1; ?><?= isset($_GET['id']) ? '&id=' . $_GET['id'] : '' ; ?>"><?= isset($_GET['page']) && (count($pages) == $_GET['page']) ? '' : 'Вперед' ; ?></a></li>
      </ul>
    <?php endif; ?>
  </div>
</section>

<section id="contacts">
  <div class="container  container--price">
    <h2><span>Контакты</span></h2>
    <div class="contact">
      <img class="logo__footer" src="img/logo-footer.svg" alt="Трактовичкоф">
      <ul class="contact__info">
        <li><img class="contact__icon" src="img/icon-home.svg" alt="адрес">г. Санкт-Петербург</li>
        <li>ул. Заречная д. 2</li>
        <li>
          <img class="contact__icon" src="img/icon-tel.svg" alt="телефон">
          <a href="tel:+79219002460">+7 (812) 900-24-60</a>
        </li>
        <li>
          <a class="contact__tel" href="tel:+79219002460">+7 (921) 900-24-60</a>
        </li>
        <li>
          <img class="contact__icon" src="img/icon-mail.svg" alt="почта">
          <a href="mailto:info@traktovichkoff.ru">info@traktovichkoff.ru</a>
        </li>
        <li>
          <img class="contact__icon" src="img/icon-vk.svg" alt="вконтакте">
          <a href="https://vk.com/traktovichkoff">vk.com/traktovichkoff</a>
        </li>
        <li>
          <span class="social-messenger">
            <a class="social-messenger__link  social-messenger__link--whatsapp" href="whatsapp://send?text=Здравствуйте!&phone=+79219002460">
              <img class="social-messenger__img" src="img/whatsapp.svg" alt="whatsapp">
            </a>
            <a class="social-messenger__link  social-messenger__link--viber" href="viber://add?number=79219002460">
              <img class="social-messenger__img" src="img/viber.svg" alt="viber">
            </a>
            <a class="social-messenger__link  social-messenger__link--telegram" href="https://t.me/YuraDet">
              <img class="social-messenger__img" src="img/telegram.svg" alt="telegram">
            </a>
          </span>
        </li>
      </ul>
    </div>
    <div id="map" class="map"></div>
  </div>
</section>


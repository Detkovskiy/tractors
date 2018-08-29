<section id="edit-gallery">
  <div class="container">
    <h2><span>Редактор галерии</span></h2>

    <p><?= $result; ?></p>
    <div class="form__wrapper">
      <div class="form_add-img">
        <?php if (isset($_SESSION['user']) && $_SESSION['user'] == 'anton'): ?>
          <form action="add-img.php" method="POST" enctype="multipart/form-data">
            <div class="button__load">
              <input class="hidden" type="file" name="img" id="img">
              <label class="button" for="img">Выбрать фото...</label>
            </div>

            <label class="checkbox">
              <input class="checkbox__input" type="checkbox" name="povorot" value="90">
              <span class="checkbox__indicator"></span>Вертикальное фото
            </label>

            <p class="title__load-cat"><b>Выбери категорую</b></p>

            <label class="radio-btn">
              <input class="radio-btn__input" type="radio" name="category" value="4" checked>
              <span class="radio-btn__indicator"></span>Без категории
            </label>

            <label class="radio-btn">
              <input class="radio-btn__input" type="radio" name="category" value="1">
              <span class="radio-btn__indicator"></span>Земляные работы
            </label>

            <label class="radio-btn">
              <input class="radio-btn__input" type="radio" name="category" value="3">
              <span class="radio-btn__indicator"></span>Благоустройсто
            </label>

            <label class="radio-btn">
              <input class="radio-btn__input" type="radio" name="category" value="2">
              <span class="radio-btn__indicator"></span>Асфальтирование
            </label>

            <label class="title__img">Заголовок к картинке
              <input class="title__img__input" type="text" name="title__img" placeholder="...">
            </label>

            <label class="textarea__img">Описание выполненной работы
              <textarea class="message__edit-gal" id="message" name="message" placeholder="..." rows="5"><?= empty($_POST['message']) ? '' : $_POST['message'];?></textarea>
            </label>

            <p><input class="button  button--submit" type="submit" value="Загрузить"></p>
          </form>
          <a class="link__gallery" href="gallery.php">Перейти в галерею</a>

        <?php else: ?>

          <p>Доступ закрыт!!!</p>
          <a href="login.php">Войди на сайт</a>

        <?php endif; ?>
      </div>

      <div class="preview__wrapper">
        <h3><span>Последнее загруженное фото</span></h3>

        <div class="gallery__item  gallery__item--preview">
            <div class="gallery__container-img">
              <picture>
                <img class="gallery__img" src="<?=$arr_last_img['link_img_1x']; ?>" srcset="<?=$arr_last_img['link_img_2x'];?> 2x" alt="<?=$arr_last_img['title'];?>">
              </picture>
            </div>
          <div class="gallery__description">
            <h3 class="gallery__title"><?=$arr_last_img['title'];?></h3>
            <p class="gallery__text"><?=$arr_last_img['description'];?>
            </p>
          </div>
        </div>
      </div>
    </div>


  </div>
</section>

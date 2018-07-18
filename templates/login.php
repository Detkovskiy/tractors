<h2 class="login-tittle  container"><span><?= !empty($login_tittle) ? $login_tittle : 'Вход' ;?></span></h2>
<form class="login-form container <?= !empty($login['errors']) ? 'form--invalid' : '' ?>" action="login.php" method="post">
  <div class="login__item <?= !empty($login['errors']) && (in_array('email', $login['errors']) || in_array('error_mail_validation', $login['errors']) || (in_array('no_user', $login['errors']))) ? 'form__item--invalid' : ''; ?>">
    <label for="email">E-mail*</label>
    <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $_POST['email'] ?? ''; ?>">
    <!--<span class="login__error"><?/*= !empty($login['errors']) && (in_array('no_user', $login['errors'])) ? 'Такого пользователя не существует' : 'Введите e-mail'; */?></span>-->
  </div>
  <div class="login__item <?= !empty($login['errors']) && (in_array('password', $login['errors']) || in_array('no_valid_password', $login['errors'])) ? 'form__item--invalid' : ''; ?>">
    <label for="password">Пароль*</label>
    <input id="password" type="text" name="password" placeholder="Введите пароль" >
    <!--<span class="login__error"><?/*= !empty($login['errors']) && in_array('no_valid_password', $login['errors']) ? 'Вы ввели неверный пароль' : 'Введите пароль'; */?></span>-->
  </div>
  <button type="submit" class="button">Войти</button>
</form>



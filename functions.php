<?php

require_once 'mysql_helper.php';
//require_once 'vendor/autoload.php';

/**
 *  Создаем масив где ключ массива является ID меню
 *
 * @param $categories
 * @return array
 */
function get_categories($categories) {
    $cat = array();
    foreach ($categories as $key) {
        $cat[$key["id"]] = $key;
    }
    return $cat;
}

/**
 * Функция построения дерева из массива
 * @param $sort_arr_categories
 * @return array
 */
function build_tree($sort_arr_categories) {
    $tree = array();

    foreach ($sort_arr_categories as $id => &$node) {

        if (!$node['parent']){
            $tree[$id] = &$node;
        }else{
            $sort_arr_categories[$node['parent']]['childs'][$id] = &$node;
        }
    }
    return $tree;
}


/**
 * Шаблон для формирования меню
 * @param $category
 * @return string
 */
function render_template_menu($category) {
    $page_id = ($category['menu_name'] == "Главная")? "": '?page=' . $category['id'];
    $class = ($category['class'] == null)? "": 'class="' . $category['class'] .'"';

    if ($category['link'] == 'no') {
      $link = '';
    } else {
      $link = 'href="' . $category['link'] .'.php'. $page_id;
    }

    $menu = '<li ' . $class . '><a '. $link .'">'. $category['menu_name'].'</a>';

    if(isset($category['childs'])){
        $menu .= '<ul class="dropdown">'. render_menu($category['childs']) .'</ul>';
    }
    $menu .= '</li>';

    return $menu;
}

/**
 * Заполняем шаблон данными
 * @param $data
 * @return string
 */
function render_menu($data) {
    $string = '';
    foreach($data as $item){
        $string .= render_template_menu($item);
    }
    return $string;
}

/**
 * Заполняет шаблон страницы
 *
 * Подключает файл с шаблоном и заполняет его данными и переданного массива, возвращает готовый HTML
 *
 * @param string $file_template
 * @param array $data
 * @return array
 */
function render_template($file_template, $data) {
    if (file_exists($file_template)) {
        extract($data);
        ob_start('ob_gzhandler');
        require $file_template;
        return ob_get_clean();
    } else {
        return '';
    }
}

/**
 * Валидация формы добавления лота
 *
 * Проверяет поля формы на пустоту и валидность полей для цифр.
 * Возврашает массив с ошибками.
 *
 * @return array
 */
function validation() {
    $errors = [];
    $field_numeric = ['lot-rate', 'lot-step'];
    $empty_field = ['lot-name', 'category', 'message', 'lot-date'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($field_numeric as $value_field) {
            if (!is_numeric($_POST[$value_field]))  {
                $errors[] = $value_field;
            }
            if ($_POST[$value_field] == 0) {
                $errors[] = $value_field;
            }
        }

        foreach ($empty_field as $value_field) {
            if ($_POST[$value_field] == '') {
                $errors[] = $value_field;
            }
        }
    }

    return $errors;
}

/**
 * Валидация файла
 *
 * Принимает файл из формы, проверяет его формат и размер, переносит его в указанную папку и возвращает массив с ошибками или ссылку на файл
 *
 * @param string $field_form
 * @return array
 */
function file_validation($field_form) {
    $mime_type = ['image/png', 'image/jpeg'];
    $result['error'] = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES[$field_form]) && ($_FILES[$field_form]['size'] > 0)) {
        $file_tmp_name = $_FILES[$field_form]['tmp_name'];
        $file_size = $_FILES[$field_form]['size'];
        $file_type = mime_content_type($file_tmp_name);
        $file_max_size = 1000000;

        if (!in_array($file_type, $mime_type)){
            $result['error'] = 'Загрузите картинку в формате jpg или png' . "<br>";
        }

        if ($file_size > $file_max_size) {
            $result['error'] .= 'Максимальный размер файла не должен превышать - 1МБ';
        }

        if (empty($result['error'])) {
            $file_name = $_FILES[$field_form]['name'];
            if ($field_form == "avatar") {
                $file_path = __DIR__ . '/img/avatars/';
                $file_url = 'img/avatars/' . $file_name;
                move_uploaded_file($_FILES[$field_form]['tmp_name'], $file_path . $file_name);
                $result['url'] = $file_url;
            } else {
                $file_path = __DIR__ . '/img/';
                $file_url = 'img/' . $file_name;
                move_uploaded_file($_FILES[$field_form]['tmp_name'], $file_path . $file_name);
                $result['url'] = $file_url;
            }
        }
    }

    return $result;
}

/**
 * Валидация входа на сайт
 *
 * Принимает ресур соединения с БД и почту.
 * Проверяет поля формы на пустоту и валидность введенного пользователем email.
 * Проверяет наличие введенной почты в БД.
 * Возврашает массив с ошибками.
 *
 * @param $link
 * @param string $email
 * @return array
 */
function login_validation($link, $email) {
    $errors = [];
    $user = null;
    $empty_field = ['email', 'password'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        foreach ($empty_field as $value_field) {
            if ($_POST[$value_field] == '') {
                $errors[] = $value_field;
            }
        }

        if (!in_array('email', $errors)) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'error_mail_validation';
            }
        }
    }

    /**
     * Если поля формы заполнены и валидны, проходит поиск пользователя в БД по введенному email
     */
    if (empty($errors)) {
        $sql_user = '
          SELECT id, email, password, name, avatar 
          FROM user
          WHERE email = ?;';

        if (!$user = select_data($link, $sql_user, [$email])[0]) {
            $errors[] = 'no_user';
        }
    }

    $result = ['errors' => $errors, 'user' => $user];

    return $result;
}

/**
 * Валидация формы регистрации нового пользователя
 *
 * Проверяет поля формы на пустоту и валидность введенного пользователем email.
 * Возврашает массив с ошибками.
 *
 * @return array
 */
function registration_validation() {
    $errors = [];
    $empty_field = ['email', 'password', 'name', 'message'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        foreach ($empty_field as $value_field) {
            if ($_POST[$value_field] == '') {
                $errors[] = $value_field;
            }
        }

        if (!in_array('email', $errors)) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'error_mail_validation';
            }
        }
    }

    return $errors;
}

/**
 * Проверка введенной ставки
 *
 * Проверяет введеную ставку на: пустоту поля, введены только цифры и ставка больше уже существуещей ставки
 *
 * @param int $bet
 * @return array
 */
function cost_validation($bet) {
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['cost'] == '') {
            $errors[] = 'empty';
        }
        if (!is_numeric($_POST['cost']))  {
            $errors[] = 'no_numeric';
        }
        if ($_POST['cost'] < $bet) {
            $errors[] = 'no_first_bet';
        }
    }

    return $errors;
}

/**
 * Проверка ставки
 *
 * Проверяет наличие ставки пользователя у лота
 *
 * @param array $array
 * @return boolean
 */
function find_bet($array) {
    $result = false;

    foreach ($array as $bet) {
        if ($bet['user_id'] === $_SESSION['user']['id']) {
            $result = true;
            break;
        }
    }

    return $result;
}

/**
 * Получение данных из БД
 *
 * Читает данные из MySQL и возвращать их в виде массива.
 *
 * @param $link
 * @param string $sql SQL-запрос с плейсхолдерами
 * @param array $data массив с данными для запроса
 * @return array
 */
function select_data($link, $sql, $data) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);

    return $result;
}

/**
 * Вставка данных в БД
 *
 * Формирует запрос на основе имени таблицы и ассоциативного массива с ключами - именами полей, и значениями - значениями этих полей.
 *
 * @param $link
 * @param string $table имя таблицы
 * @param array $data массив с данными для запроса
 * @return boolean
 */
function insert_data($link, $table, $data) {
    $keys_arr = array_keys($data);
    $keys = implode(", ", $keys_arr);

    $values_arr = array_values($data);
    $placeholder = [];
    foreach ($values_arr as $key) {
        $placeholder[] = '?';
        }
    $values = implode(", ", $placeholder);

    $sql = "INSERT INTO $table ($keys) VALUES ($values)";
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($stmt);
    $last_id = mysqli_insert_id($link);
    return $result && !empty($last_id) ? $last_id : false;
}

/**
 * Произвольный запрос из БД
 *
 * Выполнят запросы на обновление и удаление данных из БД
 *
 * @param $link
 * @param string $sql
 * @param array $data массив с данными для запроса
 * @return boolean
 */
function exec_query($link, $sql, $data) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($stmt) ? true : false;
    return $result;
}



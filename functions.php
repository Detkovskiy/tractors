<?php

require_once 'mysql_helper.php';

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
   // $page_id = ($category['menu_name'] == "Главная")? "": '?page=' . $category['id'];
    $class = ($category['class'] == null)? '': 'class="' . $category['class'] .'"';

    if ($category['link'] == 'no') {
      $link = '';
    } else if ($category['link']{0} == '#') {
        $link = 'href="' . $category['link'] . '"';
      }
        else {
        $link = 'href="' . $category['link'] .'.php"';
    }

    $menu = '<li ' . $class . '><a '. $link .'>'. $category['menu_name'].'</a>';

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



<?php session_start();
require_once 'init.php';

$result = $_SERVER['REQUEST_URI'];

/*if (preg_match ("/([^a-zA-Z0-9\.\/\-\_\#])/", $result)) {

  header("HTTP/1.0 404 Not Found");
  echo "Недопустимые символы в URL";
  exit;
}*/

$array_url = preg_split ("/(\/|\..*$)/", $result,-1, PREG_SPLIT_NO_EMPTY);

print_r(end($array_url));

if (!$array_url) {
  $ID_page = 1;
}else {
  $sef_value = $array_url[0];
}

$title = "Главная";

$arr_categories = select_data($link, 'SELECT menu_name, id, parent, link, class FROM menu;', '');
$sort_arr_categories = get_categories($arr_categories);
$tree = build_tree($sort_arr_categories);
$print_menu = render_menu($tree);
/*
// формирование данных микроразметки
$sql_param = isset($_GET['page']) ? $sql_param = $_GET['page'] : 1;

$sql_meta = '
        SELECT description, keywords, title, og_description, image
        FROM meta
        WHERE page_id = ?';

$arr_meta = select_data($link, $sql_meta, [$sql_param]);*/

$main_menu = render_template('templates/main-menu.php',
  [
    'print_menu' => $print_menu
  ]);
/*
$meta = render_template('templates/meta.php',
  [
    'arr_meta' => $arr_meta[0]
  ]);*/

$layout = render_template('templates/layout.php',
  [
    'title' => $title,
    'result' => $result,
    /*'meta' => $meta,*/
    'main_menu' => $main_menu
  ]);

print $layout;



<?php session_start();
require_once 'init.php';

$city = "СПБ";
if (!empty($_GET['utm_term'])) {
  $sql_city = 'SELECT city_name FROM city WHERE utm_metka = ?';
  $arr_city = select_data($link, $sql_city, [$_GET['utm_term']]);
  $city = empty($arr_city[0]['city_name']) ? "СПБ" : $arr_city[0]['city_name'];
}

$arr_categories = select_data($link, 'SELECT menu_name, id, parent, link, class FROM menu;', '');
$sort_arr_categories = get_categories($arr_categories);
$tree = build_tree($sort_arr_categories);
$print_menu = render_menu($tree);

$sql_meta = 'SELECT * FROM meta WHERE id = ?';
$sql_contact = 'SELECT * FROM contact WHERE id = ?';

$arr_meta = select_data($link, $sql_meta, [$arr_categories[0]['id']]);
$arr_contact = select_data($link, $sql_contact, [1]);

$meta = render_template('templates/meta.php',
  [
    'arr_meta' => $arr_meta[0]
  ]);

$main_menu = render_template('templates/main-menu.php',
  [
    'print_menu' => $print_menu
  ]);

$content = render_template('templates/index_c.php',
  [
    'city' => $city
  ]);

$layout = render_template('templates/layout.php',
  [
    'title' => $arr_meta[0]['title_page'],
    /*'result' => $result,*/
    'content' => $content,
    'meta' => $meta,
    'main_menu' => $main_menu,
    'contact' => $arr_contact[0]
  ]);

print $layout;



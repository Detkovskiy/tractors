<?php session_start();
require_once 'init.php';
/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 17.06.2018
 * Time: 18:11
 */


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

$content = render_template('templates/gallery.php',
  [

  ]);

$layout = render_template('templates/layout.php',
  [
    'title' => $arr_meta[0]['title_page'],
    'content' => $content,
    'meta' => $meta,
    'main_menu' => $main_menu,
    'contact' => $arr_contact[0]
  ]);

print $layout;

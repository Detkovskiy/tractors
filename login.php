<?php session_start();
require_once 'init.php';
require_once 'get_user.php';


$title = "Вход";

$login = [];

if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {

    if (password_verify($_POST['password'], $user_password)) {

      $_SESSION['user'] = 'anton';
      header("Location: index.php");

    } else {

      //$login['errors'][] = 'no_valid_password';

    }
}

$arr_categories = select_data($link, 'SELECT menu_name, id, parent, link, class FROM menu;', '');
$sort_arr_categories = get_categories($arr_categories);
$tree = build_tree($sort_arr_categories);
$print_menu = render_menu($tree);

$sql_contact = 'SELECT * FROM contact WHERE id = ?';
$arr_contact = select_data($link, $sql_contact, [1]);

$sql_meta = 'SELECT * FROM meta WHERE id = ?';
$arr_meta = select_data($link, $sql_meta, [$arr_categories[0]['id']]);

$meta = render_template('templates/meta.php',
  [
    'arr_meta' => $arr_meta[0]
  ]);

$main_menu = render_template('templates/main-menu.php',
  [
    'print_menu' => $print_menu
  ]);

$content = render_template('templates/login.php',
  [
    'login' => $login
  ]);

$layout = render_template('templates/layout.php',
  [
    'title' => $title,
    'content' => $content,
    'meta' => $meta,
    'main_menu' => $main_menu,
    'contact' => $arr_contact[0]
  ]);

print $layout;



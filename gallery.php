<?php session_start();
require_once 'init.php';

$arr_categories = select_data($link, 'SELECT menu_name, id, parent, link, class FROM menu;', '');
$sort_arr_categories = get_categories($arr_categories);
$tree = build_tree($sort_arr_categories);
$print_menu = render_menu($tree);

$sql_meta = 'SELECT * FROM meta WHERE id = ?';
$sql_contact = 'SELECT * FROM contact WHERE id = ?';

$arr_meta = select_data($link, $sql_meta, [$arr_categories[0]['id']]);
$arr_contact = select_data($link, $sql_contact, [1]);

$current_page = $_GET['page'] ?? 1;
$page_item = 6;

if (isset($_GET['id'])) {

  /**
   *  Отключение фильтрации. Показ лотов всех категорий
   */
  if ($_GET['id'] == 'all') {
    header("Location: gallery.php");
  }

  /**
   *  Запрос в БД для определения количества картинок выбранной категории
   */
  $sql_count_img = '
      SELECT count(*) as count
      FROM gallery_img
      WHERE category_id = ?;';

  /**
   *  Расчет колчества страниц для пагинации
   */
  $count_img = select_data($link, $sql_count_img, [$_GET['id']])[0];
  $page_count = ceil($count_img['count'] / $page_item);
  $offset = ($current_page - 1) * $page_item;
  $pages = range(1, $page_count);

  /**
   *  Запрос данных лотов из БД с учетом параметров пагинации
   */
  $sql_img = '
        SELECT g.id, g.category_id, g.title, g.description, g.link_lightbox, g.link_img_2x, g.link_img_1x, g.link_mobile_2x, g.link_mobile_1x FROM gallery_img g
        JOIN gallery_categories c ON category_id = c.id
        WHERE c.id = ? 
         ORDER BY g.id DESC 
        LIMIT ? OFFSET ?;';

  $arr_img = select_data($link, $sql_img, [$_GET['id'], $page_item, $offset]);

} else {

  /**
   * При отсутствии GET запроса, отображаются лоты всех категорий, участвующие в торгах
   *
   * Запрос о количестве лотов и расчет пагинации
   */
  $sql_count_img = 'SELECT count(*) as count FROM gallery_img';
  $count_img = select_data($link, $sql_count_img, '')[0];

  $page_count = ceil($count_img['count'] / $page_item);
  $offset = ($current_page - 1) * $page_item;
  $pages = range(1, $page_count);

  /**
   * Запрос данных лотов из БД с учетом параметров пагинации
   */
  $sql_img = '
    SELECT g.id, g.category_id, g.title, g.description, g.link_lightbox, g.link_img_2x, g.link_img_1x, g.link_mobile_2x, g.link_mobile_1x FROM gallery_img g
    JOIN gallery_categories c ON category_id = c.id
    ORDER BY g.id DESC 
    LIMIT ? OFFSET ?;';

  $arr_img = select_data($link, $sql_img, [$page_item, $offset]);
}

/*
$sql_arr_img = 'SELECT `category_id`, `title`, `description`, `link_lightbox`, `link_img_2x`, `link_img_1x`, `link_mobile_2x`, `link_mobile_1x` FROM gallery_img ORDER BY id DESC LIMIT 1';

$arr_img = select_data($link, $sql_arr_img, []);*/

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
    'arr_img' => $arr_img,
    'pages' => $pages,
    'page_count' => $page_count,
    'current_page' => $current_page
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

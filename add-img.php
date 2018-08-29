<?php session_start();
require_once 'init.php';
require 'vendor/autoload.php';

$result = '';

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['img']['error'] == 0 && isset($_FILES['img'])){
  $validation_file = file_validation('img');

  if(is_uploaded_file($_FILES['img']['tmp_name']) && empty($validation_file['error'])){

    $fileName = pathinfo($_FILES['img']['name'], PATHINFO_FILENAME);

    $fileExtension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

    $img = $_FILES['img']['tmp_name']; //путь к файлу из временной папки

    $manager = new Intervention\Image\ImageManager(array('driver' => 'gd'));

    $rotate = 0;
    if (isset($_POST['povorot'])) {
      $rotate = '-90';
    }

    switch ($_POST['category']) {
      case '1':
        $gallery_folder = 'gallery/earthwork/';
        break;
      case '2':
        $gallery_folder = 'gallery/asphalt/';
        break;
      case '3':
        $gallery_folder = 'gallery/accomplishment/';
        break;
      default:
        $gallery_folder = 'gallery/others/';
    }

    $image_lightbox = $manager
      ->make($img)
      ->resize(1000, null, function ($constraint) {$constraint->aspectRatio();})
      ->rotate($rotate)
      ->save($gallery_folder.'lightbox/'.$fileName.'@lightbox'.'.'.$fileExtension);

    $image_2x = $manager
      ->make($img)
      ->resize(800, null, function ($constraint) {$constraint->aspectRatio();})
      ->rotate($rotate)
      ->save($gallery_folder.'img/'.$fileName.'@2x'.'.'.$fileExtension);

    $image_1x = $manager
      ->make($img)
      ->resize(400, null, function ($constraint) {$constraint->aspectRatio();})
      ->rotate($rotate)
      ->save($gallery_folder.'img/'.$fileName.'@1x'.'.'.$fileExtension);

    $image_mobile_2x = $manager
      ->make($img)
      ->resize(560, null, function ($constraint) {$constraint->aspectRatio();})
      ->rotate($rotate)
      ->save($gallery_folder.'mobile/'.$fileName.'@mobile_2x'.'.'.$fileExtension);

    $image_mobile_1x = $manager
      ->make($img)
      ->resize(280, null, function ($constraint) {$constraint->aspectRatio();})
      ->rotate($rotate)
      ->save($gallery_folder.'mobile/'.$fileName.'@mobile_1x'.'.'.$fileExtension);

    $img_add = [
      'category_id' => $_POST['category'],
      'title' => htmlspecialchars($_POST['title__img']),
      'description' => htmlspecialchars($_POST['message']),
      'link_lightbox' => $gallery_folder.'lightbox/'.$fileName.'@lightbox'.'.'.$fileExtension,
      'link_img_2x' => $gallery_folder.'img/'.$fileName.'@2x'.'.'.$fileExtension,
      'link_img_1x' => $gallery_folder.'img/'.$fileName.'@1x'.'.'.$fileExtension,
      'link_mobile_2x' => $gallery_folder.'mobile/'.$fileName.'@mobile_2x'.'.'.$fileExtension,
      'link_mobile_1x' => $gallery_folder.'mobile/'.$fileName.'@mobile_1x'.'.'.$fileExtension,
      'date' =>  date('Y-m-d H:i:s')
    ];

    insert_data($link, 'gallery_img', $img_add);

  } else {
    echo ($validation_file['error']);
  }
  $result = 'Фото загруженно!';
}


//$image_list = select_data($link, 'SELECT name, category FROM image;', '');
//var_dump(select_data($link, 'SELECT DATE_FORMAT(date, "%d %m %Y") FROM gallery_lightbox;', ''));

//var_dump(select_data($link, 'SELECT DATE FROM gallery_lightbox;', ''));


$arr_categories = select_data($link, 'SELECT menu_name, id, parent, link, class FROM menu;', '');
$sort_arr_categories = get_categories($arr_categories);
$tree = build_tree($sort_arr_categories);
$print_menu = render_menu($tree);

$sql_meta = 'SELECT * FROM meta WHERE id = ?';
$sql_contact = 'SELECT * FROM contact WHERE id = ?';

$arr_meta = select_data($link, $sql_meta, [$arr_categories[0]['id']]);
$arr_contact = select_data($link, $sql_contact, [1]);

$sql_last_img = 'SELECT `title`, `description`, `link_img_2x`, `link_img_1x` FROM gallery_img ORDER BY id DESC LIMIT 1';
$arr_last_img = select_data($link, $sql_last_img, []);

$meta = render_template('templates/meta.php',
  [
    'arr_meta' => $arr_meta[0]
  ]);

$main_menu = render_template('templates/main-menu.php',
  [
    'print_menu' => $print_menu
  ]);

$content = render_template('templates/add-img.php',
  [
    'result' => $result,
    'arr_last_img' => $arr_last_img[0]
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





INSERT INTO meta (description, keywords, og_title, og_description, og_url_page, og_url_image)
  VALUE
  ('Комплексное выполнение земляных работ в СПБ. Земляные работы выполняем точно по проектной документации. Собственная строительная техники.',
   'земляные работы на участке, земляные работы спб, земляные работы',
   'xxx - земляные работы СПБ и Ленинградской области',
   'Комплексное выполнение земляных работ в СПБ. Земляные работы выполняем точно по проектной документации. Собственная строительная техники.',
   'https://xxx.ru/img/zemljanye-raboty-spb-tablet.jpg', 'https://xxx.ru/img/');

INSERT INTO contact (tel_code_city, tel_code_mobile, tel, email, adres_sity, adres_street, vk, viber, telegram, watsapp)
  VALUE
  ('812',
   '921',
   '900-24-60',
   'info@traktovichkoff.ru',
   'Санкт-Петербург',
   'Заречная, 2',
   'vk.com/traktovichkoff',
   'viber://add?number=79219002460',
   'https://t.me/YuraDet',
   'whatsapp://send?text=Здравствуйте!&phone=+79219002460'
  );

INSERT INTO city (city_name, utm_metka)
  VALUE
  ('Красном селе', 'krasnoe'),
  ('Яльгелево', 'ygelevo'),
  ('Разбегаево', 'razbegaevo'),
  ('Горбунках', 'garbynki'),
  ('Стрельне', 'strelna'),
  ('Ломоносове', 'lomonosov'),
  ('Малое Карлино', 'karlino'),
  ('Новоселье', 'novosele'),
  ('Аннино', 'annino'),
  ('Пушкине', 'pyshkin'),
  ('Гатчине', 'gatchina'),
  ('Тайцах', 'taici'),
  ('Пудости', 'pydost'),
  ('Кипени', 'kipen'),
  ('Александровском', 'alexandrovskoe'),
  ('Всеволожске', 'vsevolojsk'),
  ('Буграх', 'bygri'),
  ('Колпино', 'kolpino'),
  ('Павловске', 'pavlovsk'),
  ('Песочном', 'pesochnoe'),
  ('Разметелево', 'razmetelevo');


INSERT INTO menu (menu_name, link, parent, class) VALUE
  (
    'Стоимость', '#price', 0, null
);

INSERT INTO gallery_categories(category_name)
  VALUE
  ('Земляные работы'),
  ('Асфальтирование'),
  ('Благоустройство'),
  ('Все категории');

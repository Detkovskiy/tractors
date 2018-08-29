CREATE TABLE `meta` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `description` text,
  `keywords` text,
  `og_title` text,
  `og_description` text,
  `og_url_page` text,
  `og_url_image` text
);

CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tel_code_sity` text,
  `tel_code_mobile` text,
  `tel` text,
  `email` text,
  `adres_sity` text,
  `adres_street` text,
  `vk` text,
  `viber` text,
  `telegram` text,
  `watsapp` text
);

CREATE TABLE `city` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `city_name` text,
  `utm_metka` text
);

CREATE TABLE gallery_categories(
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_name CHAR(100)
);

CREATE TABLE `gallery_img` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category` text,
  `title` text,
  `description` text,
  `link_lightbox` text,
  `link_img_2x` text,
  `link_img_1x` text,
  `link_mobile_2x` text,
  `link_mobile_1x` text,
  `date` DATE
);

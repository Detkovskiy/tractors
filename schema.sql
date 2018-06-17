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

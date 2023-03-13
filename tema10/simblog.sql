-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-03-2023 a las 11:05:47
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `simblog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blog` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`id`, `title`, `author`, `blog`, `image`, `tags`, `created_at`, `updated_at`) VALUES
(1, 'A day with Symfony2', 'dsyph3r', 'Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.', 'beach.jpg', 'symfony2, php, paradise, symblog', '2023-02-19 17:00:41', '2023-02-19 18:00:00'),
(2, 'The pool on the roof must have a leak', 'Zero Cool', 'Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.', 'pool_leak.jpg', 'pool, leaky, hacked, movie, hacking, symblog', '2023-02-19 17:00:41', '2011-07-23 06:12:00'),
(3, 'Misdirection. What the eyes see and the ears hear, the mind believes', 'Gabriel', 'Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'misdirection.jpg', 'misdirection, magic, movie, hacking, symblog', '2023-02-19 17:00:41', '2011-07-16 16:14:00'),
(4, 'The grid - A digital frontier', 'Kevin Flynn', 'Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.', 'the_grid.jpg', 'grid, daftpunk, movie, symblog', '2023-02-19 17:00:41', '2011-06-02 18:54:00'),
(5, 'You\'re either a one or a zero. Alive or dead', 'Gary Winston', 'Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'one_or_zero.jpg', 'binary, one, zero, alive, dead, !trusting, movie, symblog', '2023-02-19 17:00:41', '2011-04-25 15:34:00'),
(6, 'A day with Symfony2', 'dsyph3r', 'Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.', 'beach.jpg', 'symfony2, php, paradise, symblog', '2023-02-19 17:05:56', '2023-02-19 18:05:00'),
(7, 'The pool on the roof must have a leak', 'Zero Cool', 'Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.', 'pool_leak.jpg', 'pool, leaky, hacked, movie, hacking, symblog', '2023-02-19 17:05:56', '2011-07-23 06:12:00'),
(8, 'Misdirection. What the eyes see and the ears hear, the mind believes', 'Gabriel', 'Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'misdirection.jpg', 'misdirection, magic, movie, hacking, symblog', '2023-02-19 17:05:56', '2011-07-16 16:14:00'),
(9, 'The grid - A digital frontier', 'Kevin Flynn', 'Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.', 'the_grid.jpg', 'grid, daftpunk, movie, symblog', '2023-02-19 17:05:56', '2011-06-02 18:54:00'),
(10, 'You\'re either a one or a zero. Alive or dead', 'Gary Winston', 'Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'one_or_zero.jpg', 'binary, one, zero, alive, dead, !trusting, movie, symblog', '2023-02-19 17:05:56', '2011-04-25 15:34:00'),
(11, 'A day with Symfony2', 'dsyph3r', 'Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.', 'beach.jpg', 'symfony2, php, paradise, symblog', '2023-02-19 17:07:57', '2023-02-19 18:07:00'),
(12, 'The pool on the roof must have a leak', 'Zero Cool', 'Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.', 'pool_leak.jpg', 'pool, leaky, hacked, movie, hacking, symblog', '2023-02-19 17:07:57', '2011-07-23 06:12:00'),
(13, 'Misdirection. What the eyes see and the ears hear, the mind believes', 'Gabriel', 'Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'misdirection.jpg', 'misdirection, magic, movie, hacking, symblog', '2023-02-19 17:07:57', '2011-07-16 16:14:00'),
(14, 'The grid - A digital frontier', 'Kevin Flynn', 'Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.', 'the_grid.jpg', 'grid, daftpunk, movie, symblog', '2023-02-19 17:07:57', '2011-06-02 18:54:00'),
(15, 'You\'re either a one or a zero. Alive or dead', 'Gary Winston', 'Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'one_or_zero.jpg', 'binary, one, zero, alive, dead, !trusting, movie, symblog', '2023-02-19 17:07:57', '2011-04-25 15:34:00'),
(16, 'A day with Symfony2', 'dsyph3r', 'Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.', 'beach.jpg', 'symfony2, php, paradise, symblog', '2023-02-19 17:08:28', '2023-02-19 18:08:00'),
(17, 'The pool on the roof must have a leak', 'Zero Cool', 'Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.', 'pool_leak.jpg', 'pool, leaky, hacked, movie, hacking, symblog', '2023-02-19 17:08:28', '2011-07-23 06:12:00'),
(18, 'Misdirection. What the eyes see and the ears hear, the mind believes', 'Gabriel', 'Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'misdirection.jpg', 'misdirection, magic, movie, hacking, symblog', '2023-02-19 17:08:28', '2011-07-16 16:14:00'),
(19, 'The grid - A digital frontier', 'Kevin Flynn', 'Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.', 'the_grid.jpg', 'grid, daftpunk, movie, symblog', '2023-02-19 17:08:28', '2011-06-02 18:54:00'),
(20, 'You\'re either a one or a zero. Alive or dead', 'Gary Winston', 'Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'one_or_zero.jpg', 'binary, one, zero, alive, dead, !trusting, movie, symblog', '2023-02-19 17:08:28', '2011-04-25 15:34:00'),
(21, 'A day with Symfony2', 'dsyph3r', 'Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.', 'beach.jpg', 'symfony2, php, paradise, symblog', '2023-02-19 17:09:10', '2023-02-19 18:09:00'),
(22, 'The pool on the roof must have a leak', 'Zero Cool', 'Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.', 'pool_leak.jpg', 'pool, leaky, hacked, movie, hacking, symblog', '2023-02-19 17:09:10', '2011-07-23 06:12:00'),
(23, 'Misdirection. What the eyes see and the ears hear, the mind believes', 'Gabriel', 'Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'misdirection.jpg', 'misdirection, magic, movie, hacking, symblog', '2023-02-19 17:09:10', '2011-07-16 16:14:00'),
(24, 'The grid - A digital frontier', 'Kevin Flynn', 'Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.', 'the_grid.jpg', 'grid, daftpunk, movie, symblog', '2023-02-19 17:09:10', '2011-06-02 18:54:00'),
(25, 'You\'re either a one or a zero. Alive or dead', 'Gary Winston', 'Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'one_or_zero.jpg', 'binary, one, zero, alive, dead, !trusting, movie, symblog', '2023-02-19 17:09:10', '2011-04-25 15:34:00'),
(37, 'hshhhss', 'dsyph3r', 'shhshshs', '63f8ad900f279logo.png', 'sjshsjs', '2023-02-24 12:29:04', '2023-02-24 13:29:04'),
(38, 'blog prueba', 'paco', 'prueba', '640edd98b87f1logocasarural.jpg', 'prueba', '2023-03-13 08:23:52', '2023-03-13 09:23:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `blog_id`, `user`, `comment`, `approved`, `created_at`, `updated_at`) VALUES
(1, 1, 'symfony', 'To make a long story short. You can\'t go wrong by choosing Symfony! And no one has ever been fired for using Symfony.', 1, '2023-02-19 18:09:00', NULL),
(2, 1, 'David', 'To make a long story short. Choosing a framework must not be taken lightly; it is a long-term commitment. Make sure that you make the right selection!', 1, '2023-02-19 18:09:00', NULL),
(3, 2, 'Dade', 'Anything else, mom? You want me to mow the lawn? Oops! I forgot, New York, No grass.', 1, '2023-02-19 18:09:00', NULL),
(4, 2, 'Kate', 'Are you challenging me? ', 1, '2011-07-23 06:15:00', NULL),
(5, 2, 'Dade', 'Name your stakes.', 1, '2011-07-23 06:18:00', NULL),
(6, 2, 'Kate', 'If I win, you become my slave.', 1, '2011-07-23 06:22:00', NULL),
(7, 2, 'Dade', 'Your SLAVE?', 1, '2011-07-23 06:25:00', NULL),
(8, 2, 'Kate', 'You wish! You\'ll do shitwork, scan, crack copyrights...', 1, '2011-07-23 06:46:00', NULL),
(9, 2, 'Dade', 'And if I win?', 1, '2011-07-23 10:22:00', NULL),
(10, 2, 'Kate', 'Make it my first-born!', 1, '2011-07-23 11:08:00', NULL),
(11, 2, 'Dade', 'Make it our first-date!', 1, '2011-07-24 18:56:00', NULL),
(12, 2, 'Kate', 'I don\'t DO dates. But I don\'t lose either, so you\'re on!', 1, '2011-07-25 22:28:00', NULL),
(13, 3, 'Stanley', 'It\'s not gonna end like this.', 1, '2023-02-19 18:09:00', NULL),
(14, 3, 'Gabriel', 'Oh, come on, Stan. Not everything ends the way you think it should. Besides, audiences love happy endings.', 1, '2023-02-19 18:09:00', NULL),
(15, 5, 'Mile', 'Doesn\'t Bill Gates have something like that?', 1, '2023-02-19 18:09:00', NULL),
(16, 5, 'Gary', 'Bill Who?', 1, '2023-02-19 18:09:00', NULL),
(18, 1, 'admin', 'buena playa', 1, '2023-03-04 13:26:28', '2023-03-04 13:26:28'),
(19, 1, 'Anonymous', 'buena playa', 1, '2023-03-04 13:31:01', '2023-03-04 13:31:01'),
(20, 2, 'Anonymous', 'wow', 1, '2023-03-04 13:32:04', '2023-03-04 13:32:04'),
(21, 1, 'Anonymous', 'buena playa', 1, '2023-03-13 09:22:01', '2023-03-13 09:22:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) COLLATE utf8_spanish2_ci NOT NULL,
  `user` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `perfil` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `user`, `email`, `password`, `perfil`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin', 'admin@gmail.com', '$2y$10$VQO9jzYgtJza4pnM4elEAu7b7EwLpHajKKHqBqtZumsXrZbIN2u5y', 'admin', '2023-03-03 13:47:40', '2023-03-03 13:47:40'),
(4, 'paco', 'paco', 'paco@gmail.com', '$2y$10$fimEBBewfHDxBe6dKusZ3eptSIkzdHlH3.UR2y/IyDFxa9YPxhzBG', 'admin', '2023-03-13 09:23:06', '2023-03-13 09:23:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CDAE07E97` (`blog_id`);

--
-- Indices de la tabla `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CDAE07E97` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

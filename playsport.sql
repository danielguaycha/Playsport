-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-11-2018 a las 19:55:17
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `playsport`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `tournament_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_tournament_id_foreign` (`tournament_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `status`, `tournament_id`) VALUES
(1, 'Grupo A', 1, 1),
(2, 'Grupo B', 1, 1),
(3, 'Grupo C', 1, 1),
(4, 'Grupo D', 1, 1),
(5, 'Liguilla Futsal', 1, 2),
(6, 'Liguilla Basket', 1, 3),
(7, 'Grupo A', 1, 4),
(8, 'Grupo B', 1, 4),
(9, 'Grupo C', 1, 4),
(10, 'Grupo D', 1, 4),
(11, 'Grupo A', 1, 5),
(12, 'Grupo B', 1, 5),
(13, 'Grupo C', 1, 5),
(14, 'Grupo D', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_controls`
--

DROP TABLE IF EXISTS `group_controls`;
CREATE TABLE IF NOT EXISTS `group_controls` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pj` int(11) NOT NULL DEFAULT '0',
  `pg` int(11) NOT NULL DEFAULT '0',
  `pe` int(11) NOT NULL DEFAULT '0',
  `pp` int(11) NOT NULL DEFAULT '0',
  `gf` int(11) NOT NULL DEFAULT '0',
  `gc` int(11) NOT NULL DEFAULT '0',
  `pts` int(11) NOT NULL DEFAULT '0',
  `time_table_id` int(10) UNSIGNED NOT NULL,
  `team_group_id` int(10) UNSIGNED NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_controls_time_table_id_foreign` (`time_table_id`),
  KEY `group_controls_team_group_id_foreign` (`team_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `group_controls`
--

INSERT INTO `group_controls` (`id`, `pj`, `pg`, `pe`, `pp`, `gf`, `gc`, `pts`, `time_table_id`, `team_group_id`, `team_id`) VALUES
(46, 1, 1, 0, 0, 3, 1, 3, 16, 14, 16),
(47, 1, 0, 0, 1, 1, 3, 0, 16, 15, 15),
(50, 1, 1, 0, 0, 2, 1, 3, 17, 14, 16),
(51, 1, 0, 0, 1, 1, 2, 0, 17, 16, 14),
(52, 1, 0, 1, 0, 3, 3, 1, 18, 15, 15),
(53, 1, 0, 1, 0, 3, 3, 1, 18, 13, 17),
(54, 1, 1, 0, 0, 3, 2, 3, 19, 14, 16),
(55, 1, 0, 0, 1, 2, 3, 0, 19, 13, 17),
(56, 1, 1, 0, 0, 2, 0, 3, 20, 15, 15),
(57, 1, 0, 0, 1, 0, 2, 0, 20, 16, 14),
(80, 1, 1, 0, 0, 2, 1, 3, 15, 16, 14),
(81, 1, 0, 0, 1, 1, 2, 0, 15, 13, 17),
(88, 1, 1, 0, 0, 12, 10, 3, 43, 36, 35),
(89, 1, 0, 0, 1, 10, 12, 0, 43, 37, 39),
(90, 1, 1, 0, 0, 15, 12, 3, 46, 40, 44),
(91, 1, 0, 0, 1, 12, 15, 0, 46, 39, 42),
(92, 1, 1, 0, 0, 14, 16, 3, 49, 42, 37),
(93, 1, 0, 0, 1, 16, 14, 0, 49, 43, 36),
(96, 1, 1, 0, 0, 12, 8, 3, 44, 38, 41),
(97, 1, 0, 0, 1, 8, 12, 0, 44, 37, 39),
(98, 1, 1, 0, 0, 12, 11, 3, 47, 41, 43),
(99, 1, 0, 0, 1, 11, 12, 0, 47, 40, 44),
(102, 1, 1, 0, 0, 12, 8, 3, 45, 38, 41),
(103, 1, 0, 0, 1, 8, 12, 0, 45, 36, 35),
(104, 1, 1, 0, 0, 14, 15, 3, 48, 41, 43),
(105, 1, 0, 0, 1, 15, 14, 0, 48, 39, 42),
(112, 1, 1, 0, 0, 12, 9, 3, 40, 34, 38),
(113, 1, 0, 0, 1, 9, 12, 0, 40, 33, 34),
(114, 1, 1, 0, 0, 15, 10, 3, 41, 35, 40),
(115, 1, 0, 0, 1, 10, 15, 0, 41, 34, 38),
(116, 1, 1, 0, 0, 12, 10, 3, 42, 33, 34),
(117, 1, 0, 0, 1, 10, 12, 0, 42, 35, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(29, '2013_10_18_042820_create_organizations_table', 1),
(30, '2014_10_12_000000_create_users_table', 1),
(31, '2014_10_12_100000_create_password_resets_table', 1),
(32, '2018_10_18_044151_create_sports_table', 1),
(33, '2018_10_18_045906_create_players_table', 1),
(34, '2018_10_18_050453_create_tournaments_table', 1),
(35, '2018_10_18_051434_create_teams_table', 1),
(36, '2018_10_18_051856_create_player_teams_table', 1),
(38, '2018_10_18_053320_create_groups_table', 1),
(39, '2018_10_18_053545_create_team_groups_table', 1),
(40, '2018_10_18_185107_create_stages_table', 1),
(41, '2018_10_18_185809_create_time_tables_table', 1),
(43, '2018_11_02_202352_create_pages_table', 2),
(45, '2018_11_12_191004_create_results_table', 4),
(46, '2018_11_14_052350_create_stats_table', 5),
(47, '2018_11_15_011154_create_group_controls_table', 6),
(49, '2018_11_14_171952_create_stage_controls_table', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizations`
--

DROP TABLE IF EXISTS `organizations`;
CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `logo`) VALUES
(1, 'UAIC', 'logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'page',
  `user_id` int(10) UNSIGNED NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `content`, `url`, `type`, `user_id`, `parent`, `created_at`, `updated_at`) VALUES
(6, 'Natación', 'Torneo de Natación', '<h2 style=\"text-align: center;\">Nataci&oacute;n</h2>\r\n\r\n<p>Here :)</p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 100%;\">\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Nombre</th>\r\n			<th scope=\"col\">Apellidos</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>Valor</td>\r\n			<td>Valor</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Valor</td>\r\n			<td>Valor</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>', 'natacion', 'page', 1, 0, '2018-11-05 09:52:24', '2018-11-05 10:30:08'),
(7, 'Gincana', 'Competición', '<h2 style=\"text-align: center;\">Gincana</h2>\r\n\r\n<p>Description here :)</p>', 'gincana', 'page', 1, 0, '2018-11-05 10:27:35', '2018-11-05 10:27:35'),
(8, 'Cam. Mojadas', 'Pág. Camisetas mojadas', '<h2 style=\"text-align: center;\">Camisetas Mojadas</h2>\r\n\r\n<p>Description here :)</p>', 'cam-mojadas', 'page', 1, 0, '2018-11-05 10:28:44', '2018-11-05 10:28:44'),
(9, 'Postas', 'Pag. Postas', '<h2 style=\"text-align: center;\">Postas</h2>\r\n\r\n<p>Description here :v</p>', 'postas', 'page', 1, 0, '2018-11-05 10:29:20', '2018-11-05 10:29:20'),
(10, 'Evento', 'Descripción del evento', '<h2 style=\"text-align: center;\">Descripci&oacute;n del evento</h2>', 'evento', 'page', 1, 0, '2018-11-06 22:59:16', '2018-11-06 22:59:16');
INSERT INTO `pages` (`id`, `title`, `description`, `content`, `url`, `type`, `user_id`, `parent`, `created_at`, `updated_at`) VALUES
(11, 'Premios', 'Premios a ganadores y ganadoras de eventos', '<h2 id=\"premios\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Premios</font></font></font></font></h2>\r\n\r\n<h3><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Regalos</font></font></font></font></h3>\r\n\r\n<p><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Con el patrocinio de empresas de El oro y la colaboraci&oacute;n de los estudiantes en el 8&ordm; semestre de la carrera de ingenier&iacute;a, traemos una lista de premios para los alumnos m&aacute;s destacados en las diversas disciplinas y eventos.</font></font></font></font></p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 100%\">\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Regalo</font></font></font></font></th>\r\n			<th scope=\"col\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Categor&iacute;a Premiada</font></font></font></font></th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">2 botellas de vodka</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Mejor barra</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Un mes en crossfit</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Mejor goleador / a</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Joya ba&ntilde;ada en plata</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Madrina de deportes</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Beca para capacitaci&oacute;n en dise&ntilde;o gr&aacute;fico</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Mejor mascota</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Cup&oacute;n de 50% de descuento en maquillaje y peinado.</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Mayor cantidad de me gusta (Candidatas)</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">4 arreglos florares</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">4 candidatas finalistas</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Banda para la Se&ntilde;orita Imagen y asesoramiento completo</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Imagen de se&ntilde;orita</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Regalo especial</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Ganadoras de Postas (Mujeres)</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Botella de whisky</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Equipo mejor uniformado</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">20% de descuento en orden de consumo</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Ganadores De Fulbito&nbsp;</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Botella de venetto</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Ganadores de postas</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Pizza&nbsp;</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Ganadores de baloncesto</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Pizza</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Ganadoras de baloncesto</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Botella de vodka&nbsp;</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Ganadores de volea&nbsp;</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Ratonero</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Ganador Nataci&oacute;n (Hombres)</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Rat&oacute;n</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Ganador Nataci&oacute;n (Mujeres)</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Pizza</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Ganadores de Ginkana</font></font></font></font></td>\r\n		</tr>\r\n		<tr>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Pizza&nbsp;</font></font></font></font></td>\r\n			<td><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Mejor eslogan</font></font></font></font></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h3><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Copas y medallas</font></font></font></font></h3>\r\n\r\n<p align=\"center\"><img alt=\"\" border=\"0\" height=\"300\" hspace=\"0\" src=\"https://i.imgur.com/61fC6NL.jpg\" style=\"border-radius: 50%;width:278px;height:300px;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;border:0px solid black;\" vspace=\"0\" width=\"278\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align: center;\"><img alt=\"\" border=\"0\" height=\"499\" hspace=\"0\" src=\"data:image/png;base64,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\" style=\"width:721px;height:499px;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;border:0px solid black;\" vspace=\"0\" width=\"721\" /></p>\r\n\r\n<p>&nbsp;</p>', 'premios', 'page', 3, 0, '2018-11-06 23:00:15', '2018-11-07 00:01:26'),
(12, 'Concursos', 'Concursos', '<h2 style=\"text-align: center;\">Concursos</h2>\r\n\r\n<h3>Srta. Deportes Inform&aacute;tica</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Mejor Slogan</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Mascota</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>Equipo mejor uniformado</h3>', 'concursos', 'page', 1, 0, '2018-11-06 23:35:47', '2018-11-06 23:35:47');
INSERT INTO `pages` (`id`, `title`, `description`, `content`, `url`, `type`, `user_id`, `parent`, `created_at`, `updated_at`) VALUES
(13, 'Reglas', 'Página de reglas generales', '<p align=\"center\" class=\"MsoNoSpacing\" style=\"text-align:center; margin:0cm 0cm 0.0001pt\"><br />\r\n<span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">UNIVERSIDAD T&Eacute;CNICA DE MACHALA</span></span></b></span></span></p>\r\n\r\n<p align=\"center\" class=\"MsoNoSpacing\" style=\"text-align:center; margin:0cm 0cm 0.0001pt\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">UNIDAD ACADEMICA DE INGENIER&Iacute;A CIVIL</span></span></b></span></span></p>\r\n\r\n<p align=\"center\" class=\"MsoNoSpacing\" style=\"text-align:center; margin:0cm 0cm 0.0001pt\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><b><i><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">CARRERA DE INGENIER&Iacute;A DE SISTEMAS</span></span></i></b></span></span></p>\r\n\r\n<p align=\"center\" class=\"MsoNoSpacing\" style=\"margin-left:35.4pt; text-align:center; margin:0cm 0cm 0.0001pt\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">ORGANIZA: 17 VA PROMOCI&Oacute;N DE ESTUDIANTES</span></span></b></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\">&nbsp;</p>\r\n\r\n<p align=\"center\" style=\"text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">REGLAMENTO GENERAL DE LOS JUEGOS DEPORTIVOS</span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\"><strong><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Del Establecimiento</span></span></span></span></span></span></strong></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">No se podr&aacute; ingresar al establecimiento con bebidas alcoh&oacute;licas, las &uacute;nicas bebidas permitidas son las que se vender&aacute;n dentro de establecimiento. </span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Si &eacute;l o la estudiante desea llevar un acompa&ntilde;ante lo puede hacer pero bajo su responsabilidad, dicho acompa&ntilde;ante entrar&aacute; al evento solo con &eacute;l o la estudiante de la carrera de Ingenier&iacute;a de Sistemas y no podr&aacute; participar en ninguna de las disciplinas.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">En el caso de que &nbsp;suscite agresi&oacute;n f&iacute;sica o verbal &nbsp;hacia los &aacute;rbitros u organizadores del evento, durante la ejecuci&oacute;n de alguna de las competencias el equipo ser&aacute; descalificado, el agresor no podr&aacute; seguir participando en ninguna disciplina y se le restaran 30 puntos al curso donde el jugador se encontrase inscrito. </span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">El evento empezar&aacute; a las 8 de la ma&ntilde;ana, con los equipos que se encuentren presentes. </span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Los estudiantes deben cuidar las &aacute;reas, estudiante que haga mal uso de las instalaciones o suceda algo inapropiado ser&aacute; sancionado dependiendo el caso (Deber&aacute; reparar los da&ntilde;os causados).</span></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\"><strong><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">De los Docentes</span></span></span></span></span></span></strong></p>\r\n\r\n<ol start=\"6\">\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Un equipo podr&aacute; reforzarse en cualquiera de las disciplinas &uacute;nicamente con su tutor asignado; en el caso de que un docente no este asignado como tutor en alg&uacute;n curso podr&aacute; reforzar.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Un docente tutor solo podr&aacute; participar en su curso asignado y en el equipo de docentes. </span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Los docentes no pueden participar con otro curso, en caso de que el curso sea eliminado.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">En cancha solo puede estar un docente por equipo.</span></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\"><strong><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">De los estudiantes</span></span></span></span></span></span></strong></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Los estudiantes pagar&aacute;n una inscripci&oacute;n de $10.00 por semestre. (cubrir&aacute; todas las disciplinas)</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Para cualquier disciplina solo pueden participar estudiantes que est&eacute;n registrados en la hoja de inscripci&oacute;n anteriormente dada y en la disciplina inscrita.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Los estudiantes deben presentar el <u>carnet estudiantil o c&eacute;dula </u>al momento de jugar en cada disciplina para poder verificar su inscripci&oacute;n y matricula.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Un curso podr&aacute; inscribir a su equipo de varones con estudiantes que pertenezcan a dicho curso; a <u>excepci&oacute;n de las mujeres que podr&aacute;n hacer uso de la fusi&oacute;n de varios paralelos</u>.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Los estudiantes varones y mujeres pueden participar en el curso que se encuentren matriculados, en caso de constar en varios semestres matriculados, <u>&uacute;nicamente puede participar en un curso de su preferencia.</u></span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">En el caso de ganar un equipo fusionado de mujeres los puntos ser&aacute;n asignados a los paralelos a los cuales pertenecen.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">En caso de que un equipo no participe en la Gincana, se le restara la mitad de los puntos obtenidos en las competencias deportivas realizadas.</span></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\"><strong><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Asignaci&oacute;n de Puntos:</span></span></span></span></span></span></strong></p>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\">&nbsp;</p>\r\n\r\n<table align=\"center\" class=\"Table\" style=\"width:424.7pt; border-collapse:collapse; border:solid windowtext 1.0pt\" width=\"708\">\r\n	<tbody>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#00b0f0; width:139.45pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"232\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:white\">DEPORTE</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#00b0f0; width:158.0pt; border-left:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"263\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b>&nbsp;</b></span></span></span></p>\r\n			</td>\r\n			<td style=\"border:solid windowtext 1.0pt; background:#00b0f0; width:127.25pt; border-left:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"top\" width=\"212\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\">&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:18.75pt\">\r\n			<td nowrap=\"nowrap\" style=\"border-bottom:none; background:#fde9d9; width:139.45pt; border-top:none; border-left:solid windowtext 1.0pt; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:18.75pt\" width=\"232\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><u><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:black\">DISCIPLINA</span></span></u></b></span></span></span></p>\r\n			</td>\r\n			<td nowrap=\"nowrap\" style=\"border:none; background:#fde9d9; width:158.0pt; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:18.75pt\" width=\"263\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><u><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:black\">PUNTAJE HOMBRES</span></span></u></b></span></span></span></p>\r\n			</td>\r\n			<td style=\"border:none; background:#fde9d9; width:127.25pt; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:18.75pt\" valign=\"top\" width=\"212\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><u><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:black\">PUNTAJE MUJERES</span></span></u></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:black\">Nataci&oacute;n</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:158.0pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"263\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">25</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td style=\"border-bottom:solid windowtext 1.0pt; width:127.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"top\" width=\"212\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">25</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:black\">Velocidad</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:158.0pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"263\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">15</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td style=\"border-bottom:solid windowtext 1.0pt; width:127.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"top\" width=\"212\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">15</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:black\">Fulbito</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:158.0pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"263\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">15</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td style=\"border-bottom:solid windowtext 1.0pt; width:127.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"top\" width=\"212\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">-----</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:black\">Futbol sala</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:158.0pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"263\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">15</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td style=\"border-bottom:solid windowtext 1.0pt; width:127.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"top\" width=\"212\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">20</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:black\">B&aacute;squet</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:158.0pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"263\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">15</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td style=\"border-bottom:solid windowtext 1.0pt; width:127.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"top\" width=\"212\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">15</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:black\">V&oacute;ley</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:158.0pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"263\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">10</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td style=\"border-bottom:solid windowtext 1.0pt; width:127.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"top\" width=\"212\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">-----</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:red\">Camiseta Mojadas</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td colspan=\"2\" nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:285.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"475\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:red\">30</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:14.0pt\"><span style=\"color:black\">Gymkana</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td colspan=\"2\" nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:285.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"475\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">30</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">Slogan</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td colspan=\"2\" nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:285.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"475\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">15</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">Mascota</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td colspan=\"2\" nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:285.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"475\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">20</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">Madrina</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td colspan=\"2\" nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:285.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"475\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">30</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr style=\"height:21.0pt\">\r\n			<td nowrap=\"nowrap\" style=\"border:solid windowtext 1.0pt; background:#fde9d9; width:139.45pt; border-top:none; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" valign=\"bottom\" width=\"232\">\r\n			<p style=\"margin-bottom:.0001pt; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">Mejor Uniformado</span></span></b></span></span></span></p>\r\n			</td>\r\n			<td colspan=\"2\" nowrap=\"nowrap\" style=\"border-bottom:solid windowtext 1.0pt; width:285.25pt; border-top:none; border-left:none; border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt; height:21.0pt\" width=\"475\">\r\n			<p align=\"center\" style=\"margin-bottom:.0001pt; text-align:center; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:16.0pt\"><span style=\"color:black\">15</span></span></b></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\">&nbsp;</p>\r\n\r\n<ol start=\"8\">\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">El curso con la mayor cantidad de puntos se har&aacute; acreedor a la copa que los corona como el GRAN CAMPE&Oacute;N de la carrera de Ingenier&iacute;a de Sistemas.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">La mascota no pude ser un animal ni ning&uacute;n ni&ntilde;o, la mascota debe ser una persona disfraza considerando que el disfraz sea referente a la inform&aacute;tica.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Para el concurso de camisetas mojadas deber&aacute;n participar en pareja un hombre y una mujer, donde los participantes hombres deber&aacute;n usar una camiseta blanca y pantaloneta, mientras que las mujeres deben usar blusa blanca y licra. </span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Para el concurso de gincana cada equipo deber&aacute; inscribir como m&iacute;nimo una mujer. Ejemplo: (2 hombres y 1 mujer) (1 hombre y 2 mujeres).</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Los juegos de la gincana se har&aacute;n conocer el d&iacute;a del evento.</span></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Futbol (Solo se pueden inscribir 10 jugadores)</span></span></span></b></span></span></span></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Cada equipo debe presentarse correctamente uniformado.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Solo podr&aacute;n jugar las personas que est&eacute;n registradas en la hoja de inscripci&oacute;n anteriormente dada m&aacute;s su dirigente de curso.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Cada equipo deber&aacute; presentarse con un m&aacute;ximo de 7 jugadores incluido el arquero y un m&iacute;nimo de 5 jugadores.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Todo jugador que le saquen tarjeta ROJA no podr&aacute; jugar el siguiente partido.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Se jugar&aacute;n 2 tiempos cada uno de 15 min con un descanso de 5 min.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Si al finalizar el encuentro quedan iguales en goles se realizar&aacute; una tanda de 3 penales por equipo, si despu&eacute;s de esto a&uacute;n siguen empatados se realizar&aacute; un penal por cada equipo a muerte s&uacute;bita. </span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Todos los partidos son a eliminaci&oacute;n directa.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">El equipo podr&aacute; realizar N cambios.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Al primer lugar se premiar&aacute; con medallas de Oro, y un trofeo.&nbsp; Al segundo lugar se premiar&aacute; con medallas de plata.</span></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">B&aacute;squet (Solo se pueden inscribir 8 jugadores)</span></span></span></b></span></span></span></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Todo equipo debe presentarse correctamente uniformado, con un m&iacute;nimo de 4 jugadores.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">El equipo podr&aacute; realizar N cambios.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Solo podr&aacute;n jugar las personas que est&eacute;n registradas en la hoja de inscripci&oacute;n anteriormente dada.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Se jugar&aacute;n dos tiempos de 15min y un descanso de 5 minutos.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Se permitir&aacute; dos minutos libres en el partido (tiempos muertos) por equipo.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Jugador con tres faltas ser&aacute; expulsado del partido, &ldquo;luego de ello por cada falta ser&aacute;n realizados dos tiros libres por el equipo contrario&rdquo;.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Todos los partidos son a eliminaci&oacute;n directa</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Al primer lugar se premiar&aacute; con&nbsp; medallas de Oro, y un trofeo.&nbsp; Al segundo lugar se premiar&aacute; con medallas de plata</span></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">V&oacute;ley (Solo se pueden inscribir 5 jugadores)</span></span></span></b></span></span></span></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Todo equipo debe presentarse correctamente uniformado.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Solo se permitir&aacute; 3 cambios.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">El jugador puede entrar y salir.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Se realizar&aacute;n 2 sets de 10 puntos cada uno, en caso de empate un set &nbsp;adicional de 8 puntos. </span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Todos los partidos son a eliminaci&oacute;n directa</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Al primer lugar se premiar&aacute; con&nbsp; medallas de Oro, y un trofeo.&nbsp; Al segundo lugar se premiar&aacute; con medallas de plata.</span></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Indor (Solo se pueden inscribir 7 jugadores)</span></span></span></b></span></span></span></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Cada equipo debe presentarse correctamente uniformado.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Solo podr&aacute;n participar los estudiantes que est&eacute;n registrados en las hojas de inscripci&oacute;n.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Cada equipo deber&aacute; presentarse m&aacute;ximo con 5 jugadores y un m&iacute;nimo de 4.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Cada periodo de tiempo ser&aacute; de 15 min. Con un descanso de 5min.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">El jugador que reciba tarjeta roja no podr&aacute; jugar el siguiente partido.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Si al finalizar el encuentro quedan iguales en goles se realizar&aacute; una tanda de 3 penales por equipo, si despu&eacute;s se esto a&uacute;n siguen empatados se realizar&aacute; un penal por equipo a muerte s&uacute;bita.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Todos los partidos son a eliminaci&oacute;n directa.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">El equipo podr&aacute; realizar N cambios.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Al primer lugar se premiar&aacute; con&nbsp; medallas de Oro, y un trofeo.&nbsp; Al segundo lugar se premiar&aacute; con medallas de plata</span></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Nataci&oacute;n (Solo se pueden inscribir 3 jugadores)</span></span></span></b></span></span></span></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Para esta disciplina deben participar 3 personas.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">La modalidad de nado ser&aacute; estilo libre y en postas.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Al existir solo 2 integrantes por equipo les tocar&aacute; participar 2 veces a uno de ellos.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">En cada tanda de competencia pasar&aacute; a la siguiente ronda &uacute;nicamente el equipo con mejor tiempo.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Los equipos con mejor tiempo se enfrentar&aacute;n quedando como ganador el que realice el mejor tiempo.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Al primer lugar se premiar&aacute; con&nbsp; medallas de Oro, y un trofeo.&nbsp; Al segundo lugar se premiar&aacute; con medallas de plata</span></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Velocidad con postas (Solo se pueden inscribir 3 jugadores)</span></span></span></b></span></span></span></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Para esta disciplina deben participar 3 personas.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0.0001pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">La distancia a correr ser&aacute; de 100m. en postas. </span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"ES-EC\" style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Al primer lugar se premiar&aacute; con&nbsp; medallas de Oro, y un trofeo.&nbsp; Al segundo lugar se premiar&aacute; con medallas de plata</span></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify; margin:0cm 0cm 8pt\">&nbsp;</p>', 'reglas', 'page', 2, 0, '2018-11-06 23:46:40', '2018-11-14 22:30:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL DEFAULT '0',
  `dni` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL DEFAULT '0',
  `observations` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `organization_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `players_organization_id_foreign` (`organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `players`
--

INSERT INTO `players` (`id`, `name`, `last_name`, `age`, `dni`, `type`, `number`, `observations`, `created_at`, `updated_at`, `organization_id`) VALUES
(2, 'Edison', 'Chamba', 18, '0000000000', 'Male', 0, NULL, '2018-11-04 01:52:50', '2018-11-04 01:52:50', 1),
(3, 'Yereel', 'Mendoza', 18, '0000000000', 'Male', 0, NULL, '2018-11-04 01:53:22', '2018-11-04 01:53:22', 1),
(4, 'Peter', 'Guerrero', 18, '0000000000', 'Male', 0, NULL, '2018-11-04 01:54:52', '2018-11-04 01:54:52', 1),
(5, 'Fernando', 'Mejía', 18, '0', 'Male', 0, NULL, '2018-11-04 01:55:49', '2018-11-04 01:55:49', 1),
(6, 'Brandon', 'Mendieta', 18, '0', 'Male', 0, NULL, '2018-11-04 01:56:08', '2018-11-04 01:56:08', 1),
(7, 'Javier', 'Torres', 18, '0', 'Male', 0, NULL, '2018-11-04 01:56:20', '2018-11-04 01:56:20', 1),
(8, 'Fernando', 'Ochoa', 18, '0', 'Male', 0, NULL, '2018-11-04 01:56:33', '2018-11-04 01:56:33', 1),
(9, 'Salviano', 'Nuñez', 18, '0', 'Male', 0, NULL, '2018-11-04 01:56:49', '2018-11-04 01:56:49', 1),
(10, 'Wilson', 'Paredes', 18, '0', 'Male', 0, NULL, '2018-11-04 01:57:10', '2018-11-04 01:57:10', 1),
(11, 'David', 'Martillo', 18, '0', 'Male', 0, NULL, '2018-11-04 01:57:25', '2018-11-04 01:57:25', 1),
(12, 'Gabriel', 'Vega', 18, '0', 'Male', 0, NULL, '2018-11-04 01:57:36', '2018-11-04 01:57:36', 1),
(13, 'Jordi', 'Guerrero', 18, '0', 'Male', 0, NULL, '2018-11-04 01:57:53', '2018-11-04 01:57:53', 1),
(14, 'Jhon', 'Alvarado', 18, '0', 'Male', 0, NULL, '2018-11-04 01:58:07', '2018-11-04 01:58:07', 1),
(15, 'Kevin', 'Pastor', 18, '0', 'Male', 0, NULL, '2018-11-04 01:58:41', '2018-11-04 01:58:41', 1),
(16, 'Gabriel', 'Chero', 18, '0', 'Male', 0, NULL, '2018-11-04 01:58:52', '2018-11-04 01:58:52', 1),
(17, 'Fabricio', 'Garcia', 18, '0', 'Male', 0, NULL, '2018-11-04 01:59:07', '2018-11-04 01:59:07', 1),
(18, 'Luis', 'Vinces', 18, '0', 'Male', 0, NULL, '2018-11-04 01:59:21', '2018-11-04 01:59:21', 1),
(19, 'Kevin', 'Gavilanez', 18, '0', 'Male', 0, NULL, '2018-11-04 01:59:35', '2018-11-04 01:59:35', 1),
(20, 'Allan', 'Poma', 18, '0', 'Male', 0, NULL, '2018-11-04 01:59:54', '2018-11-04 01:59:54', 1),
(21, 'Leiver', 'Palomeque', 18, '0', 'Male', 0, NULL, '2018-11-04 02:00:05', '2018-11-04 02:00:05', 1),
(22, 'Marlon', 'Palma', 18, '0', 'Male', 0, NULL, '2018-11-04 02:00:20', '2018-11-04 02:00:20', 1),
(23, 'Jorge', 'Iñiguez', 18, '0', 'Male', 0, NULL, '2018-11-04 02:00:35', '2018-11-04 02:00:35', 1),
(24, 'Felipe', 'Montero', 18, '0', 'Male', 0, NULL, '2018-11-04 02:00:47', '2018-11-04 02:00:47', 1),
(25, 'Calos', 'Jumbo', 18, '0', 'Male', 0, NULL, '2018-11-04 02:01:22', '2018-11-04 02:01:22', 1),
(26, 'Jayro', 'Jimenez', 18, '0', 'Male', 0, NULL, '2018-11-04 02:01:34', '2018-11-04 02:01:34', 1),
(27, 'Edison', 'Erraez', 18, '0', 'Male', 0, NULL, '2018-11-04 02:01:44', '2018-11-04 02:01:44', 1),
(28, 'Rafael', 'Mendieta', 18, '0', 'Male', 0, NULL, '2018-11-04 02:01:56', '2018-11-04 02:01:56', 1),
(29, 'Segundo', 'Jaramillo', 18, '0', 'Male', 0, NULL, '2018-11-04 02:02:12', '2018-11-04 02:02:12', 1),
(30, 'Cristian', 'Chimbolema', 18, '0', 'Male', 0, NULL, '2018-11-04 02:02:25', '2018-11-04 02:02:25', 1),
(31, 'Lakeisha', 'Ochoa', 18, '0', 'Female', 0, NULL, '2018-11-13 04:59:49', '2018-11-13 04:59:49', 1),
(32, 'Stefany', 'Pallaroso', 18, '0', 'Female', 0, NULL, '2018-11-13 05:00:12', '2018-11-13 05:00:12', 1),
(33, 'Jennifer', 'Carchi', 18, '0', 'Female', 0, NULL, '2018-11-13 05:00:49', '2018-11-13 05:00:49', 1),
(34, 'Arely', 'Martinez', 18, '0', 'Female', 0, NULL, '2018-11-13 05:01:18', '2018-11-13 05:01:18', 1),
(35, 'Lady', 'Armijos', 18, '0', 'Female', 0, NULL, '2018-11-13 05:01:35', '2018-11-13 05:01:35', 1),
(36, 'Génesis', 'Chimbo', 18, '0', 'Female', 0, NULL, '2018-11-13 05:01:51', '2018-11-13 05:01:51', 1),
(37, 'Dayana', 'Tigre', 18, '0', 'Female', 12, NULL, '2018-11-13 05:02:06', '2018-11-14 00:46:53', 1),
(38, 'Gabriela', 'Astudillo', 18, '0', 'Female', 0, NULL, '2018-11-13 05:02:41', '2018-11-13 05:02:41', 1),
(39, 'Silvia', 'Cabrera', 18, '0', 'Female', 0, NULL, '2018-11-13 05:02:58', '2018-11-13 05:02:58', 1),
(40, 'Elisa', 'Espinoza', 18, '0', 'Female', 0, NULL, '2018-11-13 05:03:12', '2018-11-13 05:03:12', 1),
(41, 'Amelia', 'Labanda', 18, '0', 'Female', 0, NULL, '2018-11-13 05:03:26', '2018-11-13 05:03:26', 1),
(42, 'Jazmin', 'Orellana', 18, '0', 'Female', 0, NULL, '2018-11-13 05:03:40', '2018-11-13 05:03:40', 1),
(43, 'Xiomara', 'Pinos', 18, '0', 'Female', 0, NULL, '2018-11-13 05:03:52', '2018-11-13 05:03:52', 1),
(44, 'Ginger', 'Vasquez', 18, '0', 'Female', 0, NULL, '2018-11-13 05:04:06', '2018-11-13 05:04:06', 1),
(45, 'Meybi', 'Bermeo', 18, '0', 'Female', 0, NULL, '2018-11-13 05:04:29', '2018-11-13 05:04:29', 1),
(46, 'Roxanna', 'Quezada', 18, '0', 'Female', 0, NULL, '2018-11-13 05:04:46', '2018-11-13 05:04:46', 1),
(47, 'Rosa', 'Guachamín', 18, '0', 'Female', 0, NULL, '2018-11-13 05:05:02', '2018-11-13 05:05:02', 1),
(48, 'Fernanda', 'Suarez', 18, '0', 'Female', 0, NULL, '2018-11-13 05:05:16', '2018-11-13 05:05:16', 1),
(49, 'Jeniffer', 'Herrera', 18, '0', 'Female', 0, NULL, '2018-11-13 05:05:28', '2018-11-13 05:05:28', 1),
(50, 'Amanda', 'Luzuriaga', 18, '0', 'Female', 0, NULL, '2018-11-13 05:05:40', '2018-11-13 05:05:40', 1),
(51, 'Jazmin', 'Eras', 18, '0', 'Female', 0, NULL, '2018-11-13 05:05:52', '2018-11-13 05:05:52', 1),
(52, 'Melanie', 'Ochoa', 18, '0', 'Female', 0, NULL, '2018-11-13 05:06:25', '2018-11-13 05:06:25', 1),
(53, 'Maria', 'Contento', 18, '0', 'Female', 0, NULL, '2018-11-13 05:06:36', '2018-11-13 05:06:36', 1),
(54, 'Maria', 'Ramirez', 18, '0', 'Female', 0, NULL, '2018-11-13 05:06:48', '2018-11-13 05:06:48', 1),
(55, 'Susy', 'Fernandez', 18, '0', 'Female', 0, NULL, '2018-11-13 05:07:01', '2018-11-13 05:07:01', 1),
(56, 'Heydi', 'MIte', 18, '0', 'Female', 0, NULL, '2018-11-13 05:07:13', '2018-11-13 05:07:13', 1),
(57, 'Ximena', 'Pacheco', 18, '0', 'Female', 0, NULL, '2018-11-13 05:07:26', '2018-11-13 05:07:26', 1),
(58, 'María', 'Jimenez', 18, '0', 'Female', 0, NULL, '2018-11-13 05:07:40', '2018-11-13 05:07:40', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `player_teams`
--

DROP TABLE IF EXISTS `player_teams`;
CREATE TABLE IF NOT EXISTS `player_teams` (
  `team_id` int(10) UNSIGNED NOT NULL,
  `player_id` int(10) UNSIGNED NOT NULL,
  KEY `player_teams_team_id_foreign` (`team_id`),
  KEY `player_teams_player_id_foreign` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `player_teams`
--

INSERT INTO `player_teams` (`team_id`, `player_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(13, 15),
(13, 16),
(13, 17),
(13, 18),
(13, 19),
(13, 20),
(13, 21),
(13, 22),
(13, 23),
(13, 24),
(12, 25),
(12, 26),
(12, 27),
(12, 28),
(12, 29),
(12, 30),
(14, 31),
(14, 32),
(14, 33),
(14, 34),
(14, 35),
(14, 36),
(14, 37),
(15, 38),
(15, 39),
(15, 40),
(15, 41),
(15, 42),
(15, 43),
(15, 44),
(16, 45),
(16, 46),
(16, 47),
(16, 48),
(16, 49),
(16, 50),
(16, 51),
(17, 52),
(17, 53),
(17, 54),
(17, 55),
(17, 56),
(17, 57),
(17, 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `result_a` int(11) NOT NULL DEFAULT '0',
  `result_b` int(11) NOT NULL DEFAULT '0',
  `penal_a` int(11) NOT NULL DEFAULT '0',
  `penal_b` int(11) NOT NULL DEFAULT '0',
  `others_points` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_table_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `results_time_table_id_foreign` (`time_table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `results`
--

INSERT INTO `results` (`id`, `result_a`, `result_b`, `penal_a`, `penal_b`, `others_points`, `desc`, `time_table_id`) VALUES
(1, 2, 1, 0, 0, NULL, NULL, 15),
(2, 3, 4, 0, 0, NULL, NULL, 1),
(3, 3, 2, 0, 0, NULL, NULL, 19),
(4, 3, 3, 0, 0, NULL, NULL, 18),
(5, 1, 3, 0, 0, NULL, NULL, 16),
(6, 1, 2, 0, 0, NULL, NULL, 17),
(7, 0, 2, 0, 0, NULL, NULL, 20),
(8, 3, 3, 4, 5, NULL, NULL, 50),
(9, 12, 9, 0, 0, NULL, NULL, 40),
(10, 10, 12, 0, 0, NULL, NULL, 43),
(11, 15, 12, 0, 0, NULL, NULL, 46),
(12, 16, 14, 0, 0, NULL, NULL, 49),
(13, 15, 10, 0, 0, NULL, NULL, 41),
(14, 12, 8, 0, 0, NULL, NULL, 44),
(15, 12, 11, 0, 0, NULL, NULL, 47),
(16, 10, 12, 0, 0, NULL, NULL, 42),
(17, 12, 8, 0, 0, NULL, NULL, 45),
(18, 14, 15, 0, 0, NULL, NULL, 48),
(19, 5, 4, 0, 0, NULL, NULL, 2),
(20, 2, 4, 0, 0, NULL, NULL, 3),
(21, 2, 2, 4, 3, NULL, NULL, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sports`
--

DROP TABLE IF EXISTS `sports`;
CREATE TABLE IF NOT EXISTS `sports` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `min_players` int(11) NOT NULL DEFAULT '0',
  `max_players` int(11) NOT NULL DEFAULT '0',
  `denomination` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Goals, Points',
  `rules` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sports`
--

INSERT INTO `sports` (`id`, `name`, `duration`, `status`, `min_players`, `max_players`, `denomination`, `rules`, `logo`) VALUES
(1, 'Fútbol', '20.00', 1, 5, 7, 'Goles', 'Ninguna', NULL),
(2, 'Basket', '20.00', 1, 3, 5, 'Putos', 'Ninguna', NULL),
(3, 'Volley', '-1.00', 1, 3, 3, 'Puntos', 'Ninguna', NULL),
(4, 'Futsal', '20.00', 1, 4, 6, 'Goles', 'Ninguno', 'logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stages`
--

DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `match_num` int(11) NOT NULL DEFAULT '0',
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '-1',
  `tournament_id` int(10) UNSIGNED NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `stages_tournament_id_foreign` (`tournament_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `stages`
--

INSERT INTO `stages` (`id`, `name`, `match_num`, `desc`, `status`, `tournament_id`, `parent`) VALUES
(1, 'SemiFinal', 2, 'Fútbol Masculino', -1, 1, 0),
(2, 'Final', 1, 'Fútbol Masculino', -1, 1, 1),
(3, 'Etapa Final', 1, 'Final Futsal', -1, 2, 0),
(4, 'Fase Final', 1, 'Fase Final de Basket Femenino', -1, 3, 0),
(5, 'Semifinal', 2, 'Semifinal Basket Masculino', -1, 4, 0),
(6, 'Final', 1, 'Final Basket Masculino', -1, 4, 5),
(7, 'Semifinal', 2, 'Semifinal Voley', -1, 5, 0),
(8, 'Final', 1, 'Final de voley', -1, 5, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stage_controls`
--

DROP TABLE IF EXISTS `stage_controls`;
CREATE TABLE IF NOT EXISTS `stage_controls` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `team_old` int(11) NOT NULL,
  `team_new` int(11) NOT NULL,
  `time_table_id` int(10) UNSIGNED NOT NULL,
  `team` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stage_controls_time_table_id_foreign` (`time_table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `stage_controls`
--

INSERT INTO `stage_controls` (`id`, `team_old`, `team_new`, `time_table_id`, `team`) VALUES
(26, 45, 10, 50, 'team_a'),
(27, 46, 8, 50, 'team_b'),
(28, 51, 16, 53, 'team_a'),
(30, 52, 15, 53, 'team_b'),
(31, 49, 8, 52, 'team_a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yellow` int(11) NOT NULL DEFAULT '0',
  `red` int(11) NOT NULL DEFAULT '0',
  `goals` int(11) NOT NULL DEFAULT '0',
  `value` int(11) NOT NULL DEFAULT '0' COMMENT 'additional value',
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tournament_id` int(10) UNSIGNED NOT NULL,
  `player_id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `time_table_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stats_tournament_id_foreign` (`tournament_id`),
  KEY `stats_player_id_foreign` (`player_id`),
  KEY `stats_team_id_foreign` (`team_id`),
  KEY `stats_time_table_id_foreign` (`time_table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `stats`
--

INSERT INTO `stats` (`id`, `yellow`, `red`, `goals`, `value`, `observation`, `tournament_id`, `player_id`, `team_id`, `time_table_id`) VALUES
(3, 0, 0, 2, 0, '', 2, 57, 17, 15),
(5, 0, 0, 1, 0, '', 2, 50, 16, 19),
(6, 0, 0, 2, 0, '', 2, 56, 17, 19),
(7, 0, 0, 1, 0, '', 2, 49, 16, 19),
(9, 0, 0, 3, 0, '', 2, 37, 14, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_id` int(10) UNSIGNED NOT NULL,
  `sport_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_organization_id_foreign` (`organization_id`),
  KEY `teams_sport_id_foreign` (`sport_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `teams`
--

INSERT INTO `teams` (`id`, `name`, `alias`, `type`, `logo`, `organization_id`, `sport_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Primero \"A\"', '1A', 'Male', '#146b3c', 1, 1, 1, '2018-10-29 20:21:47', '2018-11-12 02:28:46'),
(3, 'Primero \"B\"', '1B', 'Male', '#d0355c', 1, 1, 1, '2018-11-04 00:35:03', '2018-11-12 02:29:06'),
(4, 'Segundo \"A\"', '2A', 'Male', '#e4a561', 1, 1, 1, '2018-11-04 00:35:55', '2018-11-12 02:29:34'),
(5, 'Segundo \"B\"', '2B', 'Male', '#1a73a5', 1, 1, 1, '2018-11-04 00:36:36', '2018-11-12 02:29:44'),
(6, 'Tercero \"A\"', '3A', 'Male', '#0068d6', 1, 1, 1, '2018-11-04 00:37:10', '2018-11-12 02:29:59'),
(7, 'Cuarto \"A\"', '4A', 'Male', '#04948d', 1, 1, 1, '2018-11-04 00:37:47', '2018-11-12 02:30:15'),
(8, 'Quinto \"A\"', '5A', 'Male', '#52669a', 1, 1, 1, '2018-11-04 00:38:56', '2018-11-12 02:30:19'),
(9, 'Sexto \"A\"', '6A', 'Male', '#17baf4', 1, 1, 1, '2018-11-04 00:39:37', '2018-11-12 02:30:23'),
(10, 'Séptimo \"A\"', '7A', 'Male', '#41759d', 1, 1, 1, '2018-11-04 00:40:00', '2018-11-12 02:30:29'),
(11, 'Octavo \"A\"', '8A', 'Male', '#f14742', 1, 1, 1, '2018-11-04 00:40:46', '2018-11-12 02:30:33'),
(12, 'Noveno \"A\"', '9A', 'Male', '#00466f', 1, 1, 1, '2018-11-04 00:41:08', '2018-11-12 02:30:37'),
(13, 'Décimo \"A\"', '10A', 'Male', '#0491ab', 1, 1, 1, '2018-11-04 00:41:43', '2018-11-12 02:30:41'),
(14, 'Segundo \"A\"', '2A', 'Female', '#e4a561', 1, 4, 1, '2018-11-05 09:30:04', '2018-11-12 02:27:06'),
(15, 'Séptimo \"A\"', '7A', 'Female', '#41759d', 1, 4, 1, '2018-11-05 09:30:45', '2018-11-12 02:27:19'),
(16, 'Noveno \"A\"', '9A', 'Female', '#00466f', 1, 4, 1, '2018-11-05 09:31:13', '2018-11-12 02:27:36'),
(17, 'Décimo \"A\"', '10A', 'Female', '#0491ab', 1, 4, 1, '2018-11-05 09:32:05', '2018-11-12 02:27:50'),
(18, 'Segundo \"A\"', '2A', 'Female', '#e4a561', 1, 2, 1, '2018-11-12 00:07:57', '2018-11-12 00:12:13'),
(19, 'Séptimo \"A\"', '7A', 'Female', '#41759d', 1, 2, 1, '2018-11-12 00:09:11', '2018-11-12 00:12:44'),
(20, 'Noveno \"A\"', '9A', 'Female', '#00466f', 1, 2, 1, '2018-11-12 00:09:28', '2018-11-12 00:09:28'),
(21, 'Décimo \"A\"', '10A', 'Female', '#0491ab', 1, 2, 1, '2018-11-12 00:09:50', '2018-11-12 00:59:43'),
(22, 'Primero \"A\"', '1A', 'Male', '#146b3c', 1, 2, 1, '2018-11-12 01:01:09', '2018-11-12 01:01:09'),
(23, 'Primero \"B\"', '1B', 'Male', '#d0355c', 1, 2, 1, '2018-11-12 01:01:29', '2018-11-12 01:01:29'),
(24, 'Segundo \"A\"', '2A', 'Male', '#e4a561', 1, 2, 1, '2018-11-12 01:02:38', '2018-11-12 01:02:38'),
(25, 'Segundo \"B\"', '2B', 'Male', '#1a73a5', 1, 2, 1, '2018-11-12 01:02:59', '2018-11-12 01:02:59'),
(26, 'Tercero \"A\"', '3A', 'Male', '#0068d6', 1, 2, 1, '2018-11-12 01:03:25', '2018-11-12 01:03:25'),
(27, 'Cuarto \"A\"', '4A', 'Male', '#04948d', 1, 2, 1, '2018-11-12 01:03:58', '2018-11-12 01:03:58'),
(28, 'Quinto \"A\"', '5A', 'Male', '#52669a', 1, 2, 1, '2018-11-12 01:04:19', '2018-11-12 01:04:19'),
(29, 'Sexto \"A\"', '6A', 'Male', '#17baf4', 1, 2, 1, '2018-11-12 01:04:41', '2018-11-12 01:04:41'),
(30, 'Séptimo \"A\"', '7A', 'Male', '#41759d', 1, 2, 1, '2018-11-12 01:04:59', '2018-11-12 01:04:59'),
(31, 'Octavo \"A\"', '8A', 'Male', '#f14742', 1, 2, 1, '2018-11-12 01:05:16', '2018-11-12 01:05:16'),
(32, 'Noveno \"A\"', '9A', 'Male', '#00466f', 1, 2, 1, '2018-11-12 01:05:29', '2018-11-12 01:05:29'),
(33, 'Décimo \"A\"', '10A', 'Male', '#0491ab', 1, 2, 1, '2018-11-12 01:05:57', '2018-11-12 01:06:27'),
(34, 'Primero \"A\"', '1A', 'Male', '#146b3c', 1, 3, 1, '2018-11-12 01:38:11', '2018-11-12 01:38:11'),
(35, 'Primero \"B\"', '1B', 'Male', '#d0355c', 1, 3, 1, '2018-11-12 01:38:27', '2018-11-12 01:38:27'),
(36, 'Segundo \"A\"', '2A', 'Male', '#e4a561', 1, 3, 1, '2018-11-12 01:39:28', '2018-11-12 01:39:28'),
(37, 'Segundo \"B\"', '2B', 'Male', '#1a73a5', 1, 3, 1, '2018-11-12 01:39:48', '2018-11-12 01:39:48'),
(38, 'Tercero \"A\"', '3A', 'Male', '#0068d6', 1, 3, 1, '2018-11-12 01:40:03', '2018-11-12 01:40:03'),
(39, 'Cuarto \"A\"', '4A', 'Male', '#04948d', 1, 3, 1, '2018-11-12 01:40:15', '2018-11-12 01:40:15'),
(40, 'Quinto \"A\"', '5A', 'Male', '#52669a', 1, 3, 1, '2018-11-12 01:40:23', '2018-11-12 01:40:23'),
(41, 'Sexto \"A\"', '6A', 'Male', '#17baf4', 1, 3, 1, '2018-11-12 01:40:36', '2018-11-12 01:40:36'),
(42, 'Octavo \"A\"', '8A', 'Male', '#f14742', 1, 3, 1, '2018-11-12 01:40:48', '2018-11-12 01:40:48'),
(43, 'Noveno \"A\"', '9A', 'Male', '#00466f', 1, 3, 1, '2018-11-12 01:41:02', '2018-11-12 01:41:02'),
(44, 'Décimo \"A\"', '10A', 'Male', '#0491ab', 1, 3, 1, '2018-11-12 01:41:16', '2018-11-12 01:41:16'),
(45, 'Ganador Grupo A', 'Ganador Grupo A', 'Male', '#256298', 1, 1, 0, '2018-11-12 18:21:44', '2018-11-12 18:21:44'),
(46, 'Ganador Grupo B', 'Ganador Grupo B', 'Male', '#256298', 1, 1, 0, '2018-11-12 18:21:44', '2018-11-12 18:21:44'),
(47, 'Ganador Grupo C', 'Ganador Grupo C', 'Male', '#256298', 1, 1, 0, '2018-11-12 18:40:02', '2018-11-12 18:40:02'),
(48, 'Ganador Grupo D', 'Ganador Grupo D', 'Male', '#256298', 1, 1, 0, '2018-11-12 18:40:02', '2018-11-12 18:40:02'),
(49, 'Ganador #1', 'Ganador #1', 'Male', '#256298', 1, 1, 0, '2018-11-12 18:43:08', '2018-11-12 18:43:08'),
(50, 'Ganador #2', 'Ganador #2', 'Male', '#256298', 1, 1, 0, '2018-11-12 18:43:08', '2018-11-12 18:43:08'),
(51, '1er Mejor', '1er Mejor', 'Female', '#256298', 1, 4, 0, '2018-11-12 21:29:32', '2018-11-12 21:29:32'),
(52, '2do Mejor', '2do Mejor', 'Female', '#256298', 1, 4, 0, '2018-11-12 21:29:32', '2018-11-12 21:29:32'),
(53, '1ero Mejor', '1ero Mejor', 'Female', '#256298', 1, 2, 0, '2018-11-13 01:36:05', '2018-11-13 01:36:05'),
(54, '2do Mejor', '2do Mejor', 'Female', '#256298', 1, 2, 0, '2018-11-13 01:36:05', '2018-11-13 01:36:05'),
(55, 'Ganador Grupo A', 'Ganador Grupo A', 'Male', '#256298', 1, 2, 0, '2018-11-13 01:39:05', '2018-11-13 01:39:05'),
(56, 'Ganador Grupo B', 'Ganador Grupo B', 'Male', '#256298', 1, 2, 0, '2018-11-13 01:39:05', '2018-11-13 01:39:05'),
(57, 'Ganador Grupo C', 'Ganador Grupo C', 'Male', '#256298', 1, 2, 0, '2018-11-13 01:39:28', '2018-11-13 01:39:28'),
(58, 'Ganador Grupo D', 'Ganador Grupo D', 'Male', '#256298', 1, 2, 0, '2018-11-13 01:39:28', '2018-11-13 01:39:28'),
(59, 'Ganador Sem. #1', 'Ganador Sem. #1', 'Male', '#256298', 1, 2, 0, '2018-11-13 01:40:27', '2018-11-13 01:40:27'),
(60, 'Ganador Sem. #2', 'Ganador Sem. #2', 'Male', '#256298', 1, 2, 0, '2018-11-13 01:40:27', '2018-11-13 01:40:27'),
(61, 'Ganador Grupo A', 'Ganador Grupo A', 'Male', '#256298', 1, 3, 0, '2018-11-13 01:53:48', '2018-11-13 01:53:48'),
(62, 'Ganador Grupo C', 'Ganador Grupo C', 'Male', '#256298', 1, 3, 0, '2018-11-13 01:53:48', '2018-11-13 01:53:48'),
(63, 'Ganador Grupo B', 'Ganador Grupo B', 'Male', '#256298', 1, 3, 0, '2018-11-13 01:54:20', '2018-11-13 01:54:20'),
(64, 'Ganador Grupo D', 'Ganador Grupo D', 'Male', '#256298', 1, 3, 0, '2018-11-13 01:54:20', '2018-11-13 01:54:20'),
(65, 'Ganador Sem. #1', 'Ganador Sem. #1', 'Male', '#256298', 1, 3, 0, '2018-11-13 01:54:54', '2018-11-13 01:54:54'),
(66, 'Ganador Sem. #2', 'Ganador Sem. #2', 'Male', '#256298', 1, 3, 0, '2018-11-13 01:54:54', '2018-11-13 01:54:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team_groups`
--

DROP TABLE IF EXISTS `team_groups`;
CREATE TABLE IF NOT EXISTS `team_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pj` int(11) NOT NULL DEFAULT '0',
  `gf` int(11) NOT NULL DEFAULT '0',
  `gc` int(11) NOT NULL DEFAULT '0',
  `pts` int(11) NOT NULL DEFAULT '0',
  `pg` int(11) NOT NULL DEFAULT '0',
  `pe` int(11) NOT NULL DEFAULT '0',
  `pp` int(11) NOT NULL DEFAULT '0',
  `group_id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_groups_team_id_foreign` (`team_id`),
  KEY `team_groups_group_id_foreign` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `team_groups`
--

INSERT INTO `team_groups` (`id`, `pj`, `gf`, `gc`, `pts`, `pg`, `pe`, `pp`, `group_id`, `team_id`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 1, 7, '2018-11-04 00:43:16', '2018-11-14 22:38:31'),
(2, 0, 0, 0, 0, 0, 0, 0, 1, 4, '2018-11-04 00:43:16', '2018-11-14 22:38:32'),
(3, 0, 0, 0, 0, 0, 0, 0, 1, 10, '2018-11-04 00:43:17', '2018-11-14 22:38:33'),
(4, 0, 0, 0, 0, 0, 0, 0, 2, 5, '2018-11-04 00:44:10', '2018-11-04 00:44:10'),
(5, 0, 0, 0, 0, 0, 0, 0, 2, 6, '2018-11-04 00:44:10', '2018-11-04 00:44:10'),
(6, 0, 0, 0, 0, 0, 0, 0, 2, 8, '2018-11-04 00:44:10', '2018-11-04 00:44:10'),
(7, 0, 0, 0, 0, 0, 0, 0, 3, 13, '2018-11-04 00:44:47', '2018-11-04 00:44:47'),
(8, 0, 0, 0, 0, 0, 0, 0, 3, 3, '2018-11-04 00:44:48', '2018-11-04 00:44:48'),
(9, 0, 0, 0, 0, 0, 0, 0, 3, 11, '2018-11-04 00:44:48', '2018-11-04 00:44:48'),
(10, 0, 0, 0, 0, 0, 0, 0, 4, 12, '2018-11-04 00:45:11', '2018-11-04 00:45:11'),
(11, 0, 0, 0, 0, 0, 0, 0, 4, 9, '2018-11-04 00:45:11', '2018-11-04 00:45:11'),
(12, 0, 0, 0, 0, 0, 0, 0, 4, 1, '2018-11-04 00:45:11', '2018-11-04 00:45:11'),
(13, 3, 6, 8, 1, 0, 1, 2, 5, 17, '2018-11-05 09:38:24', '2018-11-14 20:49:40'),
(14, 3, 8, 4, 9, 3, 0, 0, 5, 16, '2018-11-05 09:38:24', '2018-11-14 09:14:59'),
(15, 3, 6, 6, 4, 1, 1, 1, 5, 15, '2018-11-05 09:38:24', '2018-11-14 09:15:06'),
(16, 3, 3, 5, 3, 1, 0, 2, 5, 14, '2018-11-05 09:38:24', '2018-11-14 20:49:39'),
(17, 0, 0, 0, 0, 0, 0, 0, 6, 21, '2018-11-12 00:14:00', '2018-11-12 00:14:00'),
(18, 0, 0, 0, 0, 0, 0, 0, 6, 20, '2018-11-12 00:14:00', '2018-11-12 00:14:00'),
(19, 0, 0, 0, 0, 0, 0, 0, 6, 19, '2018-11-12 00:14:00', '2018-11-12 00:14:00'),
(20, 0, 0, 0, 0, 0, 0, 0, 6, 18, '2018-11-12 00:14:00', '2018-11-12 00:14:00'),
(21, 0, 0, 0, 0, 0, 0, 0, 7, 23, '2018-11-12 01:07:51', '2018-11-12 01:07:51'),
(22, 0, 0, 0, 0, 0, 0, 0, 7, 25, '2018-11-12 01:07:51', '2018-11-12 01:07:51'),
(23, 0, 0, 0, 0, 0, 0, 0, 7, 29, '2018-11-12 01:07:52', '2018-11-12 01:07:52'),
(24, 0, 0, 0, 0, 0, 0, 0, 8, 22, '2018-11-12 01:08:09', '2018-11-12 01:08:09'),
(25, 0, 0, 0, 0, 0, 0, 0, 8, 27, '2018-11-12 01:08:09', '2018-11-12 01:08:09'),
(26, 0, 0, 0, 0, 0, 0, 0, 8, 31, '2018-11-12 01:08:09', '2018-11-12 01:08:09'),
(27, 0, 0, 0, 0, 0, 0, 0, 9, 24, '2018-11-12 01:08:30', '2018-11-12 01:08:30'),
(28, 0, 0, 0, 0, 0, 0, 0, 9, 26, '2018-11-12 01:08:30', '2018-11-12 01:08:30'),
(29, 0, 0, 0, 0, 0, 0, 0, 9, 32, '2018-11-12 01:08:31', '2018-11-12 01:08:31'),
(30, 0, 0, 0, 0, 0, 0, 0, 10, 28, '2018-11-12 01:08:48', '2018-11-12 01:08:48'),
(31, 0, 0, 0, 0, 0, 0, 0, 10, 30, '2018-11-12 01:08:48', '2018-11-12 01:08:48'),
(32, 0, 0, 0, 0, 0, 0, 0, 10, 33, '2018-11-12 01:08:48', '2018-11-12 01:08:48'),
(33, 2, 21, 22, 3, 1, 0, 1, 11, 34, '2018-11-12 01:43:35', '2018-11-14 22:05:17'),
(34, 2, 22, 24, 3, 1, 0, 1, 11, 38, '2018-11-12 01:43:35', '2018-11-14 22:04:25'),
(35, 2, 25, 22, 3, 1, 0, 1, 11, 40, '2018-11-12 01:43:35', '2018-11-14 22:05:17'),
(36, 2, 20, 22, 3, 1, 0, 1, 12, 35, '2018-11-12 01:43:55', '2018-11-14 21:53:54'),
(37, 2, 18, 24, 0, 0, 0, 2, 12, 39, '2018-11-12 01:43:55', '2018-11-14 21:52:49'),
(38, 2, 24, 16, 6, 2, 0, 0, 12, 41, '2018-11-12 01:43:55', '2018-11-14 21:53:54'),
(39, 2, 27, 29, 0, 0, 0, 2, 13, 42, '2018-11-12 01:44:18', '2018-11-14 21:55:06'),
(40, 2, 26, 24, 3, 1, 0, 1, 13, 44, '2018-11-12 01:44:18', '2018-11-14 21:53:07'),
(41, 2, 26, 26, 6, 2, 0, 0, 13, 43, '2018-11-12 01:44:18', '2018-11-14 21:55:06'),
(42, 1, 14, 16, 3, 1, 0, 0, 14, 37, '2018-11-12 01:45:15', '2018-11-14 21:51:59'),
(43, 1, 16, 14, 0, 0, 0, 1, 14, 36, '2018-11-12 01:45:15', '2018-11-14 21:51:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `time_tables`
--

DROP TABLE IF EXISTS `time_tables`;
CREATE TABLE IF NOT EXISTS `time_tables` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `team_id_a` int(10) UNSIGNED NOT NULL,
  `team_id_b` int(10) UNSIGNED NOT NULL,
  `stage_id` int(10) UNSIGNED DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `time_tables_team_id_a_foreign` (`team_id_a`),
  KEY `time_tables_team_id_b_foreign` (`team_id_b`),
  KEY `time_tables_group_id_foreign` (`group_id`),
  KEY `time_tables_stage_id_foreign` (`stage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `time_tables`
--

INSERT INTO `time_tables` (`id`, `date`, `hour`, `place`, `status`, `team_id_a`, `team_id_b`, `stage_id`, `group_id`) VALUES
(1, '2018-11-15', '11:00:00', 'Cancha de Fútbol', 0, 4, 7, NULL, 1),
(2, '2018-11-15', '13:40:00', 'Cancha de Fútbol', 1, 10, 7, NULL, 1),
(3, '2018-11-16', '09:00:00', 'Cancha de Fútbol', -1, 10, 4, NULL, 1),
(5, '2018-11-15', '11:40:00', 'Cancha de Fútbol', -1, 6, 5, NULL, 2),
(6, '2018-11-15', '14:20:00', 'Cancha de Fútbol', -1, 8, 5, NULL, 2),
(7, '2018-11-16', '09:40:00', 'Machala', -1, 8, 6, NULL, 2),
(8, '2018-11-15', '12:20:00', 'Cancha de Fútbol', -1, 3, 13, NULL, 3),
(9, '2018-11-15', '15:00:00', 'Cancha de Fútbol', -1, 11, 13, NULL, 3),
(11, '2018-11-16', '10:20:00', 'Cancha de Fútbol', -1, 11, 3, NULL, 3),
(12, '2018-11-15', '13:00:00', 'Cancha de Fútbol', -1, 1, 12, NULL, 4),
(13, '2018-11-15', '15:40:00', 'Cancha de Fútbol', -1, 1, 9, NULL, 4),
(14, '2018-11-16', '11:00:00', 'Cancha de Fútbol', -1, 9, 12, NULL, 4),
(15, '2018-11-15', '11:00:00', 'Cancha multiple', 1, 14, 17, NULL, 5),
(16, '2018-11-15', '11:25:00', 'Cancha multiple', 1, 15, 16, NULL, 5),
(17, '2018-11-16', '08:30:00', 'Cancha multiple', 1, 14, 16, NULL, 5),
(18, '2018-11-16', '08:55:00', 'Cancha multiple', 1, 15, 17, NULL, 5),
(19, '2018-11-16', '09:20:00', 'Cancha multiple', 1, 16, 17, NULL, 5),
(20, '2018-11-16', '10:35:00', 'Cancha multiple', 1, 14, 15, NULL, 5),
(21, '2018-11-15', '11:50:00', 'Cancha multiple', -1, 18, 21, NULL, 6),
(22, '2018-11-15', '12:15:00', 'Cancha multiple', -1, 19, 20, NULL, 6),
(23, '2018-11-15', '12:40:00', 'Cancha multiple', -1, 18, 20, NULL, 6),
(24, '2018-11-15', '13:05:00', 'Cancha multiple', -1, 19, 21, NULL, 6),
(25, '2018-11-16', '11:00:00', 'Cancha multiple', -1, 20, 21, NULL, 6),
(26, '2018-11-16', '11:25:00', 'Cancha de Fútbol', -1, 18, 19, NULL, 6),
(27, '2018-11-15', '13:30:00', 'Cancha multiple', -1, 25, 23, NULL, 7),
(28, '2018-11-15', '15:10:00', 'Cancha multiple', -1, 29, 23, NULL, 7),
(29, '2018-11-16', '13:15:00', 'Cancha multiple', -1, 29, 25, NULL, 7),
(30, '2018-11-15', '13:55:00', 'Cancha multiple', -1, 31, 27, NULL, 8),
(31, '2018-11-15', '15:35:00', 'Cancha multiple', -1, 27, 22, NULL, 8),
(32, '2018-11-16', '13:40:00', 'Cancha multiple', -1, 31, 22, NULL, 8),
(33, '2018-11-15', '14:20:00', 'Cancha multiple', -1, 32, 24, NULL, 9),
(34, '2018-11-15', '16:00:00', 'Cancha multiple', -1, 26, 24, NULL, 9),
(35, '2018-11-16', '14:05:00', 'Cancha multiple', -1, 32, 26, NULL, 9),
(36, '2018-11-15', '14:45:00', 'Cancha multiple', -1, 33, 28, NULL, 10),
(37, '2018-11-15', '16:25:00', 'Cancha multiple', -1, 30, 28, NULL, 10),
(38, '2018-11-16', '14:30:00', 'Cancha multiple', -1, 33, 30, NULL, 10),
(40, '2018-11-15', '11:00:00', 'Cancha de Volley', 1, 38, 34, NULL, 11),
(41, '2018-11-15', '13:00:00', 'Cancha de Volley', 1, 40, 38, NULL, 11),
(42, '2018-11-15', '14:30:00', 'Cancha de Volley', 1, 40, 34, NULL, 11),
(43, '2018-11-15', '11:30:00', 'Cancha de Volley', 1, 39, 35, NULL, 12),
(44, '2018-11-15', '13:30:00', 'Cancha de Volley', 1, 41, 39, NULL, 12),
(45, '2018-11-15', '15:00:00', 'Cancha de Volley', 1, 41, 35, NULL, 12),
(46, '2018-11-15', '12:00:00', 'Cancha de Volley', 1, 44, 42, NULL, 13),
(47, '2018-11-15', '14:00:00', 'Cancha de Volley', 1, 43, 44, NULL, 13),
(48, '2018-11-15', '15:30:00', 'Cancha de Volley', 1, 43, 42, NULL, 13),
(49, '2018-11-15', '12:30:00', 'Cancha de Volley', 1, 36, 37, NULL, 14),
(50, '2018-11-16', '11:40:00', 'Cancha de Fútbol', 2, 10, 8, 1, NULL),
(51, '2018-11-15', '12:20:00', 'Cancha de Fútbol', -1, 47, 48, 1, NULL),
(52, '2018-11-16', '13:00:00', 'Cancha de Fútbol', -1, 8, 50, 2, NULL),
(53, '2018-11-16', '12:00:00', 'Cancha multiple', 2, 16, 15, 3, NULL),
(54, '2018-11-16', '12:30:00', 'Cancha múltiple', -1, 53, 54, 4, NULL),
(55, '2018-11-16', '15:00:00', 'Cancha múltiple', -1, 55, 56, 5, NULL),
(56, '2018-11-16', '15:25:00', 'Cancha múltiple', -1, 57, 58, 5, NULL),
(57, '2018-11-16', '16:00:00', 'Cancha múltiple', -1, 59, 60, 6, NULL),
(58, '2018-11-16', '11:00:00', 'Cancha de Volley', -1, 61, 62, 7, NULL),
(59, '2018-11-16', '11:00:00', 'Cancha de Volley', -1, 63, 64, 7, NULL),
(60, '2018-11-16', '11:00:00', 'Cancha de Volley', -1, 65, 66, 8, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
CREATE TABLE IF NOT EXISTS `tournaments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_init` date NOT NULL,
  `date_end` date NOT NULL,
  `type` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `rules` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sports_id` int(10) UNSIGNED NOT NULL,
  `organizations_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tournaments_sports_id_foreign` (`sports_id`),
  KEY `tournaments_organizations_id_foreign` (`organizations_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tournaments`
--

INSERT INTO `tournaments` (`id`, `name`, `date_init`, `date_end`, `type`, `logo`, `url`, `status`, `rules`, `sports_id`, `organizations_id`, `created_at`, `updated_at`) VALUES
(1, 'Fútbol Masculino', '2018-11-15', '2018-11-16', 'Male', 'logo.png', 'futbol', 1, 'rules', 1, 1, '2018-10-29 20:12:00', '2018-11-10 22:21:20'),
(2, 'Futsal Femenino', '2018-10-06', '2018-10-07', 'Female', 'logo.png', 'futsal', 1, 'rules', 4, 1, '2018-10-29 20:14:11', '2018-11-10 22:35:07'),
(3, 'Basket Femenino', '2018-10-06', '2018-10-07', 'Female', 'logo.png', 'basket-f', 1, 'rules', 2, 1, '2018-10-29 20:14:46', '2018-11-10 22:35:31'),
(4, 'Basket Masculino', '2018-10-06', '2018-10-07', 'Male', 'logo.png', 'basket-m', 1, 'rules', 2, 1, '2018-10-29 20:15:24', '2018-11-10 22:35:57'),
(5, 'Volley Masculino', '2018-10-06', '2018-10-07', 'Male', 'logo.png', 'volley', 1, 'rules', 3, 1, '2018-10-29 20:16:12', '2018-11-10 22:36:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` enum('member','editor','admin','web') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `organization_id` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_organization_id_foreign` (`organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `rol`, `organization_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Daniel Guaycha', 'danielguaycha95@gmail.com', NULL, '$2y$10$qZAJlQc5xZuMvNp/3wrLkeSCYKCp.xZEdK39XCjApDdES4QaF/Y0i', 'member', 1, 'UkHlSHEbygi16EDrAlpt1WzOgmIb4bL0QwSROLJ9oCXsj3kcBzssuh8VeLjw', NULL, NULL),
(2, 'Nixon Quezada', 'nxnqzd@gmail.com', NULL, '$2y$10$XbdbdHJjbBLQKhN6cgExu.uSXRKbGiyKnEjm2Zl.WaK8TBGLeNOU6', 'member', 1, NULL, NULL, NULL),
(3, 'Erick Cañarte', 'ca.arte07@hotmail.com', NULL, '$2y$10$6jcOMOsXf0k3vjc09WFRruQXhuhLtekUwIOv26M5BleOOm6PKmXr6', 'member', 1, NULL, NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);

--
-- Filtros para la tabla `group_controls`
--
ALTER TABLE `group_controls`
  ADD CONSTRAINT `group_controls_team_group_id_foreign` FOREIGN KEY (`team_group_id`) REFERENCES `team_groups` (`id`),
  ADD CONSTRAINT `group_controls_time_table_id_foreign` FOREIGN KEY (`time_table_id`) REFERENCES `time_tables` (`id`);

--
-- Filtros para la tabla `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`);

--
-- Filtros para la tabla `player_teams`
--
ALTER TABLE `player_teams`
  ADD CONSTRAINT `player_teams_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `player_teams_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Filtros para la tabla `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_time_table_id_foreign` FOREIGN KEY (`time_table_id`) REFERENCES `time_tables` (`id`);

--
-- Filtros para la tabla `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);

--
-- Filtros para la tabla `stage_controls`
--
ALTER TABLE `stage_controls`
  ADD CONSTRAINT `stage_controls_time_table_id_foreign` FOREIGN KEY (`time_table_id`) REFERENCES `time_tables` (`id`);

--
-- Filtros para la tabla `stats`
--
ALTER TABLE `stats`
  ADD CONSTRAINT `stats_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `stats_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `stats_time_table_id_foreign` FOREIGN KEY (`time_table_id`) REFERENCES `time_tables` (`id`),
  ADD CONSTRAINT `stats_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);

--
-- Filtros para la tabla `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `teams_sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`);

--
-- Filtros para la tabla `team_groups`
--
ALTER TABLE `team_groups`
  ADD CONSTRAINT `team_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `team_groups_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Filtros para la tabla `time_tables`
--
ALTER TABLE `time_tables`
  ADD CONSTRAINT `time_tables_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `time_tables_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`),
  ADD CONSTRAINT `time_tables_team_id_a_foreign` FOREIGN KEY (`team_id_a`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `time_tables_team_id_b_foreign` FOREIGN KEY (`team_id_b`) REFERENCES `teams` (`id`);

--
-- Filtros para la tabla `tournaments`
--
ALTER TABLE `tournaments`
  ADD CONSTRAINT `tournaments_organizations_id_foreign` FOREIGN KEY (`organizations_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `tournaments_sports_id_foreign` FOREIGN KEY (`sports_id`) REFERENCES `sports` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

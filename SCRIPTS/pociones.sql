-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2022 a las 04:21:48
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pociones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `email`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'ekedward@heyfoodie.cl', 'Elly Kedward', 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(2, 'akyteler@heyfoodie.cl', 'Alice Kyteler', 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(3, 'mblavatsky@heyfoodie.cl', 'Madame Blavatsky', 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(4, 'jwytte@heyfoodie.cl', 'Joan Wytte', 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(5, 'guacolda@heyfoodie.cl', 'Guacolda esposa de Lautaro', 0, '2022-07-30 06:47:51', '2022-07-30 06:48:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `description`, `price`, `stock`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Pétalos', NULL, 2000, 13, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(2, 'Sal De Mar', NULL, 3000, 15, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(3, 'Vino', NULL, 6000, 20, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(4, 'Polvo Mágico', NULL, 30000, 20, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(5, 'Cenizas', NULL, 2500, 6, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(6, 'Aloe Vera', NULL, 1500, 18, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(7, 'Lagrima De Gato', NULL, 9000, 12, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(8, 'Jugo Mágico', NULL, 27000, 10, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(9, 'Sanguijuelas', NULL, 13000, 15, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(10, 'Polvo De Cuerno De Bicornio', NULL, 65000, 19, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(11, 'Miel', NULL, 2000, 98, 1, '2022-07-30 06:49:31', '2022-07-30 07:01:41'),
(12, 'Tilo', NULL, 300, 48, 1, '2022-07-30 06:49:46', '2022-07-30 07:01:41'),
(13, 'Limón', NULL, 1200, 30, 1, '2022-07-30 06:49:58', '2022-07-30 06:51:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredient_potions`
--

CREATE TABLE `ingredient_potions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `potion_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingredient_potions`
--

INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0.20, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(2, 1, 2, 0.10, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(3, 1, 3, 0.40, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(4, 1, 4, 0.30, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(5, 2, 5, 0.30, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(6, 2, 6, 0.30, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(7, 2, 7, 0.10, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(8, 2, 8, 0.30, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(9, 3, 9, 0.20, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(10, 3, 10, 0.10, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(11, 3, 7, 0.30, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(12, 3, 4, 0.20, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(13, 3, 2, 0.10, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(14, 3, 5, 0.10, '2022-07-29 02:41:10', '2022-07-29 02:41:10'),
(16, 4, 11, 0.30, NULL, NULL),
(17, 4, 12, 0.10, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(82, '2014_10_12_000000_create_users_table', 1),
(83, '2014_10_12_100000_create_password_resets_table', 1),
(84, '2019_08_19_000000_create_failed_jobs_table', 1),
(85, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(86, '2022_07_29_021838_create_clients_table', 1),
(87, '2022_07_29_021951_create_potions_table', 1),
(88, '2022_07_29_022112_create_ingredients_table', 1),
(89, '2022_07_29_022205_create_ingredient_potions_table', 1),
(90, '2022_07_29_022234_create_sales_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 1, 'API Token', '2620335f7170efaf0cacc25b2c1264b241de51a6c5b813ab4c9e523c2cad82bf', '[\"*\"]', NULL, '2022-07-30 07:20:52', '2022-07-30 07:20:52'),
(3, 'App\\Models\\User', 1, 'API Token', '3b1f00cdfd2e73a7377da6c31e1168524e98b159f2b07e8a6833efd73e79fc77', '[\"*\"]', '2022-07-30 07:23:39', '2022-07-30 07:22:45', '2022-07-30 07:23:39'),
(4, 'App\\Models\\User', 1, 'API Token', 'a75a77c1e9dcb8ae3d8d81f80b855205e5424699d9cae2d76234f05bd9406987', '[\"*\"]', '2022-07-30 08:05:46', '2022-07-30 07:33:20', '2022-07-30 08:05:46'),
(5, 'App\\Models\\User', 1, 'API Token', 'dabe55373944c3b493c82c1227b6f9e97558e5ae2dd62e79cdb5887a360b7394', '[\"*\"]', NULL, '2022-07-30 07:33:20', '2022-07-30 07:33:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `potions`
--

CREATE TABLE `potions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `potions`
--

INSERT INTO `potions` (`id`, `name`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Poción De Amor', NULL, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(2, 'Poción Alisadora', NULL, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(3, 'Poción Multijugos', NULL, 1, '2022-07-29 02:34:51', '2022-07-29 02:34:51'),
(4, 'Agua Para Resfrio', NULL, 1, '2022-07-30 06:55:10', '2022-07-30 06:55:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `potion_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 6, 72600, 1, '2021-10-11 20:04:16', '2021-10-11 20:04:16'),
(2, 2, 2, 12, 122400, 1, '2021-09-15 22:33:24', '2021-09-15 22:33:24'),
(3, 3, 1, 30, 363000, 1, '2021-10-06 20:34:33', '2021-10-06 20:34:33'),
(4, 1, 2, 5, 51000, 1, '2021-10-12 21:37:00', '2021-10-12 21:37:00'),
(5, 1, 1, 3, 36300, 1, '2021-10-06 20:34:33', '2021-10-06 20:34:33'),
(6, 2, 1, 5, 60500, 1, '2021-09-15 22:33:24', '2021-09-15 22:33:24'),
(7, 3, 2, 9, 91800, 1, '2021-10-14 16:32:59', '2021-10-14 16:32:59'),
(8, 2, 1, 18, 217800, 1, '2021-10-12 21:37:00', '2021-10-12 21:37:00'),
(9, 2, 1, 30, 363000, 1, '2021-10-14 16:32:59', '2021-10-14 16:32:59'),
(10, 2, 2, 1, 10200, 1, '2021-10-11 20:04:16', '2021-10-11 20:04:16'),
(11, 3, 2, 2, 20400, 1, '2021-09-13 23:48:48', '2021-09-13 23:48:48'),
(12, 1, 3, 6, 110100, 1, '2021-10-01 22:35:59', '2021-10-01 22:35:59'),
(13, 1, 1, 22, 266200, 1, '2021-09-13 23:48:48', '2021-09-13 23:48:48'),
(14, 1, 1, 21, 254100, 1, '2021-10-01 22:35:59', '2021-10-01 22:35:59'),
(15, 3, 2, 7, 71400, 1, '2021-09-16 22:48:34', '2021-09-16 22:48:34'),
(16, 3, 3, 1, 18350, 1, '2021-09-22 23:59:28', '2021-09-22 23:59:28'),
(17, 1, 1, 5, 60500, 1, '2021-09-22 23:59:28', '2021-09-22 23:59:28'),
(18, 4, 1, 8, 96800, 1, '2021-09-16 22:48:34', '2021-09-16 22:48:34'),
(19, 4, 1, 42, 508200, 1, '2021-09-15 21:06:10', '2021-09-15 21:06:10'),
(20, 1, 1, 12, 145200, 1, '2021-09-15 21:06:10', '2021-09-15 21:06:10'),
(21, 4, 3, 13, 238550, 1, '2021-09-20 00:45:35', '2021-09-20 00:45:35'),
(22, 3, 2, 35, 357000, 1, '2021-10-03 18:22:59', '2021-10-03 18:22:59'),
(23, 3, 2, 33, 336600, 1, '2021-09-20 00:45:35', '2021-09-20 00:45:35'),
(24, 2, 2, 13, 132600, 1, '2021-10-03 18:22:59', '2021-10-03 18:22:59'),
(25, 3, 1, 22, 266200, 1, '2021-09-27 22:06:41', '2021-09-27 22:06:41'),
(26, 3, 1, 45, 544500, 1, '2021-09-27 22:06:41', '2021-09-27 22:06:41'),
(27, 1, 2, 5, 51000, 1, '2021-09-15 16:28:12', '2021-09-15 16:28:12'),
(28, 1, 2, 13, 132600, 1, '2021-09-15 16:28:12', '2021-09-15 16:28:12'),
(29, 1, 2, 54, 550800, 1, '2021-10-18 23:49:23', '2021-10-18 23:49:23'),
(30, 1, 1, 95, 1149500, 1, '2021-10-18 23:49:23', '2021-10-18 23:49:23'),
(31, 4, 3, 33, 605550, 1, '2021-09-23 00:33:21', '2021-09-23 00:33:21'),
(32, 4, 2, 13, 132600, 1, '2021-09-23 00:33:21', '2021-09-23 00:33:21'),
(33, 4, 1, 15, 181500, 1, '2021-09-23 23:04:55', '2021-09-23 23:04:55'),
(34, 4, 1, 17, 205700, 1, '2021-09-23 23:04:55', '2021-09-23 23:04:55'),
(35, 3, 3, 19, 348650, 1, '2021-09-23 21:08:52', '2021-09-23 21:08:52'),
(36, 1, 2, 21, 214200, 1, '2021-09-23 21:08:52', '2021-09-23 21:08:52'),
(37, 4, 3, 23, 422050, 1, '2021-10-06 21:52:48', '2021-10-06 21:52:48'),
(38, 4, 1, 25, 302500, 1, '2021-10-06 21:52:48', '2021-10-06 21:52:48'),
(39, 1, 3, 27, 495450, 1, '2021-10-18 01:00:03', '2021-10-18 01:00:03'),
(40, 4, 3, 22, 403700, 1, '2021-10-18 01:00:03', '2021-10-18 01:00:03'),
(41, 3, 1, 17, 205700, 1, '2021-10-09 19:43:11', '2021-10-09 19:43:11'),
(42, 3, 2, 12, 122400, 1, '2021-10-09 19:43:11', '2021-10-09 19:43:11'),
(43, 2, 3, 7, 128450, 1, '2021-10-19 01:00:03', '2021-10-19 01:00:03'),
(44, 3, 2, 2, 20400, 1, '2021-10-19 01:00:03', '2021-10-19 01:00:03'),
(45, 3, 3, 14, 256900, 1, '2021-10-10 19:43:11', '2021-10-10 19:43:11'),
(46, 1, 1, 22, 266200, 1, '2021-10-10 19:43:11', '2021-10-10 19:43:11'),
(47, 4, 3, 1, 18350, 1, '2021-10-20 01:00:03', '2021-10-20 01:00:03'),
(48, 4, 3, 3, 55050, 1, '2021-10-20 01:00:03', '2021-10-20 01:00:03'),
(49, 1, 1, 9, 108900, 1, '2021-10-11 19:43:11', '2021-10-11 19:43:11'),
(50, 4, 3, 15, 275250, 1, '2021-10-11 19:43:11', '2021-10-11 19:43:11'),
(51, 3, 2, 18, 183600, 1, '2021-10-21 01:00:03', '2021-10-21 01:00:03'),
(52, 3, 1, 33, 399300, 1, '2021-10-21 01:00:03', '2021-10-21 01:00:03'),
(53, 2, 1, 22, 266200, 1, '2021-10-12 19:43:11', '2021-10-12 19:43:11'),
(54, 3, 3, 11, 201850, 1, '2021-10-12 19:43:11', '2021-10-12 19:43:11'),
(55, 5, 4, 2, 1260, 1, '2022-07-30 07:00:24', '2022-07-30 07:03:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@heyfoodie.cl', NULL, '$2y$10$HXAjxfVH1PgJoqR3uexIuemlvkqec9SsbjjsrqKEn0pD.9SBjus2e', NULL, '2022-07-29 03:11:01', '2022-07-29 03:11:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_email_index` (`email`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredients_name_index` (`name`),
  ADD KEY `ingredients_price_index` (`price`),
  ADD KEY `ingredients_stock_index` (`stock`);

--
-- Indices de la tabla `ingredient_potions`
--
ALTER TABLE `ingredient_potions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredient_potions_potion_id_index` (`potion_id`),
  ADD KEY `ingredient_potions_ingredient_id_index` (`ingredient_id`),
  ADD KEY `ingredient_potions_quantity_index` (`quantity`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `potions`
--
ALTER TABLE `potions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `potions_name_index` (`name`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_client_id_index` (`client_id`),
  ADD KEY `sales_potion_id_index` (`potion_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ingredient_potions`
--
ALTER TABLE `ingredient_potions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `potions`
--
ALTER TABLE `potions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingredient_potions`
--
ALTER TABLE `ingredient_potions`
  ADD CONSTRAINT `ingredient_potions_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `ingredient_potions_potion_id_foreign` FOREIGN KEY (`potion_id`) REFERENCES `potions` (`id`);

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `sales_potion_id_foreign` FOREIGN KEY (`potion_id`) REFERENCES `potions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

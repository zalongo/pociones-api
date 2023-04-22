INSERT INTO `clients` (`id`, `name`,`email`, `created_at`, `updated_at`) VALUES (NULL, 'Elly Kedward', 'ekedward@heyfoodie.cl', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `clients` (`id`, `name`,`email`, `created_at`, `updated_at`) VALUES (NULL, 'Alice Kyteler', 'akyteler@heyfoodie.cl', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `clients` (`id`, `name`,`email`, `created_at`, `updated_at`) VALUES (NULL, 'Madame Blavatsky', 'mblavatsky@heyfoodie.cl', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `clients` (`id`, `name`,`email`, `created_at`, `updated_at`) VALUES (NULL, 'Joan Wytte', 'jwytte@heyfoodie.cl', '2022-07-28 22:34:51', '2022-07-28 22:34:51');




INSERT INTO `potions` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, 'Poción De Amor', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `potions` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, 'Poción Alisadora', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `potions` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, 'Poción Multijugos', '2022-07-28 22:34:51', '2022-07-28 22:34:51');


INSERT INTO `ingredients` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES (NULL, 'Pétalos', '2000', '13', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `ingredients` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES (NULL, 'Sal De Mar', '3000', '15', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `ingredients` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES (NULL, 'Vino', '6000', '20', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `ingredients` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES (NULL, 'Polvo Mágico', '30000', '20', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `ingredients` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES (NULL, 'Cenizas', '2500', '6', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `ingredients` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES (NULL, 'Aloe Vera', '1500', '18', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `ingredients` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES (NULL, 'Lagrima De Gato', '9000', '12', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `ingredients` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES (NULL, 'Jugo Mágico', '27000', '10', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `ingredients` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES (NULL, 'Sanguijuelas', '13000', '15', '2022-07-28 22:34:51', '2022-07-28 22:34:51');
INSERT INTO `ingredients` (`id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES (NULL, 'Polvo De Cuerno De Bicornio', '65000', '19', '2022-07-28 22:34:51', '2022-07-28 22:34:51');





INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '0.2', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '1', '2', '0.1', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '1', '3', '0.4', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '1', '4', '0.3', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '2', '5', '0.3', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '2', '6', '0.3', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '2', '7', '0.1', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '2', '8', '0.3', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '3', '9', '0.2', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '3', '10', '0.1', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '3', '7', '0.3', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '3', '4', '0.2', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '3', '2', '0.1', '2022-07-28 22:41:10', '2022-07-28 22:41:10');
INSERT INTO `ingredient_potions` (`id`, `potion_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES (NULL, '3', '5', '0.1', '2022-07-28 22:41:10', '2022-07-28 22:41:10');








INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '6', '72600', '2021-10-11 17:04:16', '2021-10-11 17:04:16');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '2', '2', '12', '122400', '2021-09-15 19:33:24', '2021-09-15 19:33:24');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '1', '30', '363000', '2021-10-06 17:34:33', '2021-10-06 17:34:33');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '2', '5', '51000', '2021-10-12 18:37:00', '2021-10-12 18:37:00');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '3', '36300', '2021-10-06 17:34:33', '2021-10-06 17:34:33');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '2', '1', '5', '60500', '2021-09-15 19:33:24', '2021-09-15 19:33:24');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '2', '9', '91800', '2021-10-14 13:32:59', '2021-10-14 13:32:59');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '2', '1', '18', '217800', '2021-10-12 18:37:00', '2021-10-12 18:37:00');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '2', '1', '30', '363000', '2021-10-14 13:32:59', '2021-10-14 13:32:59');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '2', '2', '1', '10200', '2021-10-11 17:04:16', '2021-10-11 17:04:16');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '2', '2', '20400', '2021-09-13 20:48:48', '2021-09-13 20:48:48');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '3', '6', '110100', '2021-10-01 19:35:59', '2021-10-01 19:35:59');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '22', '266200', '2021-09-13 20:48:48', '2021-09-13 20:48:48');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '21', '254100', '2021-10-01 19:35:59', '2021-10-01 19:35:59');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '2', '7', '71400', '2021-09-16 19:48:34', '2021-09-16 19:48:34');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '3', '1', '18350', '2021-09-22 20:59:28', '2021-09-22 20:59:28');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '5', '60500', '2021-09-22 20:59:28', '2021-09-22 20:59:28');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '1', '8', '96800', '2021-09-16 19:48:34', '2021-09-16 19:48:34');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '1', '42', '508200', '2021-09-15 18:06:10', '2021-09-15 18:06:10');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '12', '145200', '2021-09-15 18:06:10', '2021-09-15 18:06:10');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '3', '13', '238550', '2021-09-19 21:45:35', '2021-09-19 21:45:35');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '2', '35', '357000', '2021-10-03 15:22:59', '2021-10-03 15:22:59');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '2', '33', '336600', '2021-09-19 21:45:35', '2021-09-19 21:45:35');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '2', '2', '13', '132600', '2021-10-03 15:22:59', '2021-10-03 15:22:59');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '1', '22', '266200', '2021-09-27 19:06:41', '2021-09-27 19:06:41');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '1', '45', '544500', '2021-09-27 19:06:41', '2021-09-27 19:06:41');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '2', '5', '51000', '2021-09-15 13:28:12', '2021-09-15 13:28:12');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '2', '13', '132600', '2021-09-15 13:28:12', '2021-09-15 13:28:12');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '2', '54', '550800', '2021-10-18 20:49:23', '2021-10-18 20:49:23');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '95', '1149500', '2021-10-18 20:49:23', '2021-10-18 20:49:23');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '3', '33', '605550', '2021-09-22 21:33:21', '2021-09-22 21:33:21');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '2', '13', '132600', '2021-09-22 21:33:21', '2021-09-22 21:33:21');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '1', '15', '181500', '2021-09-23 20:04:55', '2021-09-23 20:04:55');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '1', '17', '205700', '2021-09-23 20:04:55', '2021-09-23 20:04:55');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '3', '19', '348650', '2021-09-23 18:08:52', '2021-09-23 18:08:52');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '2', '21', '214200', '2021-09-23 18:08:52', '2021-09-23 18:08:52');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '3', '23', '422050', '2021-10-06 18:52:48', '2021-10-06 18:52:48');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '1', '25', '302500', '2021-10-06 18:52:48', '2021-10-06 18:52:48');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '3', '27', '495450', '2021-10-17 22:00:03', '2021-10-17 22:00:03');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '3', '22', '403700', '2021-10-17 22:00:03', '2021-10-17 22:00:03');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '1', '17', '205700', '2021-10-09 16:43:11', '2021-10-09 16:43:11');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '2', '12', '122400', '2021-10-09 16:43:11', '2021-10-09 16:43:11');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '2', '3', '7', '128450', '2021-10-18 22:00:03', '2021-10-18 22:00:03');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '2', '2', '20400', '2021-10-18 22:00:03', '2021-10-18 22:00:03');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '3', '14', '256900', '2021-10-10 16:43:11', '2021-10-10 16:43:11');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '22', '266200', '2021-10-10 16:43:11', '2021-10-10 16:43:11');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '3', '1', '18350', '2021-10-19 22:00:03', '2021-10-19 22:00:03');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '3', '3', '55050', '2021-10-19 22:00:03', '2021-10-19 22:00:03');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '1', '1', '9', '108900', '2021-10-11 16:43:11', '2021-10-11 16:43:11');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '4', '3', '15', '275250', '2021-10-11 16:43:11', '2021-10-11 16:43:11');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '2', '18', '183600', '2021-10-20 22:00:03', '2021-10-20 22:00:03');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '1', '33', '399300', '2021-10-20 22:00:03', '2021-10-20 22:00:03');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '2', '1', '22', '266200', '2021-10-12 16:43:11', '2021-10-12 16:43:11');
INSERT INTO `sales` (`id`, `client_id`, `potion_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES (NULL, '3', '3', '11', '201850', '2021-10-12 16:43:11', '2021-10-12 16:43:11');






INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, 'user', 'user@heyfoodie.cl', NULL, '$2y$10$HXAjxfVH1PgJoqR3uexIuemlvkqec9SsbjjsrqKEn0pD.9SBjus2e', NULL, '2022-07-28 23:11:01', '2022-07-28 23:11:01');




SELECT clients.name, potions.name, sales.quantity, sales.created_at
FROM `sales`
left join clients on clients.id = sales.client_id
left join potions on potions.id = sales.potion_id
order by sales.id ASC
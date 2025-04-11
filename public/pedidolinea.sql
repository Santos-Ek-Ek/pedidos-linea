/*
Navicat MySQL Data Transfer

Source Server         : Laravel
Source Server Version : 80031
Source Host           : 127.0.0.1:3306
Source Database       : pedidolinea

Target Server Type    : MYSQL
Target Server Version : 80031
File Encoding         : 65001

Date: 2025-04-11 12:59:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for administradores
-- ----------------------------
DROP TABLE IF EXISTS `administradores`;
CREATE TABLE `administradores` (
`id`  bigint UNSIGNED NOT NULL AUTO_INCREMENT ,
`nombre_completo`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`email`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`password`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`remember_token`  varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at`  timestamp NULL DEFAULT NULL ,
`updated_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
UNIQUE INDEX `administradores_email_unique` (`email`) USING BTREE 
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of administradores
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
`id`  bigint UNSIGNED NOT NULL AUTO_INCREMENT ,
`nombre`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`activo`  tinyint(1) NOT NULL ,
`created_at`  timestamp NULL DEFAULT NULL ,
`updated_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=3

;

-- ----------------------------
-- Records of categorias
-- ----------------------------
BEGIN;
INSERT INTO `categorias` VALUES ('1', 'Platos fuertes / Principales', '1', '2025-04-08 21:21:16', '2025-04-08 21:21:16'), ('2', 'Bebidas', '1', '2025-04-08 21:21:24', '2025-04-08 21:21:24');
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
`id`  bigint UNSIGNED NOT NULL AUTO_INCREMENT ,
`uuid`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`connection`  text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`queue`  text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`payload`  longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`exception`  longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`failed_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`),
UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid`) USING BTREE 
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
`id`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
`migration`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`batch`  int NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=34

;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('25', '2014_10_12_000000_create_users_table', '1'), ('26', '2014_10_12_100000_create_password_reset_tokens_table', '1'), ('27', '2019_08_19_000000_create_failed_jobs_table', '1'), ('28', '2019_12_14_000001_create_personal_access_tokens_table', '1'), ('29', '2025_03_27_210514_create_administradores_table', '1'), ('30', '2025_03_27_221041_create_categoria_table', '1'), ('31', '2025_03_28_002327_create_producto_table', '1'), ('33', '2025_03_28_014902_create_pedidos_table', '2');
COMMIT;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
`email`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`token`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`created_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`email`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pedidos
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
`id`  bigint UNSIGNED NOT NULL AUTO_INCREMENT ,
`producto_id`  bigint UNSIGNED NOT NULL ,
`cliente_id`  bigint UNSIGNED NOT NULL ,
`notas`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`total`  double(10,2) NOT NULL ,
`direccion`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`horario_entrega`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`estado`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`created_at`  timestamp NULL DEFAULT NULL ,
`updated_at`  timestamp NULL DEFAULT NULL ,
`metodo_pago`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`metodo_entrega`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`cantidad`  bigint NULL DEFAULT NULL ,
`ticket_path`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
INDEX `pedidos_producto_id_foreign` (`producto_id`) USING BTREE ,
INDEX `pedidos_cliente_id_foreign` (`cliente_id`) USING BTREE 
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=121

;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
BEGIN;
INSERT INTO `pedidos` VALUES ('125', '1', '3', '', '40.00', 'gk - qwe', '9:00am - 10:00am', 'Enviado', '2025-04-11 17:21:07', '2025-04-11 18:45:46', 'Pagar al repartidor', 'Enviar a domicilio', '1', 'tickets/pedido_3_20250411172107.pdf'), ('126', '1', '3', '', '40.00', 'gk - qwe', '9:00am - 10:00am', 'Pendiente', '2025-04-11 17:36:40', '2025-04-11 17:36:40', 'Pagar al repartidor', 'Enviar a domicilio', '1', 'tickets/pedido_3_20250411173640.pdf'), ('127', '2', '3', '', '50.00', 'gk - qwe', '9:00am - 10:00am', 'Enviado', '2025-04-11 17:40:33', '2025-04-11 17:40:33', 'Pagar al pasar a\r\n                                                            recoge', 'Pasar a recoger', '1', 'tickets/pedido_3_20250411174033.pdf'), ('128', '1', '4', '', '40.00', 'hjklhklh - kh', '9:00am - 10:00am', 'Enviado', '2025-04-11 18:16:34', '2025-04-11 18:16:34', 'Pagar al pasar a\r\n                                                            recoge', 'Pasar a recoger', '1', 'tickets/pedido_4_20250411181634.pdf'), ('129', '2', '4', '', '50.00', 'hjklhklh - kh', '9:00am - 10:00am', 'Enviado', '2025-04-11 18:16:34', '2025-04-11 18:16:34', 'Pagar al pasar a\r\n                                                            recoge', 'Pasar a recoger', '1', 'tickets/pedido_4_20250411181634.pdf');
COMMIT;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
`id`  bigint UNSIGNED NOT NULL AUTO_INCREMENT ,
`tokenable_type`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`tokenable_id`  bigint UNSIGNED NOT NULL ,
`name`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`token`  varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`abilities`  text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL ,
`last_used_at`  timestamp NULL DEFAULT NULL ,
`expires_at`  timestamp NULL DEFAULT NULL ,
`created_at`  timestamp NULL DEFAULT NULL ,
`updated_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
UNIQUE INDEX `personal_access_tokens_token_unique` (`token`) USING BTREE ,
INDEX `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`) USING BTREE 
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
`id`  bigint UNSIGNED NOT NULL AUTO_INCREMENT ,
`nombre`  varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`imagen`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`detalle`  text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL ,
`categoria_id`  bigint UNSIGNED NOT NULL ,
`precio`  decimal(10,2) NOT NULL ,
`activo`  tinyint(1) NOT NULL DEFAULT 1 ,
`created_at`  timestamp NULL DEFAULT NULL ,
`updated_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
INDEX `productos_categoria_id_foreign` (`categoria_id`) USING BTREE 
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=3

;

-- ----------------------------
-- Records of productos
-- ----------------------------
BEGIN;
INSERT INTO `productos` VALUES ('1', 'Papas fritas', 'productos/papas-fritas.webp', 'ifhgkhn', '1', '40.00', '1', '2025-04-08 21:21:50', '2025-04-08 21:21:50'), ('2', 'Tacos al pastor', 'productos/tacos-al-pastor.webp', 'lhhcbcgsghfd', '1', '50.00', '1', '2025-04-08 21:22:11', '2025-04-08 21:22:11');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id`  bigint UNSIGNED NOT NULL AUTO_INCREMENT ,
`name`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`lastname`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`email`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`email_verified_at`  timestamp NULL DEFAULT NULL ,
`password`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`telefono`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`direccion`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`referencia_envio`  longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL ,
`activo`  tinyint(1) NOT NULL ,
`remember_token`  varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at`  timestamp NULL DEFAULT NULL ,
`updated_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
UNIQUE INDEX `users_email_unique` (`email`) USING BTREE 
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=5

;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('3', 'Santos', 'Ek', 'jizee06@gmail.com', null, '$2y$12$XW/aONjBVeSTF4kXyFjme.yHAK/f7Nr1Phg4QWPuXF8pJHwELNGt2', '9881038014', 'gk', 'qwe', '1', null, '2025-04-10 02:40:03', '2025-04-11 00:24:37'), ('4', 'Ismael', 'elk', 'ismaelek03@gmail.com', null, '$2y$12$ivN1itVsU38mnZKZ0w3uouuSsS5GW3u3t5eXsVT0izJwNX/3FbMgS', '1234567890', 'hjklhklh', 'kh', '1', null, '2025-04-11 18:14:45', '2025-04-11 18:16:34');
COMMIT;

-- ----------------------------
-- Auto increment value for administradores
-- ----------------------------
ALTER TABLE `administradores` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for categorias
-- ----------------------------
ALTER TABLE `categorias` AUTO_INCREMENT=3;

-- ----------------------------
-- Auto increment value for failed_jobs
-- ----------------------------
ALTER TABLE `failed_jobs` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for migrations
-- ----------------------------
ALTER TABLE `migrations` AUTO_INCREMENT=34;

-- ----------------------------
-- Auto increment value for password_reset_tokens
-- ----------------------------
ALTER TABLE `password_reset_tokens` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for pedidos
-- ----------------------------
ALTER TABLE `pedidos` AUTO_INCREMENT=121;

-- ----------------------------
-- Auto increment value for personal_access_tokens
-- ----------------------------
ALTER TABLE `personal_access_tokens` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for productos
-- ----------------------------
ALTER TABLE `productos` AUTO_INCREMENT=3;

-- ----------------------------
-- Auto increment value for users
-- ----------------------------
ALTER TABLE `users` AUTO_INCREMENT=5;

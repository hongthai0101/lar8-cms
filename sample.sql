/*
 Navicat Premium Data Transfer

 Source Server         : Maria Local
 Source Server Type    : MariaDB
 Source Server Version : 100703
 Source Host           : localhost:3306
 Source Schema         : core_laravel

 Target Server Type    : MariaDB
 Target Server Version : 100703
 File Encoding         : 65001

 Date: 15/09/2022 13:54:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `order` tinyint(4) NOT NULL DEFAULT 0,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `created_id` bigint(20) unsigned NOT NULL,
  `updated_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
BEGIN;
INSERT INTO `categories` VALUES (1, 'Thai', 0, 'Thai', 'publish', 0, 1, 1, 1, '2022-09-12 11:00:15', '2022-09-12 11:00:15');
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for galleries
-- ----------------------------
DROP TABLE IF EXISTS `galleries`;
CREATE TABLE `galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `order` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`values`)),
  `created_id` bigint(20) unsigned NOT NULL,
  `updated_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galleries_created_id_index` (`created_id`),
  KEY `galleries_updated_id_index` (`updated_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of galleries
-- ----------------------------
BEGIN;
INSERT INTO `galleries` VALUES (1, 'Thai', 'Thai', 1, 0, '1-2.jpg', 'publish', '[{\"img\":\"1-2.jpg\",\"description\":\"\"},{\"img\":\"1-1.jpg\",\"description\":\"\"},{\"img\":\"1.png\",\"description\":\"\"}]', 1, 1, '2022-09-12 10:55:36', '2022-09-12 10:55:36', NULL);
COMMIT;

-- ----------------------------
-- Table structure for media_files
-- ----------------------------
DROP TABLE IF EXISTS `media_files`;
CREATE TABLE `media_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder_id` int(10) unsigned NOT NULL DEFAULT 0,
  `mime_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_files_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of media_files
-- ----------------------------
BEGIN;
INSERT INTO `media_files` VALUES (1, 1, '1', 0, 'image/png', 135971, '1.png', '[]', '2022-09-12 10:13:49', '2022-09-12 10:13:49', NULL);
INSERT INTO `media_files` VALUES (2, 1, '1-1', 0, 'image/jpeg', 948147, '1-1.jpg', '[]', '2022-09-12 10:14:14', '2022-09-12 10:14:14', NULL);
INSERT INTO `media_files` VALUES (3, 1, '1-2', 0, 'image/jpeg', 948147, '1-2.jpg', '[]', '2022-09-12 10:17:49', '2022-09-12 10:17:49', NULL);
COMMIT;

-- ----------------------------
-- Table structure for media_folders
-- ----------------------------
DROP TABLE IF EXISTS `media_folders`;
CREATE TABLE `media_folders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_folders_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of media_folders
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for media_settings
-- ----------------------------
DROP TABLE IF EXISTS `media_settings`;
CREATE TABLE `media_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of media_settings
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for meta_boxes
-- ----------------------------
DROP TABLE IF EXISTS `meta_boxes`;
CREATE TABLE `meta_boxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'seo',
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `reference_id` int(10) unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_boxes_reference_id_index` (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of meta_boxes
-- ----------------------------
BEGIN;
INSERT INTO `meta_boxes` VALUES (1, 'seo', '{\"title\":\"Thai\",\"description\":\"Thai\"}', 1, 'Messi\\Blog\\Models\\Post');
INSERT INTO `meta_boxes` VALUES (2, 'seo', '{\"title\":\"Thai\",\"description\":\"Thai\"}', 1, 'Messi\\Blog\\Models\\Category');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2015_12_20_100001_create_permissions_table', 1);
INSERT INTO `migrations` VALUES (4, '2015_12_20_100002_create_roles_table', 1);
INSERT INTO `migrations` VALUES (5, '2015_12_20_100003_create_permission_role_table', 1);
INSERT INTO `migrations` VALUES (6, '2015_12_20_100004_create_role_user_table', 1);
INSERT INTO `migrations` VALUES (7, '2015_12_20_100005_create_permission_user_table', 1);
INSERT INTO `migrations` VALUES (8, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (9, '2021_08_14_000000_add_meta_users_table', 1);
INSERT INTO `migrations` VALUES (10, '2021_08_15_093333_create_media_table', 1);
INSERT INTO `migrations` VALUES (11, '2021_08_16_123456_create_posts_table', 1);
INSERT INTO `migrations` VALUES (12, '2021_08_19_070450_create_slug_table', 1);
INSERT INTO `migrations` VALUES (13, '2021_08_19_123456_create_meta_boxes_table', 1);
INSERT INTO `migrations` VALUES (14, '2021_08_20_524172_create_settings_table', 1);
INSERT INTO `migrations` VALUES (15, '2021_08_23_123456_create_galleries_table', 1);
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
BEGIN;
INSERT INTO `permission_role` VALUES (1, 1, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (2, 2, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (32, 14, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (33, 15, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (34, 13, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (35, 16, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (36, 17, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (37, 4, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_role` VALUES (38, 5, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_role` VALUES (39, 6, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_role` VALUES (40, 7, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_role` VALUES (41, 8, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_role` VALUES (42, 9, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_role` VALUES (43, 10, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_role` VALUES (44, 11, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_role` VALUES (45, 12, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_role` VALUES (46, 18, 1, '2022-09-12 10:54:23', '2022-09-12 10:54:23');
INSERT INTO `permission_role` VALUES (47, 19, 1, '2022-09-12 10:54:23', '2022-09-12 10:54:23');
INSERT INTO `permission_role` VALUES (48, 20, 1, '2022-09-12 10:54:23', '2022-09-12 10:54:23');
INSERT INTO `permission_role` VALUES (49, 21, 1, '2022-09-12 10:54:23', '2022-09-12 10:54:23');
INSERT INTO `permission_role` VALUES (50, 22, 1, '2022-09-12 10:54:23', '2022-09-12 10:54:23');
COMMIT;

-- ----------------------------
-- Table structure for permission_user
-- ----------------------------
DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE `permission_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  KEY `permission_user_user_id_foreign` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_user
-- ----------------------------
BEGIN;
INSERT INTO `permission_user` VALUES (1, 1, 1, NULL, NULL);
INSERT INTO `permission_user` VALUES (2, 2, 1, NULL, NULL);
INSERT INTO `permission_user` VALUES (32, 14, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (33, 15, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (34, 13, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (35, 16, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (36, 17, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (37, 4, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (38, 5, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (39, 6, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (40, 7, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (41, 8, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (42, 9, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (43, 10, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (44, 11, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (45, 12, 1, '2022-09-12 09:15:31', '2022-09-12 09:15:31');
INSERT INTO `permission_user` VALUES (46, 18, 1, '2022-09-12 10:54:23', '2022-09-12 10:54:23');
INSERT INTO `permission_user` VALUES (47, 19, 1, '2022-09-12 10:54:23', '2022-09-12 10:54:23');
INSERT INTO `permission_user` VALUES (48, 20, 1, '2022-09-12 10:54:23', '2022-09-12 10:54:23');
INSERT INTO `permission_user` VALUES (49, 21, 1, '2022-09-12 10:54:23', '2022-09-12 10:54:23');
INSERT INTO `permission_user` VALUES (50, 22, 1, '2022-09-12 10:54:23', '2022-09-12 10:54:23');
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'System',
  `system` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES (1, 'View Any Dashboard', 'viewAny-dashboard', 'System', 0, NULL, NULL);
INSERT INTO `permissions` VALUES (2, 'View Any User', 'viewAny-user', 'User', 0, NULL, NULL);
INSERT INTO `permissions` VALUES (4, 'View User', 'view-user', 'User', 0, '2022-09-12 08:55:44', '2022-09-12 08:55:44');
INSERT INTO `permissions` VALUES (5, 'Create User', 'create-user', 'User', 0, '2022-09-12 08:55:44', '2022-09-12 08:55:44');
INSERT INTO `permissions` VALUES (6, 'Update User', 'update-user', 'User', 0, '2022-09-12 08:55:44', '2022-09-12 08:55:44');
INSERT INTO `permissions` VALUES (7, 'Delete User', 'delete-user', 'User', 0, '2022-09-12 08:55:44', '2022-09-12 08:55:44');
INSERT INTO `permissions` VALUES (8, 'View Any Blog', 'viewAny-blog', 'Blog', 0, '2022-09-12 09:06:43', '2022-09-12 09:06:43');
INSERT INTO `permissions` VALUES (9, 'View Blog', 'view-blog', 'Blog', 0, '2022-09-12 09:06:43', '2022-09-12 09:06:43');
INSERT INTO `permissions` VALUES (10, 'Create Blog', 'create-blog', 'Blog', 0, '2022-09-12 09:06:43', '2022-09-12 09:06:43');
INSERT INTO `permissions` VALUES (11, 'Update Blog', 'update-blog', 'Blog', 0, '2022-09-12 09:06:43', '2022-09-12 09:06:43');
INSERT INTO `permissions` VALUES (12, 'Delete Blog', 'delete-blog', 'Blog', 0, '2022-09-12 09:06:43', '2022-09-12 09:06:43');
INSERT INTO `permissions` VALUES (13, 'View Any Role', 'viewAny-role', 'Role', 0, '2022-09-12 09:07:32', '2022-09-12 09:07:32');
INSERT INTO `permissions` VALUES (14, 'View Role', 'view-role', 'Role', 0, '2022-09-12 09:07:32', '2022-09-12 09:07:32');
INSERT INTO `permissions` VALUES (15, 'Create Role', 'create-role', 'Role', 0, '2022-09-12 09:07:32', '2022-09-12 09:07:32');
INSERT INTO `permissions` VALUES (16, 'Update Role', 'update-role', 'Role', 0, '2022-09-12 09:07:32', '2022-09-12 09:07:32');
INSERT INTO `permissions` VALUES (17, 'Delete Role', 'delete-role', 'Role', 0, '2022-09-12 09:07:32', '2022-09-12 09:07:32');
INSERT INTO `permissions` VALUES (18, 'View Any Setting', 'viewAny-setting', 'Setting', 0, '2022-09-12 10:53:49', '2022-09-12 10:53:49');
INSERT INTO `permissions` VALUES (19, 'View Setting', 'view-setting', 'Setting', 0, '2022-09-12 10:53:49', '2022-09-12 10:53:49');
INSERT INTO `permissions` VALUES (20, 'Create Setting', 'create-setting', 'Setting', 0, '2022-09-12 10:53:49', '2022-09-12 10:53:49');
INSERT INTO `permissions` VALUES (21, 'Update Setting', 'update-setting', 'Setting', 0, '2022-09-12 10:53:49', '2022-09-12 10:53:49');
INSERT INTO `permissions` VALUES (22, 'Delete Setting', 'delete-setting', 'Setting', 0, '2022-09-12 10:53:49', '2022-09-12 10:53:49');
COMMIT;

-- ----------------------------
-- Table structure for post_categories
-- ----------------------------
DROP TABLE IF EXISTS `post_categories`;
CREATE TABLE `post_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of post_categories
-- ----------------------------
BEGIN;
INSERT INTO `post_categories` VALUES (1, 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for post_tags
-- ----------------------------
DROP TABLE IF EXISTS `post_tags`;
CREATE TABLE `post_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of post_tags
-- ----------------------------
BEGIN;
INSERT INTO `post_tags` VALUES (1, 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `is_featured` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT 0,
  `created_id` bigint(20) unsigned NOT NULL,
  `updated_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
BEGIN;
INSERT INTO `posts` VALUES (1, 'Thai', 'Thai', '<p><img src=\"/storage/1.png\" alt=\"1\" /><br />Thai</p>', 'publish', 0, '1.png', 0, 1, 1, '2022-09-12 10:59:41', '2022-09-12 11:00:00', NULL);
COMMIT;

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
BEGIN;
INSERT INTO `role_user` VALUES (1, 1, 1, NULL, NULL);
INSERT INTO `role_user` VALUES (2, 2, 198, '2022-09-12 10:54:50', '2022-09-12 10:54:50');
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'Admin', 'admin', NULL, 0, NULL, NULL);
INSERT INTO `roles` VALUES (2, 'Ke Toan', 'ke-toan', 'Ke Toan', 0, '2022-09-12 10:29:05', '2022-09-12 10:29:05');
COMMIT;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
BEGIN;
INSERT INTO `settings` VALUES (1, '__admin_title__', 's:6:\"Limo 2\";');
INSERT INTO `settings` VALUES (2, '__admin_copyright__', 's:17:\"2021 © by Thailh\";');
INSERT INTO `settings` VALUES (3, '__admin_favicon__', 's:5:\"1.png\";');
INSERT INTO `settings` VALUES (4, '__admin_logo__', 's:5:\"1.png\";');
COMMIT;

-- ----------------------------
-- Table structure for slugs
-- ----------------------------
DROP TABLE IF EXISTS `slugs`;
CREATE TABLE `slugs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` int(10) unsigned NOT NULL,
  `reference_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `slugs_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of slugs
-- ----------------------------
BEGIN;
INSERT INTO `slugs` VALUES (1, 'thai', 1, 'Messi\\Blog\\Models\\Gallery', '');
INSERT INTO `slugs` VALUES (2, 'thaile', 1, 'Messi\\Blog\\Models\\Tag', '');
INSERT INTO `slugs` VALUES (3, 'thai', 1, 'Messi\\Blog\\Models\\Post', '');
INSERT INTO `slugs` VALUES (4, 'thai', 1, 'Messi\\Blog\\Models\\Category', '');
COMMIT;

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_id` smallint(5) unsigned NOT NULL,
  `updated_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tags
-- ----------------------------
BEGIN;
INSERT INTO `tags` VALUES (1, 'ThaiLe', 'ThaiLe', 'draft', 1, 1, '2022-09-12 10:56:15', '2022-09-12 10:56:23');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Super Admin', 'admin@admin.com', NULL, '$2y$10$WIUg8VKcYZkv/9B4wo9Squ8MYiSQFRehbAn3eNJoIhFSHRRmVwf3C', 'xAJJdomT62K9r8zGM5EeiDaa7bH344eWQdKiIokUHCivpBJgLERqAZA1AK7C', '2022-09-12 08:26:27', '2022-09-12 08:26:27', NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, 'Addie Armstrong I', 'xferry@mertz.com', NULL, '$2y$10$8sb1W0dAC7Y0BcJFfKy4COU14UuMTDaE/e2im73OQtxvDNQETsH/q', NULL, '1980-07-19 06:17:31', '2010-05-06 20:33:30', NULL, NULL, NULL);
INSERT INTO `users` VALUES (3, 'Matilde Hettinger', 'darryl.halvorson@hotmail.com', NULL, '$2y$10$WKxOkoutohKY42J8bybd5eaubufm0mzatA8lb99.Fff/sXnghGZnq', NULL, '1984-06-12 21:31:45', '1983-07-21 14:36:34', NULL, NULL, NULL);
INSERT INTO `users` VALUES (4, 'Johathan Bode', 'schroeder.catalina@weber.com', NULL, '$2y$10$uAI8sK48YlCADvdYVSL5v.fdOaJ25oTMCQ1SgPYU4hjKZCnfKcIfu', NULL, '2001-02-16 06:36:58', '1977-11-18 18:42:40', NULL, NULL, NULL);
INSERT INTO `users` VALUES (5, 'Leonard Carter I', 'eichmann.elza@cummerata.com', NULL, '$2y$10$jgjauJ4h0EvIbz0PLGJOrOO9Kbq0S1i1X/yHBdwL1YQK3D2Yk5ode', NULL, '1971-10-18 07:52:21', '1985-05-26 13:12:38', NULL, NULL, NULL);
INSERT INTO `users` VALUES (6, 'Dr. Demond Kirlin', 'miller93@glover.com', NULL, '$2y$10$V/qBmM/3cmOmGPNzlM0/I..HqZsOwl9k4g3K6vHMg58369eFewZ1y', NULL, '1981-08-25 19:20:21', '1986-05-27 15:58:08', NULL, NULL, NULL);
INSERT INTO `users` VALUES (7, 'Lizzie Kling III', 'kennith65@hagenes.biz', NULL, '$2y$10$OIfs5hWlrVyENVJdjZIUxuz0EXoKQbXtS8IxVFGEXdKqLDKeLs3U.', NULL, '1995-02-02 03:44:10', '1982-11-02 06:50:46', NULL, NULL, NULL);
INSERT INTO `users` VALUES (8, 'Elliott Collier', 'frederik19@nikolaus.biz', NULL, '$2y$10$lQ.s4B7XCOo6IpOhyKn.ceaGJs9loksLwSvlVZDXh/q4CTDm7PNd.', NULL, '2006-02-19 11:21:27', '2003-11-06 18:02:23', NULL, NULL, NULL);
INSERT INTO `users` VALUES (9, 'Kathryn Sipes', 'damon.erdman@bruen.biz', NULL, '$2y$10$Jw4arZWHpGvsBEUqoVZDPO.RhsY.FYbcuz.GIgtpHOJgiiSiDG8Fu', NULL, '1974-04-18 00:43:56', '2018-06-07 11:44:29', NULL, NULL, NULL);
INSERT INTO `users` VALUES (10, 'Mr. Elias Kozey', 'lynn10@kris.com', NULL, '$2y$10$UCNKgOMmCU/L1NeNdotoaeetXqdmykwi90wT35BsK5rUgXI/Xks6W', NULL, '1974-11-18 14:58:23', '1994-01-23 17:05:14', NULL, NULL, NULL);
INSERT INTO `users` VALUES (11, 'Maverick Schultz I', 'aglae37@runte.com', NULL, '$2y$10$kFr/uA/.96vn2fg0ZBzeCOWEAaKpgDUbJReJqraaL.brkm.MUjUI6', NULL, '1981-11-22 09:08:24', '1976-01-11 12:18:20', NULL, NULL, NULL);
INSERT INTO `users` VALUES (12, 'Vicente Kulas', 'domingo.hintz@satterfield.com', NULL, '$2y$10$F2H1lXjbYaewyaATqAEx8egTxYeDH1WNoWyYO1n9tD7u4hlrkiziS', NULL, '2020-09-23 12:43:43', '1980-02-12 03:42:29', NULL, NULL, NULL);
INSERT INTO `users` VALUES (13, 'Keeley Daniel', 'cummerata.florida@hotmail.com', NULL, '$2y$10$GzAsYgqphoCtqhcfSxVE1OCYTHIrb1ECPVIZT8.ddNry5NRdZAPFC', NULL, '2003-11-27 20:39:56', '1995-11-06 07:17:29', NULL, NULL, NULL);
INSERT INTO `users` VALUES (14, 'Frederique Reilly DDS', 'katrina94@hotmail.com', NULL, '$2y$10$Rjhi5FFvEPCvgRnFPtR1keudZ3FC0GM0Y2eNmYL5CfLJKi3koVjuC', NULL, '2016-05-17 01:53:50', '1978-07-19 01:01:33', NULL, NULL, NULL);
INSERT INTO `users` VALUES (15, 'Prof. Dennis Wiegand V', 'goberbrunner@yahoo.com', NULL, '$2y$10$yvCDc88noMn/opT1C1pDUuPVKtTfbYbLIeFeSlro7GAJXxHe/04fu', NULL, '2019-01-20 17:30:20', '2009-03-19 13:37:35', NULL, NULL, NULL);
INSERT INTO `users` VALUES (16, 'Regan Koch', 'adalberto38@hotmail.com', NULL, '$2y$10$hdFWI9TPXns.9zgsfqnQQeXQ6EdGUT1tDDYGz.07z8XsxArbMZ/cy', NULL, '1973-05-02 02:42:57', '1971-03-15 22:50:23', NULL, NULL, NULL);
INSERT INTO `users` VALUES (17, 'Cara DuBuque', 'uschulist@gmail.com', NULL, '$2y$10$xP5lWk33JZw0OvH2y1Mv4eLvhl6ykGGKzjOtjsdcwslOl/BG447aO', NULL, '2022-08-10 23:58:26', '1990-10-06 19:45:12', NULL, NULL, NULL);
INSERT INTO `users` VALUES (18, 'Piper Kutch', 'lucas.adams@hand.info', NULL, '$2y$10$KCcT3M8a/iNPhO2KwWAGtulJpP/PaXSkeADkb159.Z9joIaQHvVti', NULL, '1988-03-30 00:57:08', '2012-03-22 16:16:38', NULL, NULL, NULL);
INSERT INTO `users` VALUES (19, 'Erling Deckow', 'nmclaughlin@bahringer.com', NULL, '$2y$10$GISZkhulhviIVr1bEa9OQ.sAxlmFEnRvnl5jgoGpix1TAOgtQatEW', NULL, '2011-11-27 11:11:02', '2010-10-06 05:44:07', NULL, NULL, NULL);
INSERT INTO `users` VALUES (20, 'Dr. Eliza Beatty', 'lehner.gabrielle@yahoo.com', NULL, '$2y$10$f4UfMtNH56tcq4Vo3SVPme6MpbTa3e/afvmg0OQVTKoUhBGZ0Woxi', NULL, '1974-09-22 06:53:26', '2018-10-18 15:36:11', NULL, NULL, NULL);
INSERT INTO `users` VALUES (21, 'Dalton Weber', 'natalie.doyle@yahoo.com', NULL, '$2y$10$0LQeYdipuxYhWrclv8E5WugyFQp1kHmWESwYCQHBKJkSGaAl1qF4O', NULL, '1996-09-09 14:58:03', '1973-09-08 08:08:07', NULL, NULL, NULL);
INSERT INTO `users` VALUES (22, 'Kristian Dickinson', 'wilmer.rice@hettinger.biz', NULL, '$2y$10$01zIPrPFr7eDYhY9a7R5tuD9lTjhkT2qVox6WRv0gpBetTZD9oY.G', NULL, '1986-05-14 10:23:10', '1973-10-05 05:07:03', NULL, NULL, NULL);
INSERT INTO `users` VALUES (23, 'Agnes Auer', 'cornelius.paucek@hotmail.com', NULL, '$2y$10$lBeANU/rnjH3NBDu8WwAD.weAEh2qYq9DKyPb5UPL1hNGXKADTG/a', NULL, '1990-02-25 15:01:35', '2006-10-02 11:25:45', NULL, NULL, NULL);
INSERT INTO `users` VALUES (24, 'Prof. Vergie Roob PhD', 'dare.maximillian@gmail.com', NULL, '$2y$10$PUKimLjMtCBGrDNb8o0L2OeFeGwjuJOE1BAIAh0SYRTCq2Vdwk1xy', NULL, '2002-08-29 07:27:53', '2007-06-07 01:02:22', NULL, NULL, NULL);
INSERT INTO `users` VALUES (25, 'Veronica Bechtelar', 'cmcclure@hotmail.com', NULL, '$2y$10$yGVG.4C2il2MmvPOe1PgF.O38eT8/nSfh7f9kfyaNS2K9tpbNboJq', NULL, '2016-06-11 18:06:45', '1976-08-08 16:59:32', NULL, NULL, NULL);
INSERT INTO `users` VALUES (26, 'Prof. Deon Flatley DVM', 'mreichel@feest.org', NULL, '$2y$10$mqomZlsvL3T6ll3ZJFHW8eosGc4p/uWO5d67gL/8twlhjtnAIhmFa', NULL, '2015-10-30 11:31:19', '2008-03-03 07:28:50', NULL, NULL, NULL);
INSERT INTO `users` VALUES (27, 'Rebeca Lowe', 'liana69@schoen.com', NULL, '$2y$10$BllWseXJFtsnjxyJ/vxJp.SiGh0yAF/4gKo4ppoxV1y83pZ0.2QBK', NULL, '1986-07-05 07:01:20', '1996-03-17 05:36:40', NULL, NULL, NULL);
INSERT INTO `users` VALUES (28, 'Keyon Lindgren', 'brown.elena@yahoo.com', NULL, '$2y$10$hu0FgVR/00UX.rNmVHodi.IMapSP3p1xnmBKSQ34lfCYOabZkUWDi', NULL, '2021-05-03 15:37:29', '1975-12-03 16:29:22', NULL, NULL, NULL);
INSERT INTO `users` VALUES (29, 'Nels Rohan', 'reid.gottlieb@schulist.biz', NULL, '$2y$10$Rt4YVS/MaozdvGG7zwKA0.3.s3MDE9cO4fQFYO7zD5HkoeXfY3PGC', NULL, '1988-09-08 22:06:35', '1979-10-06 04:51:46', NULL, NULL, NULL);
INSERT INTO `users` VALUES (30, 'Prof. Rachelle Medhurst', 'feeney.clarabelle@hotmail.com', NULL, '$2y$10$NwzwKfNE1hupcOpyk0D.Ne/RTI.nmtCJHlFnSot66ihh7zfvT2SMq', NULL, '1986-04-21 13:00:37', '1992-09-17 17:02:16', NULL, NULL, NULL);
INSERT INTO `users` VALUES (31, 'Dr. Kadin Bechtelar PhD', 'nelson.cartwright@hickle.com', NULL, '$2y$10$Lv5eTzkEacHZzJpKq9UKB.VEE5wGNpi.Ak2WGRnjVrm06RodCkd5O', NULL, '2009-03-08 17:12:00', '1991-09-13 10:36:16', NULL, NULL, NULL);
INSERT INTO `users` VALUES (32, 'Lilliana Pouros Jr.', 'garett.powlowski@trantow.com', NULL, '$2y$10$6BPF3S5EcyF9v.0El/yOsOorvo.7JNmCNxlU01oJooOKZmU.rWSou', NULL, '1994-09-05 17:29:46', '2022-01-15 03:43:16', NULL, NULL, NULL);
INSERT INTO `users` VALUES (33, 'Garrison Kuvalis', 'dickens.crystal@mckenzie.com', NULL, '$2y$10$sJISU.TGmWbZdEZ2EFWEp.cTy0L18dLvlHd6vY3uJ7z1gFhQdCN.O', NULL, '2002-11-09 09:12:49', '2013-10-30 23:59:05', NULL, NULL, NULL);
INSERT INTO `users` VALUES (34, 'Clemens Marks', 'mafalda80@heathcote.com', NULL, '$2y$10$zr2wsQ5uJ6qOOYKQT6G6S.NuRpVL8sH3geZKEt6/uQQHLQj32c0OW', NULL, '2014-09-13 23:06:24', '2010-05-10 05:44:33', NULL, NULL, NULL);
INSERT INTO `users` VALUES (35, 'Dino Lubowitz', 'dayne.heathcote@wiza.info', NULL, '$2y$10$wsMu.DkakykiXE8oTU3raOHXVxJoamlgYq7.ZYgH7g82N0mfZEp/S', NULL, '1978-05-09 04:31:04', '1977-01-09 08:29:57', NULL, NULL, NULL);
INSERT INTO `users` VALUES (36, 'Prof. Lola Swaniawski IV', 'bernita81@gmail.com', NULL, '$2y$10$asY1A/q8FG.ewOY5uJcs5OEIy074B94MUBc4LFWjAewA9dDD2i4/q', NULL, '2007-12-20 22:32:36', '1982-07-25 08:43:40', NULL, NULL, NULL);
INSERT INTO `users` VALUES (37, 'Jordan Wunsch', 'mittie11@wehner.org', NULL, '$2y$10$PMYoyFa8uzdfpZjSWymFueiUIJgulPL1Z.d5QSWjkmpTr9OHV8Aii', NULL, '1972-03-25 06:24:27', '1980-02-05 17:10:03', NULL, NULL, NULL);
INSERT INTO `users` VALUES (38, 'Prof. Raheem Reichert', 'anabel13@gmail.com', NULL, '$2y$10$dpKWZHE0eWtX4jSGjDETf.PnKeP5Tv8wxz7QvRFDHUltYr4e7DTIy', NULL, '1989-05-19 21:35:54', '1975-02-18 08:44:35', NULL, NULL, NULL);
INSERT INTO `users` VALUES (39, 'Clarissa Luettgen', 'hortense.koch@gmail.com', NULL, '$2y$10$Oq0jiLKeJ/bv47prVppWKumWBHGSvEYVYjrP1rLvKS6YOMc/WE5Ka', NULL, '2013-08-31 02:30:33', '2004-12-09 23:59:28', NULL, NULL, NULL);
INSERT INTO `users` VALUES (40, 'Daron Konopelski', 'ulockman@hotmail.com', NULL, '$2y$10$XHxAc5yxziI.GhtaogXbDuyjqCpMR1IIpn6ZlPK4kC06hMRMyj6ui', NULL, '2018-10-18 15:39:12', '1990-11-15 00:45:32', NULL, NULL, NULL);
INSERT INTO `users` VALUES (41, 'Flavie Hettinger', 'vprohaska@mante.com', NULL, '$2y$10$t3xRk7xidWxGvAP.9fbaXOHrXrT8A07fFJuz0CJkO86RB2LT0xgEy', NULL, '2014-08-18 22:06:09', '1977-10-20 15:55:51', NULL, NULL, NULL);
INSERT INTO `users` VALUES (42, 'Sophie Fay', 'gislason.chad@hoeger.info', NULL, '$2y$10$pMJYDQu4PFdfhftfYz84o.kpWMhyZKBCpQLz7llG4hc9SkWLh9YGS', NULL, '1994-05-16 06:05:29', '1971-02-21 13:27:01', NULL, NULL, NULL);
INSERT INTO `users` VALUES (43, 'Treva Adams PhD', 'gulgowski.danika@nolan.info', NULL, '$2y$10$tm2dDlM28TVYy/VEHayF5.1HTsRVQcMdRHPhdR83C0TQ5mVP5aj2q', NULL, '2010-12-29 13:16:00', '1980-10-27 07:19:28', NULL, NULL, NULL);
INSERT INTO `users` VALUES (44, 'Van Corkery IV', 'elmo.haley@hotmail.com', NULL, '$2y$10$Z21X/9lgamr4GNjTFu8Lm.Dz5gJGJIRFIgJ7CTetI9EwNVaui2Tge', NULL, '2006-08-04 16:45:10', '2005-11-25 10:47:11', NULL, NULL, NULL);
INSERT INTO `users` VALUES (45, 'Lincoln Collier', 'frami.wilbert@hotmail.com', NULL, '$2y$10$T1.0ot7/ldT9Aguo1vjT1OmuLKKBo8RoKxUBnwoxZd0n4MKQfKgaq', NULL, '1987-07-30 17:34:21', '1978-08-12 22:29:35', NULL, NULL, NULL);
INSERT INTO `users` VALUES (46, 'Micheal Hills DDS', 'gloria.bins@hessel.org', NULL, '$2y$10$B0q1DHJCGsX7JlCQaufzaOgkwZ.Gn1nQIbGMj7wizGSCSpU30lWMG', NULL, '2020-12-27 05:40:19', '1978-05-18 17:13:46', NULL, NULL, NULL);
INSERT INTO `users` VALUES (47, 'Prof. Rico Rogahn', 'qtoy@bode.com', NULL, '$2y$10$y0Q70ghzF6RyeJcsokjGWON6EFZWgDMJcRUbMUwrYp4CF9nQ87iY6', NULL, '2005-12-20 02:00:29', '1991-01-05 14:55:25', NULL, NULL, NULL);
INSERT INTO `users` VALUES (48, 'Pink Bruen II', 'zelma23@spinka.com', NULL, '$2y$10$yBq25BeBEdJFSkdIIHayde/JDeTt8GirgaiIYcPkG7/fxocihS6iO', NULL, '1970-12-30 05:53:46', '2019-12-08 13:01:43', NULL, NULL, NULL);
INSERT INTO `users` VALUES (49, 'Mr. Fidel Stanton', 'keshawn.murray@hotmail.com', NULL, '$2y$10$ttq2KmUNJpo4NTblqES18.wC5MAyIMAWvcSoBwkjO8Jj3U6nMhlS.', NULL, '1977-11-23 08:52:40', '1988-04-29 23:28:19', NULL, NULL, NULL);
INSERT INTO `users` VALUES (50, 'Prof. Ayana Baumbach', 'prince.romaguera@franecki.info', NULL, '$2y$10$VjQJCGfujM05f2hFbVf.g.9IL4rirjMe/PYElMJxme/vGwDbxpmxa', NULL, '2016-10-09 21:59:59', '2001-06-01 06:54:21', NULL, NULL, NULL);
INSERT INTO `users` VALUES (51, 'Ms. Alicia Swaniawski', 'heidenreich.rowan@thiel.info', NULL, '$2y$10$SpedDpYOtc2bNIfsVgIItuvtpzYqADHSgs6jumDKut6m2QqIxbNnK', NULL, '2002-07-19 22:35:17', '1970-07-08 23:26:26', NULL, NULL, NULL);
INSERT INTO `users` VALUES (52, 'Kira Nitzsche', 'jacobs.merritt@gmail.com', NULL, '$2y$10$pRMBOrNPoVPmO6A0cmmzIOQm99y60bh1PsIZPq.fW./1mQ4wIH.xu', NULL, '2019-09-27 19:44:57', '2013-09-04 20:39:37', NULL, NULL, NULL);
INSERT INTO `users` VALUES (53, 'Jaeden Lakin', 'audra.berge@hyatt.com', NULL, '$2y$10$6.yplQTstXbn0W0PZ7RnxelNKCe.OglTdYJJgmB5ObVF9vr3K7NZW', NULL, '1995-01-01 02:41:23', '2010-12-31 05:31:21', NULL, NULL, NULL);
INSERT INTO `users` VALUES (54, 'Garland Wyman MD', 'bogisich.clotilde@hotmail.com', NULL, '$2y$10$wfz5JO8srLRF1uNNPRzobOuBlFyjVnsyBn/nixjVjYh3AfFeBp5.e', NULL, '2019-06-17 03:13:53', '2015-10-30 09:46:53', NULL, NULL, NULL);
INSERT INTO `users` VALUES (55, 'Grace Volkman', 'ibarton@reilly.com', NULL, '$2y$10$A.hMZ/dGxx8MUw4uT3mPbusKWiRDjXwUmy1f2QDFQY3.ZgRiUxehC', NULL, '1971-07-18 01:24:58', '2010-02-14 05:50:15', NULL, NULL, NULL);
INSERT INTO `users` VALUES (56, 'Eusebio Mueller III', 'zkunde@hotmail.com', NULL, '$2y$10$QyeSGsf.ixZ9miIRuAdLge6gSz8wihJC9m0qPvOsLHtkY/ly1uCua', NULL, '2014-01-19 00:23:09', '1988-04-20 14:11:57', NULL, NULL, NULL);
INSERT INTO `users` VALUES (57, 'Avis Carter', 'bernhard.rosario@gerhold.org', NULL, '$2y$10$k.LkRTgPClw.Z.4HUiaMOe41JiE/ZwPfoNCHbIs7l/P0y6kUAf8Pa', NULL, '1983-05-05 14:49:46', '2017-10-12 06:21:16', NULL, NULL, NULL);
INSERT INTO `users` VALUES (58, 'Ms. Kelly Balistreri Jr.', 'ckoepp@weimann.com', NULL, '$2y$10$f3kISOk10xkLjzheNIXoYOgwzH7yMt57GIIjGULNsq64Y84us2ss2', NULL, '2011-09-26 05:54:37', '1979-09-16 08:50:38', NULL, NULL, NULL);
INSERT INTO `users` VALUES (59, 'Prof. Kassandra Nienow', 'jwaters@zemlak.info', NULL, '$2y$10$3MduUldSqpDx.z8iMAqTOu7mstAi7UboYCV9eLl1qgef5b4b4C9oe', NULL, '1971-03-28 00:36:55', '2017-06-02 16:04:19', NULL, NULL, NULL);
INSERT INTO `users` VALUES (60, 'Claire O\'Hara', 'tstrosin@hotmail.com', NULL, '$2y$10$AVSZw3qLM.NXM4x2a2E8s.JmVcYaAC0JGv0LwSyVwOJroB/J9OzLG', NULL, '1985-01-10 06:57:15', '1994-05-09 17:53:00', NULL, NULL, NULL);
INSERT INTO `users` VALUES (61, 'Dr. Nichole Nitzsche', 'nhowe@gmail.com', NULL, '$2y$10$8GRGCUY1J8R3HYnpY5/nYefGbNq3A2QwHEqnbMvbVlsp/EE0V7wqO', NULL, '2021-04-04 01:19:13', '1979-07-24 14:14:16', NULL, NULL, NULL);
INSERT INTO `users` VALUES (62, 'Cloyd Maggio', 'yasmine23@friesen.info', NULL, '$2y$10$eZYW23Al4.uAvDz7WNvyoO5j/p4dcT75UK49YuEne.KbA0jFyX7UC', NULL, '2010-07-05 13:14:31', '2021-09-17 13:02:56', NULL, NULL, NULL);
INSERT INTO `users` VALUES (63, 'Dr. Walker Weber V', 'vdavis@gmail.com', NULL, '$2y$10$z.oGVp5OvbhOKZExtt21V.NkrCyjBezqTv/fvLeoleAObsI4zpQxu', NULL, '2022-05-26 13:04:09', '1971-08-30 03:54:40', NULL, NULL, NULL);
INSERT INTO `users` VALUES (64, 'Emiliano Hackett', 'lueilwitz.edmond@reinger.com', NULL, '$2y$10$Cx/wTlY6mAV7g7xavOj29e15g8RkXRaN65oIeyzxMESUGMKVKU2ke', NULL, '2018-11-09 17:33:21', '2006-02-20 12:19:32', NULL, NULL, NULL);
INSERT INTO `users` VALUES (65, 'Dr. Anthony Eichmann', 'bednar.pauline@gmail.com', NULL, '$2y$10$opDWCosmeq6GW1xJNZ/8/eI1b6W8Rs9ipL.5uTBGZC4YNVuQGtsny', NULL, '1994-03-15 18:50:02', '1988-07-23 12:50:20', NULL, NULL, NULL);
INSERT INTO `users` VALUES (66, 'Mr. Franz Schmitt III', 'langworth.savanna@gmail.com', NULL, '$2y$10$q/eIl3Pdedvs1PAZqnxbBuY49hDfCfTRExuYFuEp1guYzUSX1EFvq', NULL, '1986-09-29 13:20:15', '1992-11-15 18:16:33', NULL, NULL, NULL);
INSERT INTO `users` VALUES (67, 'Mrs. Corrine Lynch DVM', 'bogisich.cornell@denesik.com', NULL, '$2y$10$z.1uXMbYKvkDA16pMFpV5OV4PmQUd77tl8j1CV.97G2JVTJbEF8gK', NULL, '2016-11-21 17:45:12', '1989-12-29 05:55:18', NULL, NULL, NULL);
INSERT INTO `users` VALUES (68, 'Laisha Greenfelder', 'stehr.chadd@morissette.com', NULL, '$2y$10$uLlE8oD.vC.mwKgGt6HpA.5OoI6VKccbkOjXqFMM0ovIxF3fsajda', NULL, '1989-09-08 05:47:24', '1993-04-09 02:03:20', NULL, NULL, NULL);
INSERT INTO `users` VALUES (69, 'Kassandra Roob', 'mante.deangelo@quigley.biz', NULL, '$2y$10$WqZKO2NjPBIRRX3iWD3XLOP1tpIdp7IxkldjNJ89xDpXQ0EO7XRRS', NULL, '1983-02-06 00:53:40', '1987-12-15 09:16:14', NULL, NULL, NULL);
INSERT INTO `users` VALUES (70, 'Mohamed Gislason', 'stamm.osborne@gmail.com', NULL, '$2y$10$IqRxHek1urFIhlviKnIQa.3v.caQVJRU3/e9CG76XhKiAc9N.fbVW', NULL, '2018-03-22 01:50:34', '1995-04-14 03:11:58', NULL, NULL, NULL);
INSERT INTO `users` VALUES (71, 'Prof. Sadye Watsica', 'edaniel@gmail.com', NULL, '$2y$10$TILU7aO68.ZTeNGoCyrA2O15ksXE6Q2ftgJNX6x.dNpjKdkT7m6TG', NULL, '2018-07-25 22:42:43', '2015-04-09 02:27:49', NULL, NULL, NULL);
INSERT INTO `users` VALUES (72, 'Prof. Claire Tillman I', 'zlarson@hotmail.com', NULL, '$2y$10$YJdSAQUCAtvjLMRoFOYxIOU4QPxlsQBnmu74oB9BTbMmiaHfRSMo2', NULL, '2002-06-25 10:24:46', '2004-11-16 22:07:11', NULL, NULL, NULL);
INSERT INTO `users` VALUES (73, 'Dr. Cortez Gislason V', 'astanton@gmail.com', NULL, '$2y$10$2KbhQv6D5ekDsaEOXhrOGekNP7sVMy.2sHIlnIAN.WoOK.dguchse', NULL, '1973-09-27 02:50:08', '2012-11-25 22:14:59', NULL, NULL, NULL);
INSERT INTO `users` VALUES (74, 'Lilian McCullough I', 'luz.casper@paucek.com', NULL, '$2y$10$QaCZiRZEpP9o.q/iWvxWne72/5hm/Q46zJ.pl4HrSU6jDM5HdPNaO', NULL, '1984-12-21 03:53:35', '2021-09-18 00:24:07', NULL, NULL, NULL);
INSERT INTO `users` VALUES (75, 'Beverly Littel', 'barton.glen@welch.com', NULL, '$2y$10$qE69hk0qKkKtgvOefNZsd.kvx8q3EMWhN7GNhrAmTaM1r7oRWEXb6', NULL, '2022-05-15 22:50:04', '1985-02-17 23:00:16', NULL, NULL, NULL);
INSERT INTO `users` VALUES (76, 'Norval Feest', 'kunze.lacey@stokes.com', NULL, '$2y$10$bucT/3x9oiebQVZ28zntcepOlsOvG4MB7dAg7JHe5rAFKZhNJpXMK', NULL, '1972-12-31 04:39:08', '2015-08-02 04:41:10', NULL, NULL, NULL);
INSERT INTO `users` VALUES (77, 'Sandrine O\'Connell', 'mervin31@gusikowski.info', NULL, '$2y$10$vQgGGLd4m8C41HhyqkAVAOcLY8qb.4M6YMhQNAPpytJSpEwpmddRO', NULL, '2010-11-07 12:40:25', '1998-10-04 04:20:15', NULL, NULL, NULL);
INSERT INTO `users` VALUES (78, 'Melisa Borer', 'pwill@pfannerstill.com', NULL, '$2y$10$Rnld119exi/u4j/eRPyXt.nYubTE6N/rGVAyqbWXSu/kWG1oPXXzm', NULL, '2017-12-24 19:51:50', '1995-05-21 08:16:21', NULL, NULL, NULL);
INSERT INTO `users` VALUES (79, 'Marquis Klocko', 'pablo75@yahoo.com', NULL, '$2y$10$kTxck6/p9UoddajmD2jUIuaYBO4r8wxh9Sz5oM/zx2/ZFDoBpComq', NULL, '1970-06-01 23:35:14', '2003-08-29 13:23:49', NULL, NULL, NULL);
INSERT INTO `users` VALUES (80, 'Susan Hermiston DVM', 'cary53@gleason.biz', NULL, '$2y$10$n2v7kHhOOeSi14.VSeRk9.x3/m67e8HlSOejqaEWvRQ/11PM4y/b2', NULL, '2007-03-27 04:48:41', '1984-12-09 22:44:00', NULL, NULL, NULL);
INSERT INTO `users` VALUES (81, 'Prof. Jayne Orn', 'ryan.anabelle@gmail.com', NULL, '$2y$10$iVcB7axvSiEjEpcECWxqcODI39b.Ek7lktc2f5K/8ZD1WCc8lvJFi', NULL, '1998-04-27 14:46:11', '1977-07-13 07:02:24', NULL, NULL, NULL);
INSERT INTO `users` VALUES (82, 'Dr. Armand Bartell V', 'aquitzon@gmail.com', NULL, '$2y$10$q9nvtKI5Mt1bmxu80BsiuufVSi3mG.3/3v8s6Pj2GlSn88Y5e07bK', NULL, '1980-03-22 14:09:47', '1993-04-20 22:07:49', NULL, NULL, NULL);
INSERT INTO `users` VALUES (83, 'Donald Waelchi V', 'mattie60@rippin.org', NULL, '$2y$10$PD3L2bMPCQanMdYQhaaJSez6cGRCbPGheZAunObOne/xqVKe0V7CK', NULL, '2021-06-26 11:08:25', '1979-01-25 17:06:54', NULL, NULL, NULL);
INSERT INTO `users` VALUES (84, 'Westley Luettgen Jr.', 'lueilwitz.meagan@hettinger.com', NULL, '$2y$10$9fqmiD0vhPgVY4qNSf0JN..Mjjv3hqGQMlv7Kr2I.grBIoEc6yhsy', NULL, '1970-10-14 16:21:04', '2007-09-04 17:53:54', NULL, NULL, NULL);
INSERT INTO `users` VALUES (85, 'Miss Allie Jacobs Jr.', 'wilburn.denesik@hotmail.com', NULL, '$2y$10$1FoILTXsIfkzlAJ1XH71guzBQTHrerPJKD5lxWhiyaICB/rbUSDVu', NULL, '1971-05-05 01:58:35', '1981-04-20 01:47:40', NULL, NULL, NULL);
INSERT INTO `users` VALUES (86, 'Orpha Hodkiewicz IV', 'towne.meda@hotmail.com', NULL, '$2y$10$kVBFVe.FDDqFnrXzyzhnL.PNLWL6uA9UgDwdWiE5ptFSGFOnQ0qse', NULL, '1992-05-27 07:41:37', '2012-01-09 10:23:11', NULL, NULL, NULL);
INSERT INTO `users` VALUES (87, 'Dr. Dasia Hoeger MD', 'gene.walsh@hotmail.com', NULL, '$2y$10$QLKPIoVFw1GIqivAJj3R5OfU33dWLnFWZdJ2JMzGdnn/v3FvzcbNO', NULL, '1970-04-30 01:37:47', '1970-09-03 21:25:23', NULL, NULL, NULL);
INSERT INTO `users` VALUES (88, 'Elta Carter', 'fatima.schowalter@gmail.com', NULL, '$2y$10$GXwyppOSTjyVrPIObhWU/OsQvxveNv2kpTkZAsQ3s3ZxdrqarfA12', NULL, '1985-12-16 13:27:00', '2012-05-24 10:11:08', NULL, NULL, NULL);
INSERT INTO `users` VALUES (89, 'Katlynn Wehner I', 'sidney.ritchie@ledner.com', NULL, '$2y$10$H66.Ex.Jyw8FMYYKEbBcXeLN9fwyRq6axtbnHzI7z4Yie8MZvfamm', NULL, '1978-04-27 13:31:56', '1982-07-11 06:39:05', NULL, NULL, NULL);
INSERT INTO `users` VALUES (90, 'Dr. Enos Kovacek II', 'randal.klocko@johnson.info', NULL, '$2y$10$FfTerVgH3IW.meOAKlXv9.z/r565xVzg4TSLUSM0l27Fkdr/ppCma', NULL, '1992-01-08 10:35:28', '1993-01-22 12:01:12', NULL, NULL, NULL);
INSERT INTO `users` VALUES (91, 'Miss Cassandra Bernier II', 'winifred.kub@hackett.biz', NULL, '$2y$10$i.fTABEDz9U.Z/910VcgpevpdcBHli9VL5DFvSsUiu0ZnyZx6j1Ja', NULL, '2000-11-20 09:19:01', '1971-05-12 03:16:08', NULL, NULL, NULL);
INSERT INTO `users` VALUES (92, 'Dr. Darron Murphy', 'ursula69@yahoo.com', NULL, '$2y$10$0Hbk4q3Co41hmaVmoIMcN.Q2HZi0QaiTG7XujkBnFUKuj3o8neTyy', NULL, '1972-02-27 06:56:17', '2018-02-19 08:22:30', NULL, NULL, NULL);
INSERT INTO `users` VALUES (93, 'Jaron Kuhn', 'myrl95@jacobson.com', NULL, '$2y$10$AQHNOvYFesAEHidiTOQTa.oTYZ77jUAJnNxoN937zmeblu1PQCDtW', NULL, '2003-10-04 12:07:46', '1975-11-03 10:52:03', NULL, NULL, NULL);
INSERT INTO `users` VALUES (94, 'Keegan Hodkiewicz', 'carter.alex@cassin.net', NULL, '$2y$10$w9NTF4my62aRzTnS3ySskeGoxI1Jt.4c2zVAY9GxPsYLVKn3dNHVm', NULL, '1972-08-10 01:00:02', '1986-08-15 00:02:56', NULL, NULL, NULL);
INSERT INTO `users` VALUES (95, 'Josefa Reinger', 'dulce91@ferry.org', NULL, '$2y$10$0LUcdb3GQ3x9KneZyuIIFOieZKG/dFk.DLYK0pehIyS02CS2NBewy', NULL, '1989-08-19 22:08:35', '1983-07-16 03:55:26', NULL, NULL, NULL);
INSERT INTO `users` VALUES (96, 'Mrs. Colleen Renner', 'cecil59@toy.com', NULL, '$2y$10$ln8DD3JX7ftxjSDiIi6SHe3xQYngzkg5CtJI42WuNxcGv8kNTKwpm', NULL, '1972-02-22 12:19:58', '2017-10-20 21:16:29', NULL, NULL, NULL);
INSERT INTO `users` VALUES (97, 'Asia Spencer', 'lurline63@hodkiewicz.com', NULL, '$2y$10$.LpkdrcMejaH9Qq..aEgh.JiHVi8/sEhwuU7idS9nhrGn63hGava6', NULL, '1988-09-09 13:20:00', '2016-01-27 16:27:50', NULL, NULL, NULL);
INSERT INTO `users` VALUES (98, 'Sanford Douglas', 'benedict.moen@yahoo.com', NULL, '$2y$10$GB3lFkrfBDF5ruRWDg20n.PKuv6S45iOjr.ZeBPdaq0c6s8syRtdu', NULL, '1990-03-24 08:21:23', '1987-05-02 08:18:32', NULL, NULL, NULL);
INSERT INTO `users` VALUES (99, 'Miss Carmella Ward MD', 'sandra35@shields.org', NULL, '$2y$10$YgVSFQhP3rpMFHrliBzK3undxAUm03qkWlqnCM3iUuthnpBMqiUuq', NULL, '2005-10-04 22:55:48', '2009-01-22 14:23:21', NULL, NULL, NULL);
INSERT INTO `users` VALUES (100, 'Dr. Rollin Kohler Sr.', 'jordy00@yahoo.com', NULL, '$2y$10$wUKrOOdw1WuhN76cKZ4LT.XtNKooAYouBOv8ZrKnYMls6IcsZZ4ge', NULL, '1997-06-03 07:42:37', '1981-08-20 12:44:07', NULL, NULL, NULL);
INSERT INTO `users` VALUES (101, 'Ms. Abbie Grady V', 'dlittel@yahoo.com', NULL, '$2y$10$JAu/wqIyEhNhLT4JaYqVNubrN1VZaMAw1aNN.jHim/VHcK65/Zq8C', NULL, '2019-03-27 00:17:44', '2005-03-05 09:43:21', NULL, NULL, NULL);
INSERT INTO `users` VALUES (102, 'Dr. Marcella Jones II', 'jbauch@goyette.org', NULL, '$2y$10$WiYSmzCdu6AX5IJ.gSGmgeBFk1lul7j54FYexNSKrmEL85fOYLfPS', NULL, '2007-07-02 00:11:16', '1970-10-04 12:51:06', NULL, NULL, NULL);
INSERT INTO `users` VALUES (103, 'Norene Romaguera', 'stella.windler@hills.com', NULL, '$2y$10$tLO8n0JB.QgvbgpCJpa1z./aifr6m2HQmdV5SxL2YsqLWrfVVKM4G', NULL, '2013-10-09 09:22:35', '2011-07-22 19:40:46', NULL, NULL, NULL);
INSERT INTO `users` VALUES (104, 'Isobel Langworth', 'laury.fadel@yahoo.com', NULL, '$2y$10$3lNt3egPpcqmVPyPUYb.wuheGpY/V/6IgPfrIKymY79weXO231NVy', NULL, '1984-05-11 09:44:50', '2015-06-30 11:03:56', NULL, NULL, NULL);
INSERT INTO `users` VALUES (105, 'Miss Roberta Roob DVM', 'schimmel.simeon@hotmail.com', NULL, '$2y$10$D7hHx.RZOSQ.0mlTZhqQZOhkk8ni6ahrByhW8Xc2JRNOrTQ3OeSkG', NULL, '2017-03-17 19:08:57', '2009-11-26 02:32:59', NULL, NULL, NULL);
INSERT INTO `users` VALUES (106, 'Casper Rowe II', 'tad79@yahoo.com', NULL, '$2y$10$.mOklU0KfxuD6SYIEHyMZOepOMwO0F0MqDZmUNPR.C1ilvhb2ePPu', NULL, '2017-06-12 10:19:48', '1975-11-11 13:05:48', NULL, NULL, NULL);
INSERT INTO `users` VALUES (107, 'Kaitlyn Mante', 'sgibson@yahoo.com', NULL, '$2y$10$D.hQWYZ7NgUBT1X/iLhhk.ta7Vahp4ofa9ylUMQguOLMeG.iVQEFq', NULL, '1976-11-16 22:45:39', '1996-12-23 12:34:02', NULL, NULL, NULL);
INSERT INTO `users` VALUES (108, 'Armando Ward', 'bdoyle@hotmail.com', NULL, '$2y$10$C9cH8LQPoFMS48wiHN7.xey0IM.BqIGIGkiwECehMb999paCR5QF2', NULL, '1998-11-27 12:57:45', '2010-09-21 13:28:10', NULL, NULL, NULL);
INSERT INTO `users` VALUES (109, 'Isobel Hartmann PhD', 'tiana.jakubowski@yahoo.com', NULL, '$2y$10$PkQZeWc6run8Afcq2btsq.gjdJoMEQFPXHxJvROVeaejv5MdwgSOS', NULL, '2009-11-20 08:49:32', '2015-10-01 10:51:20', NULL, NULL, NULL);
INSERT INTO `users` VALUES (110, 'Kiarra Kshlerin', 'ziemann.concepcion@satterfield.com', NULL, '$2y$10$A6lSiltAydkMcPB35FPCEONiS7pDWptNRI6ShSzAT6YIZFTZpH8Sm', NULL, '1998-10-24 10:46:30', '2012-08-04 04:47:50', NULL, NULL, NULL);
INSERT INTO `users` VALUES (111, 'Ernie Hudson', 'tyrel.wisoky@lowe.com', NULL, '$2y$10$h0Lyl4RWh/.56GavFlboEOvjnTFl4MDdBT/yqWFhW8qqKNKYqgnLK', NULL, '1983-07-17 21:30:44', '2022-01-19 19:27:52', NULL, NULL, NULL);
INSERT INTO `users` VALUES (112, 'Dylan Romaguera IV', 'lorena39@lesch.com', NULL, '$2y$10$Cpqxk2S3Kd2F1peydSdFPuP9f6owtz53lTwZsW2wV9L3Po1SVVjFa', NULL, '2005-03-09 14:00:13', '1982-03-28 06:08:30', NULL, NULL, NULL);
INSERT INTO `users` VALUES (113, 'Anabel Blick PhD', 'jadon84@yahoo.com', NULL, '$2y$10$lBJWUJBfpXgnXYUv8ibRy.ijmkuaiwlqlvjFcgJEgW27UeDeHmxG.', NULL, '2002-08-31 12:05:52', '1973-05-31 19:06:39', NULL, NULL, NULL);
INSERT INTO `users` VALUES (114, 'Mrs. Dorothy Kunze II', 'elza06@gmail.com', NULL, '$2y$10$Gw5uqRNM.YVmLkT26glq9uZI5.x5HI8ZLOKDvyAnwwCkNJdBPZWni', NULL, '2007-04-16 05:50:29', '1991-07-07 21:17:37', NULL, NULL, NULL);
INSERT INTO `users` VALUES (115, 'Westley Swift MD', 'liliana.quitzon@dibbert.com', NULL, '$2y$10$HkjkQgremyTnxrvHFE4hfer2WrUeY.RYsYZeoP7JcXt.4x83EiC2u', NULL, '2021-10-29 12:07:19', '2013-09-06 16:26:04', NULL, NULL, NULL);
INSERT INTO `users` VALUES (116, 'Anjali Robel', 'hayley.mraz@howell.com', NULL, '$2y$10$f0lc4opmJ4sJt9S3dp9s/enxxE1grIjVzW.vpSZXo.FJd0Q.OuCqe', NULL, '2003-11-02 17:01:58', '1992-07-22 00:17:48', NULL, NULL, NULL);
INSERT INTO `users` VALUES (117, 'Dr. Albert Powlowski Jr.', 'kunde.clarissa@bechtelar.com', NULL, '$2y$10$9JaRx4iEOydZwf.j.dj4L.ozn.ri1Vk4bVUiayw2ZboGwC7oEJIpe', NULL, '1990-11-13 14:24:44', '1972-02-01 06:14:59', NULL, NULL, NULL);
INSERT INTO `users` VALUES (118, 'Talon Reichel', 'chessel@blick.info', NULL, '$2y$10$NQ.Ne9ACAHGbDv5nqf3N1Oq0ihzaZRPWeLp.CDTkExDprTl21hLKS', NULL, '1998-03-13 07:01:37', '2012-08-17 16:46:46', NULL, NULL, NULL);
INSERT INTO `users` VALUES (119, 'Arden Kuphal', 'evie.rowe@hotmail.com', NULL, '$2y$10$mRNBtunPayb7qxSRpYAmfObdv/sylM8jPj/NHEFxk6m5nP2oxwG/W', NULL, '1997-10-21 21:07:32', '1973-07-20 18:42:09', NULL, NULL, NULL);
INSERT INTO `users` VALUES (120, 'Peggie Gaylord', 'cyrus.parker@lang.com', NULL, '$2y$10$ekdLbzF8ZCxCxzWPtmyseOy6tWU7MujizzXFfSKdArVSFx6WwYg.S', NULL, '1989-01-25 20:36:13', '1978-01-15 20:19:30', NULL, NULL, NULL);
INSERT INTO `users` VALUES (121, 'Elyse Conroy', 'madison49@yahoo.com', NULL, '$2y$10$Z2jOnfEJbXkXFjyWWo1RjOt0pw54h2vim2lMwZL9Ad63UatNQU.H.', NULL, '2002-08-08 18:31:05', '1986-12-10 19:10:56', NULL, NULL, NULL);
INSERT INTO `users` VALUES (122, 'Mr. Andrew Koepp DDS', 'charlie.runolfsdottir@gmail.com', NULL, '$2y$10$nfy2D600fkkTxLchAJMXK.beslW7i0MX99tSM/dIWEQ.rguRP.zA2', NULL, '1993-10-07 10:01:27', '1970-10-07 06:09:27', NULL, NULL, NULL);
INSERT INTO `users` VALUES (123, 'Rowland Pouros', 'halle55@hotmail.com', NULL, '$2y$10$CRKHDI74TPoyUtHVwUveE.szQ489GkI/JK2aBaPNRrFTuUGgErVS.', NULL, '1987-08-01 22:03:05', '2003-04-08 19:41:29', NULL, NULL, NULL);
INSERT INTO `users` VALUES (124, 'Mr. Torey Franecki DVM', 'esta.sporer@hotmail.com', NULL, '$2y$10$0HX4NpL3FVshXrh37y0Xauwfk4bNL7zn2ADhgEO9.fXzDL4n/AfX6', NULL, '1996-04-04 03:16:20', '2008-07-12 17:13:58', NULL, NULL, NULL);
INSERT INTO `users` VALUES (125, 'Olen Larson IV', 'jan33@borer.com', NULL, '$2y$10$mnLFzCOTqpM42HeaFNMZwuZplKfMbKg1bvGBBDw/twaI1vI8gxzKW', NULL, '2018-10-31 01:58:17', '2002-01-01 02:15:20', NULL, NULL, NULL);
INSERT INTO `users` VALUES (126, 'Lizeth Reichel', 'kuhic.deshaun@daniel.com', NULL, '$2y$10$0USK/9u0OLT.x.Rf21ozveYNLZfpgInTeKgAcl9Fa8JOotDQWET2y', NULL, '1981-08-07 00:44:06', '1984-06-28 17:39:20', NULL, NULL, NULL);
INSERT INTO `users` VALUES (127, 'Grover Reinger IV', 'elisha.kertzmann@gmail.com', NULL, '$2y$10$WP1gYFt9lNrZ4QKkcaqya.IlAA8D97OombCvagDp6wVPokv.s5Cr2', NULL, '2001-12-13 06:32:00', '2009-05-21 18:19:59', NULL, NULL, NULL);
INSERT INTO `users` VALUES (128, 'Edythe Kovacek', 'tconnelly@botsford.com', NULL, '$2y$10$tRK7bsvxeUlbnzUnIPfBvu1DmjtiqTAZanmvNpK7zy3dGVJh/zhbu', NULL, '1974-05-19 11:29:53', '1984-10-26 23:19:14', NULL, NULL, NULL);
INSERT INTO `users` VALUES (129, 'Mr. Marlin Crooks DDS', 'kulas.price@yahoo.com', NULL, '$2y$10$PPYedciD0hjXtRtGGvyCL.UFHhiI9frVrmGMTZ3Qo9UoPiS25A8.2', NULL, '1999-10-15 18:21:26', '1982-11-09 12:10:43', NULL, NULL, NULL);
INSERT INTO `users` VALUES (130, 'Eldridge Spencer', 'emard.einar@hotmail.com', NULL, '$2y$10$207Uzq.JYKd6r94fuI.fkeSanz1stADNcJH.F9DOVG3zTdB2/pYBe', NULL, '1976-06-04 00:27:50', '1995-05-28 01:48:42', NULL, NULL, NULL);
INSERT INTO `users` VALUES (131, 'Evelyn Lebsack I', 'elissa17@yahoo.com', NULL, '$2y$10$q6Rk0QyegN9jjVGvkf.PXuJ/cL9Fr1fLJP6m/wRM8l9jmtlB/2vmm', NULL, '1980-10-15 22:31:24', '2000-10-30 21:51:10', NULL, NULL, NULL);
INSERT INTO `users` VALUES (132, 'Mrs. Thelma Dach MD', 'xschoen@rohan.net', NULL, '$2y$10$lgE0ilXlIIfey5YW.lUpqOg4QW.Yp6YLi8rPfMgegZGynzV.Rsf4e', NULL, '2011-04-23 21:24:29', '2007-10-25 09:38:25', NULL, NULL, NULL);
INSERT INTO `users` VALUES (133, 'Macy Gaylord PhD', 'aiden.witting@yahoo.com', NULL, '$2y$10$2uKOsWMWdzOgZ7DYGiqZ9u3DfNvRu3Sh0EM9Zy/BBLeZifbkBAon.', NULL, '1980-01-30 21:02:16', '2021-08-30 08:26:03', NULL, NULL, NULL);
INSERT INTO `users` VALUES (134, 'Turner Graham II', 'greyson78@gmail.com', NULL, '$2y$10$PfO8qcm/mZ9Wok5U/l64g.ZYUQ5jLVUGFClhli0GhQgI8DPGyh8AC', NULL, '1989-10-05 10:33:36', '2015-05-25 09:58:20', NULL, NULL, NULL);
INSERT INTO `users` VALUES (135, 'Evangeline Orn', 'brandt.okon@gmail.com', NULL, '$2y$10$3YuDLkl/3w87lOmz9XxuqeG7ggF7TYbCurVka9h0p1xJJ/VCta07G', NULL, '1997-03-20 06:58:22', '2004-11-23 09:24:26', NULL, NULL, NULL);
INSERT INTO `users` VALUES (136, 'Mr. Lazaro Murazik', 'darrel50@yahoo.com', NULL, '$2y$10$A2heGi.q3UHsEbmL0JHLSeELMRC3/hA2qImSVhD8es8T4e5d9iTU6', NULL, '2002-10-09 15:00:48', '2002-08-25 05:38:42', NULL, NULL, NULL);
INSERT INTO `users` VALUES (137, 'Dr. Henriette Goldner Sr.', 'chase.krajcik@hotmail.com', NULL, '$2y$10$7oh65lLQRMxSgy3vok.SD.4iY6rmiNvuRBlww7oGJ6QSvlpanpq.O', NULL, '2022-09-02 02:15:00', '1980-04-07 22:34:19', NULL, NULL, NULL);
INSERT INTO `users` VALUES (138, 'Mr. Gust Hodkiewicz IV', 'block.karl@hotmail.com', NULL, '$2y$10$J0emjkkQ3JkrjVsKLxTi5.yXoWMtVlGW1xpZnCe.GF62FV5GYlbKm', NULL, '1982-11-08 02:20:03', '2006-07-31 05:29:19', NULL, NULL, NULL);
INSERT INTO `users` VALUES (139, 'Mr. Saige Kunze', 'dawn37@wyman.com', NULL, '$2y$10$PV/xHmlJ3AM4X.BMFMer/uUd1fIzfO0Xa/A.cDn1innm.HqyvM9JO', NULL, '2012-05-01 13:58:23', '2005-10-05 03:05:41', NULL, NULL, NULL);
INSERT INTO `users` VALUES (140, 'Prof. Charity Jaskolski II', 'santina.rippin@yahoo.com', NULL, '$2y$10$2ebOnOpTQ3t.2FnyUQC.CeF7HvAbw8jc.XxjWcWwlfhG6quDhPATi', NULL, '2016-01-14 10:26:46', '1993-10-03 13:33:30', NULL, NULL, NULL);
INSERT INTO `users` VALUES (141, 'Vena Bednar', 'dquigley@hauck.net', NULL, '$2y$10$43FwPgf9nN6vx0fr2DjKBOlBGLTmfz5J7bpj0d./eRjBNm3u3SP2e', NULL, '1997-10-18 01:21:45', '2004-12-29 08:12:52', NULL, NULL, NULL);
INSERT INTO `users` VALUES (142, 'Gerald Huels', 'magali.nikolaus@wiegand.org', NULL, '$2y$10$Zu9H6LdbD9PV/F5Xw8nPDOFrQyiKIUz3F3VmE6thLYcVb7AMa1Dcq', NULL, '2001-11-19 18:43:10', '2015-04-27 00:29:13', NULL, NULL, NULL);
INSERT INTO `users` VALUES (143, 'Kyleigh Gottlieb', 'bwyman@hotmail.com', NULL, '$2y$10$jHxb/PNY6eLWphcFAxw6i.OUYRx9LDj1u5AYXWbVGBi/8Trbj/qD2', NULL, '1972-07-31 10:08:44', '2021-10-18 16:35:14', NULL, NULL, NULL);
INSERT INTO `users` VALUES (144, 'Rodger Torphy', 'marlin.okon@turner.com', NULL, '$2y$10$Ow2aFjO.Pv8ncszDVToSw.5kveVAgHapY9Obc.AFgAF7f740YRpLK', NULL, '1999-06-20 20:32:23', '1999-08-14 00:16:24', NULL, NULL, NULL);
INSERT INTO `users` VALUES (145, 'Shanelle Goodwin', 'poconner@windler.com', NULL, '$2y$10$480ohdPASeAiESPXP4sIv.Q7IvrWBq640MYAekWbmLPz1okfzuk/a', NULL, '2012-01-18 01:56:40', '2017-12-08 21:03:13', NULL, NULL, NULL);
INSERT INTO `users` VALUES (146, 'Alexanne Keeling', 'johns.emmet@schultz.com', NULL, '$2y$10$0FBjDANRO753kvGPl2wF3Om9Vq2aIOVbYDjGPCUXkE20j6s2ext8K', NULL, '1979-05-19 18:57:41', '1999-05-30 17:33:18', NULL, NULL, NULL);
INSERT INTO `users` VALUES (147, 'Karelle Wehner', 'korbin33@yahoo.com', NULL, '$2y$10$BYYG/0ZdS0dM/mvTrPXtd.WEPPTW0H0iAoYYeJ6b/Lc50x/uJ7rli', NULL, '1990-01-14 20:09:44', '1994-11-29 13:56:36', NULL, NULL, NULL);
INSERT INTO `users` VALUES (148, 'Zoe Bashirian', 'sigmund41@flatley.biz', NULL, '$2y$10$uOD6mLJBapWmktUDydyYS.CW3IsaTRewSt3H3vRcVh2/6IJyDzEzm', NULL, '2014-07-26 06:29:18', '1982-01-23 23:55:12', NULL, NULL, NULL);
INSERT INTO `users` VALUES (149, 'Mrs. Sienna Jenkins III', 'zgorczany@hotmail.com', NULL, '$2y$10$74MB6GeEhBTHSItP2MhgXuoZ9lfX4Y1W3eZL6gBOvfOkG.ohr/it6', NULL, '2004-05-03 12:30:56', '1974-09-03 00:32:59', NULL, NULL, NULL);
INSERT INTO `users` VALUES (150, 'Antonetta Weber', 'awolff@yahoo.com', NULL, '$2y$10$yBwL0LQdhXFNJtF4STM/tuxGCDz17c1oB8DJ3Z0hFdpIWBMVUaixO', NULL, '1989-09-12 10:22:41', '1977-02-03 00:00:56', NULL, NULL, NULL);
INSERT INTO `users` VALUES (151, 'Clair Crona', 'rosemarie54@yahoo.com', NULL, '$2y$10$jL4eoEBmi0rSt4UOhnvm9OLumkA0lhb7DotNsnyDnq/VH8ndm3T9C', NULL, '1970-07-21 23:50:26', '2013-07-15 05:10:57', NULL, NULL, NULL);
INSERT INTO `users` VALUES (152, 'Aliza Schultz', 'erin.schaefer@yahoo.com', NULL, '$2y$10$oUgRJoVGWjfHfV2l0xhsoutNX9zmYCJxDWASBs4SW.OvvEPqwwaAm', NULL, '1980-09-06 11:22:15', '1970-12-04 15:42:38', NULL, NULL, NULL);
INSERT INTO `users` VALUES (153, 'Lera Rau', 'gmarks@schulist.com', NULL, '$2y$10$7iNoeq1gVARlBo9PnQlt5ef2ZkCzX0CvUYQMOiKlm1yzWAYVXt3oC', NULL, '1986-09-25 06:07:32', '2016-09-17 12:57:18', NULL, NULL, NULL);
INSERT INTO `users` VALUES (154, 'Melany Nolan', 'madge43@damore.org', NULL, '$2y$10$zB7ojhNuHvphwtNOvITkKu/Z/w9kWbnrnrrGLep.r7zLj3LDzvflK', NULL, '2000-04-18 17:47:12', '2017-04-11 00:48:15', NULL, NULL, NULL);
INSERT INTO `users` VALUES (155, 'Ayana Kautzer', 'nikolaus.jackson@ward.info', NULL, '$2y$10$BWXwLTwZi1jnQY99Y9VkDOOa4XV61ZLmf/3YClcwMdseyIt.ESkFG', NULL, '1989-12-09 13:42:46', '1994-07-19 05:44:30', NULL, NULL, NULL);
INSERT INTO `users` VALUES (156, 'Verner Tremblay', 'fbahringer@gmail.com', NULL, '$2y$10$JOmKG6k4ViYGHmYohDbnfeYkkcjFSA3XzC7OzxNOEAGG8A8fvkRkW', NULL, '2014-03-08 23:05:38', '1983-11-08 02:16:32', NULL, NULL, NULL);
INSERT INTO `users` VALUES (157, 'Prof. Marjory Kilback', 'dstark@mayert.net', NULL, '$2y$10$1zHsj3AA6fYmW3p6aifYz.cSgVxBseuVd8CkLYJEB/wdDqdeyPgRG', NULL, '2006-07-20 07:24:42', '2020-03-18 07:31:10', NULL, NULL, NULL);
INSERT INTO `users` VALUES (158, 'Rubie Kautzer', 'dylan37@yahoo.com', NULL, '$2y$10$7mmyfGc72wdpIvSbgG/xeu4JiyACa.BpXpgVNBklAczZSM6a9TwR2', NULL, '1987-11-02 17:57:20', '2011-12-19 16:36:08', NULL, NULL, NULL);
INSERT INTO `users` VALUES (159, 'Ms. Carmen Lockman MD', 'marvin.otho@hotmail.com', NULL, '$2y$10$cEJ1cYGbdIdKgUAqoF1K..saFidanktqd0FO2g.auR75puRB0kGUm', NULL, '1974-06-29 03:39:33', '1998-05-18 08:30:56', NULL, NULL, NULL);
INSERT INTO `users` VALUES (160, 'Dr. Benjamin Bruen', 'brakus.madonna@wolff.com', NULL, '$2y$10$7TQXfBluq/O97ImoIuu5f.feF1DWYwHMGCjEqZ8MLHfr6np0zZcbe', NULL, '1982-08-06 00:50:39', '1983-07-31 21:17:56', NULL, NULL, NULL);
INSERT INTO `users` VALUES (161, 'Jonathon Will', 'shany10@krajcik.biz', NULL, '$2y$10$KfdJUTtqkho9zMoc1stqFewnVFEikAgfA1T26znSEn4CcFWExulim', NULL, '1979-07-23 20:49:51', '1975-04-16 12:45:19', NULL, NULL, NULL);
INSERT INTO `users` VALUES (162, 'Arch Toy', 'ugusikowski@hessel.com', NULL, '$2y$10$335.5WvNGSfcovN.zJFf1O8/8o4RK1xAAiiLhqXu38lWdnlCC88JG', NULL, '2018-01-30 14:34:05', '1990-11-09 13:37:09', NULL, NULL, NULL);
INSERT INTO `users` VALUES (163, 'Jalon Franecki', 'brakus.lazaro@yahoo.com', NULL, '$2y$10$qeunW28QldogcD1Z5VeOp.RanPpnfnq0EWpVZxKtOaxvh3tIWYQ/q', NULL, '1989-04-11 01:36:32', '2000-05-31 03:45:49', NULL, NULL, NULL);
INSERT INTO `users` VALUES (164, 'Prof. Jimmie Bradtke', 'xsporer@haag.com', NULL, '$2y$10$iVDj8hPtiSg9Dps29.5cKOjLViwL/k77e5QSykP1fJJq0iY9Eatzq', NULL, '1970-03-07 18:58:00', '2017-10-22 04:36:56', NULL, NULL, NULL);
INSERT INTO `users` VALUES (165, 'Dr. Eloy Ortiz III', 'qgulgowski@gmail.com', NULL, '$2y$10$P2gusFZ9dMQ2B7E6wl8Ajuk3bYNuFuPu530JsJ82ZL.z4JT556DAC', NULL, '1998-04-06 00:26:28', '1995-11-05 15:33:42', NULL, NULL, NULL);
INSERT INTO `users` VALUES (166, 'Obie Sanford', 'kkuhic@tremblay.biz', NULL, '$2y$10$tYq0Qmt9n8kO6w2W5ldhouV769GQYmJAkV/z557ycHQ8R3XKHiYZ6', NULL, '1974-01-11 21:53:04', '1970-10-05 02:28:01', NULL, NULL, NULL);
INSERT INTO `users` VALUES (167, 'Miss Shayna Bernhard', 'jaleel.bode@yahoo.com', NULL, '$2y$10$VYIJ/1Ny7bsyJoQLNeMfpucy.YcQZxoQ5DD15a5xx1qRCaeS4AFLq', NULL, '1995-03-27 09:42:27', '1996-02-05 11:19:23', NULL, NULL, NULL);
INSERT INTO `users` VALUES (168, 'Tessie Gleichner', 'akilback@hotmail.com', NULL, '$2y$10$KW7x/HE2NBFKj.stzdgEeeBxTblgVhq58RI7SsW.r0hBT3NBRoS6u', NULL, '2010-07-08 19:33:31', '2014-03-28 07:24:39', NULL, NULL, NULL);
INSERT INTO `users` VALUES (169, 'Edison Friesen', 'wcronin@renner.com', NULL, '$2y$10$plZldEuIJSvWF9lTjSIzGOGKD.MUd/wB2fOHGawTqc9gPpV7q.PJi', NULL, '2012-07-06 11:50:23', '1981-05-12 03:57:31', NULL, NULL, NULL);
INSERT INTO `users` VALUES (170, 'Dr. Kenyatta Windler', 'xlittle@hotmail.com', NULL, '$2y$10$MX.UOPxcPARMEKlNsbdYIeUGdPN5KbgVgbY5a8iWaWUImjzS8V4ZC', NULL, '2017-11-26 15:08:11', '1993-03-31 03:47:46', NULL, NULL, NULL);
INSERT INTO `users` VALUES (171, 'Ms. Amber Murray', 'laisha48@cole.com', NULL, '$2y$10$cDjMY/75M2X93bMBS9sdLeLZGhe/HX9o0I0hykzPrJAw3wRWe3CA2', NULL, '1985-11-04 19:03:58', '1978-11-20 14:01:33', NULL, NULL, NULL);
INSERT INTO `users` VALUES (172, 'Moises Roob', 'rhintz@schultz.com', NULL, '$2y$10$BqN2n4corosTHAe6IW6MQ.EoX6Qhfi397H02fyfGZYF8oYQQfxJLe', NULL, '1984-04-02 16:49:06', '1993-09-09 14:52:38', NULL, NULL, NULL);
INSERT INTO `users` VALUES (173, 'Giovani Shields', 'mante.hermann@hotmail.com', NULL, '$2y$10$IF6mFEcjIXjRRdtDGKPGBOJWjp5mjz0H59F.b.HqXsSLx2AX44KLK', NULL, '1972-10-06 18:31:38', '1987-07-13 03:45:53', NULL, NULL, NULL);
INSERT INTO `users` VALUES (174, 'Prof. Werner Stroman', 'bmccullough@effertz.org', NULL, '$2y$10$novVYPPRfm/XhkI2diH/WOu50TYR3W7NDcdd161QXyLysTkKtfdc.', NULL, '1981-06-02 15:34:49', '1980-10-27 11:47:09', NULL, NULL, NULL);
INSERT INTO `users` VALUES (175, 'Lexi Howell', 'emoen@gmail.com', NULL, '$2y$10$05MowKkGcqjkj73v8xFGq.uagFPO9WC29SVAL46x0.uEYBFRQpknu', NULL, '1981-06-09 04:02:19', '2001-09-02 18:07:55', NULL, NULL, NULL);
INSERT INTO `users` VALUES (176, 'Felix Fay', 'friedrich92@gmail.com', NULL, '$2y$10$IUPBBzOdlgsE37rx/Na4LeOG8/V5rq7GTifqCwyhBtJg8dqTuqVpa', NULL, '2009-11-07 01:59:44', '2010-10-15 12:35:42', NULL, NULL, NULL);
INSERT INTO `users` VALUES (177, 'Roosevelt Collier', 'uhauck@yahoo.com', NULL, '$2y$10$ozjzxg5rxB85bUR5/Oah7uFSiqtmkjXpFV0KmOHoMusZ6b2BhK3NW', NULL, '2006-11-11 00:49:15', '1999-07-12 12:07:19', NULL, NULL, NULL);
INSERT INTO `users` VALUES (178, 'Adeline Koepp IV', 'rollin.lind@lueilwitz.com', NULL, '$2y$10$5tJxPiyL6I6mt7uKwpSOwuCa2IC94nG734oEtk/NMVWv9MD0LYece', NULL, '2007-11-05 00:31:11', '1990-05-12 02:43:24', NULL, NULL, NULL);
INSERT INTO `users` VALUES (179, 'Agustin Botsford', 'iullrich@hotmail.com', NULL, '$2y$10$h6MADcehbM09KRtoZS1SM.Sa4BSlmoPFRuGUriFNuA0IJ90V3UgcK', NULL, '1973-10-04 23:11:22', '1992-07-17 15:11:40', NULL, NULL, NULL);
INSERT INTO `users` VALUES (180, 'Cyril Dicki', 'mckenna41@kub.biz', NULL, '$2y$10$PO3hRfS5529wAtVatuFotuw44zUFU1BK6Zgu9dwMMTP00.cfSwhd6', NULL, '1995-05-11 05:21:18', '1980-09-07 06:08:25', NULL, NULL, NULL);
INSERT INTO `users` VALUES (181, 'Jeramie Batz II', 'catharine72@hotmail.com', NULL, '$2y$10$iXcXODnk/ev7MloClDehVONQPw2utO0hTbtLMLhZxYj8ldLsnXTrK', NULL, '1973-01-31 09:31:42', '2009-11-19 11:19:26', NULL, NULL, NULL);
INSERT INTO `users` VALUES (182, 'Danielle Sipes', 'kirk89@orn.net', NULL, '$2y$10$d1BlQsvEM67unIegQJCd7ujwMZh4o5hvgYfxxOaS32M/1ntKPnle.', NULL, '2016-07-26 22:54:20', '1987-02-23 00:15:35', NULL, NULL, NULL);
INSERT INTO `users` VALUES (183, 'Prof. Kennedy Upton III', 'yherman@yahoo.com', NULL, '$2y$10$Uzxj9jTv5mBG2XRQRm.5lus4V754rPE1SCuKXIXX3xc4i2q78J2fy', NULL, '1990-05-25 20:18:44', '1996-11-04 17:52:07', NULL, NULL, NULL);
INSERT INTO `users` VALUES (184, 'Kellen Kirlin', 'fannie.shanahan@yahoo.com', NULL, '$2y$10$qOhgrzzGkD8Ad5Gj1csBtuSuADCDIPXhH5asuIvfhIa9QwHOKdsm2', NULL, '1991-06-01 16:58:57', '1995-10-17 15:24:42', NULL, NULL, NULL);
INSERT INTO `users` VALUES (185, 'Dr. Zoie Jaskolski', 'huels.veronica@gmail.com', NULL, '$2y$10$AbAvrHNV.tU/id0yE4m6aOrCYO1E3PdS8BjR76.c85oot0mgj16Wm', NULL, '2012-08-15 04:11:03', '1971-07-19 17:42:21', NULL, NULL, NULL);
INSERT INTO `users` VALUES (186, 'Simone Zulauf', 'rice.ubaldo@yahoo.com', NULL, '$2y$10$qOpUVErqJsDxRnxmv8jfA.w/8FQ7Cv8xZ94.xa3Y5KNOS5dgb82RG', NULL, '2013-12-28 02:51:45', '2003-10-09 03:31:28', NULL, NULL, NULL);
INSERT INTO `users` VALUES (187, 'Amina Lynch', 'schulist.lera@champlin.com', NULL, '$2y$10$ozhEGDSRnePI/6EiFveNwO8nVLtEsKeWvOcFXGqWtewWk2.3RlOXq', NULL, '2005-08-12 14:06:26', '1988-05-04 16:43:23', NULL, NULL, NULL);
INSERT INTO `users` VALUES (188, 'Ms. Nellie Fahey', 'houston.abshire@gmail.com', NULL, '$2y$10$tnsUo658Ax/nsUbXF2.KtuPqe9l/d.dHMzrVW1XqxvfJ6wvlF9ele', NULL, '1990-11-21 13:30:14', '1973-07-19 17:12:09', NULL, NULL, NULL);
INSERT INTO `users` VALUES (189, 'Fernando Goyette', 'morton.sauer@bins.com', NULL, '$2y$10$kjeQPMWaAMK0Se.EcK2Bs./vN/DwWIEbc2Y19vqApTQs/ad5MLh8G', NULL, '2021-02-11 05:47:23', '2011-11-02 13:52:02', NULL, NULL, NULL);
INSERT INTO `users` VALUES (190, 'Aisha Steuber Sr.', 'vzulauf@ullrich.com', NULL, '$2y$10$WLDkE7Wd..Sac8ZvQSV4J.dvKRI0JNbPVcGJt99nDKB9dSh/XzCJy', NULL, '1981-10-28 08:46:24', '1973-10-28 11:57:26', NULL, NULL, NULL);
INSERT INTO `users` VALUES (191, 'Roselyn Beatty', 'nicklaus90@hotmail.com', NULL, '$2y$10$6A2nsVZorI0D9L4V2l3zN.NgLbksTxSztHN36t4GwHneypIZhkyCC', NULL, '1974-03-27 15:33:40', '2001-01-03 16:14:19', NULL, NULL, NULL);
INSERT INTO `users` VALUES (192, 'Lulu Kozey IV', 'charlene81@johns.com', NULL, '$2y$10$eEsDk72HjSNa9LT17c4.yOmY.erTI4j3q.TV2NvBM6MRGv.Ndeski', NULL, '1979-01-29 03:00:22', '1982-10-08 20:51:29', NULL, NULL, NULL);
INSERT INTO `users` VALUES (193, 'Lois Farrell DDS', 'okon.chadrick@hotmail.com', NULL, '$2y$10$YwqsDMUE2AixMtYW9Z59SObcWKIsDzxJXgm4Pnb1tLxKC8E6Y8PrS', NULL, '2012-05-26 23:14:09', '1970-07-31 01:43:53', NULL, NULL, NULL);
INSERT INTO `users` VALUES (194, 'Jordon Gibson', 'mohammad.kris@gmail.com', NULL, '$2y$10$rkMY8U4QRcnzO53m8D9NnuY6gcqGt2KaYUfxtElHGxPTebJb7HyKS', NULL, '2003-08-20 10:34:23', '1970-11-01 08:25:48', NULL, NULL, NULL);
INSERT INTO `users` VALUES (195, 'Elsie Rath II', 'brady00@jacobs.org', NULL, '$2y$10$hETuMvCUQJdTCEBbihg5z.cemTeHWegOI8KxzBRz1.BV4YQ0XMJAq', NULL, '1980-05-27 11:46:39', '1986-04-11 04:18:12', NULL, NULL, NULL);
INSERT INTO `users` VALUES (196, 'Nickolas Simonis', 'lilly14@gmail.com', NULL, '$2y$10$d8D1BwhNdxnwlVOBjAvmYesUh006/0lJQS4LS0OwfSKOdVbHakDfK', NULL, '1995-03-26 21:01:26', '1988-05-10 07:41:32', NULL, NULL, NULL);
INSERT INTO `users` VALUES (197, 'Earnestine Funk', 'pbeier@hotmail.com', NULL, '$2y$10$QhoYSm3QOENuHgDaet/09OWQNCnSZUPE/3JQtj9yvuXcQFBvhPhMa', NULL, '1982-01-07 11:49:11', '2022-09-12 10:54:56', NULL, NULL, '2022-09-12 10:54:56');
INSERT INTO `users` VALUES (198, 'Rozella West DDS', 'wiza.jordan@gmail.com', NULL, '$2y$10$BL.wywVFtqR/Nx.5G.Dm.unOKJih0.WTtJpFZSmVyDx/BtLVSH8uG', NULL, '1990-09-30 10:06:05', '2000-09-20 07:41:44', NULL, NULL, NULL);
INSERT INTO `users` VALUES (199, 'Glen Rippin II', 'newton24@yahoo.com', NULL, '$2y$10$tjEoqNHkF8HWYm9BybI4zuZNcxdSa0oYO/SG7ocDHZsDF3a.umA.y', NULL, '2012-07-23 20:28:48', '2022-09-12 10:48:55', NULL, NULL, '2022-09-12 10:48:55');
INSERT INTO `users` VALUES (200, 'Irwin Beier', 'elenor16@gmail.com', NULL, '$2y$10$/nHveLNM2PjaxZPPDdf5FOH9n.YWM4Pr0TJVAKYIY1Snz1DA0pmOu', NULL, '1981-10-21 02:30:49', '2022-09-12 10:48:48', NULL, NULL, '2022-09-12 10:48:48');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

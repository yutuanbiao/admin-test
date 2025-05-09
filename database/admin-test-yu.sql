/*
 Navicat Premium Dump SQL

 Source Server         : 本地数据库
 Source Server Type    : MySQL
 Source Server Version : 50726 (5.7.26)
 Source Host           : localhost:3306
 Source Schema         : admin-yu

 Target Server Type    : MySQL
 Target Server Version : 50726 (5.7.26)
 File Encoding         : 65001

 Date: 09/05/2025 15:01:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pwd` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `loginip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '上次登录的ip地址',
  `logintime` int(10) NULL DEFAULT NULL COMMENT '上次登录的时间',
  `times` int(10) NOT NULL COMMENT '登录次数',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', '14e1b600b1fd579f47433b88e8d85291', '127.0.0.1', 1746773519, 4);
INSERT INTO `admin` VALUES (2, 'test', '14e1b600b1fd579f47433b88e8d85291', '1', 1, 1);

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '学号',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `headimg` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `sex` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '性别',
  `birthday` int(11) NULL DEFAULT NULL,
  `age` int(11) NULL DEFAULT NULL COMMENT '年龄',
  `m_id` int(11) NULL DEFAULT NULL COMMENT '所在专业id',
  `deleted_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2022062020 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES (2022062001, '张三', 'photo/TcIrv5qzHA3pnN2Wjndwj7eO8KtezzBKcnID0h3V.jpg', '男', NULL, 20, 1, NULL);
INSERT INTO `customer` VALUES (2022062002, '李四', NULL, '男', NULL, 22, 2, NULL);
INSERT INTO `customer` VALUES (2022062003, '王五', NULL, '女', NULL, 21, 1, NULL);
INSERT INTO `customer` VALUES (2022062004, '李勇', NULL, '男', NULL, 30, 1, NULL);
INSERT INTO `customer` VALUES (2022062005, '刘晨', NULL, '男', NULL, 20, 1, NULL);
INSERT INTO `customer` VALUES (2022062006, '王敏', NULL, '女', NULL, 20, 1, NULL);
INSERT INTO `customer` VALUES (2022062007, '刘小庄', NULL, '男', NULL, 18, 2, NULL);
INSERT INTO `customer` VALUES (2022062008, '赵大', NULL, '女', NULL, 14, 1, NULL);
INSERT INTO `customer` VALUES (2022062009, '李大鹏', NULL, '女', NULL, 20, 3, NULL);
INSERT INTO `customer` VALUES (2022062010, '刘晓丽', NULL, '女', NULL, 18, 1, NULL);
INSERT INTO `customer` VALUES (2022062011, '刘洋', NULL, '女', NULL, 22, 6, NULL);
INSERT INTO `customer` VALUES (2022062012, '金钟旭', NULL, '男', NULL, 25, 5, NULL);
INSERT INTO `customer` VALUES (2022062013, '王玉昌', NULL, '男', NULL, 43, 4, NULL);
INSERT INTO `customer` VALUES (2022062014, '王赵新', NULL, '男', NULL, 25, 1, NULL);
INSERT INTO `customer` VALUES (2022062015, '赵浩洋', NULL, '男', NULL, 23, 3, NULL);
INSERT INTO `customer` VALUES (2022062016, '张天赐', NULL, '男', NULL, 50, 1, NULL);
INSERT INTO `customer` VALUES (2022062017, '郎忠博', NULL, '男', NULL, 39, 1, NULL);
INSERT INTO `customer` VALUES (2022062019, '测试', 'photo/t0ZRPUVr71taUnIszCDj7YohzmxOK8qr72XdH8VO.png', '男', 1746633600, 1, 1, NULL);

-- ----------------------------
-- Table structure for customer1
-- ----------------------------
DROP TABLE IF EXISTS `customer1`;
CREATE TABLE `customer1`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `age` int(3) NULL DEFAULT NULL,
  `dob` date NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '客户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer1
-- ----------------------------

-- ----------------------------
-- Table structure for major
-- ----------------------------
DROP TABLE IF EXISTS `major`;
CREATE TABLE `major`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '专业id',
  `major` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '专业名',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of major
-- ----------------------------
INSERT INTO `major` VALUES (1, '市场部');
INSERT INTO `major` VALUES (2, '财务');
INSERT INTO `major` VALUES (3, '人资');
INSERT INTO `major` VALUES (4, '运维');
INSERT INTO `major` VALUES (5, '研发');
INSERT INTO `major` VALUES (6, '测试部');
INSERT INTO `major` VALUES (7, '音乐');

SET FOREIGN_KEY_CHECKS = 1;

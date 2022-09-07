-- -------------------------------------------------------------
-- TablePlus 4.8.2(436)
--
-- https://tableplus.com/
--
-- Database: mvcdocker2
-- Generation Time: 2022-09-06 20:22:40.4330
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `esgi_article`;
CREATE TABLE `esgi_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` text NOT NULL,
  `article_slug` varchar(255) NOT NULL,
  `article_content` longtext NOT NULL,
  `article_status` tinyint(4) NOT NULL,
  `article_publishAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_authorId` int(11) DEFAULT NULL,
  `article_categoryId` int(11) DEFAULT NULL,
  `article_panelId` varchar(14) NOT NULL,
  `article_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`article_categoryId`),
  KEY `article_authorId` (`article_authorId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
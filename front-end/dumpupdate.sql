-- MySQL dump 10.14  Distrib 5.5.36-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: tvdb
-- ------------------------------------------------------
-- Server version	5.5.36-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `user_session`
--

DROP TABLE IF EXISTS `user_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_session` (
  `id` int(10) NOT NULL,
  `session_data` varchar(150) NOT NULL,
  `session_ip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_session`
--

LOCK TABLES `user_session` WRITE;
/*!40000 ALTER TABLE `user_session` DISABLE KEYS */;
INSERT INTO `user_session` VALUES (30,'1d5d2168106007a2dbc649d62c6b42c6bd1b8025','82.164.113.15'),(32,'92072d7249de9ba11026ac5164a40e584039464f','127.0.0.1'),(36,'87bef2af2ad68d631906613407706bd029d8d6889358dff98df0f429ddd1e50e','127.0.0.1'),(37,'07687bd11211841be23b99285ce00b11792821f89f3f3d04491a2e388f54ca53','127.0.0.1'),(38,'841ea87352367da06f7c7b2dcebea6149ff235c974c29175b59c010d4d9ad654','127.0.0.1'),(39,'bf2df993c065c9829119d98595fe83ee8829e817b20987a9d0777bac1cd3843c','127.0.0.1'),(40,'a56218009f22e87c6184f7ecfb724605c8258c84f4d7cef0ec626aaf4d04fd96','127.0.0.1'),(41,'56d9cc1c02f2837730a77eb881984c7c66dad6cebaf175e403ba219367f6897d','127.0.0.1'),(42,'3d2d82a645b1e4e93c856ae4cb37e8ebe1665594ee511002911306a0f5ca57a8','127.0.0.1'),(43,'cd69053a30deeeb4277d3ac330145b415c8407d562efbc2514a76445ac8bb638','127.0.0.1'),(44,'8e20382363f380a9052b3e26dfb13e62fcf33f749d131090f398bc95c5aeeb4d','127.0.0.1'),(45,'768cdb8689effa6ec6e8deeb1e14f24731af4c9797d5935422b1ef10d5f409dc','127.0.0.1'),(46,'0a387ea3376df627ea9189a0270ccc0af8f021f387803f7d191d2f699c2160bc','127.0.0.1'),(47,'59cc3569d15b58df53250a557c045fbb50c31909301bb12259ea59a3d2bb1f1a','127.0.0.1'),(48,'b916e4d3a6dc35b2a58b2a21b84a01af85365e558ad39509f4253f0e4501d9d7','127.0.0.1'),(49,'061a8a77432bb6057c64a14ca12b9237dda90023229039c113c64882dac3a553','127.0.0.1'),(50,'c5ad6fef50518f7ef2d57ee2723745401375df5241c2205b8a4600ad519532e1','127.0.0.1'),(51,'dbfeb2f6bd21122a431c462ad4ad9f971871ed9d9747fa0a26be214bfde84a82','127.0.0.1'),(52,'4a06d0efb7a33f6457fcbd1a9b07d98e6c6d61df3ddf9750acf69c53b88c7205','127.0.0.1'),(53,'4b9f79fe6e73062cdad553d969db256cb9d77445ebec387d82bbd1c36333a92e','127.0.0.1'),(54,'bb6b37a8574c665a278fd62a595a3e08144d5288bd936997d377e35d0a943e0f','127.0.0.1'),(55,'47a08ffc5da1b8550162040189d229c05dc873e3c1776bf7ccaf20c34021d83c','127.0.0.1'),(56,'b77023a90ca9866e3c12a21ba1e1a364301af921ec9fddbcabe2f246c7df2388','127.0.0.1'),(57,'80c106dc65471cfba65967cb475ad2b424253b8ac82aced4b424ebddda094028','127.0.0.1'),(58,'65bde713ab996e366ee6f70dd8a144db79eba11d81d18081a5cb96b585beaa39','127.0.0.1'),(60,'e4909277e75b1df0d90fb9028fa90e9f7ede6cb86cb813c664a36fc5cbb83970','127.0.0.1'),(61,'72332dfea250e6bebf6e02d52e39736e073fca96730a6b47de7276632f39f396','127.0.0.1'),(62,'23f136b9342141b9efec0f8dc53f1ebd83a693c943358373d9b107e0d0bb7855','127.0.0.1'),(63,'29d52f7e65e62012a0aa43c666d28e41f91b522f5e4fbe2472591a0fac98513d','127.0.0.1'),(64,'fd6f12b7ba9ad4accdef78df43adc16104c403711cdaabf9ba6545b4515a2621','127.0.0.1'),(40,'ff4290ce3e36056be621cc1656dcce0cbfb3ce1769d877e0eb4440d885d37aae','127.0.0.1'),(40,'5ba71d3fd82c08c46f4e5dedf761b795a8826b527a1e8659df1ab6c1599928f2','127.0.0.1'),(40,'672766f5bca0eda6c4c9027f877da590346bb5db9ddbbfd7b914ea6a0e9dcbe7','127.0.0.1'),(40,'40d714032d39009928148a05f34ca5c3800f450438205e81f506daa73303532c','127.0.0.1'),(40,'932bfd434ec4c3d17d7c762b5b41b2f7c688d1abeb0f18d6ae7a5b5e41c72d2e','127.0.0.1'),(40,'7a3a074289879108831de982740432210659022c1817c3e68499fe0008a3e91e','127.0.0.1'),(40,'eddf060b45b272442f1cf45cf1e6389d85092277f537df8ecb54c8da1216bf75','127.0.0.1'),(40,'e655f9e4e8bb2a4410108d7d4e387ddb198c0d93ddf4d658ce69e4753b732886','127.0.0.1'),(40,'c9fcc3dcd8d878eb287a7cb0f988621aedfe3b50f6cad989cb8d6f7e6a75773c','127.0.0.1'),(40,'d1a9d5b5c838f02547f190ef01409ecba05af31e274c6f5183b783bb099fb3ea','127.0.0.1'),(40,'4e59ab7971e8ffa033a2b05855fa98a079515f3d98c0b621fefd3b764b16acd0','127.0.0.1'),(40,'dc8690b0b8efb5a154b8ed3682b65f08e2cb67e960e6658f904d692002bd7b03','127.0.0.1'),(40,'a1c70cb1cb93cad993e5ad8d41b8deba39f1d978ac3b40e22e0a71d3957e9238','127.0.0.1'),(40,'5783c7b4bc45b11f8ad1cd096c60494bb9f2277d5be6225caf28f435b2485ee8','127.0.0.1'),(40,'de931682bce3fc27ddf03488f02f2db91f00ad571ec08b0caed4189c08911120','127.0.0.1'),(40,'25966b768bf77b2b51554adfd294c76fdfd028a4f8a41cb1cc8c36e89844da1e','127.0.0.1'),(40,'4d688e5e21868bb0e1f4d6b1509b612f8fb9f3ffa7324434335dc7831425f50c','127.0.0.1'),(40,'6056ef3fc2f2036a6fd6c0dde05b1afcda57b037ea0c2719c2b66c48281601f6','127.0.0.1'),(40,'1b675161c49fc916490fbcd3a7cb50612c50e368209f483b2c3c691314747b3a','127.0.0.1'),(40,'63b4db7deeed2ce6494a96e9718272cd87e51d220d53c1b6b73a1ffc591302d2','127.0.0.1'),(40,'ca83bd567c3645e8fc383cd6cbc260ec5cd081775fb3fa06b3e0dae4be3952ed','127.0.0.1'),(40,'a2ec6e7c4521178b5302ee97053481d438600b382eecce07d1365e048be68688','127.0.0.1'),(40,'704e9fe7952364d82ec3996c8b70d5a993c83c12836b831ad4cfd7036c456c40','127.0.0.1'),(40,'dde82321f4f43b06284340be57d5e619a359d22af4951633fcaac0448f0d7c69','127.0.0.1'),(40,'c15c8a8e332cae99d974d55fc48068fb54f0bfea52543309343594c069124f6e','127.0.0.1'),(40,'7341cee4f5bc8c98eba875883ac5919af804cc8a7dfab9d72000c242e7b6da10','127.0.0.1'),(40,'9e1c23157c069315b1469e43528e3448c245e32a4601962ad0421ddf40177f52','127.0.0.1'),(40,'878e996489bf0b5f2ebce84e75a6f633826ab0e230c3edacc9870a629fe48027','127.0.0.1');
/*!40000 ALTER TABLE `user_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_episodes`
--

DROP TABLE IF EXISTS `user_episodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_episodes` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `episode_id` int(10) unsigned NOT NULL DEFAULT '0',
  `show_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`episode_id`,`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_episodes`
--

LOCK TABLES `user_episodes` WRITE;
/*!40000 ALTER TABLE `user_episodes` DISABLE KEYS */;
INSERT INTO `user_episodes` VALUES (40,359051,81578),(40,359054,81578),(40,359055,81578),(40,3795561,235881),(40,3795781,235881),(40,3795831,235881),(40,3795851,235881),(40,3795871,235881),(40,3795881,235881);
/*!40000 ALTER TABLE `user_episodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_show`
--

DROP TABLE IF EXISTS `user_show`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_show` (
  `user_id` int(10) NOT NULL,
  `show_id` int(10) NOT NULL,
  `is_favorite` int(10) NOT NULL,
  PRIMARY KEY (`user_id`,`show_id`),
  KEY `user_id` (`user_id`),
  KEY `show_id` (`show_id`),
  CONSTRAINT `user_show_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_show`
--

LOCK TABLES `user_show` WRITE;
/*!40000 ALTER TABLE `user_show` DISABLE KEYS */;
INSERT INTO `user_show` VALUES (40,81115,0),(40,82647,0);
/*!40000 ALTER TABLE `user_show` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-15 15:26:46
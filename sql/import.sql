-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2016 at 08:44 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_imdstagram`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `idPost` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `posttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `idPost`, `idUser`, `posttime`) VALUES
(48, 'Very nice', 23, 3, '2016-05-09 11:35:55'),
(49, 'Zzz', 8, 3, '2016-05-10 12:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `followrequests`
--

DROP TABLE IF EXISTS `followrequests`;
CREATE TABLE `followrequests` (
  `fr_id` int(11) NOT NULL,
  `FollowingId` int(11) NOT NULL,
  `FollowedId` int(11) NOT NULL,
  `accepted` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `followrequests`
--

INSERT INTO `followrequests` (`fr_id`, `FollowingId`, `FollowedId`, `accepted`) VALUES
(1, 10, 1, 'yes'),
(2, 10, 7, 'yes'),
(3, 1, 9, 'no'),
(4, 11, 7, 'yes'),
(5, 7, 2, 'yes'),
(6, 2, 1, 'yes'),
(7, 11, 5, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
CREATE TABLE `follows` (
  `f_id` int(11) UNSIGNED NOT NULL,
  `idFollowing` int(11) NOT NULL,
  `idFollowed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`f_id`, `idFollowing`, `idFollowed`) VALUES
(1, 1, 2),
(3, 10, 5),
(5, 10, 3),
(7, 1, 6),
(8, 8, 6),
(9, 8, 5),
(11, 5, 6),
(12, 5, 7),
(13, 1, 5),
(14, 1, 8),
(15, 10, 8),
(16, 3, 5),
(17, 3, 8),
(18, 5, 10),
(19, 6, 10),
(20, 10, 6),
(22, 11, 6),
(23, 11, 9),
(24, 11, 2),
(25, 11, 10),
(26, 10, 11),
(27, 7, 11),
(28, 7, 10),
(29, 7, 3),
(30, 8, 10),
(32, 8, 11),
(33, 7, 9),
(34, 10, 2),
(35, 10, 1),
(36, 11, 5),
(37, 2, 1),
(38, 7, 2),
(39, 10, 7),
(40, 11, 7);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `l_id` int(11) UNSIGNED NOT NULL,
  `likerID` int(11) NOT NULL,
  `postLikedId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`l_id`, `likerID`, `postLikedId`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 2, 10),
(4, 3, 10),
(5, 5, 10),
(8, 5, 1),
(21, 1, 6),
(22, 1, 2),
(23, 10, 1),
(25, 10, 7),
(27, 8, 6),
(28, 8, 8),
(29, 8, 5),
(30, 8, 1),
(31, 10, 3),
(38, 5, 6),
(39, 5, 7),
(42, 1, 5),
(43, 1, 8),
(44, 3, 8),
(45, 10, 6),
(48, 11, 6),
(49, 11, 8),
(50, 11, 1),
(52, 11, 2),
(53, 11, 10),
(54, 11, 11),
(55, 10, 13),
(56, 10, 12),
(59, 7, 12),
(65, 7, 11),
(66, 7, 13),
(67, 11, 13),
(68, 11, 9),
(69, 7, 9),
(70, 10, 2),
(71, 10, 10),
(72, 10, 8),
(73, 10, 5),
(74, 10, 15),
(75, 10, 22),
(76, 10, 9),
(77, 10, 21),
(95, 3, 33);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `p_id` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `posttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUser` int(11) NOT NULL,
  `location` varchar(300) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`p_id`, `picture`, `description`, `posttime`, `idUser`, `location`) VALUES
(1, 'images/posts/admin-1461439777-thegym.jpg', 'The fabled creativity gym', '2016-04-15 22:00:00', 1, ''),
(2, 'images/posts/robinreyns-1461439899-superbrein.jpg', 'Superbrein, super programma!', '2016-04-16 22:00:00', 2, ''),
(3, 'images/posts/antoinehendrickx-1461439979-akira.jpg', 'Akira is a great movie. ', '2016-04-17 22:00:00', 3, ''),
(4, 'images/posts/jorishens-1461440193-stempeltje-fb.jpg', 'My new app: stempeltje!', '2016-04-18 22:00:00', 4, ''),
(5, 'images/posts/michaelrosen-1461440268-rosen book.jpg', 'My new book is out!', '2016-04-19 22:00:00', 5, ''),
(6, 'images/posts/lucina-1461440437-Awakening_Map.jpg', 'This map is huge!', '2016-04-20 22:00:00', 6, ''),
(7, 'images/posts/chrom-1461440527-fe.jpg', 'Cover art for FE: Awakening.', '2016-04-21 22:00:00', 7, ''),
(8, 'images/posts/bedje-1461440584-slapen.jpg', 'Want wie slaapt er nu niet graag?', '2016-04-22 22:00:00', 8, ''),
(9, 'images/posts/dickladder-1461440655-meeting.jpg', 'Straks meeting. Het zit hier al vol.', '2016-04-23 22:00:00', 9, ''),
(10, 'images/posts/thomasvanmalderen-1461440764-holhorse.jpg', 'A drawing I made.', '2016-04-24 22:00:00', 10, ''),
(11, 'images/posts/thomasvanmalderen-1461834922-180px-Maestro_logo.png', 'Smax', '2016-04-28 09:15:22', 10, ''),
(14, 'images/posts/thomasvanmalderen-1461849223-aronskelk.jpg', 'aronskelk! Astonishing!', '2016-04-28 13:13:43', 10, ''),
(15, 'images/posts/thomasvanmalderen-1461849257-12801433_10207549217199914_810943447972314614_n.jpg', 'Dit is Max.', '2016-04-28 13:14:17', 10, ''),
(17, 'images/posts/thomasvanmalderen-1461849293-bord.jpg', 'een bord. #wawuie', '2016-04-28 13:14:53', 10, ''),
(18, 'images/posts/thomasvanmalderen-1461849303-12362806_1044898455530272_2426150736144359618_o.jpg', 'onze prez. #dem', '2016-04-28 13:15:03', 10, ''),
(19, 'images/posts/admin-1461850578-375051_445059205587216_1606907518_n.jpg', 'IMD''er Vincent!', '2016-04-28 13:36:18', 1, ''),
(20, 'images/posts/admin-1461850587-11894523_1037589702931490_832188887331351_o.jpg', 'IMD''er Yaron!', '2016-04-28 13:36:27', 1, ''),
(21, 'images/posts/admin-1461850596-12362806_1044898455530272_2426150736144359618_o.jpg', 'IMD''er Damon!', '2016-04-28 13:36:36', 1, ''),
(22, 'images/posts/admin-1461850605-12801433_10207549217199914_810943447972314614_n.jpg', 'IMD''er Max!', '2016-04-28 13:36:45', 1, ''),
(23, 'images/posts/michaelrosen-1462649943-Bohalista-simple-white-bedroom-7.jpg', 'This is a nice bedroom!', '2016-05-07 19:39:03', 5, ''),
(29, 'images/posts/antoinehendrickx-1462883773-Profiel01.jpeg', 'schoen', '2016-05-10 12:36:13', 3, 'Mechelen, Belgium'),
(30, 'images/posts/antoinehendrickx-1462883819-Doge&Jerry.jpg', 'azeerrrtetyetgd', '2016-05-10 12:36:59', 3, 'Mechelen, Belgium'),
(31, 'images/posts/antoinehendrickx-1462903249-Doge Ross.jpg', 'lol', '2016-05-10 18:00:49', 3, NULL),
(32, 'images/posts/antoinehendrickx-1462903757-me.jpg', '#selfie', '2016-05-10 18:09:17', 3, NULL),
(33, 'images/posts/antoinehendrickx-1462903935-noice.gif', 'noice', '2016-05-10 18:12:15', 3, 'Mechelen, Belgium');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `r_id` int(11) UNSIGNED NOT NULL,
  `reporter` varchar(300) NOT NULL,
  `reportedPost` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`r_id`, `reporter`, `reportedPost`) VALUES
(3, '7', '33'),
(4, '3', '33'),
(5, '10', '33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `u_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(400) COLLATE utf8_bin NOT NULL,
  `account` varchar(11) COLLATE utf8_bin NOT NULL DEFAULT 'public',
  `avatar` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `bio` varchar(400) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `firstname`, `lastname`, `email`, `password`, `account`, `avatar`, `bio`) VALUES
(1, 'admin', 'IMDstagram', 'admin', 'admin@email.com', '$2y$12$mRcMoJYOWErYnynVqqhVA.T.R4n3CJguLmtEuG6DgKH11jHheMuEK', 'private', 'images/avatars/basic_avatar.jpg', 'This is the official page of IMDstagram. Try posting some pictures!'),
(2, 'robinreyns', 'Robin', 'Reyns', 'robin@email.com', '$2y$12$.FarmgfPWxYVtvw/YWMP3eTphLeLZZ16G7NV.b.2W7ndCifpO63ny', 'public', 'images/avatars/robinreyns-1461439863-robin.jpg', 'Robin Reyns from Thomas MORE. Hello!'),
(3, 'antoinehendrickx', 'Antoine', 'Hendrickx', 'antoine@email.com', '$2y$12$6CaakJWjMDyadS5.xVC6ZevXF9d2LBCqJj0N4XZRcz15C/PrstTSu', 'public', 'images/avatars/antoinehendrickx-1462882299-me.jpg', 'Antoine here. I love loempia''s! '),
(4, 'jorishens', 'Joris', 'Hens', 'joris@email.com', '$2y$12$BWKfcUJOWQ0zjzzaens/N.9MKKXh7lvWKZSL0XXhFds.qgZB4w55K', 'public', 'images/avatars/jorishens-1461440167-goodbytes_thumb.jpg', 'Joris Hens, also known as Goodbytes. Now on IMDstagram!'),
(5, 'michaelrosen', 'Michael', 'Rosen', 'michael@email.com', '$2y$12$/XOhHsQF1DQ1XMZZEubh2eVBeV4cPmGIQ.qapzN21xtWRCYhwneNS', 'private', 'images/avatars/michaelrosen-1461440246-michael.png', 'Michael rosen. Child books author extraordinaire.'),
(6, 'lucina', 'Lucina', 'FE', 'lucina@fireemblem.com', '$2y$12$xuyzVnWyqkdm0QXY/z8lGe3o5.d9S.EX8AUoCim02tOpOmDRczLeq', 'public', 'images/avatars/lucina-1461440322-lucina.jpg', 'Lucina from Fire Emblem Awakening. '),
(7, 'chrom', 'Chrom', 'FE', 'chrom@fireemblem.com', '$2y$12$qOdzwvyOtMtvxEUJxB5/JOWp4BAyEbffWkO9tF0qK65uW7nZaEPIG', 'public', 'images/avatars/chrom-1461440497-chrom.png', 'Yllisean prince Chrom. Go Shepherds!'),
(8, 'bedje', 'Bedje', 'Slapen', 'bedje@slapen.be', '$2y$12$4urHq36IYfo/MO9z/R8gMOptdramH2bIG.8wuu0AngxE9c5OxR5hq', 'public', 'images/avatars/bedje-1461440558-bedje.jpg', 'Because Slapen is life.'),
(9, 'dickladder', 'Dick', 'Ladder', 'dickladder@email.nl', '$2y$12$luNw7BZl3SskmV.nuAHEyeo4eO3jFzSSTNdrU.m2KXhIwN4jfcYKq', 'public', 'images/avatars/dickladder-1461440624-dickladder.jpg', 'CEO of Dutchie Enterprises.'),
(10, 'thomasvanmalderen', 'Thomas', 'Van Malderen', 'thomas@email.com', '$2y$12$FWnp3aylyAtGJHpPxEm7COYVKoM8sg7HqJKfuH4fPEkESttsK5plC', 'public', 'images/avatars/thomasvanmalderen-1461440731-thomas.jpg', 'Tokke, de coolste jongen ooit'),
(11, 'grandillusions', 'Tim', 'Rowett', 'tim@toys.uk', '$2y$12$0P6G3p5nncR3eE4J9VdHveV6UNu7VJVQhMBb6A6FFm0ssz7qIS5FK', 'private', 'images/avatars/grandillusions-1462650171-Rowett-Tim.jpg', 'Boss at Grand Illusions. I love toys! Wow! astonishing! extraordinary! *heh*');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `followrequests`
--
ALTER TABLE `followrequests`
  ADD PRIMARY KEY (`fr_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `followrequests`
--
ALTER TABLE `followrequests`
  MODIFY `fr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `f_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `l_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `r_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

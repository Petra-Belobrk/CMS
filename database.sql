-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: database2
-- Generation Time: Nov 04, 2019 at 07:35 PM
-- Server version: 10.1.41-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `user_id`) VALUES
(1, 'PHP', 1),
(2, 'JavaScript', 0),
(3, 'Bootstrap', 0),
(4, 'CSS', 0),
(5, 'HTML', 0),
(8, 'Java', 0),
(9, 'OOP', 0),
(10, 'Procedural PHP', 0),
(11, 'Design', 0),
(12, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 1, 'Annonimus', 'unkno@wno.com', 'First!', 'approved', '2019-08-08'),
(4, 2, 'etere', 's@g.com', 'second post', 'approved', '2019-08-08'),
(8, 1, 'Proba', 'info@g.com', 'nesto', 'approved', '2019-08-20'),
(9, 27, 'Arafel', 'n@b.com', 'sekfjsld sdkc', 'approved', '2019-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `user_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `likes`) VALUES
(1, 1, 0, 'Post numero Uno', '5Ra', '', '2019-08-08', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eleifend ex vitae nulla euismod vestibulum. Vivamus turpis orci, luctus ac ultricies vel, hendrerit ornare leo. Vestibulum eleifend massa quis neque ultrices, eu vestibulum metus efficitur. Morbi facilisis nec odio eget placerat.          ', 'PHP', 1, 'draft', 73, 0),
(2, 5, 0, 'My Second Post', 'Erica', 'Arafel', '2019-08-27', 'images-3.jpg', '<p>Ut convallis neque id nisl pretium, at fermentum nisi rutrum. Integer aliquet mollis arcu, semper accumsan orci pretium id. Sed ut tempus enim, ac mattis ligula. lllslkdfsd</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', 'Bootstrap', 3, 'published', 17, 1),
(3, 4, 0, 'Random Rant', '5Ra', 'Markinjo', '2019-08-22', 'images-5.jpg', '<p>Every man who has lotted here over the centuries, has looked up to the light and imagined climbing to freedom. So easy, so simple! And like shipwrecked men turning to seawater foregoing uncontrollable thirst, many have died trying. And then here there can be no true despair without hope. So as I terrorize Gotham, I will feed its people hope to poison their souls. I will let them believe that they can survive so that you can watch them climbing over each other to stay in the sun. You can watch me torture an entire city. And then when you’ve truly understood the depth of your failure, we will fulfill Ra’s Al Ghul’s destiny. We will destroy Gotham. And then, when that is done, and Gotham is… ashes Then you have my permission to die.</p>', 'test', 0, 'draft', 1, 0),
(4, 9, 0, 'Random Rant', '5Ra', 'Juan', '2019-08-22', 'images-5.jpg', '<p>Every man who has lotted here over the centuries, has looked up to the light and imagined climbing to freedom. So easy, so simple! And like shipwrecked men turning to seawater foregoing uncontrollable thirst, many have died trying. And then here there can be no true despair without hope. So as I terrorize Gotham, I will feed its people hope to poison their souls. I will let them believe that they can survive so that you can watch them climbing over each other to stay in the sun. You can watch me torture an entire city. And then when you’ve truly understood the depth of your failure, we will fulfill Ra’s Al Ghul’s destiny. We will destroy Gotham. And then, when that is done, and Gotham is… ashes Then you have my permission to die.</p>', 'test', 0, 'draft', 0, 0),
(5, 4, 0, 'Random Rant', '5Ra', '', '2019-08-20', 'images-5.jpg', '<p>Every man who has lotted here over the centuries, has looked up to the light and imagined climbing to freedom. So easy, so simple! And like shipwrecked men turning to seawater foregoing uncontrollable thirst, many have died trying. And then here there can be no true despair without hope. So as I terrorize Gotham, I will feed its people hope to poison their souls. I will let them believe that they can survive so that you can watch them climbing over each other to stay in the sun. You can watch me torture an entire city. And then when you’ve truly understood the depth of your failure, we will fulfill Ra’s Al Ghul’s destiny. We will destroy Gotham. And then, when that is done, and Gotham is… ashes Then you have my permission to die.</p>', 'test', 0, 'draft', 0, 0),
(7, 5, 0, 'My Second Post', 'Erica', '', '2019-08-20', 'images-3.jpg', '<p>Ut convallis neque id nisl pretium, at fermentum nisi rutrum. Integer aliquet mollis arcu, semper accumsan orci pretium id. Sed ut tempus enim, ac mattis ligula. lllslkdfsd</p>', 'Bootstrap', 0, 'draft', 0, 0),
(8, 1, 0, 'Post numero Uno', '5Ra', '', '2019-08-20', 'image_1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eleifend ex vitae nulla euismod vestibulum. Vivamus turpis orci, luctus ac ultricies vel, hendrerit ornare leo. Vestibulum eleifend massa quis neque ultrices, eu vestibulum metus efficitur. Morbi facilisis nec odio eget placerat.          ', 'PHP', 0, 'draft', 0, 0),
(10, 1, 0, 'SONA Cruise', '', 'New', '2019-08-21', '_large_image_2.jpg', '<p>yscxv fhgbv &nbsp;sdxfbcv</p>', '', 0, 'draft', 1, 0),
(11, 10, 0, 'Home', '', 'Xent', '2019-08-21', 'images-31.jpg', '<p>bvbhjn fghbn ztgh uzghj</p>', '', 0, 'draft', 1, 0),
(12, 4, 0, 'Random Rant', '5Ra', '', '2019-08-22', 'images-5.jpg', '<p>Every man who has lotted here over the centuries, has looked up to the light and imagined climbing to freedom. So easy, so simple! And like shipwrecked men turning to seawater foregoing uncontrollable thirst, many have died trying. And then here there can be no true despair without hope. So as I terrorize Gotham, I will feed its people hope to poison their souls. I will let them believe that they can survive so that you can watch them climbing over each other to stay in the sun. You can watch me torture an entire city. And then when you’ve truly understood the depth of your failure, we will fulfill Ra’s Al Ghul’s destiny. We will destroy Gotham. And then, when that is done, and Gotham is… ashes Then you have my permission to die.</p>', 'test', 0, 'draft', 0, 0),
(13, 5, 0, 'My Second Post', 'Erica', '', '2019-08-22', 'images-3.jpg', '<p>Ut convallis neque id nisl pretium, at fermentum nisi rutrum. Integer aliquet mollis arcu, semper accumsan orci pretium id. Sed ut tempus enim, ac mattis ligula. lllslkdfsd</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', 'Bootstrap', 0, 'draft', 0, 0),
(14, 5, 0, 'My Second Post', 'Erica', '', '2019-08-22', 'images-3.jpg', '<p>Ut convallis neque id nisl pretium, at fermentum nisi rutrum. Integer aliquet mollis arcu, semper accumsan orci pretium id. Sed ut tempus enim, ac mattis ligula. lllslkdfsd</p>', 'Bootstrap', 0, 'draft', 0, 0),
(15, 5, 0, 'My Second Post', 'Erica', '', '2019-08-22', 'images-3.jpg', '<p>Ut convallis neque id nisl pretium, at fermentum nisi rutrum. Integer aliquet mollis arcu, semper accumsan orci pretium id. Sed ut tempus enim, ac mattis ligula. lllslkdfsd</p>', 'Bootstrap', 0, 'draft', 0, 0),
(16, 5, 0, 'My Second Post', 'Erica', '', '2019-08-22', 'images-3.jpg', '<p>Ut convallis neque id nisl pretium, at fermentum nisi rutrum. Integer aliquet mollis arcu, semper accumsan orci pretium id. Sed ut tempus enim, ac mattis ligula. lllslkdfsd</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', 'Bootstrap', 0, 'draft', 1, 0),
(17, 4, 0, 'Random Rant', '5Ra', '', '2019-08-22', 'images-5.jpg', '<p>Every man who has lotted here over the centuries, has looked up to the light and imagined climbing to freedom. So easy, so simple! And like shipwrecked men turning to seawater foregoing uncontrollable thirst, many have died trying. And then here there can be no true despair without hope. So as I terrorize Gotham, I will feed its people hope to poison their souls. I will let them believe that they can survive so that you can watch them climbing over each other to stay in the sun. You can watch me torture an entire city. And then when you’ve truly understood the depth of your failure, we will fulfill Ra’s Al Ghul’s destiny. We will destroy Gotham. And then, when that is done, and Gotham is… ashes Then you have my permission to die.</p>', 'test', 0, 'draft', 0, 0),
(18, 10, 0, 'Home', '', 'Xent', '2019-08-22', 'images-31.jpg', '<p>bvbhjn fghbn ztgh uzghj</p>', '', 0, 'draft', 0, 0),
(19, 1, 0, 'SONA Cruise', '', 'New', '2019-08-22', '_large_image_2.jpg', '<p>yscxv fhgbv &nbsp;sdxfbcv</p>', '', 0, 'draft', 0, 0),
(20, 1, 0, 'Post numero Uno', '5Ra', '', '2019-08-22', 'image_1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eleifend ex vitae nulla euismod vestibulum. Vivamus turpis orci, luctus ac ultricies vel, hendrerit ornare leo. Vestibulum eleifend massa quis neque ultrices, eu vestibulum metus efficitur. Morbi facilisis nec odio eget placerat.          ', 'PHP', 0, 'draft', 0, 0),
(21, 5, 0, 'My Second Post', 'Erica', '', '2019-08-22', 'images-3.jpg', '<p>Ut convallis neque id nisl pretium, at fermentum nisi rutrum. Integer aliquet mollis arcu, semper accumsan orci pretium id. Sed ut tempus enim, ac mattis ligula. lllslkdfsd</p>', 'Bootstrap', 0, 'draft', 0, 0),
(22, 4, 0, 'Random Rant', '5Ra', '', '2019-08-22', 'images-5.jpg', '<p>Every man who has lotted here over the centuries, has looked up to the light and imagined climbing to freedom. So easy, so simple! And like shipwrecked men turning to seawater foregoing uncontrollable thirst, many have died trying. And then here there can be no true despair without hope. So as I terrorize Gotham, I will feed its people hope to poison their souls. I will let them believe that they can survive so that you can watch them climbing over each other to stay in the sun. You can watch me torture an entire city. And then when you’ve truly understood the depth of your failure, we will fulfill Ra’s Al Ghul’s destiny. We will destroy Gotham. And then, when that is done, and Gotham is… ashes Then you have my permission to die.</p>', 'test', 0, 'draft', 0, 0),
(24, 4, 0, 'Random Rant', '5Ra', 'Markinjo', '2019-08-22', 'images-5.jpg', '<p>Every man who has lotted here over the centuries, has looked up to the light and imagined climbing to freedom. So easy, so simple! And like shipwrecked men turning to seawater foregoing uncontrollable thirst, many have died trying. And then here there can be no true despair without hope. So as I terrorize Gotham, I will feed its people hope to poison their souls. I will let them believe that they can survive so that you can watch them climbing over each other to stay in the sun. You can watch me torture an entire city. And then when you’ve truly understood the depth of your failure, we will fulfill Ra’s Al Ghul’s destiny. We will destroy Gotham. And then, when that is done, and Gotham is… ashes Then you have my permission to die.</p>', 'test', 0, 'draft', 0, 0),
(25, 5, 0, 'My Second Post', 'Erica', '', '2019-08-27', 'images-3.jpg', '<p>Ut convallis neque id nisl pretium, at fermentum nisi rutrum. Integer aliquet mollis arcu, semper accumsan orci pretium id. Sed ut tempus enim, ac mattis ligula. lllslkdfsd</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', 'Bootstrap', 0, 'published', 0, 0),
(26, 1, 0, 'Post numero Uno', '5Ra', '', '2019-08-22', 'image_1.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eleifend ex vitae nulla euismod vestibulum. Vivamus turpis orci, luctus ac ultricies vel, hendrerit ornare leo. Vestibulum eleifend massa quis neque ultrices, eu vestibulum metus efficitur. Morbi facilisis nec odio eget placerat.</p>', 'PHP', 0, 'draft', 0, 0),
(27, 5, 1, 'gfdsa', '', 'Arafel', '2019-08-27', 'images-10.jpg', 'dfvc sd xcs s sd &nbsp;sd yxc sd', 'php', 0, 'published', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$hgug6fb8bvzyqrofaove22',
  `user_session` varchar(255) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `user_session`, `token`) VALUES
(1, 'Arafel', '$2y$12$QuaRsJWzO3Sl8xjOkRSbNOua4QgZMpAwZLm3Gvm.DWe0.Vk5lf3P6', '5Ra', 'Test', 'info@h.com', '', 'admin', '$2y$10$hgug6fb8bvzyqrofaove22 	', '38', '0'),
(3, 'Markinjo', '$2y$12$CP9HI2ijE8/P0iriY4Cg/OqKDTe444TyI78f.uGVAxvstD8wmaYze', 'Markoslav', 'Markic', 'mmm@gmail.com', '', 'subscriber', '$2y$10$hgug6fb8bvzyqrofaove22 	', '', '0'),
(4, 'New', '123', 'Test', 'Test', 'm@m.com', '', 'subscriber', '$2y$10$hgug6fb8bvzyqrofaove22 	', '', '0'),
(5, 'Xent', '$2y$12$6j/g/u9o7TrAbUDqvHgP2Oo4OkiCcr7BGNQkhEwahHsl9hINSn0XG', '', '', 'x@ent.com', '', 'admin', '$2y$10$hgug6fb8bvzyqrofaove22', '7', ''),
(6, 'Juan', '$2y$10$hgug6fb8bvzyqrofaove2u5H3MF19TuPHM2C7JU8kEqnaNMQfl9YG', '', '', 'ju@an.hr', '', 'admin', '$2y$10$hgug6fb8bvzyqrofaove22', '', '5a97840e8224263f7a6f060d1329fbd778933ad56acfda0a23e2ad305289441ea9085b5dd38965af28f9105e1b16550b18e9'),
(8, 'Xa', '$2y$10$xS4imhR.N8HnLvOp7dRmzefL0DkQAd9QMKok73f0UboMp.ggwkxp6', 'Markoslav', 'Test', 'm@m.com', '', 'admin', '$2y$10$hgug6fb8bvzyqrofaove22', '10', '0'),
(10, 'Prvi', '$2y$12$U3OTUYwuiTufCbrjBJ.sOevPuW/mZ5I75TViu91Md1fYg/yQ8fl0m', '', '', 'p@g.com', '', 'subscriber', '$2y$10$hgug6fb8bvzyqrofaove22', '', '0'),
(11, 'Proba', '$2y$12$uVMq0mi5WwLOoNjrOBrcjelANv6Xkxp7dvU2PGWeZcJIQL7nWfef6', '', '', 'abc@def.com', '', 'subscriber', '$2y$10$hgug6fb8bvzyqrofaove22', '', '6970ec16b7185e0641d99e5bdfa8d676b93ff0d08a3e28e1db61d16f37dbe86e75d75e8580f60cb778abe6e7c834b9eb6e57'),
(14, 'LooL', '$2y$12$aNb4lcByURO0M7V6xjW2CO26qstPwAgHLQkH2B2FDmNLKvZ48Y8Wy', '', '', '1@m.com', '', 'subscriber', '$2y$10$hgug6fb8bvzyqrofaove22', '', '0df2f57be6427d9d67239a03ca2d1d7a37d1ae1da9b584f4e4e253b230bd173ea0c93f1576cd673986b17e9e6720956a03e6'),
(15, 'Lopo', '$2y$12$YHUP2pCcoTsp7uRihxEtreZxbHG/n4zd3kkEv4rGBTTlTgvJ.ergW', '', '', 'lopo@gmail.com', '', 'subscriber', '$2y$10$hgug6fb8bvzyqrofaove22', '9', '0'),
(29, 'Yoko', '$2y$12$DnVP3ojkqIQczrdcZewdeePPSuyDGekj3GOM.WVmyRMoQ91akmMOa', '', '', 'yoko@gmail.com123', '', 'admin', '$2y$10$hgug6fb8bvzyqrofaove22', '48', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, '3c3008c5524a54c7be7110637ffcdb1e', 1566396831),
(2, '85ec89e6a62ee9e3f40e4cab836cf641', 1566371858),
(3, 'db47dfe0050e6fae070e23ae41b24880', 1566373623),
(4, '6d02618fc20cbf5d3a69e7844a8ffe43', 1566479179),
(5, '2ee0bb0288d64ec89575d64c262f588e', 1566565732),
(6, 'd0336d61e78e976356e701a41bac464c', 1566828260),
(7, 'bc30af0559123b31fa863158f8bcd9d7', 1566898188);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

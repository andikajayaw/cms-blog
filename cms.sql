-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 26, 2021 at 03:33 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `title`) VALUES
(1, 'Vue'),
(2, 'Javascript'),
(3, 'PHP'),
(4, 'Java'),
(5, 'React'),
(6, 'Laravel');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `author` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_post`, `author`, `email`, `description`, `status`, `date`) VALUES
(15, 5, 'abc', 'abc@mail.com', 'abc', 'APPROVED', '2021-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `date` timestamp NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `total_comment` int(11) NOT NULL DEFAULT '0',
  `total_views` int(11) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `id_category`, `title`, `author`, `username`, `date`, `image`, `description`, `tags`, `total_comment`, `total_views`, `status`) VALUES
(2, 3, 'LARAVEL', 'andinidewi', '', '2021-01-21 13:06:01', '4.jpg', '<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'php, laravel', 2, 0, 'published'),
(3, 5, 'REACT', 'ANDIKA JAYA FUTURE', '', '2021-01-20 12:32:12', '9.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'react, javascript', 0, 0, 'published'),
(4, 1, 'VUE ', 'ANDIKA JAYA MASTER VUE', '', '2021-01-13 15:35:48', '6.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'vue, javascript', 0, 0, 'published'),
(5, 6, 'LARAVEL POST', 'andikajayaw', '', '2021-01-21 12:54:48', '3.jpg', '<p>HELLO</p>', 'laravel, php', 0, 14, 'published'),
(6, 2, 'Testing', 'andikajayaw', '', '2021-01-21 12:49:24', '1.jpg', '<p>Javascript post!</p>', 'javascript, js', 0, 0, 'published'),
(8, 3, 'LARAVEL', 'andinidewi', '', '2021-01-22 14:43:54', '4.jpg', '<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'php, laravel', 0, 0, 'published'),
(9, 5, 'REACT', 'ANDIKA JAYA FUTURE', '', '2021-01-22 14:43:54', '9.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'react, javascript', 0, 0, 'published'),
(10, 5, 'REACT', 'ANDIKA JAYA FUTURE', '', '2021-01-23 14:58:10', '9.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'react, javascript', 0, 0, 'published'),
(11, 3, 'LARAVEL', 'andinidewi', '', '2021-01-23 14:58:10', '4.jpg', '<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'php, laravel', 0, 0, 'published'),
(12, 2, 'Testing', 'andikajayaw', '', '2021-01-23 14:58:10', '1.jpg', '<p>Javascript post!</p>', 'javascript, js', 0, 1, 'published'),
(13, 6, 'LARAVEL POST', 'andikajayaw', '', '2021-01-23 14:58:10', '3.jpg', '<p>HELLO</p>', 'laravel, php', 0, 0, 'published'),
(14, 1, 'VUE ', 'ANDIKA JAYA MASTER VUE', '', '2021-01-23 14:58:10', '6.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'vue, javascript', 0, 0, 'published'),
(15, 5, 'REACT', 'ANDIKA JAYA FUTURE', '', '2021-01-23 14:58:10', '9.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'react, javascript', 0, 0, 'published'),
(16, 3, 'LARAVEL', 'andinidewi', '', '2021-01-23 14:58:10', '4.jpg', '<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'php, laravel', 0, 0, 'published'),
(17, 3, 'LARAVEL', 'andinidewi', '', '2021-01-23 15:06:47', '4.jpg', '<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'php, laravel', 0, 0, 'published'),
(18, 5, 'REACT', 'ANDIKA JAYA FUTURE', '', '2021-01-23 15:06:47', '9.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'react, javascript', 0, 0, 'published'),
(19, 1, 'VUE ', 'ANDIKA JAYA MASTER VUE', '', '2021-01-23 15:06:47', '6.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'vue, javascript', 0, 0, 'published'),
(20, 6, 'LARAVEL POST', 'andikajayaw', '', '2021-01-23 15:06:47', '3.jpg', '<p>HELLO</p>', 'laravel, php', 0, 0, 'published'),
(21, 2, 'Testing', 'andikajayaw', '', '2021-01-23 15:06:47', '1.jpg', '<p>Javascript post!</p>', 'javascript, js', 0, 0, 'published'),
(22, 3, 'LARAVEL', 'andinidewi', '', '2021-01-23 15:06:47', '4.jpg', '<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'php, laravel', 0, 0, 'published'),
(23, 5, 'REACT', 'ANDIKA JAYA FUTURE', '', '2021-01-23 15:06:47', '9.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'react, javascript', 0, 0, 'published'),
(24, 5, 'REACT', 'ANDIKA JAYA FUTURE', '', '2021-01-23 15:06:47', '9.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'react, javascript', 0, 0, 'published'),
(25, 3, 'LARAVEL', 'andinidewi', '', '2021-01-23 15:06:47', '4.jpg', '<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'php, laravel', 0, 0, 'published'),
(26, 2, 'Testing', 'andikajayaw', '', '2021-01-23 15:06:47', '1.jpg', '<p>Javascript post!</p>', 'javascript, js', 0, 1, 'published'),
(27, 6, 'LARAVEL POST', 'andikajayaw', '', '2021-01-23 15:06:47', '3.jpg', '<p>HELLO</p>', 'laravel, php', 0, 0, 'published'),
(28, 1, 'VUE ', 'ANDIKA JAYA MASTER VUE', '', '2021-01-23 15:06:47', '6.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'vue, javascript', 0, 0, 'published'),
(29, 5, 'REACT', 'ANDIKA JAYA FUTURE', '', '2021-01-23 15:06:47', '9.jpg', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'react, javascript', 0, 0, 'published'),
(30, 3, 'LARAVEL', 'andinidewi', '', '2021-01-23 15:06:47', '4.jpg', '<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'php, laravel', 0, 2, 'published'),
(31, 4, 'ABC', NULL, '7', '2021-01-25 12:55:20', '5.jpg', '<p>abc</p>', 'abc', 0, 0, 'published'),
(32, 1, 'ABCD', NULL, '5', '2021-01-25 12:58:18', '2.jpg', '<p>aBC</p>', 'vue, javascript', 0, 0, 'published'),
(33, 5, 'Test 23', NULL, 'spongebob', '2021-01-25 13:14:53', '3.jpg', '<p>React</p>', 'react', 0, 4, 'published'),
(38, 5, 'Test 23', '', 'spongebob', '2021-01-25 13:57:48', '3.jpg', '<p>React</p>', 'react', 0, 0, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `roles` varchar(50) NOT NULL,
  `rand_salt` varchar(255) DEFAULT '$2y$10$usesomesillystringforsalt$',
  `email` varchar(50) NOT NULL,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `first_name`, `last_name`, `roles`, `rand_salt`, `email`, `image`) VALUES
(1, 'andikajayawiguna123', '12345678', 'andika jaya', 'wiguna', 'SUBSCRIBER', '', 'andikajayaw@mail.com', ''),
(2, 'admin', 'admin', 'EDP', 'AdminAJA', 'admin', NULL, 'admin@mail.com', NULL),
(3, 'admin123', 'admin123', 'Admin', 'Admin', 'ADMIN', NULL, 'admin2@mail.com', NULL),
(4, 'andinidewi', '123', 'Andini', 'Dewi', 'SUBSCRIBER', NULL, 'andini@mail.com', NULL),
(5, 'keselekbijikambing123', '$2y$10$jneuR2EealQpAGdi9ULgNu/ttp9JtbrO.ZsIm2Ow08.TCaDc5Z.lK', 'keselek', 'biji', 'ADMIN', '$2y$10$iusesomecrazystring22', 'keselekbiji@mail.com', NULL),
(7, 'hobbits', '123', 'Andro', 'Meda', 'subscriber', '$2y$10$iusesomecrazystring22', 'hobbit@mail.com', NULL),
(8, 'abc', '$1$7tJasJh6$.rJ/F9rJy4SQxm1R6cW3J0', '', '', 'ADMIN', '$2y$10$usesomesillystringforsalt$', 'abc@mail.com', NULL),
(9, 'admin123', '$1$naSWsVjU$NdXKe9x824bkqlysG4jOZ.', '', '', 'ADMIN', '$2y$10$usesomesillystringforsalt$', 'admin123@mail.com', NULL),
(10, 'users', '$2y$12$sy2UL.iuvRtV6KxAW2dWt.eYFb0SH9o9/n/gm5E/TvqrozVc5OZB2', NULL, NULL, 'subscriber', '$2y$10$usesomesillystringforsalt$', 'users@mail.com', NULL),
(11, 'spongebob', '$2y$12$HvkeempxTkgiUVVIwyum3u6e6D31yX6d/Axh8QtBtQKq0E7towjBa', 'sponge', 'bob', 'ADMIN', '$2y$10$usesomesillystringforsalt$', 'spongebob@mail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id_online` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id_online`, `session`, `time`) VALUES
(4, 'll92rs69qd8vdv6q8terpedlbg', 1611419374),
(5, 'e4p55tealc9avdqfl2bb6n2581', 1611416967),
(6, '52gcui7gcon9n79v0g2acmdqrp', 1611417275),
(7, 'irsot7s6jepndalhp7cb5kv06c', 1611417209),
(8, '0faupbr8tm5p4njj4saf2qn4md', 1611419064),
(9, 'i13j6nb89demqvqjq342f8d3ks', 1611417537),
(10, '4ekba2b8rfhsduoueo6l4ckd5o', 1611419229),
(11, 'ckaabssvltclj9m6gpvthiu4ak', 1611501538),
(12, '1vmn2p9brv68j288qtm81ljlig', 1611585255);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id_online`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id_online` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

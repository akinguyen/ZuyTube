-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2019 at 06:25 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videotube`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Auto & Vehicles'),
(9, 'Comedy'),
(13, 'Education'),
(10, 'Entertainment'),
(1, 'Film & Animation'),
(7, 'Gaming'),
(12, 'Howto & Style'),
(3, 'Music'),
(11, 'News & Politics'),
(15, 'Nonprofit & Activism'),
(8, 'People & Blogs'),
(4, 'Pets & Animals'),
(14, 'Science & Technology'),
(5, 'Sports'),
(6, 'Travel & Events');

-- --------------------------------------------------------

--
-- Table structure for table `commentdislikes`
--

CREATE TABLE `commentdislikes` (
  `commentId` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commentdislikes`
--

INSERT INTO `commentdislikes` (`commentId`, `username`, `id`) VALUES
(36, 'atruong655', 5);

-- --------------------------------------------------------

--
-- Table structure for table `commentlikes`
--

CREATE TABLE `commentlikes` (
  `id` int(11) NOT NULL,
  `commentId` int(11) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commentlikes`
--

INSERT INTO `commentlikes` (`id`, `commentId`, `username`) VALUES
(12, 35, 'atruong655'),
(13, 35, 'nguy534'),
(15, 36, 'nguy534'),
(24, 42, 'nguy534'),
(25, 43, 'Black Pink'),
(26, 42, 'Black Pink'),
(27, 41, 'Black Pink'),
(28, 40, 'Black Pink'),
(29, 36, 'Black Pink'),
(30, 35, 'Black Pink'),
(31, 45, 'Black Pink'),
(32, 54, 'Black Pink'),
(33, 55, 'Black Pink'),
(34, 53, 'Black Pink');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `videoId` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `username` varchar(25) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `videoId`, `comment`, `username`, `date`) VALUES
(35, 45, 'sad', 'nguy534', '2019-01-06 13:08:27'),
(36, 45, 'Hi', 'atruong655', '2019-01-06 13:12:15'),
(40, 45, 'Love you Jennie', 'nguy534', '2019-01-06 16:21:27'),
(41, 45, 'Love YOU Jennie From 2019', 'nguy534', '2019-01-06 16:22:34'),
(42, 45, 'Jennie is on FIRE !!!', 'nguy534', '2019-01-06 16:23:26'),
(43, 45, 'FIRE @@@', 'nguy534', '2019-01-06 16:25:50'),
(44, 45, '2019 <3 <3 <3', 'Black Pink', '2019-01-06 16:35:47'),
(45, 45, 'Jennie in your area !!', 'Black Pink', '2019-01-06 16:36:36'),
(46, 45, 'BLACK PINK !!', 'Black Pink', '2019-01-06 16:39:56'),
(47, 45, 'SOLOOOOOOOOOO', 'Black Pink', '2019-01-06 16:43:50'),
(48, 45, 'YESS BLACK PINK !!', 'Black Pink', '2019-01-06 16:44:13'),
(49, 45, 'T_T T_T', 'Black Pink', '2019-01-06 16:46:00'),
(50, 45, '<3 <3 <3', 'Black Pink', '2019-01-06 16:46:34'),
(51, 45, 'JENNIE x BP', 'Black Pink', '2019-01-06 16:46:48'),
(53, 45, '2019 is the BEST Year @@@', 'Black Pink', '2019-01-06 16:48:05'),
(54, 42, 'We Love You Jennie @@@', 'Black Pink', '2019-01-06 16:50:11'),
(55, 21, 'C++ is the best language !!', 'Black Pink', '2019-01-06 16:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `videoId` int(11) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `videoId`, `username`) VALUES
(6, 24, 'Black Pink');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `videoId` int(11) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `videoId`, `username`) VALUES
(7, 5, 'atruong655'),
(9, 1, 'nguy534'),
(14, 7, 'nguy534'),
(16, 2, 'nguy534'),
(17, 24, 'nguy534'),
(18, 27, 'nguy534'),
(20, 19, 'nguy534'),
(21, 3, 'nguy534'),
(23, 5, 'nguy534'),
(24, 4, 'nguy534'),
(25, 4, 'atruong655'),
(26, 28, 'atruong655'),
(27, 1, 'atruong655'),
(28, 48, 'nguy534'),
(29, 36, 'nguy534'),
(32, 20, 'nguy534'),
(33, 28, 'nguy534'),
(34, 26, 'nguy534'),
(35, 41, 'nguy534'),
(36, 35, 'nguy534'),
(37, 40, 'nguy534'),
(38, 43, 'nguy534'),
(39, 18, 'nguy534'),
(41, 23, 'nguy534'),
(42, 29, 'nguy534'),
(43, 42, 'nguy534'),
(44, 50, 'nguy534'),
(45, 25, 'nguy534'),
(46, 35, 'atruong655'),
(47, 21, 'nguy534'),
(48, 22, 'nguy534'),
(50, 54, 'Black Pink'),
(51, 4, 'Black Pink'),
(52, 26, 'Black Pink'),
(53, 33, 'Black Pink'),
(54, 32, 'nguy534'),
(56, 45, 'Black Pink'),
(57, 42, 'Black Pink'),
(58, 31, 'Black Pink'),
(59, 34, 'Black Pink'),
(60, 21, 'Black Pink');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `fromUser` varchar(25) NOT NULL,
  `toUser` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `fromUser`, `toUser`) VALUES
(37, 'atruong655', 'Root'),
(56, 'atruong655', 'Black Pink'),
(59, 'Black Pink', 'nguy534'),
(60, 'Black Pink', 'Root'),
(61, 'Black Pink', 'Kpop'),
(62, 'nguy534', 'atruong655'),
(63, 'nguy534', 'Root'),
(64, 'nguy534', 'Kpop'),
(65, 'Black Pink', 'atruong655');

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `videoId` int(11) NOT NULL,
  `imagePath` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `videoId`, `imagePath`) VALUES
(1, 1, 'https://i.ytimg.com/vi/agdWbggD0zc/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLDoNfAkgGZjCEUQQGqoW0s15CRfSg'),
(2, 2, 'https://i.ytimg.com/vi/1j--teRycJw/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLA9fsjbv8_2zX8mWQLCyVBmVMO8Zw'),
(3, 3, 'https://i.ytimg.com/vi/Lwk8ub8zcgY/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAuoPbnwBnV3xUhth_rWq6kXrdV-Q'),
(4, 4, 'https://i.ytimg.com/vi/5uLKIlCcjk0/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLBKEUsfQtSPKOzmY4zIlB2qomNx1Q'),
(5, 5, 'https://i.ytimg.com/vi/UOpE-hRFPCo/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAL5LX3pHtkQeGSNMQIAT4azInB3A'),
(6, 6, 'https://i.ytimg.com/vi/ryVf0uJVrpQ/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLDW5H3bMqU_LkPjLKd9kX_WVwI1pw'),
(7, 7, 'https://i.ytimg.com/vi/BZAw4n4e_ew/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLClyC-pUh0jv-UHbhbstpAAmxuVow'),
(17, 17, 'https://i.ytimg.com/vi/lby8GrEkEmY/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAwUD_jfIdxJUp14SZwEINKFLF2cQ'),
(18, 18, 'https://i.ytimg.com/vi/98wJJRYLcDA/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLBZrFfDyqPK8EOyDO3AzOMPoOjRdg'),
(19, 19, 'https://i.ytimg.com/vi/hza2ahW4c9s/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCrVEoQ59P-vlopkIltciL0VFH_1Q'),
(20, 20, 'https://i.ytimg.com/vi/QYspSvy7ous/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLACUwncyRTv_5XmVvoUHZYnmhnzdg'),
(21, 21, 'https://i.ytimg.com/vi/mUQZ1qmKlLY/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAl3OKSrh4g5bcooIBKfBljJC_-Zg'),
(22, 22, 'https://i.ytimg.com/vi/shdb-Bn-kMo/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCvu0juQN9288BiocpsEyupaLAGtQ'),
(23, 23, 'https://i.ytimg.com/vi/m4GEJeVZwPU/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCQ2JsQFGWFv54deH_0ijTX3Fp0DQ'),
(24, 24, 'https://i.ytimg.com/vi/a50b3tOXZ0E/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAg_R9S7mUTPBJZQUnkkgoY9KcxVA'),
(25, 25, 'https://i.ytimg.com/vi/DIMIZPbnfNs/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCwnudtSJwlE5Xh8Ttb1RV2F6RMFA'),
(26, 26, 'https://i.ytimg.com/vi/BgxQpSEMleo/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAMmH-FyNORAddzIxbQTdo0tdDfFg'),
(27, 27, 'https://i.ytimg.com/vi/W0hCgGwaWbs/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCAH-ZEjYbdqRAWvRH6Q3NY2q1ZkA'),
(28, 28, 'https://i.ytimg.com/vi/gl1aHhXnN1k/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAJns7Pc-pdt8k4giTlwNmSTw5qow'),
(29, 29, 'https://i.ytimg.com/vi/tRY8AKSbg0Y/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLDfZ39iyhUl9Po8JHYBpXcnMvI8GA'),
(30, 30, 'https://i.ytimg.com/vi/shyCmvnpMZY/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAEjeQui557vK4hz55yuVYZHzPIQg'),
(31, 31, 'https://i.ytimg.com/vi/KiyRQbWgH3s/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLBdyrq-SN9-n3qAGklxtqM8hvUtVQ'),
(32, 32, 'https://i.ytimg.com/vi/zgsEktp35GU/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAjttkqaafAIG0DlrV6gjUYM4rd0A'),
(33, 33, 'https://i.ytimg.com/vi/_AtP7au_Q9w/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLDlB_UmmtRuo0zjYWbn2MLwHC645Q'),
(34, 34, 'https://i.ytimg.com/vi/9ihXq_WwiWM/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCZzIi9bM5oQxtOT7BUuP7W1AmivQ'),
(35, 35, 'https://i.ytimg.com/vi/XHl8VFCoxyI/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAnJWUeka79QzmA9tDeiy6fXH5q6Q'),
(36, 36, 'https://i.ytimg.com/vi/0ybRXKeWdII/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLDdU15IyXFnvn_8pexViqiFtrQChg'),
(37, 37, 'https://i.ytimg.com/vi/z-g_bAsndgE/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAoxzttXyl3I2aQO634UaTmtxEfyw'),
(38, 38, 'https://i.ytimg.com/vi/rOmNVlZxiC0/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLC9kdhRFZqp83rIC6LlygKkXHz07A'),
(39, 39, 'https://i.ytimg.com/vi/IHNzOHi8sJs/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLDvWHH4sjHPzvqUZ6w8iJBnu8QF5g'),
(40, 40, 'https://i.ytimg.com/vi/Amq-qlqbjYA/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCVyOcoaz-1V--s5k22Z8u1isSiFg'),
(41, 41, 'https://i.ytimg.com/vi/FzVR_fymZw4/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLDTKWUoYaBAjQzOYSUkYU-SK9XgdQ'),
(42, 42, 'https://i.ytimg.com/vi/xKW9q-oIZUE/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLA5IdaP0UKyUXZQxRPJfU_a545HxQ'),
(43, 43, 'https://i.ytimg.com/vi/gHj5OGqvZ_8/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLBSuDZYFCrO8cdawbG_HNwMwgYCqA'),
(44, 44, 'https://i.ytimg.com/vi/smimdoBjeAE/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLB-CYddiSaZ8kkExxqnN2cZtcD3jQ'),
(45, 45, 'https://i.ytimg.com/vi/vdDuCvCrcKg/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLBZpeXHTb990EPdLL9mJoJa2vGJCQ'),
(46, 46, 'https://i.ytimg.com/vi/NvWfJTbrTBY/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLDtyHjUjpJj8hiuOJw8rH3db6WImw'),
(47, 47, 'https://i.ytimg.com/vi/dISNgvVpWlo/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLD1M10HuEpj1A6iX5S3cTcUNMbWFQ'),
(48, 48, 'https://i.ytimg.com/vi/bwmSjveL3Lc/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAZs4oj6egkfoA5s8cIvfU0bXVnhA'),
(49, 49, 'https://i.ytimg.com/vi/DR9n-vDj-zo/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLApVylLfDQHzvSWkc5P3es2LCMgLw'),
(50, 50, 'https://i.ytimg.com/vi/LK4UWnImijY/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCatYF5auAkBv09MlqBqbfaDXIfhA'),
(51, 51, 'https://i.ytimg.com/vi/ho7HwRQqV6Q/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAJMB3GO7Z5URfrkTxgb2zf9qrxNg'),
(52, 52, 'https://i.ytimg.com/vi/eQU-R5dqP-Q/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCPdB5JMzdXAe_ysI_pQhFtQAIGcQ'),
(53, 53, 'https://i.ytimg.com/vi/pvNy3hU6v6k/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLBVITcwvHuYudV5dS6zAsc03rc6Eg'),
(54, 54, 'https://i.ytimg.com/vi/b73BI9eUkjM/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCUMgEm4aEeSVVNCguhKjNKeRuuEA'),
(55, 55, 'https://i.ytimg.com/vi/67otJZ6qe9Y/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCZsZag2i8wg5NdCDaSVZ1Wul9pfA'),
(56, 56, 'https://i.ytimg.com/vi/AX3Bsiq-13k/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCA31vOdyTPtxMkDuxTsKbzasK8Tw'),
(57, 57, 'https://i.ytimg.com/vi/7b3II_N32Pk/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLCv3AfMMaVJ5AlZYelRaOY8Pkkdew');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profileImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `profileImage`) VALUES
(1, 'atruong655', 'Anh', 'Truong', 'atruong655@yahoo.com', '12b03226a6d8be9c6e8cd5e55dc6c7920caaa39df14aab92d5e3ea9340d1c8a4d3d0b8e4314f1f6ef131ba4bf1ceb9186ab87c801af0d5c95b1befb8cedae2b9', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ'),
(2, 'nguy534', 'Duy', 'Nguyen', 'duynguyenquykhanh@gmail.com', 'a83317f11ca2f77aec98694954c54f57525d066dce93ebc79f8715a359146ef7b304809713fdb8bdde7dd6e0ceddbf9c3b38636402adb391670d1515b3fcd49e', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ'),
(3, 'andy', 'Anh', 'Truong', 'duy@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ'),
(4, 'Kpop', 'Kpop', 'Entertainment', 'kpop@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ'),
(5, 'Black Pink', 'Black', 'Pink', 'blackpink@kpop.com', 'a83317f11ca2f77aec98694954c54f57525d066dce93ebc79f8715a359146ef7b304809713fdb8bdde7dd6e0ceddbf9c3b38636402adb391670d1515b3fcd49e', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ'),
(6, 'Root', 'My', 'Admin', 'root@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `uploadedBy` varchar(50) NOT NULL,
  `title` varchar(70) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `privacy` int(11) NOT NULL,
  `videoPath` varchar(250) NOT NULL,
  `category` int(11) NOT NULL,
  `uploadDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL DEFAULT '0',
  `duration` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `uploadedBy`, `title`, `description`, `privacy`, `videoPath`, `category`, `uploadDate`, `views`, `duration`) VALUES
(1, 'Root', 'Everton v. Leicester City | PREMIER LEAGUE EXTENDED HIGHLIGHTS | 1/1/1', '', 0, 'https://www.youtube.com/watch?v=agdWbggD0zc', 1, '2019-01-01 17:46:26', 10, '7:33'),
(2, 'Root', 'Marvel vs. DC - Rise Of The Villains | PART I', '', 0, 'https://www.youtube.com/watch?v=1j--teRycJw', 1, '2019-01-01 17:47:37', 11, '10:03'),
(3, 'Root', 'Marvel vs. DC - Rise Of The Villains | PART III', '', 0, 'https://www.youtube.com/watch?v=Lwk8ub8zcgY', 1, '2019-01-01 17:48:41', 19, '16:20'),
(4, 'Root', 'Solo (Jennie)', '', 0, 'https://www.youtube.com/watch?v=5uLKIlCcjk0', 3, '2019-01-01 17:49:34', 90, '2:51'),
(5, 'Root', 'TCNN ( Will x Han Sara )', '', 0, 'https://www.youtube.com/watch?v=UOpE-hRFPCo', 3, '2019-01-01 17:51:05', 163, '4:52'),
(6, 'Root', 'Dragon Ball Heroes - Episode 6 [English Sub]', '', 0, 'https://www.youtube.com/watch?v=ryVf0uJVrpQ', 1, '2019-01-01 17:52:08', 8, '9:51'),
(7, 'Root', 'Wonder Woman vs. Doomsday: Death of Superman 2018', '', 0, 'https://www.youtube.com/watch?v=BZAw4n4e_ew', 1, '2019-01-02 12:33:02', 9, '3:23'),
(17, 'nguy534', 'Batman Kills EVERYONE At GCPD | Titans 1x11 [Season Final]', '', 0, 'https://www.youtube.com/watch?v=lby8GrEkEmY', 1, '2019-01-06 09:15:49', 25, '4:01'),
(18, 'nguy534', 'Nhac Gao nep Gao te OST', '', 0, 'https://www.youtube.com/watch?v=98wJJRYLcDA', 3, '2019-01-03 20:06:37', 6, '13:20'),
(19, 'atruong655', 'TINO - Yeu Roi', '', 0, 'https://www.youtube.com/watch?v=hza2ahW4c9s', 3, '2019-01-03 20:19:26', 9, '3:24'),
(20, 'nguy534', 'Quang Hai', '', 0, 'https://www.youtube.com/watch?v=QYspSvy7ous', 5, '2019-01-03 21:19:45', 14, '3:11'),
(21, 'nguy534', 'C++ Begin to Advanced', '', 0, 'https://www.youtube.com/watch?v=mUQZ1qmKlLY', 13, '2019-01-05 22:55:29', 12, '9:13:05'),
(22, 'nguy534', 'Aquaman Behind the Scence', '', 1, 'https://www.youtube.com/watch?v=shdb-Bn-kMo', 1, '2019-01-05 15:59:14', 4, '3:07'),
(23, 'nguy534', 'Top 40 Most Humiliating Goals In Football History', '', 0, 'https://www.youtube.com/watch?v=m4GEJeVZwPU', 5, '2019-01-03 21:22:28', 9, '10:01'),
(24, 'nguy534', 'Top 20 Insane Red Cards in Football History', '', 0, 'https://www.youtube.com/watch?v=a50b3tOXZ0E', 5, '2019-01-03 21:23:37', 12, '9:19'),
(25, 'nguy534', 'Best Fight Scenes: Louis Fan', '', 0, 'https://www.youtube.com/watch?v=DIMIZPbnfNs', 1, '2019-01-03 21:25:02', 6, '21:42'),
(26, 'nguy534', 'Best Fight Scenes: Wing Chun', '', 0, 'https://www.youtube.com/watch?v=BgxQpSEMleo', 10, '2019-01-03 21:25:57', 13, '10:33'),
(27, 'nguy534', 'Paris By Night 112 ', '', 0, 'https://www.youtube.com/watch?v=W0hCgGwaWbs', 10, '2019-01-03 21:26:39', 12, '4:32:41'),
(28, 'atruong655', 'Ariana Grande - thank u, next', '', 0, 'https://www.youtube.com/watch?v=gl1aHhXnN1k', 3, '2019-01-04 08:30:34', 21, '5:31'),
(29, 'atruong655', '5 Superstars who WILL be champions in 2019', '', 0, 'https://www.youtube.com/watch?v=tRY8AKSbg0Y', 10, '2019-01-04 08:33:45', 8, '3:01'),
(30, 'atruong655', 'The ANGRIEST Owner Of All Time? | Kitchen Nightmares', '', 0, 'https://www.youtube.com/watch?v=shyCmvnpMZY', 10, '2019-01-04 08:34:44', 6, '9:04'),
(31, 'atruong655', 'Even The Waiter Has To Spit The Lobster Out! - Kitchen Nightmares', '', 0, 'https://www.youtube.com/watch?v=KiyRQbWgH3s', 10, '2019-01-04 08:35:42', 4, '4:19'),
(32, 'atruong655', 'The WORST Steaks Served On Kitchen Nightmares', '', 0, 'https://www.youtube.com/watch?v=zgsEktp35GU', 10, '2019-01-04 08:39:29', 4, '17:29'),
(33, 'atruong655', 'Fox go FLOOF', '', 0, 'https://www.youtube.com/watch?v=_AtP7au_Q9w', 4, '2019-01-04 08:40:21', 3, '5:05'),
(34, 'atruong655', 'Showdown with Holly | Dog Whisperer', '', 0, 'https://www.youtube.com/watch?v=9ihXq_WwiWM', 4, '2019-01-04 08:41:00', 7, '3:00'),
(35, 'atruong655', 'Pit Puppy Lessons | Dog Whisperer', '', 0, 'https://www.youtube.com/watch?v=XHl8VFCoxyI', 4, '2019-01-04 08:41:34', 3, '3:47'),
(36, 'Kpop', 'Red Velvet - Red Flavor K-pop in North Korea - North Korean Reaction', '', 0, 'https://www.youtube.com/watch?v=0ybRXKeWdII', 3, '2019-01-04 11:52:24', 10, '1:36'),
(37, 'Kpop', 'Red Velvet - Bad Boy K-pop in North Korea', '', 0, 'https://www.youtube.com/watch?v=z-g_bAsndgE', 3, '2019-01-04 11:52:50', 5, '3:30'),
(38, 'Kpop', 'TWICE - What is Love? + Yes or Yes + Dance the Night Away [2018 SBS Ga', '', 0, 'https://www.youtube.com/watch?v=rOmNVlZxiC0', 3, '2019-01-04 11:53:21', 10, '8:03'),
(39, 'Black Pink', 'BLACKPINK (DDU-DU DDU-DU) M/V', 'Albums Available @ \r\nYG E-SHOP: http://bit.ly/yg-squareup\r\nAmazon US: http://bit.ly/us-squareup\r\nAmazon JP: http://bit.ly/jp-squareup\r\nQoo10 SG: http://bit.ly/qoo10-squareup', 0, 'https://www.youtube.com/watch?v=IHNzOHi8sJs', 3, '2019-01-04 11:55:39', 3, '3:36'),
(40, 'Black Pink', 'BLACKPINK (AS IF IT\"S YOUR LAST)\" M/V', '', 0, 'https://www.youtube.com/watch?v=Amq-qlqbjYA', 3, '2019-01-04 11:56:16', 4, '3:37'),
(41, 'Black Pink', 'BLACKPINK - \"STAY\" M/V', '', 0, 'https://www.youtube.com/watch?v=FzVR_fymZw4', 3, '2019-01-04 11:56:54', 17, '4:01'),
(42, 'Black Pink', 'JENNIE - \"SOLO\" DIARY EP.5-2', '', 0, 'https://www.youtube.com/watch?v=xKW9q-oIZUE', 3, '2019-01-04 11:57:19', 13, '8:03'),
(43, 'Black Pink', 'JENNIE - \"SOLO\" DIARY EP.5-1', '', 0, 'https://www.youtube.com/watch?v=gHj5OGqvZ_8', 3, '2019-01-04 11:57:56', 13, '9:38'),
(44, 'Black Pink', 'JENNIE - \"SOLO\" 1125 SBS Inkigayo : NO.1 OF THE WEEK', '', 0, 'https://www.youtube.com/watch?v=smimdoBjeAE', 3, '2019-01-04 11:58:24', 2, '4:46'),
(45, 'Black Pink', 'JENNIE - \"SOLO\" CHOREOGRAPHY UNEDITED VERSION', '', 0, 'https://www.youtube.com/watch?v=vdDuCvCrcKg', 3, '2019-01-04 11:58:55', 270, '2:58'),
(46, 'Black Pink', 'BLACKPINK (PLAYING WITH FIRE) DANCE PRACTICE VIDEO', '', 0, 'https://www.youtube.com/watch?v=NvWfJTbrTBY', 3, '2019-01-04 11:59:25', 7, '3:24'),
(47, 'Black Pink', 'BLACKPINK (WHISTLE) M/V', '', 0, 'https://www.youtube.com/watch?v=dISNgvVpWlo', 3, '2019-01-04 12:00:01', 7, '3:51'),
(48, 'Black Pink', 'BLACKPINK (BOOMBAYAH) M/V', '', 0, 'https://www.youtube.com/watch?v=bwmSjveL3Lc', 3, '2019-01-04 12:00:25', 6, '4:04'),
(49, 'Black Pink', 'JENNIE - \"SOLO\" DIARY EP.3', '', 0, 'https://www.youtube.com/watch?v=DR9n-vDj-zo', 9, '2019-01-04 12:00:54', 10, '4:03'),
(50, 'Black Pink', 'BLACKPINK (BLACKPINK HOUSE)\" EP.9-1', '', 0, 'https://www.youtube.com/watch?v=LK4UWnImijY', 9, '2019-01-04 12:06:56', 3, '11:35'),
(51, 'Black Pink', 'BLACKPINK (BLACKPINK HOUSE)\" EP.9-2', '', 0, 'https://www.youtube.com/watch?v=ho7HwRQqV6Q', 10, '2019-01-04 12:07:22', 4, '9:27'),
(52, 'Black Pink', 'BLACKPINK (BLACKPINK HOUSE) EP.9-3', '', 0, 'https://www.youtube.com/watch?v=eQU-R5dqP-Q', 10, '2019-01-04 12:07:43', 6, '9:40'),
(53, 'Black Pink', 'BLACKPINK (BLACKPINK HOUSE) EP.3-2', '', 0, 'https://www.youtube.com/watch?v=pvNy3hU6v6k', 10, '2019-01-04 12:08:25', 3, '8:59'),
(54, 'Black Pink', 'JENNIE - \"SOLO\" M/V', 'Jennie Solo MV official release', 0, 'https://www.youtube.com/watch?v=b73BI9eUkjM', 3, '2019-01-05 16:59:34', 3, '2:57'),
(55, 'Black Pink', 'BLACKPINK - \"FOREVER YOUNG\" 0715 SBS Inkigayo', '', 0, 'https://www.youtube.com/watch?v=67otJZ6qe9Y', 10, '2019-01-04 12:09:38', 5, '3:54'),
(56, 'Black Pink', 'Dua Lipa & BLACKPINK - Kiss and Make Up (Official Audio)', '', 0, 'https://www.youtube.com/watch?v=AX3Bsiq-13k', 3, '2019-01-05 18:43:55', 4, '3:10'),
(57, 'nguy534', 'Water War with Jason Momoa', '', 0, 'https://www.youtube.com/watch?v=7b3II_N32Pk', 9, '2019-01-05 16:04:12', 0, '6:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `commentdislikes`
--
ALTER TABLE `commentdislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentlikes`
--
ALTER TABLE `commentlikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `commentdislikes`
--
ALTER TABLE `commentdislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `commentlikes`
--
ALTER TABLE `commentlikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 01:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brainster_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `short_bio` text NOT NULL,
  `is_archived` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `short_bio`, `is_archived`) VALUES
(1, 'J.K.', 'Rowlings', 'J.K. Rowling is a British author best known for her fantasy book series \"Harry Potter.\"', 0),
(2, 'George', 'Orwell', 'George Orwell was an English novelist known for his works \"1984\" and \"Animal Farm.\"', 0),
(3, 'Jane', 'Austen', 'Jane Austen was an English novelist famous for her romantic fiction, including \"Pride and Prejudice.\"', 0),
(4, 'Mark', 'Twain', 'Mark Twain, also known as Samuel Clemens, was an American writer and humorist known for \"The Adventures of Huckleberry Finn.\"', 0),
(5, 'Gabriel', 'García Márquez', 'Gabriel García Márquez was a Colombian novelist and Nobel Prize winner, known for \"One Hundred Years of Solitude.\"', 0),
(6, 'Fyodor', 'Dostoevsky', 'Fyodor Dostoevsky, a renowned Russian novelist, explored the human psyche and morality in his works, such as \"Crime and Punishment\" and \"The Brothers Karamazov,\" delving into complex psychological depths.', 1),
(7, 'Fyodor', 'Dostoevskyyyy', 'Fyodor Dostoevsky, a renowned Russian novelist, explored the human psyche and morality in his works, such as \"Crime and Punishment\" and \"The Brothers Karamazov,\" delving into complex psychological depths.', 1),
(8, 'asdada', 'adadad', 'asdadadd', 1),
(9, 'Andrej', 'asdada', 'dadadadad', 1),
(10, 'Maurice', 'Leblanc', 'Maurice Leblanc (1864-1941) was a renowned French author, best known for creating the iconic gentleman thief Arsène Lupin in his captivating detective stories.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `publication_year` int(11) NOT NULL,
  `number_of_pages` int(11) NOT NULL,
  `image` text NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_archived` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author_id`, `publication_year`, `number_of_pages`, `image`, `category_id`, `is_archived`) VALUES
(1, 'Harry Potter and the Sorcerer\'s Stone', 1, 1997, 320, 'https://m.media-amazon.com/images/I/81m1s4wIPML._AC_UF1000,1000_QL80_.jpg', 7, 0),
(2, '1984', 2, 1949, 328, 'https://s3.amazonaws.com/adg-bucket/1984-george-orwell/3423-medium.jpg', 8, 0),
(3, 'Pride and Prejudice', 3, 1813, 432, 'https://m.media-amazon.com/images/I/71Q1tPupKjL._AC_UF1000,1000_QL80_.jpg', 9, 0),
(4, 'The Adventures of Huckleberry Finn', 4, 1884, 366, 'https://m.media-amazon.com/images/I/71iBE54utML._AC_UF1000,1000_QL80_.jpg', 10, 0),
(5, 'One Hundred Years of Solitude', 5, 1967, 418, 'https://m.media-amazon.com/images/I/81MI6+TpYkL._AC_UF1000,1000_QL80_.jpg', 7, 0),
(6, 'Harry Potter and the Chamber of Secrets', 1, 1998, 368, 'https://m.media-amazon.com/images/I/81S0LnPGGUL._AC_UF894,1000_QL80_.jpg', 7, 0),
(7, 'Animal Farm', 2, 1945, 112, 'https://m.media-amazon.com/images/I/91LUbAcpACL._AC_UF1000,1000_QL80_.jpg', 11, 0),
(8, 'Sense and Sensibility', 3, 1811, 384, 'https://m.media-amazon.com/images/I/718emUlQwnS._AC_UF1000,1000_QL80_.jpg', 9, 0),
(9, 'The Prince and the Pauper', 4, 1881, 192, 'https://m.media-amazon.com/images/I/91OX8Cia9xL._AC_UF1000,1000_QL80_.jpg', 5, 0),
(10, 'Love in the Time of Cholera', 5, 1985, 368, 'https://m.media-amazon.com/images/I/51hR1SC1-gL._AC_UF1000,1000_QL80_.jpg', 9, 0),
(11, 'Crime and punishment', 1, 1997, 234, 'https://m.media-amazon.com/images/I/81EcXiV-9WL._AC_UF1000,1000_QL80_.jpg', 11, 1),
(12, 'Crime and punishment', 3, 1997, 232, 'https://m.media-amazon.com/images/I/81EcXiV-9WL._AC_UF1000,1000_QL80_.jpg', 2, 1),
(13, 'something', 2, 323, 2312, 'asdasd', 10, 1),
(14, 'asdasdasdasd', 1, 14124, 231, 'https://m.media-amazon.com/images/I/81EcXiV-9WL._AC_UF1000,1000_QL80_.jpg', 9, 1),
(15, 'asdasdadadadad', 2, 23, 2313, 'https://m.media-amazon.com/images/I/81EcXiV-9WL._AC_UF1000,1000_QL80_.jpg', 9, 1),
(16, 'Arsène Lupin, Gentleman Burglar', 10, 1907, 120, 'https://m.media-amazon.com/images/I/814t4rGc0fL._AC_UF1000,1000_QL80_.jpg', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `is_archived`) VALUES
(1, 'Comedy\r\n', 0),
(2, 'Drama', 0),
(3, 'Mystery', 0),
(4, 'Horror', 1),
(5, 'History', 0),
(6, 'Biography', 1),
(7, 'Fantasy', 0),
(8, 'Dystopia', 0),
(9, 'Romance', 0),
(10, 'Adventure', 0),
(11, 'Satire', 0),
(12, 'Psychological', 1),
(14, 'Thri', 1),
(15, 'Thrillersss', 1),
(16, 'Thrillersss', 1);

-- --------------------------------------------------------

--
-- Table structure for table `private_notes`
--

CREATE TABLE `private_notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `private_notes`
--

INSERT INTO `private_notes` (`id`, `user_id`, `book_id`, `note`) VALUES
(2, 13, 2, 'Need to read this one next\r\n\r\n'),
(4, 13, 9, 'I\'m on page 12'),
(5, 14, 1, 'I\'m on page 126');

-- --------------------------------------------------------

--
-- Table structure for table `public_comments`
--

CREATE TABLE `public_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `is_approved` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `public_comments`
--

INSERT INTO `public_comments` (`id`, `user_id`, `book_id`, `comment`, `is_approved`) VALUES
(2, 13, 6, 'One of my favorite books would definitely recommend it.', 1),
(6, 14, 8, 'Love this one, need to read it one more time!', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`) VALUES
(12, 'andrejjakimovski43@gmail.com', 'andrej', '$2y$10$w1jXVwK/6k9VIE8eSmtwU.BM99.gdhG47LP8G2Eane1SW/SPLKZ2u', 'admin'),
(13, 'duvlisdimitra8@gmail.com', 'dimitra', '$2y$10$Jzp7/0j3/z0q9y4CgX92X.gg/Dqcd1bCwoLM0IsjEKlw27gQfZmUa', 'client'),
(14, 'john@gmail.com', 'john', '$2y$10$WdzO/x0KsLyx4Us8knvUO.YxL7ly9yvuR001Y/PyUDSrF9QqePsWK', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author_id`),
  ADD KEY `category` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `private_notes`
--
ALTER TABLE `private_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `book` (`book_id`);

--
-- Indexes for table `public_comments`
--
ALTER TABLE `public_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `book` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `private_notes`
--
ALTER TABLE `private_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `public_comments`
--
ALTER TABLE `public_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `private_notes`
--
ALTER TABLE `private_notes`
  ADD CONSTRAINT `private_notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `private_notes_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Constraints for table `public_comments`
--
ALTER TABLE `public_comments`
  ADD CONSTRAINT `public_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `public_comments_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

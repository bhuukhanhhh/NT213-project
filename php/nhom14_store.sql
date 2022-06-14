CREATE USER 'nhom14_admin'@'localhost' IDENTIFIED BY 'Nhom14@@@';
GRANT ALL PRIVILEGES ON nhom14_store.* TO 'nhom14_admin'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;

CREATE DATABASE nhom14_store;

--
-- Database: `nhom14_store`
--
-- --------------------------------------------------------
--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `contact` varchar(50) NULL,
    `email` varchar(255) NOT NULL UNIQUE,
    `username` varchar(255) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO user_info(id, name, contact, email, username, password) VALUES (0, "Admin Nhom14Store", "999999999", "admin@nhom14store.uit", "admini", "$2y$10$5c6OQJNa0fDSaz4266T2RuSVTkQFiU.IA3Dd/m87s2GJPGYq8hlnm");
-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
    `id` int(11) NOT NULL PRIMARY KEY,
    `name` varchar(255) NOT NULL,
    `price` int(11) NOT NULL,
    `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`) VALUES
(1, 'Cannon EOS', 36000),
(2, 'Sony DSLR', 40000),
(3, 'Sony DSLR', 50000),
(4, 'Olympus DSLR', 80000),
(5, 'Titan Model #301', 13000),
(6, 'Titan Model #201', 3000),
(7, 'HMT Milan', 8000),
(8, 'Favre Leuba #111', 18000),
(9, 'Raymond', 1500),
(10, 'Charles', 1000),
(11, 'HXR', 900),
(12, 'PINK', 1200);

--
-- AUTO_INCREMENT for table `items`
--

/* ALTER TABLE `items` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13; */

ALTER TABLE `items` ADD `picture` varchar(255) NOT NULL;

UPDATE `items` SET `picture` = 'images/cannon_eos.jpg' WHERE id=1;
UPDATE `items` SET `picture` = 'images/sony_dslr.jpeg' WHERE id=2;
UPDATE `items` SET `picture` = 'images/sony_dslr2.jpeg' WHERE id=3;
UPDATE `items` SET `picture` = 'images/olympus.jpg' WHERE id=4;
UPDATE `items` SET `picture` = 'images/titan301.jpg' WHERE id=5;
UPDATE `items` SET `picture` = 'images/titan201.jpg' WHERE id=6;
UPDATE `items` SET `picture` = 'images/hmt.JPG' WHERE id=7;
UPDATE `items` SET `picture` = 'images/favreleuba.jpg' WHERE id=8;
UPDATE `items` SET `picture` = 'images/raymond.jpg' WHERE id=9;
UPDATE `items` SET `picture` = 'images/charles.jpg' WHERE id=10;
UPDATE `items` SET `picture` = 'images/HXR.jpg' WHERE id=11;
UPDATE `items` SET `picture` = 'images/pink.jpg' WHERE id=12;

INSERT INTO `items` (`name`, `price`, `picture`) VALUES
('Rolex Daytona', 60000, 'images/rolex-daytona.jpg'),
('Rolex GMT Master II', 24999, 'images/rolex-GMT-master-II.jpg'),
('Rolex Oyster Perpetual Day Date', 56095, 'images/rolex-oyster-perpetual-day-date.jpg'),
('Rolex Submariner Date Ceramic', 13975, 'images/rolex-submariner-date-ceramic.jpg');

INSERT INTO `items` (`name`, `price`, `picture`) VALUES
('PowerShot G1 X Mark III', 3400, 'images/PowerShot-G1-X-MarkIII.jpg'),
('PowerShot G5 X Mark II', 4300, 'images/PowerShot-G5-X-MarkII.jpg'),
('PowerShot G7 X Mark III', 4950, 'images/PowerShot-G7-X-MarkIII.jpg'),
('IXUS 185', 3440, 'images/IXUS-185.jpg');

INSERT INTO `items` (`name`, `price`, `picture`) VALUES
('EOS 850D', 4999, 'images/EOS-850D.jpg'),
('EOS 90D', 5110, 'images/EOS-90D.jpg'),
('EOS 6D Mark II', 5550, 'images/EOS-6D-MarkII.jpg'),
('EOS M200', 4490, 'images/EOS-M200.png');

INSERT INTO `items` (`name`, `price`, `picture`) VALUES
('Junghans Meister Handaufzug', 350, 'images/junghans-meister-handaufzug.jpg'),
('Nordgreen Philosopher', 8750, 'images/nordgreen-philosopher.jpg');
('Michael Kors Runway', 970, 'images/michael-kors-runway.jpg');




-- --------------------------------------------------------

--
-- Table structure for table `users_items`
--

CREATE TABLE `users_items` (
    `id` int(11) NOT NULL PRIMARY KEY,
    `user_id` int(11) NOT NULL,
    `item_id` int(11) NOT NULL,
    `status` enum('Added to cart','Confirmed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_items`
--

INSERT INTO `users_items` (`id`, `user_id`, `item_id`, `status`) VALUES
(2, 1, 9, 'Added to cart'),
(3, 1, 2, 'Added to cart'),
(4, 1, 8, 'Added to cart');

--
-- AUTO_INCREMENT for table `users_items`
--
ALTER TABLE `users_items` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Indexes for table `users_items`
--

ALTER TABLE `users_items`
    ADD KEY `user_id` (`user_id`,`item_id`),
    ADD KEY `item_id` (`item_id`);


--
-- Constraints for table `users_items`
--

ALTER TABLE `users_items`
    ADD CONSTRAINT `users_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`),
    ADD CONSTRAINT `users_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

-- --------------------------------------------------------

--
-- Table structure for table `users_comments`
--

CREATE TABLE `users_comments` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `user_username` varchar(255) NOT NULL,
    `submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users_comments`
    ADD KEY `user_id` (`user_id`,`user_username`),
    ADD KEY `user_username` (`user_username`);

ALTER TABLE `users_comments`
    ADD CONSTRAINT `users_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`),
    ADD CONSTRAINT `users_comments_ibfk_2` FOREIGN KEY (`user_username`) REFERENCES `user_info` (`username`);


CREATE TABLE `contact_us` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `contact` varchar(50) NOT NULL,
    `submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `messages` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- create database --
CREATE DATABASE nhom14_storeee;

-- create user admin --
CREATE USER 'nhom14_admin'@'localhost' IDENTIFIED BY 'Nhom14@@@';
GRANT ALL PRIVILEGES ON nhom14_storeee.* TO 'nhom14_admin'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;

-- ----------------------------------------------------------------------- --
-- ----------------------------------------------------------------------- --
-- ----------------------------------------------------------------------- --


-- create table `user_info` contains all information about registered account --
CREATE TABLE `user_info` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `contact` varchar(50) NULL,
    `email` varchar(255) NOT NULL UNIQUE,
    `username` varchar(255) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- create table `store_products` contains all the store products --
CREATE TABLE `store_products` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `price` int(11) NOT NULL,
    `img` text NOT NULL,
    `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- create table `users_cart` contains products that customers added to their cart --
CREATE TABLE `user_cart` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    `quantity` int(11) NOT NULL DEFAULT 1,
    `status` enum('Added to cart','Confirmed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- create table `users_feedbacks` contains all the customer's feedbacks --
CREATE TABLE `users_feedbacks` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `user_username` varchar(255) NOT NULL,
    `submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- create table `contact_service` for customer services --
CREATE TABLE `contact_service` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `contact` varchar(50) NOT NULL,
    `submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `messages` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- ----------------------------------------------------------------------- --
-- ----------------------------------------------------------------------- --
-- ----------------------------------------------------------------------- --

-- insert admin information --
INSERT INTO user_info(id, name, contact, email, username, password) VALUES (0, "Admin Nhom14Store", "999999999", "admin@nhom14store.uit", "admini", "$2y$10$5c6OQJNa0fDSaz4266T2RuSVTkQFiU.IA3Dd/m87s2GJPGYq8hlnm");
INSERT INTO user_info(name, contact, email, username, password) VALUES ("Bui Huu Khanh", "123456789", "bhuukhanhhh@gmail.com", "bhuukhanhhh", "$2y$10$5c6OQJNa0fDSaz4266T2RuSVTkQFiU.IA3Dd/m87s2GJPGYq8hlnm");


-- insert all products to `store_products` table --
INSERT INTO `store_products` (`id`, `name`, `price`, `img`) VALUES
(1, 'Canon EOS', 3600, 'images/cameras/canon_eos.jpg'),
(2, 'Sony DSLR #101', 4000, 'images/cameras/sony_dslr.jpeg'),
(3, 'Sony DSLR #201', 4500, 'images/cameras/sony_dslr2.jpeg'),
(4, 'Charles', 1000, 'images/clothes/charles.jpg'),
(5, 'HXR', 900, 'images/clothes/HXR.jpg'),
(6, 'PINK', 1200, 'images/clothes/pink.jpg'),
(7, 'Citizen Eco Drive Promaster', 650, 'images/watches/citizen-eco-drive-promaster.jpg'),
(8, 'Fizili Ultra Thin', 20100, 'images/watches/fizili-ultra-thin.jpg'),
(9, 'Junghans Meister Handaufzug', 930, 'images/watches/junghans-meister-handaufzug.jpg'),
(10, 'PowerShot G1 X Mark III', 3400, 'images/cameras/PowerShot-G1-X-MarkIII.jpg'),
(11, 'PowerShot G5 X Mark II', 4300, 'images/cameras/PowerShot-G5-X-MarkII.jpg'),
(12, 'PowerShot G7 X Mark III', 4950, 'images/cameras/PowerShot-G7-X-MarkIII.jpg'),
(13, 'Polo #1', 400, 'images/clothes/polo-1.jpeg'),
(14, 'Polo #2', 420, 'images/clothes/polo-2.jpeg'),
(15, 'Polo #3', 490, 'images/clothes/polo-3.jpeg'),
(16, 'Michael Kors Runway', 970, 'images/watches/michael-kors-runway.jpg'),
(17, 'Oyster Perpetual Day Date', 56095, 'images/watches/rolex-oyster-perpetual-day-date.jpg'),
(18, 'Nordgreen Philosopher', 8750, 'images/watches/nordgreen-philosopher.jpg'),
(19, 'Canon EOS 6D Mark II', 5450, 'images/cameras/EOS-6D-MarkII.jpg'),
(20, 'Canon EOS 90D', 4999, 'images/cameras/EOS-90D.jpg'),
(21, 'Canon EOS 850D', 5110, 'images/cameras/EOS-850D.jpg'),
(22, 'Polo #4', 320, 'images/clothes/polo-4.jpeg'),
(23, 'Polo #5', 390, 'images/clothes/polo-5.jpeg'),
(24, 'Polo #6', 299, 'images/clothes/polo-6.jpeg'),
(25, 'Submariner Date Ceramic', 13975, 'images/watches/rolex-submariner-date-ceramic.jpg'),
(26, 'Timex Easy Reader', 84000, 'images/watches/timex-easy-reader.jpg'),
(27, 'Tissot Analog Display', 349, 'images/watches/tissot-analog.jpg'),
(28, 'Canon EOS M200', 4490, 'images/cameras/EOS-M200.png'),
(29, 'Canon EOS RP', 5500, 'images/cameras/EOS-RP.jpg'),
(30, 'IXUS 185', 3440, 'images/cameras/IXUS-185.jpg'),
(31, 'Polo #7', 500, 'images/clothes/polo-7.jpeg'),
(32, 'Polo #8', 480, 'images/clothes/polo-8.jpeg'),
(33, 'Polo #9', 280, 'images/clothes/polo-9.jpeg'),
(34, 'Fossil Gen 5E', 260, 'images/watches/fossil-gen-5e.jpg'),
(35, 'Fitbit Charge 4', 122, 'images/watches/fitbit-charge-4.jpg'),
(36, 'Apple Watch Series 6', 400, 'images/watches/apple-watch-series-6.jpeg');


-- insert data for table `user_cart` --
INSERT INTO `user_cart` (`user_id`, `product_id`, `status`) VALUES
(2, 9, 'Added to cart'),
(2, 2, 'Added to cart'),
(2, 8, 'Added to cart');


-- for table `user_cart` --
ALTER TABLE `user_cart`
    ADD KEY `user_id` (`user_id`,`product_id`),
    ADD KEY `product_id` (`product_id`);

ALTER TABLE `user_cart`
    ADD CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`),
    ADD CONSTRAINT `user_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `store_products` (`id`);


-- for table `users_comments` --
ALTER TABLE `users_feedbacks`
    ADD KEY `user_id` (`user_id`,`user_username`),
    ADD KEY `user_username` (`user_username`);

ALTER TABLE `users_feedbacks`
    ADD CONSTRAINT `users_feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`),
    ADD CONSTRAINT `users_feedbacks_ibfk_2` FOREIGN KEY (`user_username`) REFERENCES `user_info` (`username`);

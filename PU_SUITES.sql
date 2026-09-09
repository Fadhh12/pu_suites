SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create the database yourself first (phpMyAdmin -> New, or your host's
-- database panel) and select/USE it before running this file. Shared
-- hosting (InfinityFree, Hostinger, etc.) blocks DROP/CREATE DATABASE and
-- assigns you a fixed, prefixed database name, so this file intentionally
-- does not try to create or select a database itself.

-- 1. Create tables without foreign keys first

CREATE TABLE `staff` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `work` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `emp_login` (
  `empid` int(100) NOT NULL AUTO_INCREMENT,
  `Emp_Email` varchar(50) NOT NULL,
  -- Holds a password_hash() bcrypt hash (~60 chars), not a plaintext
  -- password -- login.php verifies it with password_verify(). Sized to
  -- 255 to leave headroom for future hash algorithms.
  `Emp_Password` varchar(255) NOT NULL,
  `staff_id` int(30) DEFAULT NULL,
  PRIMARY KEY (`empid`),
  KEY `fk_emp_staff` (`staff_id`),
  CONSTRAINT `fk_emp_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Failed admin login attempts, used by login.php to lock an IP out for a
-- few minutes after repeated bad passwords (there was no brute-force
-- protection at all before -- the login form could be hammered
-- indefinitely). Rows older than the lockout window are cheap to
-- accumulate at this site's scale; login.php prunes old rows as it goes.
CREATE TABLE `login_attempts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) NOT NULL,
  `attempted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip_time` (`ip`, `attempted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `room` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `bedding` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `signup` (
  `UserID` int(100) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `roombook` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `RoomType` varchar(30) NOT NULL,
  `Bed` varchar(30) NOT NULL,
  `Meal` varchar(30) NOT NULL,
  `NoofRoom` varchar(30) NOT NULL,
  `cin` date NOT NULL,
  `cout` date NOT NULL,
  `nodays` int(50) NOT NULL,
  `stat` varchar(30) NOT NULL,
  `room_id` int(30) DEFAULT NULL,
  `user_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_roombook_room` (`room_id`),
  KEY `fk_roombook_user` (`user_id`),
  CONSTRAINT `fk_roombook_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_roombook_user` FOREIGN KEY (`user_id`) REFERENCES `signup` (`UserID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `payment` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `RoomType` varchar(30) NOT NULL,
  `Bed` varchar(30) NOT NULL,
  `NoofRoom` int(30) NOT NULL,
  `cin` date NOT NULL,
  `cout` date NOT NULL,
  `noofdays` int(30) NOT NULL,
  `roomtotal` double(8,2) NOT NULL,
  `bedtotal` double(8,2) NOT NULL,
  `meal` varchar(30) NOT NULL,
  `mealtotal` double(8,2) NOT NULL,
  `finaltotal` double(8,2) NOT NULL,
  `booking_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_roombook` (`booking_id`),
  CONSTRAINT `fk_payment_roombook` FOREIGN KEY (`booking_id`) REFERENCES `roombook` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2. Insert Initial Data

INSERT INTO `staff` (`id`, `name`, `work`) VALUES
(1, 'Admin Name', 'Manager');

-- Seed login: Admin@gmail.com / ChangeMe#PU2026 (bcrypt hash below).
-- This is a placeholder for a fresh install only -- change it (see
-- README/security report) before the site is public. Generate your own
-- hash with: php -r "echo password_hash('yourpassword', PASSWORD_BCRYPT);"
INSERT INTO `emp_login` (`empid`, `Emp_Email`, `Emp_Password`, `staff_id`) VALUES
(1, 'Admin@gmail.com', '$2y$10$3c3Kosc64wY14dGrOdGITegx825HGtCpzXGHU64bIquEjEcIOfW7i', 1);

INSERT INTO `room` (`id`, `type`, `bedding`) VALUES
(4, 'Superior Room', 'Single'),
(6, 'Superior Room', 'Triple'),
(7, 'Superior Room', 'Quad'),
(8, 'Deluxe Room', 'Single'),
(9, 'Deluxe Room', 'Double'),
(10, 'Deluxe Room', 'Triple'),
(11, 'Guest House', 'Single'),
(12, 'Guest House', 'Double'),
(13, 'Guest House', 'Triple'),
(14, 'Guest House', 'Quad'),
(16, 'Superior Room', 'Double'),
(20, 'Single Room', 'Single'),
(22, 'Superior Room', 'Single'),
(23, 'Deluxe Room', 'Single'),
(24, 'Deluxe Room', 'Triple'),
(27, 'Guest House', 'Double'),
(30, 'Deluxe Room', 'Single');

INSERT INTO `signup` (`UserID`, `Username`, `Email`, `Password`) VALUES
(1, 'Steven Glecy', 'glecy@gmail.com', '123');

INSERT INTO `roombook` (`id`, `Name`, `Email`, `Country`, `Phone`, `RoomType`, `Bed`, `Meal`, `NoofRoom`, `cin`, `cout`, `nodays`, `stat`, `room_id`, `user_id`) VALUES
(1, 'Steven Glecy', 'glecy@gmail.com', 'Indonesia', '9313346569', 'Single Room', 'Single', 'Room only', '1', '2022-11-09', '2022-11-10', 1, 'Confirm', 20, 1);

INSERT INTO `payment` (`id`, `Name`, `Email`, `RoomType`, `Bed`, `NoofRoom`, `cin`, `cout`, `noofdays`, `roomtotal`, `bedtotal`, `meal`, `mealtotal`, `finaltotal`, `booking_id`) VALUES
(1, 'Steven Glecy', 'glecy@gmail.com', 'Single Room', 'Single', 1, '2022-11-09', '2022-11-10', 1, 1000.00, 10.00, 'Room only', 0.00, 1010.00, 1);

COMMIT;

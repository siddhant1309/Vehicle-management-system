-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2023 at 03:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking1`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_vehicle_info` ()   BEGIN
SELECT * FROM vehicle_info;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_veh_info` ()   BEGIN
SELECT * FROM vehicle_info;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `temp_cursor` (IN `register_num` TEXT)   BEGIN
DECLARE v_own TIME;
DECLARE r_num TEXT;
DECLARE v_finished INT DEFAULT 0;
DECLARE cursor2 CURSOR FOR SELECT V.InTime, V.ParkingNumber FROM out_table AS V;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished=1;
OPEN cursor2;
get_car: LOOP FETCH FROM cursor2 INTO v_own,r_num;
IF v_finished=1 THEN 
LEAVE get_car;
END IF;
IF v_own>register_num THEN
SELECT r_num;
END IF;
END LOOP get_car;
CLOSE cursor2;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `duration` (`p_num` VARCHAR(120)) RETURNS BIGINT(20) DETERMINISTIC BEGIN
DECLARE enter TIME;
DECLARE outtime TIME;
DECLARE difference TIME;
DECLARE minutes BIGINT;
DECLARE hours BIGINT;
DECLARE res BIGINT;
DECLARE ans BIGINT;
SET enter = (SELECT O.InTime FROM out_table AS O WHERE O.ParkingNumber=p_num);
SET outtime = (SELECT O.OutTime FROM out_table AS O WHERE O.ParkingNumber=p_num);
SET difference = TIMEDIFF(outtime,enter);
SET minutes =MINUTE(difference);
SET hours=HOUR(difference);
SET res= minutes + hours*60;
SET ans=res * 2;
UPDATE out_table SET duration= difference WHERE ParkingNumber = p_num;
RETURN ans;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `DURATION_TIME` (`p_num` VARCHAR(120)) RETURNS BIGINT(20) DETERMINISTIC BEGIN
DECLARE enter TIME;
DECLARE out_t TIME;
DECLARE ans TIME;
DECLARE res BIGINT;
set enter=(SELECT InTime FROM out_table AS O WHERE O.ParkingNumber=p_num);
set out_t=(SELECT OutTime FROM out_table AS O WHERE O.ParkingNumber=p_num);
set ans=TIMEDIFF(out_t,enter);
set res= ans.Hours*60 + ans.minutes;
set res=res*2;
RETURN res ;
UPDATE out_table As O SET O.duration=ans WHERE O.ParkingNumber=p_num;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `additional_info`
--

CREATE TABLE `additional_info` (
  `ID` int(11) NOT NULL,
  `Colour` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `additional_info`
--

INSERT INTO `additional_info` (`ID`, `Colour`) VALUES
(9, 'RED'),
(6, 'red'),
(8, 'blue');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `username` varchar(120) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `mobile` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`, `firstname`, `lastname`, `mobile`) VALUES
(13, 'admin', '123', 'sid', 'pathak', 7527851776),
(17, 'admin', '123', 'sid', 'pathak', 7527851776),
(20, 'admin', '123', 'sid', 'pathak', 7527851776),
(21, 'sid@123', '1234', 'Siddhant', 'Pathak', 1234567890);

-- --------------------------------------------------------

--
-- Table structure for table `out_table`
--

CREATE TABLE `out_table` (
  `ParkingNumber` varchar(120) DEFAULT NULL,
  `InTime` time NOT NULL DEFAULT current_timestamp(),
  `OutTime` time DEFAULT NULL,
  `Duration` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `out_table`
--

INSERT INTO `out_table` (`ParkingNumber`, `InTime`, `OutTime`, `Duration`) VALUES
('87281', '09:19:46', NULL, NULL),
('40151', '09:20:07', '09:51:05', '00:30:58'),
('32059', '09:20:32', '09:51:13', '00:30:41'),
('85992', '09:21:07', '14:04:08', '04:43:01'),
('20746', '09:21:25', '09:47:27', '00:26:02'),
('45891', '22:31:05', NULL, NULL),
('11336', '22:31:05', '10:58:00', NULL),
('56737', '22:31:05', NULL, NULL),
('12345', '00:20:04', '08:51:06', NULL),
('59543', '10:25:43', NULL, NULL),
('67945', '13:08:09', '10:58:00', NULL),
('67895', '00:02:42', '08:51:06', '08:48:24'),
('12345', '09:11:29', NULL, NULL),
('47423', '10:56:41', NULL, NULL),
('12345', '11:03:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vcategory`
--

CREATE TABLE `vcategory` (
  `ID` int(11) NOT NULL,
  `VehicleCat` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vcategory`
--

INSERT INTO `vcategory` (`ID`, `VehicleCat`) VALUES
(15, '4 wheeler'),
(17, '3 wheeler'),
(19, '2 wheeler'),
(21, '4 wheeler'),
(22, '6 wheeler');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_info`
--

CREATE TABLE `vehicle_info` (
  `ID` int(11) NOT NULL,
  `ParkingNumber` varchar(120) DEFAULT NULL,
  `VehicleCategory` varchar(120) NOT NULL,
  `VehicleCompanyname` varchar(120) DEFAULT NULL,
  `RegistrationNumber` varchar(120) DEFAULT NULL,
  `OwnerName` varchar(120) DEFAULT NULL,
  `OwnerContactNumber` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_info`
--

INSERT INTO `vehicle_info` (`ID`, `ParkingNumber`, `VehicleCategory`, `VehicleCompanyname`, `RegistrationNumber`, `OwnerName`, `OwnerContactNumber`) VALUES
(6, '45891', '2 Wheeler', 'Hyundai', '1234', 'sid', 7527851776),
(8, '56737', '2 Wheeler', 'Honda', '6996', 'sameer', 8976312345),
(9, '87281', '2 Wheeler', 'Hyundai', '1111', 'Ayan', 888888888),
(25, '12345', 'Bus', 'Scania', '8956', 'Adnan', 8951321856),
(26, '59543', '2 Wheeler', 'honda', '3234', 'shuvam', 4261728922),
(33, '47423', '3 wheeler', 'tata motors', '6578', 'shuvam bose', 8765432190),
(48, '12345', 'Bus', 'Scania', '8956', 'Adnan', 8951321856);

--
-- Triggers `vehicle_info`
--
DELIMITER $$
CREATE TRIGGER `vehiout` AFTER DELETE ON `vehicle_info` FOR EACH ROW UPDATE out_table SET out_table.OutTime=CURRENT_TIME where old.parkingnumber=out_table.ParkingNumber
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `vitem` AFTER INSERT ON `vehicle_info` FOR EACH ROW INSERT INTO out_table(parkingnumber) values(new.parkingnumber)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_info`
--
ALTER TABLE `additional_info`
  ADD KEY `fk` (`ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vcategory`
--
ALTER TABLE `vcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vcategory`
--
ALTER TABLE `vcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_info`
--
ALTER TABLE `additional_info`
  ADD CONSTRAINT `fk` FOREIGN KEY (`ID`) REFERENCES `vehicle_info` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

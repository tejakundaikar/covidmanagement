-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2020 at 08:21 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `AmbulanceLocation`
--

CREATE TABLE IF NOT EXISTS `AmbulanceLocation` (
  `amb_location_id` int(11) NOT NULL AUTO_INCREMENT,
  `ambulance_id` int(11) NOT NULL,
  `current_lat` float NOT NULL,
  `current_long` float NOT NULL,
  PRIMARY KEY (`amb_location_id`),
  KEY `ambulance_id` (`ambulance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ambulances`
--

CREATE TABLE IF NOT EXISTS `ambulances` (
  `amb_id` int(11) NOT NULL AUTO_INCREMENT,
  `amb_number` int(11) NOT NULL,
  `phc_id` int(11) NOT NULL,
  `is_available` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `att_id` int(11) NOT NULL,
  PRIMARY KEY (`amb_id`),
  KEY `phc_id` (`phc_id`,`driver_id`,`att_id`),
  KEY `driver_id` (`driver_id`),
  KEY `att_id` (`att_id`),
  KEY `phc_id_2` (`phc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `APCCSTAY`
--

CREATE TABLE IF NOT EXISTS `APCCSTAY` (
  `apcc_stay_id` int(11) NOT NULL AUTO_INCREMENT,
  `icmr_id` varchar(30) NOT NULL,
  `cc_id` int(11) NOT NULL,
  `checkin_date` datetime NOT NULL,
  `checkout_date` datetime NOT NULL,
  `discharge` text NOT NULL,
  PRIMARY KEY (`apcc_stay_id`),
  KEY `cc_id` (`cc_id`),
  KEY `icmr_id` (`icmr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `AsymtomaticCare`
--

CREATE TABLE IF NOT EXISTS `AsymtomaticCare` (
  `pat_id` int(11) NOT NULL AUTO_INCREMENT,
  `icmr_id` varchar(30) NOT NULL,
  `phc_id` int(11) NOT NULL,
  `mo_id` int(11) NOT NULL,
  `checkin_date` datetime NOT NULL,
  `fac_id` int(11) NOT NULL,
  `checkout_date` datetime NOT NULL,
  `amb_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `att_id` int(11) NOT NULL,
  PRIMARY KEY (`pat_id`),
  KEY `driver_id` (`driver_id`),
  KEY `att_id` (`att_id`),
  KEY `phc_id` (`phc_id`),
  KEY `icmr_id` (`icmr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendent`
--

CREATE TABLE IF NOT EXISTS `attendent` (
  `attendent_id` int(11) NOT NULL AUTO_INCREMENT,
  `attendent_name` text NOT NULL,
  `attendent_phone_number` text NOT NULL,
  PRIMARY KEY (`attendent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CCBedCapacity`
--

CREATE TABLE IF NOT EXISTS `CCBedCapacity` (
  `cc_id` int(11) NOT NULL,
  `male_beds` int(11) NOT NULL,
  `female_beds` int(11) NOT NULL,
  `emergency_beds` int(11) NOT NULL,
  KEY `cc_id` (`cc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CCBedOccupancy`
--

CREATE TABLE IF NOT EXISTS `CCBedOccupancy` (
  `cc_id` int(11) NOT NULL,
  `date_updated` date NOT NULL,
  `male_occuped` int(11) NOT NULL,
  `female_occupied` int(11) NOT NULL,
  `emergency_occupied` int(11) NOT NULL,
  `male_likelyfree` int(11) NOT NULL,
  `female_likelyfree` int(11) NOT NULL,
  `emergency_likelyfree` int(11) NOT NULL,
  KEY `cc_id` (`cc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CloseContact`
--

CREATE TABLE IF NOT EXISTS `CloseContact` (
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `icmr_id` varchar(30) NOT NULL,
  `name` text NOT NULL,
  `contact_number` text NOT NULL,
  `relation` text NOT NULL,
  `age` int(11) NOT NULL,
  `place` varchar(50) NOT NULL,
  `symptomatic` text NOT NULL,
  `date_of_test` date NOT NULL,
  `remarks` blob NOT NULL,
  PRIMARY KEY (`person_id`),
  KEY `address_id` (`place`),
  KEY `icmr_id` (`icmr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CovidCareCenter`
--

CREATE TABLE IF NOT EXISTS `CovidCareCenter` (
  `cc_id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_name` text NOT NULL,
  `address` varchar(30) NOT NULL,
  `contact_no` text NOT NULL,
  `doctor_incharge` text NOT NULL,
  PRIMARY KEY (`cc_id`),
  KEY `address_id` (`address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CovidHospital`
--

CREATE TABLE IF NOT EXISTS `CovidHospital` (
  `ch_id` int(11) NOT NULL AUTO_INCREMENT,
  `ch_name` text NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_no` text NOT NULL,
  `doctor_incharge` text NOT NULL,
  PRIMARY KEY (`ch_id`),
  KEY `address_id` (`address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `DeathReport`
--

CREATE TABLE IF NOT EXISTS `DeathReport` (
  `icmr_id` varchar(30) NOT NULL,
  `date_expired` date NOT NULL,
  KEY `icmr_id` (`icmr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_name` text NOT NULL,
  `driver_contact_number` text NOT NULL,
  PRIMARY KEY (`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ElectricalCA`
--

CREATE TABLE IF NOT EXISTS `ElectricalCA` (
  `icmr_id` varchar(30) NOT NULL,
  `CA` varchar(20) NOT NULL,
  KEY `icmr_id` (`icmr_id`),
  KEY `CA` (`CA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `GeoVisualization`
--

CREATE TABLE IF NOT EXISTS `GeoVisualization` (
  `icmr_id` varchar(30) NOT NULL,
  `patient_name` text NOT NULL,
  `lat` float NOT NULL,
  `log` float NOT NULL,
  `address` blob NOT NULL,
  KEY `icmr_id` (`icmr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HomequarantinePatientcare`
--

CREATE TABLE IF NOT EXISTS `HomequarantinePatientcare` (
  `icmrid` varchar(30) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `phcincharge` text NOT NULL,
  `status` text NOT NULL,
  KEY `icmrid` (`icmrid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HSBedCapacity`
--

CREATE TABLE IF NOT EXISTS `HSBedCapacity` (
  `ch_id` int(11) NOT NULL,
  `male_beds` int(11) NOT NULL,
  `female_beds` int(11) NOT NULL,
  `emergency_beds` int(11) NOT NULL,
  KEY `ch_id` (`ch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HSBedOccupancy`
--

CREATE TABLE IF NOT EXISTS `HSBedOccupancy` (
  `ch_id` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `male_occuped` int(11) NOT NULL,
  `female_occuped` int(11) NOT NULL,
  `emergency_occupied` int(11) NOT NULL,
  `male_likelyfree` int(11) NOT NULL,
  `female_likelyfree` int(11) NOT NULL,
  `emergency_likelyfree` int(11) NOT NULL,
  KEY `ch_id` (`ch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PatientWork`
--

CREATE TABLE IF NOT EXISTS `PatientWork` (
  `pat_work_id` int(11) NOT NULL AUTO_INCREMENT,
  `icmr_id` varchar(30) NOT NULL,
  `company_name` text NOT NULL,
  `occupation` text NOT NULL,
  `place_of_work` varchar(50) NOT NULL,
  PRIMARY KEY (`pat_work_id`),
  KEY `patient_id` (`icmr_id`),
  KEY `icmr_id` (`icmr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PHCS`
--

CREATE TABLE IF NOT EXISTS `PHCS` (
  `phc_id` int(11) NOT NULL AUTO_INCREMENT,
  `phc_name` int(11) NOT NULL,
  `doctor_incharge` int(11) NOT NULL,
  `phc_phone` int(11) NOT NULL,
  `doctor_phone` int(11) NOT NULL,
  `address` varchar(30) NOT NULL,
  PRIMARY KEY (`phc_id`),
  KEY `address_id` (`address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PositiveContact`
--

CREATE TABLE IF NOT EXISTS `PositiveContact` (
  `icmr_id` varchar(30) NOT NULL,
  `patient_name` text NOT NULL,
  `icmr_id_contactpatient` varchar(30) NOT NULL,
  `recorddate` datetime NOT NULL,
  PRIMARY KEY (`icmr_id`),
  KEY `icmr_id_contactpatient` (`icmr_id_contactpatient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PositivePatient`
--

CREATE TABLE IF NOT EXISTS `PositivePatient` (
  `icmr_id` varchar(30) NOT NULL,
  `SRF_id` text NOT NULL,
  `Laboratory_Name` text NOT NULL,
  `laboratory_code` text NOT NULL,
  `patient_id` text NOT NULL,
  `patient_name` text NOT NULL,
  `gender` text NOT NULL,
  `DOB` date NOT NULL,
  `age` int(11) NOT NULL,
  `stateofresidence` text NOT NULL,
  `district` text NOT NULL,
  `home_address` text NOT NULL,
  `village` text NOT NULL,
  `email_id` text NOT NULL,
  `contact_number` int(11) NOT NULL,
  `date_identifed_positive` datetime NOT NULL,
  `record_date_time` datetime NOT NULL,
  `occupation` text NOT NULL,
  `category` text NOT NULL COMMENT 'Asymtomatic or Symtomatic',
  `medical_status` text NOT NULL,
  `work_place_address` varchar(30) NOT NULL,
  `symtomatic_details_id` int(11) NOT NULL,
  `travel_history_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`icmr_id`),
  KEY `travel_history_id` (`travel_history_id`),
  KEY `work_place_id` (`work_place_address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PowerDeptConsumerData`
--

CREATE TABLE IF NOT EXISTS `PowerDeptConsumerData` (
  `CA_number` varchar(30) NOT NULL,
  `name` text NOT NULL,
  `address` blob NOT NULL,
  `lat` float NOT NULL,
  `long` float NOT NULL,
  PRIMARY KEY (`CA_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SPCHSTAY`
--

CREATE TABLE IF NOT EXISTS `SPCHSTAY` (
  `spch_stay_id` int(11) NOT NULL AUTO_INCREMENT,
  `icmr_id` varchar(30) NOT NULL,
  `ch_id` int(11) NOT NULL,
  `checkin_date` datetime NOT NULL,
  `checkout_date` datetime NOT NULL,
  `discharge` text NOT NULL,
  PRIMARY KEY (`spch_stay_id`),
  KEY `ch_id` (`ch_id`),
  KEY `icmr_id` (`icmr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TravelHistory`
--

CREATE TABLE IF NOT EXISTS `TravelHistory` (
  `Travel_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `travel_place` text NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `mode_of_travel` int(11) NOT NULL,
  PRIMARY KEY (`Travel_history_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
  `srno` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `role` text NOT NULL,
  `usertoken` text NOT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AmbulanceLocation`
--
ALTER TABLE `AmbulanceLocation`
  ADD CONSTRAINT `ambulancelocationidfk` FOREIGN KEY (`ambulance_id`) REFERENCES `ambulances` (`amb_id`);

--
-- Constraints for table `ambulances`
--
ALTER TABLE `ambulances`
  ADD CONSTRAINT `ambulanceattidfk` FOREIGN KEY (`att_id`) REFERENCES `attendent` (`attendent_id`),
  ADD CONSTRAINT `ambulancedriveridfk` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`),
  ADD CONSTRAINT `ambulancephcidfk` FOREIGN KEY (`phc_id`) REFERENCES `PHCS` (`phc_id`);

--
-- Constraints for table `APCCSTAY`
--
ALTER TABLE `APCCSTAY`
  ADD CONSTRAINT `apccstayccidfk` FOREIGN KEY (`cc_id`) REFERENCES `CovidCareCenter` (`cc_id`),
  ADD CONSTRAINT `apccstayicmridfk` FOREIGN KEY (`icmr_id`) REFERENCES `PositivePatient` (`icmr_id`);

--
-- Constraints for table `AsymtomaticCare`
--
ALTER TABLE `AsymtomaticCare`
  ADD CONSTRAINT `ppicmridfk` FOREIGN KEY (`icmr_id`) REFERENCES `PositivePatient` (`icmr_id`),
  ADD CONSTRAINT `asymptomaticcareattendantidfk` FOREIGN KEY (`att_id`) REFERENCES `attendent` (`attendent_id`),
  ADD CONSTRAINT `asymptomaticcaredriveridfk` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`),
  ADD CONSTRAINT `asymptomaticcarephcidfk` FOREIGN KEY (`phc_id`) REFERENCES `PHCS` (`phc_id`);

--
-- Constraints for table `CCBedCapacity`
--
ALTER TABLE `CCBedCapacity`
  ADD CONSTRAINT `ccbedcaacityccidfk` FOREIGN KEY (`cc_id`) REFERENCES `CovidCareCenter` (`cc_id`);

--
-- Constraints for table `CCBedOccupancy`
--
ALTER TABLE `CCBedOccupancy`
  ADD CONSTRAINT `covicarecenterccidfk` FOREIGN KEY (`cc_id`) REFERENCES `CovidCareCenter` (`cc_id`);

--
-- Constraints for table `CloseContact`
--
ALTER TABLE `CloseContact`
  ADD CONSTRAINT `closecontacticmridfk` FOREIGN KEY (`icmr_id`) REFERENCES `PositivePatient` (`icmr_id`);

--
-- Constraints for table `DeathReport`
--
ALTER TABLE `DeathReport`
  ADD CONSTRAINT `positivepatientdeathfk` FOREIGN KEY (`icmr_id`) REFERENCES `PositivePatient` (`icmr_id`);

--
-- Constraints for table `ElectricalCA`
--
ALTER TABLE `ElectricalCA`
  ADD CONSTRAINT `canumberfk` FOREIGN KEY (`CA`) REFERENCES `PowerDeptConsumerData` (`CA_number`),
  ADD CONSTRAINT `ecaicmridfk` FOREIGN KEY (`icmr_id`) REFERENCES `PositivePatient` (`icmr_id`);

--
-- Constraints for table `GeoVisualization`
--
ALTER TABLE `GeoVisualization`
  ADD CONSTRAINT `gvicmridfk` FOREIGN KEY (`icmr_id`) REFERENCES `PositivePatient` (`icmr_id`);

--
-- Constraints for table `HomequarantinePatientcare`
--
ALTER TABLE `HomequarantinePatientcare`
  ADD CONSTRAINT `homequarantinedicmridfk` FOREIGN KEY (`icmrid`) REFERENCES `PositivePatient` (`icmr_id`);

--
-- Constraints for table `HSBedCapacity`
--
ALTER TABLE `HSBedCapacity`
  ADD CONSTRAINT `hsbedcapacitychidfk` FOREIGN KEY (`ch_id`) REFERENCES `CovidHospital` (`ch_id`);

--
-- Constraints for table `HSBedOccupancy`
--
ALTER TABLE `HSBedOccupancy`
  ADD CONSTRAINT `hsbedoccupancychidfk` FOREIGN KEY (`ch_id`) REFERENCES `CovidHospital` (`ch_id`);

--
-- Constraints for table `PatientWork`
--
ALTER TABLE `PatientWork`
  ADD CONSTRAINT `patworkicmridfk` FOREIGN KEY (`icmr_id`) REFERENCES `PositivePatient` (`icmr_id`);

--
-- Constraints for table `PositiveContact`
--
ALTER TABLE `PositiveContact`
  ADD CONSTRAINT `pcicmridfk` FOREIGN KEY (`icmr_id_contactpatient`) REFERENCES `PositivePatient` (`icmr_id`);

--
-- Constraints for table `PositivePatient`
--
ALTER TABLE `PositivePatient`
  ADD CONSTRAINT `test` FOREIGN KEY (`travel_history_id`) REFERENCES `TravelHistory` (`Travel_history_id`);

--
-- Constraints for table `SPCHSTAY`
--
ALTER TABLE `SPCHSTAY`
  ADD CONSTRAINT `spchstaychidfk` FOREIGN KEY (`ch_id`) REFERENCES `CovidHospital` (`ch_id`),
  ADD CONSTRAINT `spchstayicmridfk` FOREIGN KEY (`icmr_id`) REFERENCES `PositivePatient` (`icmr_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

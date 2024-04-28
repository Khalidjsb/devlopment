-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 09:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learnoutput`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessmentactivities`
--

CREATE TABLE `assessmentactivities` (
  `AssessmentActivityID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `ActivityName` varchar(255) DEFAULT NULL,
  `PercentageOfTotalGrade` float DEFAULT NULL,
  `TotalMarks` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `CollegeID` int(11) NOT NULL,
  `UniversityID` int(11) DEFAULT NULL,
  `CollegeName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `CourseCode` varchar(255) DEFAULT NULL,
  `CourseTitle` varchar(255) DEFAULT NULL,
  `SectionNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `DepartmentID` int(11) NOT NULL,
  `CollegeID` int(11) DEFAULT NULL,
  `DepartmentName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id_gr` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Grade` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learningoutcomeassessment`
--

CREATE TABLE `learningoutcomeassessment` (
  `ID` int(11) NOT NULL,
  `LearningOutcomeID` int(11) DEFAULT NULL,
  `AssessmentActivityID` int(11) DEFAULT NULL,
  `Percentage` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learningoutcomecategories`
--

CREATE TABLE `learningoutcomecategories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learningoutcomecategories`
--

INSERT INTO `learningoutcomecategories` (`ID`, `Name`) VALUES
(1, 'المعرفة'),
(2, 'المهارات'),
(3, 'القيم والاستقلالية والمسؤلية');

-- --------------------------------------------------------

--
-- Table structure for table `learningoutcomes`
--

CREATE TABLE `learningoutcomes` (
  `LearningOutcomeID` int(11) NOT NULL,
  `ID_LearningOutcomeCategories` int(11) DEFAULT NULL,
  `CourseCode` varchar(255) DEFAULT NULL,
  `TargetLevel` int(11) DEFAULT NULL,
  `PassingGrade` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `StudentName` varchar(255) NOT NULL,
  `StudentGrade` decimal(5,2) DEFAULT NULL,
  `state` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `UniversityID` int(11) NOT NULL,
  `UniversityName` varchar(255) DEFAULT NULL,
  `ProgramGrade` float DEFAULT NULL,
  `Program` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `id_university` int(11) NOT NULL,
  `university_name` varchar(255) DEFAULT NULL,
  `college_name` varchar(255) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL,
  `course_number` int(11) DEFAULT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `section_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessmentactivities`
--
ALTER TABLE `assessmentactivities`
  ADD PRIMARY KEY (`AssessmentActivityID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`CollegeID`),
  ADD KEY `UniversityID` (`UniversityID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DepartmentID`),
  ADD KEY `CollegeID` (`CollegeID`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id_gr`);

--
-- Indexes for table `learningoutcomeassessment`
--
ALTER TABLE `learningoutcomeassessment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LearningOutcomeID` (`LearningOutcomeID`),
  ADD KEY `AssessmentActivityID` (`AssessmentActivityID`);

--
-- Indexes for table `learningoutcomecategories`
--
ALTER TABLE `learningoutcomecategories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `learningoutcomes`
--
ALTER TABLE `learningoutcomes`
  ADD PRIMARY KEY (`LearningOutcomeID`),
  ADD KEY `ID_LearningOutcomeCategories` (`ID_LearningOutcomeCategories`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`UniversityID`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id_university`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessmentactivities`
--
ALTER TABLE `assessmentactivities`
  MODIFY `AssessmentActivityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `CollegeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id_gr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `learningoutcomeassessment`
--
ALTER TABLE `learningoutcomeassessment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `learningoutcomecategories`
--
ALTER TABLE `learningoutcomecategories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `learningoutcomes`
--
ALTER TABLE `learningoutcomes`
  MODIFY `LearningOutcomeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `UniversityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `id_university` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessmentactivities`
--
ALTER TABLE `assessmentactivities`
  ADD CONSTRAINT `assessmentactivities_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);

--
-- Constraints for table `colleges`
--
ALTER TABLE `colleges`
  ADD CONSTRAINT `colleges_ibfk_1` FOREIGN KEY (`UniversityID`) REFERENCES `universities` (`UniversityID`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`CollegeID`) REFERENCES `colleges` (`CollegeID`);

--
-- Constraints for table `learningoutcomeassessment`
--
ALTER TABLE `learningoutcomeassessment`
  ADD CONSTRAINT `learningoutcomeassessment_ibfk_1` FOREIGN KEY (`LearningOutcomeID`) REFERENCES `learningoutcomes` (`LearningOutcomeID`),
  ADD CONSTRAINT `learningoutcomeassessment_ibfk_2` FOREIGN KEY (`AssessmentActivityID`) REFERENCES `assessmentactivities` (`AssessmentActivityID`);

--
-- Constraints for table `learningoutcomes`
--
ALTER TABLE `learningoutcomes`
  ADD CONSTRAINT `learningoutcomes_ibfk_1` FOREIGN KEY (`ID_LearningOutcomeCategories`) REFERENCES `learningoutcomecategories` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

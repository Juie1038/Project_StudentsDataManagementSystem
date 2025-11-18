SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` enum('Present','Absent') NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `attendance` (`id`, `student_id`, `status`, `date`) VALUES
(1, 1, 'Present', '2025-11-14'),
(2, 2, 'Present', '2025-11-14'),
(3, 3, 'Present', '2025-11-14'),
(4, 4, 'Present', '2025-11-14'),
(5, 1, 'Absent', '2025-11-16'),
(6, 2, 'Present', '2025-11-16'),
(7, 3, 'Present', '2025-11-16'),
(8, 4, 'Present', '2025-11-16'),
(9, 5, 'Present', '2025-11-16'),
(10, 6, 'Present', '2025-11-16'),
(11, 7, 'Present', '2025-11-16'),
(12, 8, 'Present', '2025-11-16'),
(13, 9, 'Present', '2025-11-16');

CREATE TABLE `class_routine` (
  `id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `Course` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `class_routine` (`id`, `day`, `time`, `Course`) VALUES
(1, 'Saturday', '10:00-11:00', 'AI'),
(2, 'Sunday', '08:00-10:00', 'CN');

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `courses` (`id`, `course_name`, `teacher_id`) VALUES
(1, 'DBMS', NULL),
(2, 'AI', NULL),
(3, 'Numerical', NULL),
(4, 'Computer Network', NULL),
(5, 'Computer Architecture', NULL),
(8, 'English  Communication', NULL),
(9, 'MAT', NULL);

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `exam_routine` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `exam_routine` (`id`, `subject`, `date`, `time`) VALUES
(1, 'CN', '2010-12-25', '10:00-11:00'),
(2, 'AI', '2023-12-25', '10:00-11:00'),
(3, 'nmu', '2025-12-07', '10:00-11:00');

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `notice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `notices` (`id`, `notice`) VALUES
(1, 'today will be off day becouse AWAMILIG is coming......................vagggggggggggggggggggoooooooooooo(:0)'),
(2, 'jamat day hahahaha'),
(3, 'Hasina apar fasir upolokkhe sokol students der biriyani dwa hbe');

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `method` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `trx_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `payments` (`id`, `student_id`, `month`, `amount`, `status`, `method`, `date`, `trx_id`) VALUES
(8, 1, 'january', 15000.00, 'Paid', 'Cash', '2025-02-12', '01');

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `Course` varchar(50) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `results` (`id`, `student_id`, `Course`, `marks`) VALUES
(3, 1, '', 78),
(4, 2, '', 34),
(5, 6, '', 88);

CREATE TABLE `retakes` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `Course` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `retakes` (`id`, `student_id`, `Course`) VALUES
(1, 1, ''),
(2, 5, ''),
(3, 6, ''),
(4, 2, 'Computer Architecture'),
(5, 2, ''),
(6, 6, 'AI'),
(7, 7, 'AI'),
(9, 9, 'English  Communication');

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `students` (`id`, `name`, `course`, `email`, `year`) VALUES
(1, 'juie', 'AI', '', '2025'),
(2, 'fatiha', 'Computer Architecture', 'fatha04@gmail.com', '2025'),
(3, 'fatiha', 'Computer Architecture', 'fatha04@gmail.com', '2025'),
(4, 'fatiha', 'Computer Architecture', 'fatha04@gmail.com', '2025'),
(5, 'jannat', 'Numerical', '', '2025'),
(6, 'Nyema Binte Azad ', 'AI', NULL, ''),
(7, 'mim', 'AI', NULL, ''),
(8, 'mim', 'Numerical', 'mim56@gmail.com', '2025'),
(9, 'idress', 'English  Communication', 'idress78@gmail.com', '2025'),
(10, 'tuli', 'MAT', NULL, ''),
(11, 'mili', 'NMA', NULL, ''),
(12, 'nimni', 'AI', NULL, '');

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `teachers` (`id`, `name`, `subject`, `email`) VALUES
(1, 'khan', 'AI', NULL),
(2, 'esty', 'CA', NULL),
(3, 'MURAD', 'DBMS', NULL);

ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

ALTER TABLE `class_routine`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

ALTER TABLE `exam_routine`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);


ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

ALTER TABLE `retakes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `class_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `exam_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `retakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;


ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL;


ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;


ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;


ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;


ALTER TABLE `retakes`
  ADD CONSTRAINT `retakes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;


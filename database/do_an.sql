-- -- phpMyAdmin SQL Dump
-- -- version 4.6.6deb5ubuntu0.5
-- -- https://www.phpmyadmin.net/
-- --
-- -- Máy chủ: localhost:3306
-- -- Thời gian đã tạo: Th9 30, 2021 lúc 01:41 AM
-- -- Phiên bản máy phục vụ: 5.7.35-0ubuntu0.18.04.2
-- -- Phiên bản PHP: 7.4.24

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET time_zone = "+00:00";


-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;

-- --
-- -- Cơ sở dữ liệu: `laravel`
-- --

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc bảng cho bảng `admin`
-- --

-- CREATE TABLE `admin` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Đang đổ dữ liệu cho bảng `admin`
-- --

-- INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
-- (1, 'Tran Van Duc', 'ductran0207.bkhn@gmail.com', '123', NULL, NULL);

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc bảng cho bảng `bill`
-- --

-- CREATE TABLE `bill` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `idStudent` int(10) UNSIGNED NOT NULL,
--   `idTypepay` int(11) NOT NULL,
--   `idAdmin` int(10) UNSIGNED NOT NULL,
--   `dateTime` date NOT NULL,
--   `money` double NOT NULL,
--   `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Đang đổ dữ liệu cho bảng `bill`
-- --

-- INSERT INTO `bill` (`id`, `idStudent`, `idTypepay`, `idAdmin`, `dateTime`, `money`, `note`, `created_at`, `updated_at`) VALUES
-- (1, 1, 1, 1, '2021-09-27', 2000000, 'Học phí 09-2021', '2021-09-27 15:29:49', '2021-09-27 15:29:49'),
-- (2, 1, 1, 1, '2021-09-28', 2000000, 'Học phí 09-2021', '2021-09-28 14:22:19', '2021-09-28 14:22:19');

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc bảng cho bảng `course`
-- --

-- CREATE TABLE `course` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Đang đổ dữ liệu cho bảng `course`
-- --

-- INSERT INTO `course` (`id`, `name`, `created_at`, `updated_at`) VALUES
-- (1, 'Lập trình máy tính', '2021-09-27 15:23:04', '2021-09-27 15:23:04'),
-- (2, 'Quản trị mạng', '2021-09-27 15:23:13', '2021-09-27 15:23:13'),
-- (3, 'Quản trị kinh doanh', '2021-09-28 14:43:15', '2021-09-28 14:43:15'),
-- (4, 'Thiết kế đồ họa', '2021-09-28 14:43:28', '2021-09-28 14:43:28');

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc đóng vai cho view `FULLNAME`
-- -- (See below for the actual view)
-- --
-- CREATE TABLE `FULLNAME` (
-- `idStudent` int(10) unsigned
-- ,`fullname` varchar(101)
-- );

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc đóng vai cho view `GENDER`
-- -- (See below for the actual view)
-- --
-- CREATE TABLE `GENDER` (
-- `id` int(10) unsigned
-- ,`gender` varchar(6)
-- );

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc bảng cho bảng `grade`
-- --

-- CREATE TABLE `grade` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `idMajor` int(10) UNSIGNED NOT NULL,
--   `idCourse` int(10) UNSIGNED NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Đang đổ dữ liệu cho bảng `grade`
-- --

-- INSERT INTO `grade` (`id`, `name`, `idMajor`, `idCourse`, `created_at`, `updated_at`) VALUES
-- (1, 'BKD01K11', 1, 1, '2021-09-27 15:23:42', '2021-09-27 15:23:42'),
-- (2, 'BKN01K11', 1, 2, '2021-09-27 15:23:51', '2021-09-27 15:23:51'),
-- (3, 'BKD01K9', 3, 1, '2021-09-28 14:45:01', '2021-09-28 14:45:10'),
-- (4, 'BKD02K11', 1, 1, '2021-09-28 14:45:29', '2021-09-28 14:45:29'),
-- (5, 'BKD03K11', 1, 1, '2021-09-28 14:45:38', '2021-09-28 14:45:38'),
-- (6, 'BKD04K11', 1, 1, '2021-09-28 14:45:55', '2021-09-28 14:45:55'),
-- (7, 'BKD05K11', 1, 1, '2021-09-28 15:52:51', '2021-09-28 15:52:51');

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc đóng vai cho view `LIST_TUITION`
-- -- (See below for the actual view)
-- --
-- CREATE TABLE `LIST_TUITION` (
-- `id` int(10) unsigned
-- ,`namegGade` varchar(50)
-- ,`nameCouse` varchar(50)
-- ,`tuitionNorm` double
-- );

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc bảng cho bảng `major`
-- --

-- CREATE TABLE `major` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `dayAdmission` date NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Đang đổ dữ liệu cho bảng `major`
-- --

-- INSERT INTO `major` (`id`, `name`, `dayAdmission`, `created_at`, `updated_at`) VALUES
-- (1, 'K11', '2019-08-15', '2021-09-27 15:22:47', '2021-09-27 15:22:47'),
-- (2, 'K10', '2018-08-15', '2021-09-28 14:21:08', '2021-09-28 14:21:08'),
-- (3, 'K9', '2017-08-15', '2021-09-28 14:41:04', '2021-09-28 14:41:04'),
-- (4, 'K12', '2020-08-28', '2021-09-28 14:42:11', '2021-09-28 14:42:11'),
-- (5, 'K13', '2021-08-15', '2021-09-28 14:42:23', '2021-09-28 14:42:23'),
-- (6, 'K8', '2017-08-15', '2021-09-28 14:42:53', '2021-09-28 14:42:53');

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc bảng cho bảng `migrations`
-- --

-- CREATE TABLE `migrations` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `batch` int(11) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Đang đổ dữ liệu cho bảng `migrations`
-- --

-- INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
-- (1, '2021_06_27_175850_admin', 1),
-- (2, '2021_06_27_180006_scholarship', 1),
-- (3, '2021_06_27_180126_course', 1),
-- (4, '2021_06_27_180144_major', 1),
-- (5, '2021_06_27_180240_typepay', 1),
-- (6, '2021_06_27_180338_tuition', 1),
-- (7, '2021_06_27_180400_grade', 1),
-- (8, '2021_06_27_180408_student', 1),
-- (9, '2021_06_27_180433_bill', 1);

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc bảng cho bảng `scholarship`
-- --

-- CREATE TABLE `scholarship` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `money` double NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Đang đổ dữ liệu cho bảng `scholarship`
-- --

-- INSERT INTO `scholarship` (`id`, `money`, `created_at`, `updated_at`) VALUES
-- (1, 10000000, '2021-09-27 15:23:20', '2021-09-27 15:23:20'),
-- (2, 6000000, '2021-09-28 14:44:09', '2021-09-28 14:44:09');

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc bảng cho bảng `student`
-- --

-- CREATE TABLE `student` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `gender` tinyint(1) NOT NULL,
--   `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `address` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `dob` date NOT NULL,
--   `idGrade` int(10) UNSIGNED NOT NULL,
--   `idScholarship` int(10) UNSIGNED NOT NULL,
--   `idTypePay` int(10) UNSIGNED NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Đang đổ dữ liệu cho bảng `student`
-- --

-- INSERT INTO `student` (`id`, `firstname`, `lastname`, `gender`, `email`, `phone`, `password`, `address`, `dob`, `idGrade`, `idScholarship`, `idTypePay`, `created_at`, `updated_at`) VALUES
-- (1, 'Tran Van', 'Duc', 1, 'ductran0207.bkhn@gmail.com', '0968845131', '$2y$10$uvn7wg4b0ZIqlWk4TaLUU.c.6n4OnEfkvmL534NYdazn26WIU7uR2', 'Số nhà 69, 96 Lĩnh Nam, Hà Nội', '1996-07-02', 1, 1, 1, '2021-09-27 15:25:02', '2021-09-27 15:25:02');

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc đóng vai cho view `STUDENT_BILL`
-- -- (See below for the actual view)
-- --
-- CREATE TABLE `STUDENT_BILL` (
-- `idS` int(10) unsigned
-- ,`firstname` varchar(50)
-- ,`lastname` varchar(50)
-- ,`email` varchar(50)
-- ,`dob` date
-- ,`nameGrade` varchar(50)
-- );

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc bảng cho bảng `tuition`
-- --

-- CREATE TABLE `tuition` (
--   `idMajor` int(10) UNSIGNED NOT NULL,
--   `idCourse` int(10) UNSIGNED NOT NULL,
--   `tuitionNorm` double NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Đang đổ dữ liệu cho bảng `tuition`
-- --

-- INSERT INTO `tuition` (`idMajor`, `idCourse`, `tuitionNorm`, `created_at`, `updated_at`) VALUES
-- (1, 1, 70000000, '2021-09-27 15:24:05', '2021-09-27 15:24:05');


-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc bảng cho bảng `typepay`
-- --

-- CREATE TABLE `typepay` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `typeofpay` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `discount` double(8,2) NOT NULL,
--   `begin` tinyint(4) NOT NULL,
--   `end` tinyint(4) NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Đang đổ dữ liệu cho bảng `typepay`
-- --

-- INSERT INTO `typepay` (`id`, `typeofpay`, `discount`, `begin`, `end`, `created_at`, `updated_at`) VALUES
-- (1, 'Months', 0.00, 1, 20, '2021-09-27 15:23:31', '2021-09-27 15:23:31'),
-- (2, 'Years', 5.00, 1, 20, '2021-09-28 14:44:39', '2021-09-28 14:44:39'),
-- (3, 'Semesters', 10.00, 1, 20, '2021-09-29 18:32:11', '2021-09-29 18:32:11');

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc cho view `FULLNAME`
-- --
-- DROP TABLE IF EXISTS `FULLNAME`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`admin`@`localhost` SQL SECURITY DEFINER VIEW `FULLNAME`  AS  select `student`.`id` AS `idStudent`,concat(`student`.`firstname`,' ',`student`.`lastname`) AS `fullname` from `student` ;

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc cho view `GENDER`
-- --
-- DROP TABLE IF EXISTS `GENDER`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`admin`@`localhost` SQL SECURITY DEFINER VIEW `GENDER`  AS  select `student`.`id` AS `id`,(case when (`student`.`gender` = 1) then 'Male' when (`student`.`gender` = 0) then 'Female' else 'Others' end) AS `gender` from `student` ;

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc cho view `LIST_TUITION`
-- --
-- DROP TABLE IF EXISTS `LIST_TUITION`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`admin`@`localhost` SQL SECURITY DEFINER VIEW `LIST_TUITION`  AS  select `grade`.`id` AS `id`,`grade`.`name` AS `namegGade`,`course`.`name` AS `nameCouse`,`tuition`.`tuitionNorm` AS `tuitionNorm` from ((`course` join `grade` on((`course`.`id` = `grade`.`idCourse`))) join `tuition` on((`course`.`id` = `tuition`.`idCourse`))) ;

-- -- --------------------------------------------------------

-- --
-- -- Cấu trúc cho view `STUDENT_BILL`
-- --
-- DROP TABLE IF EXISTS `STUDENT_BILL`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`admin`@`localhost` SQL SECURITY DEFINER VIEW `STUDENT_BILL`  AS  select `student`.`id` AS `idS`,`student`.`firstname` AS `firstname`,`student`.`lastname` AS `lastname`,`student`.`email` AS `email`,`student`.`dob` AS `dob`,`grade`.`name` AS `nameGrade` from (`student` join `grade` on((`student`.`idGrade` = `grade`.`id`))) ;

-- --
-- -- Chỉ mục cho các bảng đã đổ
-- --

-- --
-- -- Chỉ mục cho bảng `admin`
-- --
-- ALTER TABLE `admin`
--   ADD PRIMARY KEY (`id`),
--   ADD UNIQUE KEY `admin_email_unique` (`email`);

-- --
-- -- Chỉ mục cho bảng `bill`
-- --
-- ALTER TABLE `bill`
--   ADD PRIMARY KEY (`id`),
--   ADD KEY `bill_idstudent_foreign` (`idStudent`),
--   ADD KEY `bill_idadmin_foreign` (`idAdmin`);

-- --
-- -- Chỉ mục cho bảng `course`
-- --
-- ALTER TABLE `course`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Chỉ mục cho bảng `grade`
-- --
-- ALTER TABLE `grade`
--   ADD PRIMARY KEY (`id`),
--   ADD KEY `grade_idmajor_foreign` (`idMajor`),
--   ADD KEY `grade_idcourse_foreign` (`idCourse`);

-- --
-- -- Chỉ mục cho bảng `major`
-- --
-- ALTER TABLE `major`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Chỉ mục cho bảng `migrations`
-- --
-- ALTER TABLE `migrations`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Chỉ mục cho bảng `scholarship`
-- --
-- ALTER TABLE `scholarship`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Chỉ mục cho bảng `student`
-- --
-- ALTER TABLE `student`
--   ADD PRIMARY KEY (`id`),
--   ADD UNIQUE KEY `student_email_unique` (`email`),
--   ADD UNIQUE KEY `student_phone_unique` (`phone`),
--   ADD KEY `student_idgrade_foreign` (`idGrade`),
--   ADD KEY `student_idscholarship_foreign` (`idScholarship`),
--   ADD KEY `student_idtypepay_foreign` (`idTypePay`);

-- --
-- -- Chỉ mục cho bảng `tuition`
-- --
-- ALTER TABLE `tuition`
--   ADD PRIMARY KEY (`idCourse`,`idMajor`),
--   ADD KEY `tuition_idmajor_foreign` (`idMajor`);

-- --
-- -- Chỉ mục cho bảng `typepay`
-- --
-- ALTER TABLE `typepay`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- AUTO_INCREMENT cho các bảng đã đổ
-- --

-- --
-- -- AUTO_INCREMENT cho bảng `admin`
-- --
-- ALTER TABLE `admin`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
-- --
-- -- AUTO_INCREMENT cho bảng `bill`
-- --
-- ALTER TABLE `bill`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
-- --
-- -- AUTO_INCREMENT cho bảng `course`
-- --
-- ALTER TABLE `course`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
-- --
-- -- AUTO_INCREMENT cho bảng `grade`
-- --
-- ALTER TABLE `grade`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
-- --
-- -- AUTO_INCREMENT cho bảng `major`
-- --
-- ALTER TABLE `major`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
-- --
-- -- AUTO_INCREMENT cho bảng `migrations`
-- --
-- ALTER TABLE `migrations`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
-- --
-- -- AUTO_INCREMENT cho bảng `scholarship`
-- --
-- ALTER TABLE `scholarship`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
-- --
-- -- AUTO_INCREMENT cho bảng `student`
-- --
-- ALTER TABLE `student`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
-- --
-- -- AUTO_INCREMENT cho bảng `typepay`
-- --
-- ALTER TABLE `typepay`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
-- --
-- -- Các ràng buộc cho các bảng đã đổ
-- --

-- --
-- -- Các ràng buộc cho bảng `bill`
-- --
-- ALTER TABLE `bill`
--   ADD CONSTRAINT `bill_idadmin_foreign` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`id`),
--   ADD CONSTRAINT `bill_idstudent_foreign` FOREIGN KEY (`idStudent`) REFERENCES `student` (`id`);

-- --
-- -- Các ràng buộc cho bảng `grade`
-- --
-- ALTER TABLE `grade`
--   ADD CONSTRAINT `grade_idcourse_foreign` FOREIGN KEY (`idCourse`) REFERENCES `course` (`id`),
--   ADD CONSTRAINT `grade_idmajor_foreign` FOREIGN KEY (`idMajor`) REFERENCES `major` (`id`);

-- --
-- -- Các ràng buộc cho bảng `student`
-- --
-- ALTER TABLE `student`
--   ADD CONSTRAINT `student_idgrade_foreign` FOREIGN KEY (`idGrade`) REFERENCES `grade` (`id`),
--   ADD CONSTRAINT `student_idscholarship_foreign` FOREIGN KEY (`idScholarship`) REFERENCES `scholarship` (`id`),
--   ADD CONSTRAINT `student_idtypepay_foreign` FOREIGN KEY (`idTypePay`) REFERENCES `typepay` (`id`);

-- --
-- -- Các ràng buộc cho bảng `tuition`
-- --
-- ALTER TABLE `tuition`
--   ADD CONSTRAINT `tuition_idcourse_foreign` FOREIGN KEY (`idCourse`) REFERENCES `course` (`id`),
--   ADD CONSTRAINT `tuition_idmajor_foreign` FOREIGN KEY (`idMajor`) REFERENCES `major` (`id`);

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

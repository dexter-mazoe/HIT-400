<?php
require'connectDB.php';

$name = $_POST['student'];
$attadance = $_POST['attadance'];
$course_work = $_POST['course_work'];
$course_name = $_POST['course_name'];

$sql = "INSERT INTO `students`(`student_name`, `course_name`, `course_mark`, `attendance`,`id`,`device_mode`) VALUES ('$name','$course_name','$course_work','$attadance',NULL,0)";
$results = $conn->query($sql);
header('Location:lectureadmin.php');
?>
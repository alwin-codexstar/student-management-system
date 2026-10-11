<?php if(session_status()===PHP_SESSION_NONE) session_start(); ?>
<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($pageTitle ?? 'Student Management System') ?></title>
<link rel="stylesheet" href="style.css"></head><body>
<header class="topbar"><div class="brand">Student Management System</div>
<nav><a href="index.php">Dashboard</a><a href="students.php">Students</a><a href="attendance.php">Attendance</a><a href="marks.php">Marks</a></nav>
</header><main class="container">
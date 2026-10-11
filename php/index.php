<?php
require 'config.php'; $pageTitle='Dashboard';
$totalStudents=(int)$pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
$totalCourses=(int)$pdo->query("SELECT COUNT(DISTINCT course) FROM students")->fetchColumn();
$totalMarks=(int)$pdo->query("SELECT COUNT(*) FROM marks")->fetchColumn();
$presentToday=(int)$pdo->query("SELECT COUNT(*) FROM attendance WHERE attendance_date=CURDATE() AND status='Present'")->fetchColumn();
$recent=$pdo->query("SELECT * FROM students ORDER BY created_at DESC LIMIT 5")->fetchAll();
require 'header.php'; ?>
<h1>Dashboard</h1><p class="muted">Manage students, attendance and academic marks.</p>
<div class="cards">
<div class="card"><span>Total Students</span><strong><?= $totalStudents ?></strong></div>
<div class="card"><span>Courses</span><strong><?= $totalCourses ?></strong></div>
<div class="card"><span>Mark Records</span><strong><?= $totalMarks ?></strong></div>
<div class="card"><span>Present Today</span><strong><?= $presentToday ?></strong></div></div>
<div class="panel"><h2>Recently Added Students</h2><table>
<tr><th>Code</th><th>Name</th><th>Course</th><th>Year</th></tr>
<?php foreach($recent as $s): ?><tr>
<td><?= htmlspecialchars($s['student_code']) ?></td><td><?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></td>
<td><?= htmlspecialchars($s['course']) ?></td><td><?= (int)$s['year_level'] ?></td></tr><?php endforeach; ?>
</table></div><?php require 'footer.php'; ?>
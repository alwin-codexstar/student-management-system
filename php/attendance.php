<?php
require 'config.php'; $pageTitle='Attendance';
if($_SERVER['REQUEST_METHOD']==='POST'){$pdo->prepare("INSERT INTO attendance(student_id,attendance_date,status) VALUES(?,?,?) ON DUPLICATE KEY UPDATE status=VALUES(status)")->execute([(int)$_POST['student_id'],$_POST['attendance_date'],$_POST['status']]);}
$students=$pdo->query("SELECT id,student_code,first_name,last_name FROM students ORDER BY first_name")->fetchAll();
$date=$_GET['date']??date('Y-m-d'); $st=$pdo->prepare("SELECT a.*,s.student_code,s.first_name,s.last_name FROM attendance a JOIN students s ON s.id=a.student_id WHERE a.attendance_date=? ORDER BY s.first_name");$st->execute([$date]);$rows=$st->fetchAll();require 'header.php';?>
<h1>Attendance</h1><div class="panel"><form method="post" class="form-grid">
<label>Student<select name="student_id" required><?php foreach($students as $s): ?><option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['student_code'].' - '.$s['first_name'].' '.$s['last_name']) ?></option><?php endforeach; ?></select></label>
<label>Date<input type="date" name="attendance_date" value="<?= htmlspecialchars($date) ?>" required></label>
<label>Status<select name="status"><option>Present</option><option>Absent</option><option>Late</option></select></label><div><button>Save Attendance</button></div></form></div>
<div class="panel"><h2>Attendance Records</h2><table><tr><th>Code</th><th>Student</th><th>Date</th><th>Status</th></tr>
<?php foreach($rows as $r): ?><tr><td><?= htmlspecialchars($r['student_code']) ?></td><td><?= htmlspecialchars($r['first_name'].' '.$r['last_name']) ?></td><td><?= htmlspecialchars($r['attendance_date']) ?></td><td><span class="badge"><?= htmlspecialchars($r['status']) ?></span></td></tr><?php endforeach; ?></table></div>
<?php require 'footer.php'; ?>

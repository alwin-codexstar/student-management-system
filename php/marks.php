<?php
require 'config.php'; $pageTitle='Marks';
if($_SERVER['REQUEST_METHOD']==='POST'){$pdo->prepare("INSERT INTO marks(student_id,subject,marks,max_marks) VALUES(?,?,?,?)")->execute([(int)$_POST['student_id'],trim($_POST['subject']),(float)$_POST['marks'],(float)$_POST['max_marks']]);}
$students=$pdo->query("SELECT id,student_code,first_name,last_name FROM students ORDER BY first_name")->fetchAll();
$rows=$pdo->query("SELECT m.*,s.student_code,s.first_name,s.last_name,(m.marks/m.max_marks)*100 percentage FROM marks m JOIN students s ON s.id=m.student_id ORDER BY m.id DESC")->fetchAll();require 'header.php';?>
<h1>Academic Marks</h1><div class="panel"><form method="post" class="form-grid">
<label>Student<select name="student_id" required><?php foreach($students as $s): ?><option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['student_code'].' - '.$s['first_name'].' '.$s['last_name']) ?></option><?php endforeach; ?></select></label>
<label>Subject<input required name="subject"></label><label>Marks<input required type="number" step="0.01" min="0" name="marks"></label>
<label>Maximum Marks<input required type="number" step="0.01" min="1" name="max_marks" value="100"></label><div><button>Save Marks</button></div></form></div>
<div class="panel"><table><tr><th>Student</th><th>Subject</th><th>Marks</th><th>Percentage</th></tr>
<?php foreach($rows as $r): ?><tr><td><?= htmlspecialchars($r['student_code'].' - '.$r['first_name'].' '.$r['last_name']) ?></td><td><?= htmlspecialchars($r['subject']) ?></td><td><?= $r['marks'].' / '.$r['max_marks'] ?></td><td><?= number_format($r['percentage'],2) ?>%</td></tr><?php endforeach; ?></table></div>
<?php require 'footer.php'; ?>
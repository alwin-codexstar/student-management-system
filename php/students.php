<?php
require 'config.php'; $pageTitle='Students'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $action=$_POST['action']??'';
 if($action==='delete'){
   $pdo->prepare("DELETE FROM students WHERE id=?")->execute([(int)$_POST['id']]);
 } elseif($action==='save'){
   $id=(int)($_POST['id']??0);
   $data=[trim($_POST['student_code']),trim($_POST['first_name']),trim($_POST['last_name']),trim($_POST['email']),
   trim($_POST['phone']),trim($_POST['course']),trim($_POST['department']),(int)$_POST['year_level'],
   $_POST['date_of_birth']?:null,trim($_POST['gender']),trim($_POST['address'])];
   try{
    if($id){$sql="UPDATE students SET student_code=?,first_name=?,last_name=?,email=?,phone=?,course=?,department=?,year_level=?,date_of_birth=?,gender=?,address=? WHERE id=?";$data[]=$id;}
    else{$sql="INSERT INTO students(student_code,first_name,last_name,email,phone,course,department,year_level,date_of_birth,gender,address) VALUES(?,?,?,?,?,?,?,?,?,?,?)";}
    $pdo->prepare($sql)->execute($data);
   }catch(PDOException $e){$error='Could not save student. Student code or email may already exist.';}
 }
}
$edit=null;
if(isset($_GET['edit'])){$st=$pdo->prepare("SELECT * FROM students WHERE id=?");$st->execute([(int)$_GET['edit']]);$edit=$st->fetch();}
$q=trim($_GET['q']??'');
if($q!==''){$st=$pdo->prepare("SELECT * FROM students WHERE student_code LIKE ? OR first_name LIKE ? OR last_name LIKE ? OR email LIKE ? ORDER BY id DESC");$like="%$q%";$st->execute([$like,$like,$like,$like]);$students=$st->fetchAll();}
else{$students=$pdo->query("SELECT * FROM students ORDER BY id DESC")->fetchAll();}
require 'header.php'; ?>
<h1>Students</h1><?php if($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<div class="panel"><h2><?= $edit?'Edit Student':'Add Student' ?></h2>
<form method="post" class="form-grid"><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int)($edit['id']??0) ?>">
<label>Student Code<input required name="student_code" value="<?= htmlspecialchars($edit['student_code']??'') ?>"></label>
<label>First Name<input required name="first_name" value="<?= htmlspecialchars($edit['first_name']??'') ?>"></label>
<label>Last Name<input required name="last_name" value="<?= htmlspecialchars($edit['last_name']??'') ?>"></label>
<label>Email<input required type="email" name="email" value="<?= htmlspecialchars($edit['email']??'') ?>"></label>
<label>Phone<input name="phone" value="<?= htmlspecialchars($edit['phone']??'') ?>"></label>
<label>Course<input required name="course" value="<?= htmlspecialchars($edit['course']??'') ?>"></label>
<label>Department<input name="department" value="<?= htmlspecialchars($edit['department']??'') ?>"></label>
<label>Year<input required type="number" min="1" max="10" name="year_level" value="<?= (int)($edit['year_level']??1) ?>"></label>
<label>Date of Birth<input type="date" name="date_of_birth" value="<?= htmlspecialchars($edit['date_of_birth']??'') ?>"></label>
<label>Gender<select name="gender"><option value="">Select</option><?php foreach(['Male','Female','Other'] as $g): ?><option <?= (($edit['gender']??'')===$g?'selected':'') ?>><?= $g ?></option><?php endforeach; ?></select></label>
<label class="wide">Address<textarea name="address"><?= htmlspecialchars($edit['address']??'') ?></textarea></label>
<div class="wide"><button><?= $edit?'Update Student':'Add Student' ?></button><?php if($edit): ?> <a class="button secondary" href="students.php">Cancel</a><?php endif; ?></div>
</form></div>
<div class="panel"><form class="search"><input name="q" placeholder="Search students..." value="<?= htmlspecialchars($q) ?>"><button>Search</button><a class="button secondary" href="students.php">Reset</a></form>
<table><tr><th>Code</th><th>Name</th><th>Email</th><th>Course</th><th>Year</th><th>Actions</th></tr>
<?php foreach($students as $s): ?><tr><td><?= htmlspecialchars($s['student_code']) ?></td><td><?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></td>
<td><?= htmlspecialchars($s['email']) ?></td><td><?= htmlspecialchars($s['course']) ?></td><td><?= (int)$s['year_level'] ?></td><td>
<a href="?edit=<?= (int)$s['id'] ?>">Edit</a>
<form method="post" class="inline" onsubmit="return confirm('Delete this student?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$s['id'] ?>"><button class="danger">Delete</button></form>
</td></tr><?php endforeach; ?></table></div><?php require 'footer.php'; ?>
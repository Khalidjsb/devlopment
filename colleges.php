<?php
// التأكد من أنك قد قمت بتأسيس الاتصال بقاعدة البيانات بالفعل
include "connn.php";

// دالة للتحقق مما إذا كانت الجدول فارغة
function isTableEmpty($conn) {
    $result = mysqli_query($conn, "SELECT COUNT(*) FROM university");
    $row = mysqli_fetch_array($result);
    return $row[0] == 0;
}

// التحقق مما إذا تم تقديم النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استرجاع بيانات النموذج
    $universityName = $_POST['universityName'];
    $collegeName = $_POST['collegeName'];
    $body = $_POST['body'];
    $degree = $_POST['degree'];
    $program = $_POST['program'];
    $courseNumber = $_POST['courseNumber'];
    $courseCode = $_POST['courseCode'];
    $courseName = $_POST['courseName'];
    $sectionNumber = $_POST['sectionNumber'];
    // إضافة المزيد من الحقول حسب الحاجة

    // إدراج البيانات في جدول MySQL
    $sql = "INSERT INTO university (university_name, college_name, body, degree, program, course_number, course_code, course_name, section_number) VALUES ('$universityName', '$collegeName', '$body', '$degree', '$program', '$courseNumber', '$courseCode', '$courseName', '$sectionNumber')";
    // تنفيذ استعلام SQL
    if (mysqli_query($conn, $sql)) {
        // تم إدخال البيانات بنجاح
        echo "تمت إضافة البيانات بنجاح.";
    } else {
        // حدث خطأ
        echo "خطأ: " . $sql . "<br>" . mysqli_error($conn);
    }
}


include "connn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['update'])) {
    $universityName = $_POST['universityName'];
    $collegeName = $_POST['collegeName'];
    $body = $_POST['body'];
    $degree = $_POST['degree'];
    $program = $_POST['program'];
    $courseNumber = $_POST['courseNumber'];
    $courseCode = $_POST['courseCode'];
    $courseName = $_POST['courseName'];
    $sectionNumber = $_POST['sectionNumber'];
    $idu=$_POST['update'];
    $sql = "UPDATE university SET university_name = '$universityName', college_name = '$collegeName', body = '$body', degree = '$degree', program = '$program', course_number = '$courseNumber', course_code = '$courseCode', course_name = '$courseName', section_number = '$sectionNumber' WHERE id_university  ='$idu'"; 
    if (mysqli_query($conn, $sql)) {
        echo "تم تحديث البيانات بنجاح.";
    } else {
        echo "خطأ: " . $sql . "<br>" . mysqli_error($conn);
    }
}




$isEmpty = isTableEmpty($conn);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>info   </title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
  .form-group {
    display: flex;
    flex-direction: row;
    align-items: center;
  }

  .form-group label {
    width: 150px;
    margin-right: 10px;
    text-align: right;
  }

  .form-group input[type="text"],
  .form-group input[type="number"] {
    flex: 1;
  }
</style>

</head>
<body dir="rtl">
  <?php include "header.php";?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
    <h2>  بيانات
        الجامعه
        </h2>
      <?php if ($isEmpty): ?>
        <h2>إضافة بيانات</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <label for="universityName">اسم الجامعة:</label>
            <input type="text" class="form-control" id="universityName" name="universityName">
          </div>
          <div class="form-group">
            <label for="collegeName">اسم الكلية:</label>
            <input type="text" class="form-control" id="collegeName" name="collegeName">
          </div>
          <div class="form-group">
            <label for="body">معلومات عن الجامعة:</label>
            <input type="text" class="form-control" id="body" name="body">
          </div>
          <div class="form-group">
            <label for="degree">الدرجة:</label>
            <input type="text" class="form-control" id="degree" name="degree">
          </div>
          <div class="form-group">
            <label for="program">البرنامج:</label>
            <input type="text" class="form-control" id="program" name="program">
          </div>
          <div class="form-group">
            <label for="courseNumber">رقم المقرر:</label>
            <input type="text" class="form-control" id="courseNumber" name="courseNumber">
          </div>
          <div class="form-group">
            <label for="courseCode">رمز المجرر:</label>
            <input type="text" class="form-control" id="courseCode" name="courseCode">
          </div>
          <div class="form-group">
            <label for="courseName">اسم المقرر:</label>
            <input type="text" class="form-control" id="courseName" name="courseName">
          </div>
          <div class="form-group">
            <label for="sectionNumber">رقم الشعبة:</label>
            <input type="text" class="form-control" id="sectionNumber" name="sectionNumber">
          </div>
          <!-- إضافة المزيد من الحقول حسب الحاجة -->
          <button type="submit" class="btn btn-primary">اضافه</button>
        </form>
      <?php else: ?>
        <h2>تحرير البيانات</h2>
        <?php
        // استرجاع البيانات من الجدول
        $query = mysqli_query($conn, "SELECT * FROM university LIMIT 1"); // يفترض أنك تحتاج فقط إلى صف واحد لملء النموذج
        $data = mysqli_fetch_assoc($query);
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <label for="universityName">اسم الجامعة:</label>
            <input type="text" class="form-control" id="universityName" name="universityName" value="<?php echo $data['university_name']; ?>">
          </div>
          <div class="form-group">
            <label for="collegeName">اسم الكلية:</label>
            <input type="text" class="form-control" id="collegeName" name="collegeName" value="<?php echo $data['college_name']; ?>">
          </div>
          <div class="form-group">
            <label for="body">معلومات عن الجامعة:</label>
            <input type="text" class="form-control" id="body" name="body" value="<?php echo $data['body']; ?>">
          </div>
          <div class="form-group">
            <label for="degree">الدرجة:</label>
            <input type="text" class="form-control" id="degree" name="degree" value="<?php echo $data['degree']; ?>">
          </div>
          <div class="form-group">
            <label for="program">البرنامج:</label>
            <input type="text" class="form-control" id="program" name="program" value="<?php echo $data['program']; ?>">
          </div>
          <div class="form-group">
            <label for="courseNumber">رقم المقرر:</label>
            <input type="text" class="form-control" id="courseNumber" name="courseNumber" value="<?php echo $data['course_number']; ?>">
          </div>
          <div class="form-group">
            <label for="courseCode">رمز المجرر:</label>
            <input type="text" class="form-control" id="courseCode" name="courseCode" value="<?php echo $data['course_code']; ?>">
          </div>
          <div class="form-group">
            <label for="courseName">اسم المقرر:</label>
            <input type="text" class="form-control" id="courseName" name="courseName" value="<?php echo $data['course_name']; ?>">
          </div>
          <div class="form-group">
            <label for="sectionNumber">رقم الشعبة:</label>
            <input type="text" class="form-control" id="sectionNumber" name="sectionNumber" value="<?php echo $data['section_number']; ?>">
          </div>
          <!-- إضافة المزيد من الحقول حسب الحاجة -->
          <button type="submit" name="update" class="btn btn-primary" value="<?php echo $data['id_university']; ?>">تحديث</button>
        </form>
      <?php endif; ?>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
<!-- Bootstrap JS (optional, for certain Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

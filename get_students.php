<?php
include "connn.php";

// إذا تم إرسال طلب POST لتحديث حالة الطالب
if(isset($_POST['update_state'])) {
    $student_id = $_POST['student_id'];
    $new_state = $_POST['new_state'];
    include "connn.php";

    $update_query = "UPDATE students SET state='$new_state' WHERE StudentID='$student_id'";
    $conn->query($update_query);
}

$sql = "SELECT * FROM Students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بيانات الطلاب</title>
</head>
<body>

<h2>بيانات الطلاب</h2>

<table border="1">
    <tr>
        <th>رقم الطالب</th>
        <th>اسم الطالب</th>
        <th>الحالة</th>
        <th></th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["StudentID"] . "</td>";
            echo "<td>" . $row["StudentName"] . "</td>";
            echo "<td>";
            // اذا كانت حالة الطالب غير معرفة
            if (empty($row['state'])) {
                ?><form method='post' action=''>
            <select name='new_state'>
            <option value='نشط'>نشط</option>
            <option value='محروم'>محروم</option>
            </select>
            <input type='hidden' name='student_id' value="<?php echo $row['StudentID']?>">
            <input type='submit' name='update_state' value='تحديث'>
            </form><?php
            } else {
                echo $row['state'];
            }
            echo "</td>";
            // فقط اذا كانت حالة الطالب محددة وليست محروم
            if(isset($row['state']) && $row["state"] != "محروم") {
                // رابط لإضافة الدرجات
                echo "<td><a href='add_grade.php?ids=" . $row['StudentID'] . "'>اضافة درجات</a></td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>لا توجد بيانات</td></tr>";
    }
    ?>
</table>

</body>
</html>

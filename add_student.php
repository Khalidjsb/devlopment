<?php
include "connn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // التحقق من أن الاسم تم إرساله بشكل صحيح
    if(isset($_POST['studentName'])) {
        // قم بتخزين الاسم المدخل من النموذج
        $studentName = $_POST['studentName'];
        $stat = $_POST['stat'];

        // إضافة الطالب إلى قاعدة البيانات
        $sql = "INSERT INTO Students (StudentName,state) VALUES ('$studentName','$stat')";

        if ($conn->query($sql) === TRUE) {
            echo "تمت إضافة الطالب بنجاح";
        } else {
            echo "حدث خطأ أثناء إضافة الطالب: " . $conn->error;
        }
    } else {
        echo"";
    }
}
?>
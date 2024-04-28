<?php
include "connn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['learningOutcomeID']) && isset($_POST['grade'])) {
        $learningOutcomeID = $_POST['learningOutcomeID'];
        $grade = $_POST['grade'];

        // إضافة الدرجة إلى قاعدة البيانات
        $sql = "INSERT INTO grade (IDLearningOut, Grade) VALUES ('$learningOutcomeID', '$grade')";

        if ($conn->query($sql) === TRUE) {
            // إذا تمت عملية الإضافة بنجاح، استعد الدرجات المحدثة
            $sql_get_grades = "SELECT * FROM grade WHERE IDLearningOut = '$learningOutcomeID'";
            $result = $conn->query($sql_get_grades);
            $grades = array();
            while ($row = $result->fetch_assoc()) {
                $grades[] = $row['Grade'];
            }
            echo json_encode($grades); // إرجاع الدرجات المحدثة بتنسيق JSON
        } else {
            echo "حدث خطأ أثناء إضافة الدرجة: " . $conn->error;
        }
    } else {
        echo "";
    }
}
?>

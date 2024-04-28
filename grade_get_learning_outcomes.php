<?php
include "connn.php"; // يرجى تغيير اسم الملف إلى اسم ملف الاتصال الخاص بك

// استعلام لاسترداد بيانات الدرجات والأنشطة التقييمية
$sql = "SELECT g.id_gr, g.IDLearningOut, g.StudentID, g.Grade, la.Percentage, aa.ActivityName 
        FROM grade g 
        INNER JOIN learningoutcomeassessment la ON g.IDLearningOut = la.LearningOutcomeID 
        INNER JOIN assessmentactivities aa ON la.AssessmentActivityID = aa.AssessmentActivityID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // بداية جدول HTML
    $output = "<table border='1'>
                <tr>
                    <th>رقم الطالب</th>
                    <th>اسم الطالب</th>
                    <th>الدرجة</th>
                    <th>نسبة الدرجة</th>
                    <th>نشاط التقييم</th>
                </tr>";
    // استرداد البيانات وإضافتها إلى الجدول
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>
                        <td>" . $row['StudentID'] . "</td>
                        <td>" . $row['IDLearningOut'] . "</td>
                        <td>" . $row['Grade'] . "</td>
                        <td>" . $row['Percentage'] . "</td>
                        <td>" . $row['ActivityName'] . "</td>
                    </tr>";
    }
    // نهاية الجدول
    $output .= "</table>";

    // عرض الجدول المنشأ في الصفحة
    echo $output;
} else {
    echo "0 results";
}
?>

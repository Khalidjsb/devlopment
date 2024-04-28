<?php
include "connn.php";
// استرجاع البيانات وعرضها بعد الإدراج
$sql = "SELECT LearningOutcomeAssessment.*, 
        assessmentActivities.PercentageOfTotalGrade 
        FROM LearningOutcomeAssessment 
        INNER JOIN assessmentActivities 
        ON LearningOutcomeAssessment.AssessmentActivityID = assessmentActivities.AssessmentActivityID 
        ORDER BY LearningOutcomeAssessment.LearningOutcomeID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $currentLearningOutcome = null;
    while ($row = $result->fetch_assoc()) {
        if ($row['LearningOutcomeID'] != $currentLearningOutcome) {
            // إذا كانت هذه هي أول مرة تصادف هذا المعرف، قم بطباعته
            echo "<h6> مخرج التعلم للمقرر: " . $row['LearningOutcomeID'] . "</h6>";
            echo "<table class='table table-striped'>";
            echo "<thead><tr>
                <th style='text-align: right;'>معرف نشاط التقييم</th>
                <th style='text-align: right;'>النسبة من اجمالي درجة التقييم</th>
                <th style='text-align: right;'>النسبة المتبقية</th>
                <th></th>
                </tr></thead>";
            echo "<tbody>";
            $currentLearningOutcome = $row['LearningOutcomeID'];
        }
        
        // استعلام للحصول على النسبة المتبقية لنشاط التقييم
        $sql_remaining_percentage = "SELECT (PercentageOfTotalGrade - SUM(Percentage)) AS remaining_percentage 
                                    FROM LearningOutcomeAssessment 
                                    WHERE AssessmentActivityID = " . $row['AssessmentActivityID'];
        $result_remaining_percentage = $conn->query($sql_remaining_percentage);
        $remaining_percentage = 0;
        if ($result_remaining_percentage->num_rows > 0) {
            $row_remaining_percentage = $result_remaining_percentage->fetch_assoc();
            $remaining_percentage = $row_remaining_percentage['remaining_percentage'];
        }

        echo "<tr>
            <td style='text-align: right;'>" . $row["AssessmentActivityID"] . "</td>
            <td style='text-align: right;'>" . $row["Percentage"] . "%</td>
            <td style='text-align: right;'>" . $remaining_percentage . "%</td>
            <td>
            <button class='btn btn-danger btn-delete' data-id='" . $row["ID"] . "'>حذف</button></td>
            </tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<div class='alert alert-warning' style='text-align: right;'>لا توجد بيانات عن تقييم نتائج التعلم.</div>";
}
?>

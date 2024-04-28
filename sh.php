


<?php
include "connn.php";
// استرجاع البيانات وعرضها بعد الإدراج
$sql = "SELECT * FROM LearningOutcomeAssessment";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h4> مخرجات التعلم للمقرر مع أنشطة التقييم </h4>";
    $sqlh = "SELECT * , SUM(Percentage) AS totl FROM learningoutcomeassessment ";
    $resulth = $conn->query($sqlh);
    while ($rowe = $resulth->fetch_assoc()) {
        echo "<td style='text-align: right;'> المجموع( " . $rowe["totl"] ."% )</td>";
    }
    
    echo "                 <table class='table table-striped'>";
    echo "<thead><tr>
        <th style='text-align: right;'>id </th>
        <th style='text-align: right;'>مخرج التعلم للمقرر</th>
        <th style='text-align: right;'>معرف نشاط التقييم</th>
        <th style='text-align: right;'>النسبة من اجمالي درجة التقييم</th>
        <th style='text-align: right;'>النسبة المتبقية</th>
        <th></th>
        </tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        $sql_remaining_percentage = "SELECT (SELECT PercentageOfTotalGrade FROM assessmentActivities WHERE AssessmentActivityID = LearningOutcomeAssessment.AssessmentActivityID) - SUM(Percentage) AS remaining_percentage FROM LearningOutcomeAssessment WHERE AssessmentActivityID = " . $row['AssessmentActivityID'];
        $result_remaining_percentage = $conn->query($sql_remaining_percentage);
        $remaining_percentage = 0;
        if ($result_remaining_percentage->num_rows > 0) {
            $row_remaining_percentage = $result_remaining_percentage->fetch_assoc();
            $remaining_percentage = $row_remaining_percentage['remaining_percentage'];
        }
        echo "<tr>
            <td style='text-align: right;' class='table'>" . $row["ID"] . "</td>";

        $sqlg = "SELECT * FROM learningOutcomes  where LearningOutcomeID=$row[LearningOutcomeID] ";
        $resulth = $conn->query($sqlg);
        while($robw = $resulth->fetch_assoc()) {
            $sqlt = "SELECT ID, Name FROM learningoutcomecategories where ID= $robw[ID_LearningOutcomeCategories] ";
            $resultt = $conn->query($sqlt);
            while($rowt = $resultt->fetch_assoc()) {
                echo "  <td style='text-align: right;'>" .$rowt["Name"]  . "</td>";
                $sqlmm = "SELECT * FROM AssessmentActivities where AssessmentActivityID =$row[AssessmentActivityID]";
                $resultm = $conn->query($sqlmm);
                while($rowm = $resultm->fetch_assoc()) {
                    echo "
                    <td style='text-align: right;'>" .$rowm['ActivityName']."</td>
                    <td style='text-align: right;'>" . $row["Percentage"] ."% </td>
                    <td style='text-align: right;'>" . $remaining_percentage ."%</td>
                    <td>
                        <button class='btn btn-danger btn-delete' data-id='". $row['ID']."'>حذف</button>
                    </td>
                    </tr>";
                }
            }
        }
    }
    echo "</tbody>";
    echo "</table></div>";
} else {
    echo "<div class='alert alert-warning' style='text-align: right;'>لا توجد بيانات عن تقييم نتائج التعلم.</div>";
}
?>

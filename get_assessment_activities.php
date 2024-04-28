<?php
include"connn.php";

$sql = "SELECT * FROM assessmentActivities";
$result = $conn->query($sql);

$options = "<option value=''>اختر نشاط التقييم</option>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row["AssessmentActivityID"] . "'>" .$row["AssessmentActivityID"]."-". $row["ActivityName"]." - " .$row["PercentageOfTotalGrade"]. "%</option> ";
    }
}
echo $options;

// Close connection
$conn->close();
?>
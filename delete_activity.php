<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    include "connn.php";
    $activityId = $_POST["id"];
    $sql = "DELETE FROM AssessmentActivities WHERE AssessmentActivityID = $activityId";
    if ($conn->query($sql) === TRUE) {
        echo "Activity deleted successfully";
    } else {
        echo "Error deleting activity: " . $conn->error;
    }
    $conn->close();
} else {
    echo "No activity ID provided or invalid request method.";
}
?>

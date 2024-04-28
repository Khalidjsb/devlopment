<?php

// Check if request is AJAX
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Handle AJAX request
    $activityName = $_POST['activityName'];
    $percentage = $_POST['percentage'];

    // اتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learnoutput";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}


    // Check if adding this activity will exceed 100%
    $sql = "SELECT SUM(PercentageOfTotalGrade) AS totalPercentage FROM AssessmentActivities";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalPercentage = $row["totalPercentage"] + $percentage;
        if ($totalPercentage > 100 ||$percentage==0 ||$percentage <1) {
            echo "<script>alert('Cannot add activity. Total percentage exceeds 100% or 0');</script>";
        } else {
            // Insert activity into database
            $sql = "INSERT INTO AssessmentActivities (ActivityName, PercentageOfTotalGrade) VALUES ('$activityName', $percentage)";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Activity added successfully.</div>";
                // Retrieve updated data and display it
               
            } else {
                echo "<div class='alert alert-danger'>Error adding activity: " . $conn->error . "</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger'>Error: Unable to fetch total percentage.</div>";
    }

    $conn->close();
} else {
    // Redirect if accessed directly
    header("Location: index.html");
    exit();
}
?>

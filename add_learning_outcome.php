

<?php


include"connn.php";


if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  
    $category = $_POST['category'];
    $courseCode = $_POST['courseCode'];
    $targetLevel = $_POST['targetLevel'];
    $passingGrade = $_POST['passingGrade'];

    $sql = "INSERT INTO LearningOutcomes (ID_LearningOutcomeCategories, CourseCode, TargetLevel, PassingGrade) 
            VALUES ('$category', '$courseCode', '$targetLevel', '$passingGrade')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Learning outcome added successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding learning outcome: " . $conn->error . "</div>";
    }

    $conn->close();
} else {
    header("Location: index.html");
    exit();
}
?>

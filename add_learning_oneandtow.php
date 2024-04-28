<?php
include "connn.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $category = $_POST['category'];
    $assessmentActivity = $_POST['assessmentActivity'];
    $percentage = $_POST['percentage'];

    if ($percentage <= 0 || $percentage > 100) {
        echo "<div class='alert alert-danger'>الرجاء إدخال نسبة صحيحة (بين 1 و 100).</div>";
        exit();
    }

    // استلام البيانات المدخلة من النموذج
    $assessmentActivityID = $_POST['assessmentActivity'];
    $percentage = $_POST['percentage'];

    // استعلام للحصول على النسبة الإجمالية لنشاط التقييم المحدد
    $sql_total_percentage = "SELECT PercentageOfTotalGrade FROM assessmentActivities WHERE AssessmentActivityID = ?";
    $stmt_total_percentage = $conn->prepare($sql_total_percentage);
    $stmt_total_percentage->bind_param("i", $assessmentActivityID);
    $stmt_total_percentage->execute();
    $result_total_percentage = $stmt_total_percentage->get_result();

    if ($result_total_percentage->num_rows > 0) {
        $row_total_percentage = $result_total_percentage->fetch_assoc();
        $total_percentage_allowed = $row_total_percentage['PercentageOfTotalGrade'];

        $sql_current_percentage = "SELECT SUM(Percentage) AS current_percentage FROM LearningOutcomeAssessment WHERE AssessmentActivityID = ?";
        $stmt_current_percentage = $conn->prepare($sql_current_percentage);
        $stmt_current_percentage->bind_param("i", $assessmentActivityID);
        $stmt_current_percentage->execute();
        $result_current_percentage = $stmt_current_percentage->get_result();
        $current_percentage_row = $result_current_percentage->fetch_assoc();
        $current_percentage = $current_percentage_row['current_percentage'];

        if (($current_percentage + $percentage) > $total_percentage_allowed) {
            $exceed_message = "يتجاوز مجموع النسب المدخلة لهذا التقييم النسبة الإجمالية المسموح بها.";
            echo "<div class='error-message'>$exceed_message</div>";
        } else {
            $sql = "INSERT INTO learningOutcomeAssessment (LearningOutcomeID , AssessmentActivityID, Percentage) 
                    VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $category, $assessmentActivity, $percentage);
            
            if ($stmt->execute()) {
                $sql_remaining_percentage = "SELECT PercentageOfTotalGrade - (SELECT SUM(Percentage) FROM LearningOutcomeAssessment WHERE AssessmentActivityID = ?) AS remaining_percentage FROM assessmentActivities WHERE AssessmentActivityID = ?";
                $stmt_remaining_percentage = $conn->prepare($sql_remaining_percentage);
                $stmt_remaining_percentage->bind_param("ii", $assessmentActivityID, $assessmentActivityID);
                $stmt_remaining_percentage->execute();
                $result_remaining_percentage = $stmt_remaining_percentage->get_result();

                if ($result_remaining_percentage->num_rows > 0) {
                    $row_remaining_percentage = $result_remaining_percentage->fetch_assoc();
                    $remaining_percentage = $row_remaining_percentage['remaining_percentage'];
                    echo "<div class='alert alert-success'>تمت إضافة مخرج التعلم بنجاح. النسبة المتبقية: " . $remaining_percentage . "</div>";
                } else {
                    echo "<div class='alert alert-danger'>لم يتم العثور على النسبة المتبقية.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>حدث خطأ أثناء إضافة مخرج التعلم: " . $stmt->error . "</div>";
            }
        }
    } else {
        echo "لم يتم العثور على نشاط التقييم المحدد.";
    }

    // إغلاق الاتصال
    $conn->close();
}
?>

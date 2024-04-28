<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

include "connn.php";
    $sql = "SELECT * FROM learningOutcomes";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h2>نتائج التعلم</h2>";
        echo "<table class='table'>";
        echo "<tr><th>الفئة</th><th>رمز الدورة</th><th>المستوى المستهدف</th><th>الدرجة المطلوبة للنجاح</th></tr>";
        while($row = $result->fetch_assoc()) {
            
$sqlt = "SELECT ID, Name FROM learningoutcomecategories where ID= $row[ID_LearningOutcomeCategories] ";
$resultt = $conn->query($sqlt);

     while($rowt = $resultt->fetch_assoc()) {

            echo "<tr><td>" .    $rowt["Name"]. "</td><td>" . $row["CourseCode"] . "</td><td>" . $row["TargetLevel"] . "</td><td>" . $row["PassingGrade"] . "</td></tr>";
        }
        
    } 
        echo "</table>";
    } else {
        echo "لم يتم العثور على نتائج تعلم";
    }
    
}
?>

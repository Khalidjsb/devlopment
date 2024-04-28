<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learnoutput";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
$sql = "SELECT * FROM AssessmentActivities";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      //  echo "<h4></h4>";
        echo "<table class='table'>";
        echo "<thead><tr><th>انشطة التقييم</th><th>النسبة من اجمالي درجة المقرر</th><th></th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['ActivityName']} </td>
             <td>{$row['PercentageOfTotalGrade']}%</td><td>
               <button class='btn btn-danger btn-delete' data-id='" .$row["AssessmentActivityID"] . "'>حذف</button></td></tr>";

           // <button class='btn btn-danger btn-delete' data-id='" .{]}. "'>حذف</button></td></tr>";
        }
        }
        echo "</ul>";
    
    
    
$sqlt = "SELECT SUM(PercentageOfTotalGrade) AS TotalPercentage FROM AssessmentActivities";
$resultt = $conn->query($sqlt);

    $rowt = $resultt->fetch_assoc();
    $totalPercentage = $rowt["TotalPercentage"];
    if ($totalPercentage >= 100) {
        $color = 'red';
    } elseif ($totalPercentage < 100) {
        $color = 'green';
    }
    
    echo "<p style='color:$color;'>المجموع: %$totalPercentage</p>";

    



    $conn->close();?>
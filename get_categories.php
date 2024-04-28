<?php

include"connn.php";
$sql = "SELECT * FROM learningoutcomecategories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    
        echo "<option value='" . $row["ID"] . "'>"  .$row["ID"].' - '. $row["Name"] . "</option> ";
    
    }
} else {
    echo "<option value=''>No categories found</option>  ";


}

$conn->close();
?>
<input type='text' value='" . $row['PercentageOfTotalGrade'] ." readonly>
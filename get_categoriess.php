<?php

include "connn.php";

$sql = "SELECT * FROM learningoutcomes";
$result = $conn->query($sql);

$options = "<option value=''> مخرح التعلم</option>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $learningOutcomeID = $row["LearningOutcomeID"];
        $categoryID = $row["ID_LearningOutcomeCategories"];
        
        $sqlt = "SELECT ID, Name FROM learningoutcomecategories WHERE ID = $categoryID";
        $resultt = $conn->query($sqlt);

        if ($resultt->num_rows > 0) {
            while ($rowt = $resultt->fetch_assoc()) {
                $options .= "<option value='" . $learningOutcomeID . "'>" . $learningOutcomeID ."-". $rowt["Name"] . "</option>";
            }
        }
    }
}

echo $options;
$conn->close();
?>

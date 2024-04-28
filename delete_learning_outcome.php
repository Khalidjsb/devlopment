<?php
include "connn.php";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $sql = "DELETE FROM learningOutcomeAssessment WHERE ID = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    
    $conn->close();
}
?>

<?php
include "connn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $ids = $_POST["ids"];
    $grade = $_POST["grade"];

    $sql = "INSERT INTO grade (ID,StudentID, Grade) VALUES ('$id','$ids', '$grade')";
    if ($conn->query($sql) === TRUE) {
        echo $grade;
    }else{
        echo"";
    }
}
?>

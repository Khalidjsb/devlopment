<?php
// Check if file is uploaded successfully
if(isset($_FILES["excelFile"]) && $_FILES["excelFile"]["error"] == 0){
    $allowed_extensions = array("xls", "xlsx");
    $file_extension = pathinfo($_FILES["excelFile"]["name"], PATHINFO_EXTENSION);

    // Check file extension
    if(in_array($file_extension, $allowed_extensions)){
        $target_path = "uploads/" . basename($_FILES["excelFile"]["name"]);

        // Move uploaded file to uploads directory
        if(move_uploaded_file($_FILES["excelFile"]["tmp_name"], $target_path)){
            require 'vendor/autoload.php'; // Load the library here

            $spreadsheet = PhpOffice\PhpSpreadsheet\IOFactory::load($target_path);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestDataRow();

            include"connn.php";

            for ($row = 1; $row <= $highestRow; $row++){
                $studentID = $sheet->getCell('A'.$row)->getValue();
                $studentName = $sheet->getCell('B'.$row)->getValue();
                $studentGrade = $sheet->getCell('C'.$row)->getValue();
                $state = $sheet->getCell('D'.$row)->getValue();

                $sql = "INSERT INTO students (StudentID, StudentName, StudentGrade, State) 
                        VALUES ('$studentID', '$studentName', '$studentGrade', '$state')";

                if ($conn->query($sql) === TRUE) {
                    echo "Record inserted successfully!<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // Close database connection
            $conn->close();
        } else {
            echo "Error moving file to uploads directory!";
        }
    } else {
        echo "Invalid file format! Please upload an Excel file.";
    }
} else {
    echo "Error uploading file!";
}
?>

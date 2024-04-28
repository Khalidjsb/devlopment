<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بيانات الجامعة</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        .m {
            background-color: #20c997;
        }

        .btn-print {
            width: 100%;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-print:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        @media print {
            .btn-print,
            #bbtt {
                display: none;
            }
        }
    </style>
</head>
<body>
    <?php include "header.php";?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4">بيانات الجامعة</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>اسم الجامعة</th>
                                <th>اسم الكلية</th>
                                <th>معلومات عن الجامعة</th>
                                <th>الدرجة</th>
                                <th>البرنامج</th>
                                <th>رقم المقرر</th>
                                <th>رمز المقرر</th>
                                <th>اسم المقرر</th>
                                <th>رقم الشعبة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include "connn.php";
                                $query = mysqli_query($conn, "SELECT * FROM university LIMIT 1");
                                $data = mysqli_fetch_assoc($query);
                            ?>
                            <tr>
                                <td><?php echo $data['university_name']; ?></td>
                                <td><?php echo $data['college_name']; ?></td>
                                <td><?php echo $data['body']; ?></td>
                                <td><?php echo $data['degree']; ?></td>
                                <td><?php echo $data['program']; ?></td>
                                <td><?php echo $data['course_number']; ?></td>
                                <td><?php echo $data['course_code']; ?></td>
                                <td><?php echo $data['course_name']; ?></td>
                                <td><?php echo $data['section_number']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
        include "connn.php";
        $sql = "SELECT * FROM AssessmentActivities";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
    ?>
    <div class="container mt-5">
        <h4 align="center" class="mb-4">توزيع درجات أنشطة التقييم</h4> 
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div id="responseMessage" class="mt-3">
                    <?php
                        echo "<table class='table'>";
                        echo "<tbody>";
                        echo "<tr style='background-color: #007bff;color:white'>";
                        while ($rowm = mysqli_fetch_assoc($result)) {
                            echo "<td>{$rowm['ActivityName']}</td>"; 
                        }
                        echo "</tr>";
                        echo "<tr style='background-color:#28a745;'>";
                        $result->data_seek(0);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<td>{$row['PercentageOfTotalGrade']}%</td>"; 
                        } 
                        echo "</tr>";

                        $sqlt = "SELECT * FROM AssessmentActivities";
                        $resultt = $conn->query($sqlt);
                        while ($roww = mysqli_fetch_array($resultt)) {
                    ?>
                            <td>
                                <table class='table'>
                                    <?php 
                                        $saql = "SELECT * FROM LearningOutcomeAssessment where AssessmentActivityID= $roww[AssessmentActivityID]";
                                        $aresult = $conn->query($saql);
                                        while ($arow = $aresult->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td style='text-align: right;'><?php echo $arow["Percentage"]; ?>%</td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </td>
                    <?php 
                        }
                    ?>
                        </tr>
                    <?php
                        echo "</tbody>";
                        echo "</table>";
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <table class="table" dir="rtl">
                    <tr style="background-color: #007bff;color:white">
                        <th>coed</th>
                        <th>المخرج التعليمي للمقرر الدراسي</th>
                    </tr>
                    <?php
                        include "connn.php";
                        $sqlt = "SELECT ID, Name FROM learningoutcomecategories";
                        $resultt = $conn->query($sqlt);
                        while($rowt = $resultt->fetch_assoc()) {
                            echo "<tr class='m'><td>{$rowt['ID']}</td><td>{$rowt['Name']}</td></tr>";
                            $sql = "SELECT * FROM learningOutcomes where  ID_LearningOutcomeCategories= $rowt[ID] ";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row["LearningOutcomeID"]}</td>";
                                $sqltl = "SELECT ID, Name FROM learningoutcomecategories where ID= $row[ID_LearningOutcomeCategories] ";
                                $resulttl = $conn->query($sqltl);
                                while($rowtl = $resulttl->fetch_assoc()) {
                                    echo "<td>{$rowtl["Name"]}</td>";
                                }
                                echo "</tr>";
                            }
                        }
                    ?>
                </table>
                <div id="bbtt">
                    <a href="add_stusdents.php" class="btn btn-primary">ادارة الطلاب والدرجات</a><br><br>
                    <a href="dddd.php" class="btn btn-primary"> توزيع درجات أنشطة التقييم </a><br>
                </div><br>
                <button class="btn btn-primary btn-print" onClick="myf()">طباعة</button> 
                <script>
                    function myf(){
                        document.getElementById('btn_print').style.display="none";
                        document.getElementById('bbtt').style.display="none";
                        window.print();
                    }
                </script>
            </div>
        </div>
        <br><br><br><br><br>
    </div>
    <?php
        } else {
            echo "No data found";
        }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

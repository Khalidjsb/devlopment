<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>توزيع درجات أنشطة التقييم</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table tr td {
            border: 1px solid black;
        }
        .m {
            background-color: cadetblue;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <?php
    include "connn.php";

    // Query to fetch assessment activities
    $sql = "SELECT * FROM AssessmentActivities";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        ?>
        <h4 align="center" class="mb-4">توزيع درجات أنشطة التقييم</h4>
        <div class="row justify-content-center">
            <div class="col-md-4" style='padding: 0;'>
                <table border='1'>
                    <tbody>
                    <tr style='background-color: #12703d;color:white'>
                        <?php
                        // Display activity names
                        while ($rowm = mysqli_fetch_array($result)) {
                            echo "<td>{$rowm['ActivityName']}</td>";
                        }
                        ?>
                    </tr>
                    <tr style='background-color:#c9e059;'>
                        <?php
                        // Display percentages beneath activity names
                        $result->data_seek(0); // Reset pointer to fetch the data again from the beginning
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<td>{$row['PercentageOfTotalGrade']}%</td>";
                        }
                        ?>
                    </tr>
                    <?php
                    // Fetch percentages from LearningOutcomeAssessment table
                    $sqlt = "SELECT * FROM AssessmentActivities";
                    $resultt = $conn->query($sqlt);
                    while ($roww = mysqli_fetch_array($resultt)) {
                        ?>
                        <td>
                            <table>
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
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    } else {
        echo "<div class='alert alert-warning'>لا يوجد بيانات لعرضها</div>";
    }
    ?>

    <div class="row justify-content-center">
        <div class="col-md-4" style='padding: 0;'>
            <table dir="rtl" border="1">
                <tr style=' background-color: #12703d;'>
                    <th colspan="2">
                        <h4 style='padding: 25px; background-color: #12703d; color: white;margin-bottom: .0rem;margin: top 4px;'>انشطة التقييم</h4>
                    </th>
                </tr>
                <?php
                include "connn.php";
                $sqlt = "SELECT ID, Name FROM learningoutcomecategories";
                $resultt = $conn->query($sqlt);
                while ($rowt = $resultt->fetch_assoc()) {
                    echo "<tr class='m'><td>" . $rowt['ID'] . "</td><td>" . $rowt["Name"] . "</td></tr>";

                    $sql = "SELECT * FROM learningOutcomes where  ID_LearningOutcomeCategories= $rowt[ID] ";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["LearningOutcomeID"] . "</td>";

                        $sqltl = "SELECT ID, Name FROM learningoutcomecategories where ID= $row[ID_LearningOutcomeCategories] ";
                        $resulttl = $conn->query($sqltl);

                        while ($rowtl = $resulttl->fetch_assoc()) {
                            echo "<td>" . $rowtl["Name"] . "</td>";
                           
                        }
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>


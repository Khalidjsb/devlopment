<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Learning Outcome</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include"header.php";?>


<div class="container mt-5">
<h4 align="center" class="mb-4"> مخرجات التعلم للمقرر
    </h4> 

<div class="row justify-content-center">
<div class="col-md-2">
</div>
<div class="col-md-4">

<div id="responseMessage" class="mt-3"></div>
    <div id="learningOutcomes" class="mt-3"></div>
</div>
       
<div class="col-md-4">
            
    <form id="addLearningOutcomeForm">
        <div class="form-group">
            <label for="category">
          
            </label>
            <select class="form-control" id="category" name="category">
                <!-- Populate options with AJAX -->
            </select>
        </div>
        <div class="form-group">
            <label for="courseCode">      رمز الارتباط بمخرجات البرنامج</label>
            <input type="text" class="form-control" id="courseCode" name="courseCode">
        </div>
        <div class="form-group">
            <label for="targetLevel">المستوئ المستهدف :</label>
            <input type="number" class="form-control" id="targetLevel" name="targetLevel">
        </div>
        <div class="form-group">
            <label for="passingGrade"> درجات الاجتياز:</label>
            <input type="number" step="0.01" class="form-control" id="passingGrade" name="passingGrade">
        </div>
        <button type="submit" class="btn btn-primary">اضافة</button>
    </form>
</div>
       
<div class="col-md-2">
</div>
</div></div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    // Populate category select options when page loads
    $.ajax({
        type: 'GET',
        url: 'get_categories.php',
        success: function(response){
            $('#category').html(response);
        }
    });

    // Submit form via AJAX
    $('#addLearningOutcomeForm').submit(function(event){
        event.preventDefault();
        var targetLevel = parseInt($('#targetLevel').val());
        var passingGrade = parseInt($('#passingGrade').val());
        if (targetLevel <= passingGrade) {
            $('#responseMessage').html("<div class='alert alert-danger'>Target level must be higher than passing grade.</div>");
            return;
        }
        $.ajax({
            type: 'POST',
            url: 'add_learning_outcome.php',
            data: $(this).serialize(),
            success: function(response){
                $('#responseMessage').html(response);
                $('#addLearningOutcomeForm')[0].reset();
                loadLearningOutcomes();
            }
        });
    });

    // Function to load learning outcomes
    function loadLearningOutcomes() {
        $.ajax({
            type: 'GET',
            url: 'get_learning_outcomes.php',
            success: function(response){
                $('#learningOutcomes').html(response);
            }
        });
    }

    // Load learning outcomes when page loads
    loadLearningOutcomes();
});
</script>

</body>
</html>
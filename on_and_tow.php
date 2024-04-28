<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Learning Outcome</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>
        مخرجات التعلم للمقرر مع انشطة التقييم 
    </h2>
    <form id="addLearningOutcomeForm">
        <div class="form-group">
            <label for="category">مخرجات التعلم:</label>
            <select class="form-control" id="category" name="category">

        </select>
        </div>
        <div class="form-group">
            <label for="assessmentActivity"> التقييم:</label>
            <select class="form-control" id="assessmentActivity" name="assessmentActivity">
                <!-- Options will be populated dynamically using AJAX -->
            </select>
        </div>
        <div class="form-group">
            <label for="percentage">Percentage of Total Grade:</label>
            <input type="number" class="form-control" id="percentage" name="percentage">
        </div>
        <button type="submit" class="btn btn-primary">Add Learning Outcome</button>
    </form>
    <div id="sh" class="mt-3"></div>
<div id="responseMessage"></div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    // Populate category dropdown
    $.ajax({
        type: 'GET',
        url: 'get_categorieadd_grade.php',
        success: function(response){
            $('#category').html(response);
        }
    });

    // Populate assessment activity dropdown
    $.ajax({
        type: 'GET',
        url: 'get_assessment_activities.php',
        success: function(response){
            $('#assessmentActivity').html(response);
        }
    });

    // Submit form
    $('#addLearningOutcomeForm').submit(function(event){
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'add_learning_oneandtow.php',
            data: $(this).serialize(),
            success: function(response){
                $('#responseMessage').html(response);
                // Load learning outcomes after adding a new one
                loadLearningOutcomes();
            }
        });
    });

    function loadLearningOutcomes() {
        $.ajax({
            type: 'GET',
            url: 'sh.php',
            success: function(response){
                $('#sh').html(response);
            }
        });
    }

    // Load learning outcomes on page load
    loadLearningOutcomes();

});


</script>

</body>
</html>

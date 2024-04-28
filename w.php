<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Learning Outcome</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body align="center">
<div class="container mt-5">
<h4align="center" class="mb-4">مخرجات التعلم:
    </h4> 

<div class="row justify-content-center">
<div class="col-md-4">

<div id="shh" class="mt-3"></div>
<div id="sh" class="mt-3"></div>
<div class="col-md-4"></div>
</div>       
<div class="col-md-4">
            

    <form style="text-align: right;" id="addLearningOutcomeForm">
        <div class="form-group">
            <label for="category">مخرج التعلم للمقرر</label>
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
            <label for="percentage">النسبة من اجمالي درجة التقييم:</label>
            <input type="number" class="form-control" id="percentage" name="percentage" min="1">
        <span id="percentageError" style="color: red; display: none;">الرجاء إدخال قيمة أكبر من واحد.</span>
         </div>
        <button type="submit" class="btn btn-primary">اضافة</button>
    </form>
        </div>
     </div>



<div class="row justify-content-center">


        <div class="col-md-4"></div>
        <div class="col-md-4">
    

        </div>
        <div class="col-md-4">
        </div>
        </div></div>
    
<div class="container mt-5">

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('#percentage').on('input', function() {
        var percentageInput = $(this).val();
        var percentageError = $('#percentageError');
        if (percentageInput < 1) {
            percentageError.show();
        } else {
            percentageError.hide();
        }
    });

    $.ajax({
        type: 'GET',
        url: 'get_categorieadd_grade.php',
        success: function(response){
            $('#category').html(response);
        }
    });

    $.ajax({
        type: 'GET',
        url: 'get_assessment_activities.php',
        success: function(response){
            $('#assessmentActivity').html(response);
        }
    });
    $('#addLearningOutcomeForm').submit(function(event){
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'add_learning_oneandtow.php',
            data: $(this).serialize(),
            success: function(response){
              $('#shh').html(response);
loadLearningOutcomes();

            }
        });
    });




    $(document).on("click", ".btn-delete", function(){
        var id = $(this).data("id");
        if(confirm("هل أنت متأكد أنك تريد حذف هذا السجل؟")) {
            $.ajax({
                type: "POST",
                url: "delete_learning_outcome.php", 
                data: { id: id },
                success: function(response){
                    loadLearningOutcomes();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });


    loadLearningOutcomes();

    function loadLearningOutcomes() {
        $.ajax({
            type: 'GET',
            url: 'sh.php',
            success: function(response){
                $('#sh').html(response);
            }
        });
    }

});


</script>


</body>
</html>






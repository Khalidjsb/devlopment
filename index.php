
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Assessment Activity</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include"header.php";?>

<div class="container mt-5">
<div class="container mt-5">
<h4 align="center" class="mb-4">  توزيع درجات انشطة التقييم

    </h4> 

<div class="row justify-content-center">
<div class="col-md-2"></div>

<div class="col-md-4">
<div id="responseMessage" class="mt-3"></div></div>
<div class="col-md-4">
            


    <form id="addActivityForm">
        <div class="form-group">
            <label for="activityName">انشطة التقييم</label>
<select id="activityName" name="activityName">
<option value='امتحان عملي 1 Mid Term exam'>امتحان عملي 1 Mid Term exam</option>
<option value='امتحان فصلي ۲ Mid Term exam'>امتحان فصلي ۲ Mid Term exam</option>
<option value='اختبار نهائي Final exam'>اختبار نهائي Final exam</option>
<option value='Project مشروع'> Project مشروع</option>
<option value='Homework and reports واجبات منزلية وتقارير'>Homework and reports واجبات منزلية وتقارير </option>
</select>

        </div>
        <div class="form-group">
            <label for="percentage">النسبة من اجمالي درجة المقرر</label>
            <input type="number" class="form-control" id="percentage" name="percentage" min="1" required>
            <span id="percentageError" style="color: red; display: none;">الرجاء إدخال قيمة أكبر من واحد.</span>

        </div>
        <button type="submit" class="btn btn-primary">اضافة</button>
    </form>
  
</div><div class="col-md-2"></div>

</div></div>


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
    });

function loadCurrentActivities() {
    $.ajax({
        type: 'GET',
        url: 'get_activities.php',
        success: function(response){
            $('#responseMessage').html(response);
        }
    });
}

$(document).ready(function(){




    // Load current activities when page loads
    loadCurrentActivities();

    // Submit form
    $('#addActivityForm').submit(function(event){
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'add_activity.php',
            data: $(this).serialize(),
            success: function(response){
                $('#responseMessage').html(response);
                // Load current activities
                loadCurrentActivities();
            }
        });
    });


    
    $(document).on("click", ".btn-delete", function(){
        var id = $(this).data("id");
        if(confirm("هل أنت متأكد أنك تريد حذف هذا السجل؟")) {
            $.ajax({
                type: "POST",
                url: "delete_activity.php", 
                data: { id: id },
                success: function(response){
                    loadCurrentActivities();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });



    loadCurrentActivities();
});


</script>

</body>
</html>


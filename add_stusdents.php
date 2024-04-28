<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة طالب جديد</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body dir="rtl">

<?php include"header.php";?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="addStudentForm" method="POST">
                <h4 align="center" class="mb-4">إضافة طالب جديد</h4> 

                <div class="form-group">
                        <label for="studentName">اسم الطالب</label>
                        <input type="text" class="form-control" id="studentName" name="studentName">
                    </div>    <div class="form-group">
                        <label for="studentName"> حالة الطالب</label>
                        <select class="form-control" id="stat" name="stat" required>
                        <option value="">الحاله</option>
                        <option value="منتظم">منتظم</option>
                    <option value="محروم">معتذر</option>

                    <option value="محروم">محروم</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">إضافة الطالب</button>
                </form>
                <hr>
                <a href="datafrome.php" class="btn btn-primary">استيراد بيانات مجموعة طلاب من ملف اكسل  </a>

                <div id="responseMessage" class="mt-3"></div>


            </div>
        </div>

        <button style="width:100%;" onClick="myf()" id="btn_print" style="cursor:hand;">طباعة</button> 
<script>
function myf(){

    document.getElementById('btn_print').style.display="none";
  document.getElementById('addStudentForm').style.display="none";
window.print();

}

</script>


    </div>

    <script>
        $(document).ready(function(){
            $('#addStudentForm').submit(function(event){
                event.preventDefault(); // منع الإرسال الافتراضي للنموج

                var formData = $(this).serialize(); // جمع بيانات النموذج

                $.ajax({
                    url: 'add_student.php',
                    method: 'POST',
                    data: formData,
                    success: function(response){
                        $('#responseMessage').html(response); // عرض رسالة الاستجابة
                        loadLearningOutcomes();

                    }
                });
            });
            loadLearningOutcomes();

    function loadLearningOutcomes() {
        $.ajax({
            type: 'GET',
            url: 'get_students.php',
            success: function(response){
                $('#responseMessage').html(response);
            }
        });
    }

});
    </script>
</body>
</html>

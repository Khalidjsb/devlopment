<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include"header.php"; ?>

<div class="container">
    
        <h2>تحميل بيانات Excel</h2>
        <form id="uploadForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="excelFile">Choose Excel File:</label>
                <input type="file" class="form-control-file" id="excelFile" name="excelFile">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        <div id="response"></div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#uploadForm').submit(function(e){
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: formData,
                    success: function(response){
                        $('#response').html(response);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });
    </script>
</body>
</html>

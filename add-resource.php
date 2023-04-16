<?php 
session_start();

include "./config/dbconnect.php" ;



$courseQuery = "SELECT course_code, course_title FROM courses";
$result = mysqli_query($conn, $courseQuery);
if(!$result){
    echo "Error: " . $courseQuery . "<br>" . mysqli_error($conn);
}
else{
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


if(isset($_POST['title']) && isset($_POST['course']) && isset($_FILES['file'])){
    $title = $_POST['title'];
    $course = $_POST['course'];

    $fileName = $_FILES['file']['name'];
    
    $fileTmpName = $_FILES['file']['tmp_name'];
    $dir = "/uploads/resources/";



    $query = "INSERT INTO materials (material_title, course_code, material_type, resource_path, uploader) VALUES ('$title', '$course', 'Resource', '$fileName', '$_SESSION[username]')";
    

    if(!mysqli_query($conn, $query)){
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    move_uploaded_file($fileTmpName, $dir.$filename);




    $msg =  '<div class="alert alert-success alert-dismissible fade show container" role="alert">
    <strong>Thank You!</strong> Resources uploaded Successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

include "./templates/header.php"
?>

<title>Upload Resource</title>
</head>

<body>
    <?php include "./templates/navigation.php" ;?>

    <section>
        <?php echo $msg; ?>
        <div class="container col-lg-5 shadow rounded bg-warning-subtle my-3 p-3">
            <h3>Upload Resource</h3>
            
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Resource Title</label>
                    <input type="text" class="form-control"  name="title" placeholder="i.e Question paper from spring 23" required>
                </div>
                <div class="form-group">
                    <label for="course">Course</label>
                    <select class="form-control" id="course" name="course" required>

                        <?php foreach($courses as $course){
                            echo "<option value='" . $course['course_code'] . "'>" . $course['course_code'] . "</option>";
                        }?>
                    </select>
                </div>
                <div class="form-group my-2">
                    
                    <input type="file" class="form-control-file"  name="file" required>
                </div>
                <input type="submit" class="btn btn-primary" name='submit'  value="Upload"/>


            </form>
        </div>
    </section>
    <?php include "./templates/footer.php" ?>
</body>


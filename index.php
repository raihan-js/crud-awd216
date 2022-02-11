<?php
include_once "./app/function.php";
include_once "./config.php";


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Form submission</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>



    <div class="user-form wrap shadow-lg w-25 mx-auto my-5">
        <div class="form-group">
            <a class="btn btn-secondary" href="./users.php" style="width: 100%;">All users</a>
        </div>
        <div class="card">
            <div class="card-body">
                <h2>Register</h2>

                <?php

                if (isset($_POST['submit'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];

                    $tmp_name = $_FILES['photo']['tmp_name'];
                    $photo_name = $_FILES['photo']['name'];

                    // if (empty($photo_name)) {
                    //     $msg = validate("upload files");
                    // } else {
                    //     move_uploaded_file($tmp_name, 'images/' . $photo_name);
                    // }

                    if (empty($name) || empty($email) || empty($phone)) {
                        $msg = validate("All fields are required!!!");
                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $msg = validate("Invalid email address", "info");
                    } else {

                        connect()->query("INSERT INTO users (name, email, phone, photo) VALUES ('$name', '$email', '$phone', '$photo_name')");

                        $msg = validate("Successful", "info");
                        form_clear();

                        $photo_name = imageUpload($_FILES['photo'], 'images/');
                    }
                }
                ?>


                <?php echo $msg ?? ""; ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input class="form-control" type="text" name="name" value="<?php echo old('name'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input class="form-control" type="email" name="email" value="<?php echo old('email'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input class="form-control" type="text" name="phone" value="<?php echo old('phone'); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Choose your profile picture</label>
                        <input class="form-control" type="file" name="photo" value="" id="photo">
                        <img id="preload" src="" alt="" style="max-width: 100%;">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Register" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>








    <!-- JS FILES  -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $('#photo').change(function(event) {
            let url = URL.createObjectURL(event.target.files[0]);
            $('#preload').attr('src', url);
        });
    </script>
</body>

</html>
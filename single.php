<?php
include_once "./app/function.php";
include_once "./config.php";

$user_id = $_GET['user_id'] ?? false;

if ($user_id) {
    $data = connect()->query("SELECT * FROM users WHERE id='$user_id'");
    $user_data = $data->fetch_object();

    if ($user_data->name == '') {
        header('location:users.php');
    }
} else {
    header('location:users.php');
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Development Area</title>
    <!-- ALL CSS FILES  -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>



    <div class="wrap-table shadow w-25">
        <div class="card">
            <div class="card-body">
                <div class="single-user">
                    <img src="./images/<?php echo $user_data->photo; ?>" style="width: 360px; border-radius: 999px; height: 360px; object-fit: cover;">
                    <div class="user-items" style="text-align: center; padding-top:10px">
                        <h2><b><?php echo $user_data->name; ?></b></h2>
                        <h4><?php echo $user_data->email; ?></h4>
                        <h4><?php echo $user_data->phone; ?></h4>
                        <a class="btn btn-primary" href="./users.php">Back</a>
                    </div>


                </div>
            </div>
        </div>
    </div>








    <!-- JS FILES  -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
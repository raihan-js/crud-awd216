<?php
include_once "./app/function.php";
include_once "./config.php";

$data = connect()->query("SELECT * FROM users");


//delete data
$delete_id = $_GET['delete_id'] ?? false;

if ($delete_id) {
	connect()->query("DELETE FROM users WHERE id='$delete_id'");
	header('location:users.php');
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>CRUD Operation</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>



	<div class="wrap-table shadow">
		<div class="form-group">
			<a class="btn btn-info" href="./index.php">Create user</a>
		</div>
		<div class="card">
			<div class="card-body">
				<h2>All Data</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>


						<?php
						$data = connect()->query("SELECT * FROM users");


						while ($user = $data->fetch_object()) :
						?>


							<tr>
								<td><?php echo $user->id; ?></td>
								<td><?php echo $user->name; ?></td>
								<td><?php echo $user->email; ?></td>
								<td><?php echo $user->phone; ?></td>
								<td><img src="images/<?php echo $user->photo; ?>" alt=""></td>
								<td>
									<a title="View" class="btn btn-sm btn-info" href="./single.php?user_id=<?php echo $user->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<a title="Edit" class="btn btn-sm btn-warning" href="./edit.php?edit_id=<?php echo $user->id; ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
									<a title="Delete" class="btn btn-sm btn-danger" href="?delete_id=<?php echo $user->id; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
							</tr>
						<?php endwhile; ?>


					</tbody>
				</table>
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
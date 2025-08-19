<?php
include('dbConfig.php');
$errmsg ='';
$savemsg='';

//add new categories
if(isset($_POST['btnsave']))
{
	$cname=$_POST['cname'];
	if(empty($cname))
	{
		$errmsg ="Feilds are Required";
	}
	
	if(empty($errmsg))
	{
		$stmt =$db_con->prepare("INSERT INTO categories(category)VALUES(:cname)");
		$stmt->bindParam(':cname',$cname);
	
		if($stmt->execute())
		{
		$lastproductid=$db_con->lastInsertId();
			
			$savemsg ="New category Inserted";
		}
		else
		{
			$errmsg ="Error Occured";
		}
	}
	header('refresh: 5 categories.php');
}



header('refresh: 5 categories.php');
?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Add new Categories
	</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha512-Dop/vW3iOtayerlYAqCgkVr2aTr2ErwwTYOvRFUpzl2VhCMJyjQF0Q9TjUXIo6JhuM/3i0vVEt2e/7QQmnHQqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="container mt-4">
		<h3 class="mb-4">Add New Category</h3>
		
	<p></p>
		<?php if(!empty($errmsg)) echo "<div class='alert alert-danger'>$errmsg</div>"; ?>

		<?php if(!empty($savemsg)) echo "<div class='alert alert-danger'>$savemsg</div>"; ?>
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Category Name</label>
				<input type="text" name="cname" class="form-control" required>
			</div>
		
<button type="submit" name="btnsave" class="btn btn-success">Save</button>
		</form>
		
	</div>

</body>
</html>

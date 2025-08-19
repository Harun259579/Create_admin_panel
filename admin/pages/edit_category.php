<?php
include('dbConfig.php');

if(!isset($_GET['id']))
{
	die("Invalid Request");

}

//products fatch

$decode_id = base64_decode(urldecode($_GET['id']));
$pstmnt=$db_con->prepare("SELECT * FROM categories WHERE id=?");
$pstmnt->execute([$decode_id]);
$categories=$pstmnt->fetch(PDO::FETCH_ASSOC);
if(!$categories)
{
	die("categories are not available");
}

 //handle edit products
 if(isset($_POST['update']))
{
    $catename = $_POST['catename'];
	
    //Database Update
	$stmt = $db_con->prepare("UPDATE categories SET category = ?,WHERE id = ?");
	$stmt->execute([$catename,$decoded_id]);


	

	$success = "category updated successfully";
	header('refresh: 5 categories.php');
}
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Edit Categories 
	</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha512-Dop/vW3iOtayerlYAqCgkVr2aTr2ErwwTYOvRFUpzl2VhCMJyjQF0Q9TjUXIo6JhuM/3i0vVEt2e/7QQmnHQqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="container mb-3">
		<form method="post" enctype="multipart/form-data">
			<h3>Edit Categories</h3>
			<?php
			if(!empty($success))
				echo "<div class='alert alert-danger'>$success</div>";
			?>
			<div class="form-group">
				<label>Category name:</label>
				<input type="text" name="catename" class="form-control" value="<?= htmlspecialchars($categories['category']);?>">
			</div>
			
			
			<button type="submit" name="update" class="btn btn-success">Update Product</button>

			<a href="categories.php" class="btn btn-secondary">Back</a>



			
		</form>
		
	</div>

</body>
</html>

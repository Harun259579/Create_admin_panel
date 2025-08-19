<?php
include('dbConfig.php');

//Handle Delete Operation
/*error_reporting(0);
if(isset($_GET['delete_id']))
{
	$delete_id = (int)base64_decode(urldecode($_GET['delete_id']));

} 

$stmtAttr = $db_con->prepare("DELETE FROM categories WHERE product_id = ?");
$stmtAttr->execute([$delete_id]);

$stmtDel = $db_con->prepare("DELETE FROM products WHERE id = ?");
$stmtDel->execute([$delete_id]);

header('refresh: 5');*/

//fetch all dta from categories table

$stmt = $db_con->prepare("SELECT * FROM categories ORDER BY id DESC");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Show Products
	</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha512-Dop/vW3iOtayerlYAqCgkVr2aTr2ErwwTYOvRFUpzl2VhCMJyjQF0Q9TjUXIo6JhuM/3i0vVEt2e/7QQmnHQqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<style>
		.thumbnail-img
		{
			width: 80px;
			height: 80px;
			object-fit: cover;
		}

		.color-box
		{
			display: inline-block;
			width: 20px;
			height: 20px;
		
			margin-right: 4px;
		}

	</style>
</head>
<body>
	<h3 class="mb-4">All Products</h3>
	<a href="?page=add_new_category" class="btn btn-primary mb-4">Add Categories </a>
	<p></p>

	<table class=" table table-bordered table-hover">
		<thead class="thead-dark">
				<tr>
					
					<th>Categories</th>
					<th>Actions</th>
				</tr>
			</thead>
			<?php
			if($categories):?>
				<?php foreach ($categories as $row):?>
					<?php
					$category_id = $row['id'];
					$encrypted_id = urlencode(base64_encode($category_id));
					?>

					<tr>
					

					<td>
						<?php echo htmlspecialchars($row['category']);?>
					</td>


					<td>
						<a href="?page=edit_category&id=<?php echo $encrypted_id; ?>" class="btn btn-sm btn-warning">Edit</a>
					

					
						<a href="?page=categories&delete_id=<?php echo $encrypted_id; ?>" class="btn btn-sm btn-danger">Delete</a>
					

					
						<a href="view_products.php" class="btn btn-sm btn-info">View Details</a>
					</td>
				</tr>

			<?php endforeach;?>
			<?php else: ?>
				<tr>
					<td colspan="8" class="text-center">Categories Not found!
						
					</td>
				</tr>
			<?php endif; ?>


		
	</table>

</body>
</html>

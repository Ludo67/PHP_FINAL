<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "phpfinalproject_shoppingcart");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
	echo '<script>window.location="index.php"</script>';
}


?>
<!DOCTYPE html>
<html>
	<head>
		<title>SHOPPING CART</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<div id="outside">
			<h1>VIDEO GAME STORE</h1>
			<h6> By Lawrence Liang, Vlad Popa and Ludovic Marcoux-Hoyos</h6>
			<a href = "cart.php"><input type="submit" name="view_cart" class="button" value="View Cart" /></a>
			<?php
				$query = "SELECT * FROM tbl_product ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div id="item">
				<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
					<div id = "box">
						<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /></br>

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="button" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			
			<a href = "cart.php"><input type="submit" name="view_cart" class="button" value="View Cart" /></a>
		</div>
	</body>
</html>

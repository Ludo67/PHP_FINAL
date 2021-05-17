<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "phpfinalproject_shoppingcart");


if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}

?>

<!DOCTYPE html>
	<head>
		<title>Cart</title>
		<link rel="stylesheet" href="cart.css">
	</head>
	
	<body>
		<div id="outside">
			</br>
			<h3>Cart Items</h3>
			<div>
				<table>
					<tr>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total</th>
						<th>Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="button">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div>
			
				<a href = "index.php"><input type="submit" name="go_back" style="margin-top:5px;" class="button" value="Go Back" /></a>
				
				<a href = "confirmation.php"><input type="submit" name="purchase" style="margin-top:5px;" class="button_purchase" value="Purchase" /></a>
		</div>
	</body>
</html>
			
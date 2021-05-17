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
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div id ="outside">
			<h1>Thank you for shopping!</h1>
			<h3>Website by Lawrence Liang, Vlad Popa, Ludovic Marvoux-Hoyos</h3>
			<a href = "index.php"><input type="submit" name="go_back" style="margin-top:5px;" class="button" value="Go Back Shopping" /></a>	
		</div>
	</body>
</html>
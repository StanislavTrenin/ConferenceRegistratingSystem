<?php
	
	try 
	{
		
		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT location, COUNT(*) AS quantity FROM users GROUP BY location";
		$location = $_POST['location'];
		$statement = $connection->prepare($sql);
		$statement->bindParam(':location', $location, PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetchAll();
	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
?>


<?php require "templates/header.php"; ?>
		

<h2>Conference statistick</h2>


		<table>
			<thead>
				<tr>
					<th>Location</th>
					<th>Quantity</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["location"]); ?></td>
				<td><?php echo escape($row["quantity"]); ?></td>

				
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>



<a href="index.php" style="color:#b5b538">Back to home</a>


<?php include "templates/footer.php"; ?>


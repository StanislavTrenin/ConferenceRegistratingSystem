<?php
	
	try 
	{
		
		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT * FROM users";
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
		

<h2>All info about conference</h2>


		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Father Name</th>
					<th>Email Address</th>
					<th>Location</th>
					<th>Sex</th>
					<th>Last update</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["firstname"]); ?></td>
				<td><?php echo escape($row["lastname"]); ?></td>
				<td><?php echo escape($row["fathername"]); ?></td>
				<td><?php echo escape($row["email"]); ?></td>
				<td><?php echo escape($row["location"]); ?></td>
				<td><?php echo escape($row["sex"]); ?></td>
	
				<td><?php echo escape($row["date"]); ?> </td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>



<a href="index.php" style="color:#b5b538">Back to home</a>


<?php include "templates/footer.php"; ?>

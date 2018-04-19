<?php
if (isset($_POST['submit']))
{
	
	require "../config.php";
	require "../common.php";
	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$changed_user = array(
			"firstname" => $_POST['firstname'],
			"lastname"  => $_POST['lastname'],
			"fathername"  => $_POST['fathername'],
			"email"     => $_POST['email'],
			"location"  => $_POST['location'],
			"sex"       => $_POST['sex']
		);
		
		$sql = sprintf(
				"UPDATE %s SET firstname = '%s',  lastname = '%s', fathername = '%s', email = '%s', location = '%s', sex = '%s' WHERE id = %s",
				"users",
				$_POST['firstname'],
				$_POST['lastname'],
				$_POST['fathername'],
				$_POST['email'],
				$_POST['location'],
				$_POST['sex'],
				$_POST['id']
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($changed_user);


	}
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>

<?php require "templates/header.php"; ?>

<?php 
if (isset($_POST['submit']) && $statement) 
{ ?>
	<blockquote><?php echo $_POST['id']; ?> successfully changed.</blockquote>
<?php 
} ?>

<h2>Change a user info</h2>

<form method="post">
	<label for="id">ID</label>
	<input type="int" name="id" id="id">
	<label for="firstname">First Name</label>
	<input type="text" name="firstname" value="Default name" id="firstname">
	<label for="lastname">Last Name</label>
	<input type="text" name="lastname" value="Default last name" id="lastname">
	<label for="fathername">Father Name</label>
	<input type="text" name="fathername" value="Default father name" id="fathername">
	<label for="email">Email Address</label>
	<input type="text" name="email" value="Default email" id="email">
	<label for="location">Location</label>
	<input type="text" name="location" value="Default city" id="location">
	<label for="sex">Sex</label>
	
	<select name="sex">
		<option value="notdet">_______ </option>
		<option value="male">male</option>
		<option value="female">female</option>
	</select>

	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php" style="color:#b5b538">Back to home</a>

<?php require "templates/footer.php"; ?>

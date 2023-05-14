<!DOCTYPE html>
<html>
	<head>
		<title>ibuy Auctions</title>
		<link rel="stylesheet" href="ibuy.css" />
	</head>

	<body>
		<header>
			<h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>

			<form action="#">
				<input type="text" name="search" placeholder="Search for anything" />
				<input type="submit" name="submit" value="Search"/> 
			</form>
      
		</header>
<?php

require 'pdoConnection.php';


if($nep){
echo"Connected";
echo'<br>';
}

// Handling the submission form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Fetching the data from the user
  $name = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['Cpassword'];

  // Checking empty fields
  if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    echo "Please fill out all fields.";
  } 
  // Checking whether the password is longer than 8 characters or not
  else if (strlen($password) < 8) {
    echo "Password must be at least 8 characters long.";
  }
  // Checking whether the password and confirm password is matching or not
  else if ($password != $confirm_password) {
    echo "Password and confirm password do not match.";
  } else {
    //$encryption = password_hash($password, PASSWORD_DEFAULT);

    // Inserting user with the password in encrypted form
// Inserting user with the password in encrypted form
$statement = $nep->prepare("INSERT INTO register (name, email, password) VALUES (:name, :email, :password)");
$statement->bindParam(':name', $name);
$statement->bindParam(':email', $email);
$statement->bindParam(':password', $password);
$statement->execute();


    echo "Registration successful!";
  }
}
?>

<body>
  <main>
<form action="register.php" method="POST">
  <label for="name">Name:</label><br>
  <input type="text" name="fullname" id="name" /><br>
  <label for="email">Email:</label><br>
  <input type="text" name="email" id="email" /><br>
  <label for="password">Password:</label><br>
  <input type="password" name="password" id="password" /><br>
  <label for="Cpassword">Confirm Password:</label><br>
  <input type="password" name="Cpassword" id="Cpassword" /><br>
  <input type="submit" name="submit" id="submit" />
  
</form>
<a href='head.php'><input type="submit" name="submit" value="Back" /></a>
        
</main>
    
</body>
</html>
<?php
 require 'foot.php';
?>
<?php 

if (isset($_POST['login'])) {

	require 'connectDB.php';

	$Usermail = $_POST['email']; 
	$Userpass = $_POST['pwd']; 
	$role = $_POST['role']; 

	if (empty($Usermail) || empty($Userpass) ) {
		header("location: login.php?error=emptyfields");
  		exit();
	}
	else if (!filter_var($Usermail,FILTER_VALIDATE_EMAIL)) {
          header("location: login.php?error=invalidEmail");
          exit();
    }
	
	else{
		$sql = "SELECT * FROM admin WHERE admin_email=?";
		$result = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($result, $sql)) {
			header("location: login.php?error=sqlerror");
  			exit();
		}
		else{
			mysqli_stmt_bind_param($result, "s", $Usermail);
			mysqli_stmt_execute($result);
			$resultl = mysqli_stmt_get_result($result);

			if ($row = mysqli_fetch_assoc($resultl)) {
				$pwdCheck = password_verify($Userpass, $row['admin_pwd']);
				if ($pwdCheck == false) {
					header("location: login.php?error=wrongpassword");
  					exit();
				}
				else if ($pwdCheck == true) {
	                session_start();
					$_SESSION['Admin-name'] = $row['admin_name'];
					$_SESSION['Admin-email'] = $row['admin_email'];
					
					if ($role == 'admin') {
							header("location: index.php?login=success");
							exit();
					}
					else if ($role == 'lecturer') {
							header("location: lectureadmin.php?login=success");
							exit();
					}
					else if ($role == 'student') {
						require'connectDB.php';
						$sql = "SELECT * FROM devices ORDER BY id DESC";
							
						}
						$sql = "SELECT  `attandance` FROM `users` WHERE `email`='$Usermail'";
							 
						$results = $conn->query($sql);
						if ($results->num_rows > 0) {

						// output data of each row
							while($row = $results->fetch_assoc()) {
								$attendance = $row['attandance'];
								$attendance = $attendance + 1;
								$sql = " UPDATE `users` SET `attandance`='$attendance' WHERE `email`= '$Usermail'";
								$conn->query($sql);
				    
						} 
							header("location: schooladmin.php?login=success");
							exit();
					}
					header("location: schooladmin.php?login=success");
					exit();
				}
			
			else{
				header("location: login.php?error=nouser");
  				exit();
			}
		}
	}
	
mysqli_stmt_close($result);    
mysqli_close($conn);
}
	}
	
else{
  header("location: login.php");
  exit();
}
?>
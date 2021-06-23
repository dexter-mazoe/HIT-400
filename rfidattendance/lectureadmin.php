<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Students</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/devices.css"/>

	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"
	        integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	        crossorigin="anonymous">
	</script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script src="js/dev_config.js"></script>
	<script>
	  	$(window).on("load resize ", function() {
		    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
		    $('.tbl-header').css({'padding-right':scrollWidth});
		}).resize();
	</script>
	<script>
		$(document).ready(function(){
		    $.ajax({
		      	url: "lect_up.php",
		      	type: 'POST',
		      	data: {
		        'dev_up': 1,
		  		}
	      	}).done(function(data) {
	  			$('#devices').html(data);
    		});
		});
	</script>
</head>
<body>
    <div id="background-image"></div>

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' type='text/css' href="css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/header.css"/>
</head>
<header>
<div class="header">
	<div class="logo">
		<a href="index.php"><h1><b>Smart Attendance System</b></h1></a>
	</div>
</div>
<?php  
  if (isset($_GET['error'])) {
		if ($_GET['error'] == "wrongpasswordup") {
			echo '	<script type="text/javascript">
					 	setTimeout(function () {
			                $(".up_info1").fadeIn(200);
			                $(".up_info1").text("The password is wrong!!");
			                $("#admin-account").modal("show");
		              	}, 500);
		              	setTimeout(function () {
		                	$(".up_info1").fadeOut(1000);
		              	}, 3000);
					</script>';
		}
	} 
	if (isset($_GET['success'])) {
		if ($_GET['success'] == "updated") {
			echo '	<script type="text/javascript">
			 			setTimeout(function () {
			                $(".up_info2").fadeIn(200);
			                $(".up_info2").text("Your Account has been updated");
              			}, 500);
              			setTimeout(function () {
                			$(".up_info2").fadeOut(1000);
              			}, 3000);
					</script>';
		}
	}
	if (isset($_GET['login'])) {
	    if ($_GET['login'] == "success") {
	      echo '<script type="text/javascript">
	              
	              setTimeout(function () {
	                $(".up_info2").fadeIn(200);
	                $(".up_info2").text("You successfully logged in");
	              }, 500);

	              setTimeout(function () {
	                $(".up_info2").fadeOut(1000);
	              }, 4000);
	            </script> ';
	    }
	  }
?>
<div class="topnav" id="myTopnav">

    <?php  
    	if (isset($_SESSION['Admin-name'])) {
    		
    		echo '<a href="#">Home</a> <a href="ulogs.php">Student Logs</a>  <a href="logout.php">Log Out</a>';
    	}
    	else{
    		echo '<a href="login.php">Log In</a>';
    	}
    ?>
    <a href="javascript:void(0);" class="icon" onclick="navFunction()">
	  <i class="fa fa-bars"></i></a>
</div>
<div class="up_info1 alert-danger"></div>
<div class="up_info2 alert-success"></div>
</header>
<script>
	function navFunction() {
	  var x = document.getElementById("myTopnav");
	  if (x.className === "topnav") {
	    x.className += " responsive";
	  } else {
	    x.className = "topnav";
	  }
	}
</script>


<main>
	<h1 class="slideInDown animated"></h1>

	<section class="container py-lg-5">
		<div class="alert_dev"></div>
		<!-- devices -->
		<div class="row">
			<div class="col-lg-12 mt-4">
				<div class="panel">
			      <div class="panel-heading" style="font-size: 19px;">Your Students:
			      	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#new-device" style="font-size: 18px; float: right; margin-top: -6px;">New Student</button>
			      </div>
			      <div class="panel-body">
			      		<div id="devices"></div>
			      </div>
			    </div>
			</div>
		</div>
		<!-- \\devices -->
		<!-- New Devices -->
		<div class="modal fade" id="new-device" tabindex="-1" role="dialog" aria-labelledby="New Student" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 class="modal-title" id="exampleModalLongTitle">Add Student:</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form action="new_student.php" method="POST" enctype="multipart/form-data">
			      <div class="modal-body">
			      	<label for="User-mail"><b>Student:</b></label>
			      	<input type="text" name="student" id="dev_name" placeholder="Student Name..." required/><br>
			      	<label for="User-mail"><b>Attendance:</b></label>
			      	<input type="text" name="attadance" id="dev_dep" placeholder="Attandance..." required/><br>
					<label for="User-mail"><b>Course Name:</b></label>
			      	<input type="text" name="course_name" id="dev_dep" placeholder="Course Name..." required/><br>
					<label for="User-mail"><b>Course Work Mark:</b></label>
			      	<input type="text" name="course_work" id="dev_dep" placeholder="Course Work Mark..." required/><br>
			      </div>
			      <div class="modal-footer">
			        <button type="submit" 
					class="btn btn-success">Add Student</button>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div>
			  </form>
		    </div>
		  </div>
		</div>
		<!-- //New Devices -->
	</section>
</main>
</body>
</html>
<?php>
    $con=mysqli_connect("local","root","","rfidattendance");
    if(isset($_POST['1']))
    {   // get $attendance value from the current attendance value in the database
           $sql="update user set attendance=$attendance+1";
        $run_messi=mysqli_query($con,$sql);
    }
?>
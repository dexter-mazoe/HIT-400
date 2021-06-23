<div class="table-responsive-sm" style="max-height: 870px;"> 
  <table class="table">
    <thead class="table-primary">
      <tr>
        <th>CardID</th>
        <th>Name</th>
        <th>Reg.</th>
        <th>S.No</th>
        <th>Date</th>
        <th>Dept</th>
		<th>Course Code</th>
        <th>Attandance</th>
      </tr>
    </thead>
    <tbody class="table-secondary">
    <?php
      //Connect to database
      require'connectDB.php';

        $sql = "SELECT * FROM users ORDER BY id DESC";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo '<p class="error">SQL Error</p>';
        }
        else{
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
          if (mysqli_num_rows($resultl) > 0){
              while ($row = mysqli_fetch_assoc($resultl)){
      ?>
                  <TR>
                  	<TD><?php  
                    		if ($row['card_select'] == 1) {
                    			echo "<span><i class='glyphicon glyphicon-ok' title='The selected UID'></i></span>";
                    		}
                        $card_uid = $row['card_uid'];
                    	?>
                    	<form>
                    		<button type="button" class="select_btn" id="<?php echo $card_uid;?>" title="select this UID"><?php echo $card_uid;?></button>
                    	</form>
                    </TD>
                  <TD><?php echo $row['username'];?></TD>
                  <TD><?php echo $row['registered'];?></TD>
                  <TD><?php echo $row['serialnumber'];?></TD>
                  <TD><?php echo $row['user_date'];?></TD>
                  <TD><?php echo ($row['device_dep'] == "0") ? "All" : $row['device_dep'];?></TD>
				  <TD><?php echo $row['course_code'];?></TD>
                  <TD class ='<?php if($row['attandance']<40){
				  echo "bg-danger";}
				  else{
					  echo "bg-success";
				  }
					  ?>' 
				   
					  ><?php  echo $row['attandance'];?> / 80</TD>
                  </TR>
    <?php
            }   
        }
      }
    ?>
    </tbody>
  </table>
</div>
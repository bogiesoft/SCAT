<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>User Profile</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<div>
	<?php
        include_once('../ssi/Header.php');
    ?>
</div>
<div class="container-fluid text-capitalize" style="padding:0px;margin:0px;">
	<div>
		<?php
            include_once('../ssi/LeftPanelProfile.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Edit My Profile</u>
            </font>
        </div>
        <?php
			$nic = $_SESSION['nic'];
			$position = $_SESSION['position'];
			//get user info
			$getUser = "SELECT * FROM employee WHERE nic='".$nic."'";
			$resultGetUser = mysqli_query($con, $getUser) or die();
			if(mysqli_num_rows($resultGetUser) != 0){
				while($rowGetUser = mysqli_fetch_array($resultGetUser)){
					//$eId = $rowGetUser['employee_id'];
					$eInternal = $rowGetUser['internal'];
					$eContact = $rowGetUser['contact_no'];
					$eNameId = $rowGetUser['name_id'];
					$eAddressId = $rowGetUser['address_id'];
					$eEmail = $rowGetUser['employee_email'];
					//get user name
					$getName = "SELECT * FROM NAME WHERE name_id='".$eNameId."'";
					$resultGetName = mysqli_query($con, $getName) or die();
					if(mysqli_num_rows($resultGetName) != 0){
						while($rowGetName = mysqli_fetch_array($resultGetName)){
							$eFName = $rowGetName['first_name'];
							$eSName = $rowGetName['second_name'];
							$eLName = $rowGetName['last_name'];
						}
					} else {
						//redirect to login
						session_unset();
						header('../index.php?error=np');
					}
					//get eID
					if($eInternal == '1'){
						$getID = "SELECT * FROM staff WHERE employee_nic='".$nic."'";
						$resultGetID = mysqli_query($con, $getID) or die();
						if(mysqli_num_rows($resultGetID) != 0){
							while($rowGetID = mysqli_fetch_array($resultGetID)){
								$eID = $rowGetID['employee_id'];
							}
						} else {
							//redirect to login
							session_unset();
							header('../index.php?error=np');
						}
					} else {
						$getIDEX = "SELECT * FROM topup_agent WHERE employee_nic='".$nic."'";
						$resultGetIDEX = mysqli_query($con, $getIDEX) or die();
						if(mysqli_num_rows($resultGetIDEX) != 0){
							while($rowGetIDEX = mysqli_fetch_array($resultGetIDEX)){
								$eID = $rowGetIDEX['topup_agent_id'];
								$eRegDate = $rowGetIDEX['agent_reg_date_time'];
							}
						} else {
							//redirect to login
							session_unset();
							header('../index.php?error=np');
						}
					}
					//get address
					$getAddress = "SELECT * FROM address WHERE address_id='".$eAddressId."'";
					$resultGetAddress = mysqli_query($con, $getAddress) or die();
					if(mysqli_num_rows($resultGetAddress) != 0){
						while($rowGetAddress = mysqli_fetch_array($resultGetAddress)){
							$eAno = $rowGetAddress['address_no'];
							$eALane = $rowGetAddress['address_lane'];
							$eACity = $rowGetAddress['address_city'];
						}
					} else {
						//redirect to login
						session_unset();
						header('../index.php?error=np');
					}
				}
			} else {
				//redirect to login
				session_unset();
				header('../index.php?error=np');
			}
		?>
        <div style="padding:10px;"> 
        	<?php
				if(isset($_GET['error'])){
					if(!empty($_GET['error'])){
						$error = $_GET['error'];
						if($error == "wf"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">First Name Should Be Letters. Cannot Be Empty.</label>
								</div>';
						} else if($error == "wm"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Middle Name Should Be Letters.</label>
								</div>';
						} else if($error == "wl"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Last Name Should Be Letters. Cannot Be Empty.</label>
								</div>';
						} else if($error == "wn"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Should Be Letters, Numbers, / or \. Cannot Be Empty.</label>
								</div>';
						} else if($error == "wa"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Lane Should Be Letters. Cannot Be Empty.</label>
								</div>';
						} else if($error == "wc"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">City Should Be Letters. Cannot Be Empty.</label>
								</div>';
						} else if($error == "wp"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Contact Number Should Be A Valid Number With 10 Digits.</label>
								</div>';
						} else if($error == "we"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Should Be A Valid EMail Address.</label>
								</div>';
						} else if($error == "cu"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">E-Mail already exists.</label>
								</div>';
						}
					}
				}
			?>
			<form role="form" class="form-horizontal" method="post" action="controller/editProfileController.php">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="eId" id="eId" readonly="readonly" value="<?php echo $eID; ?>" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeePosition" class="control-label col-md-3">Position <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="position" id="position" readonly="readonly" value="<?php echo $position; ?>" required="required"/>
                	</div>
                </div>
                <?php
				if($position == "topupAgent"){ ?>
					<div class="form-group">
						<label for="employeelNIC" class="control-label col-md-3">Registered Date <span style="color:rgb(255,0,0);">*</span></label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="nic" id="nic" readonly="readonly" value="<?php echo $eRegDate; ?>" required="required"/>
						</div>
               		 </div>
				<?php }
				?>
                <div class="form-group text-center">
                    <label class="col-md-11">Personal Information</label> 
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nic" id="nic" readonly="readonly" value="<?php echo $nic; ?>" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" value="<?php echo $eFName; ?>" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeemName" class="control-label col-md-3">Middle Name</label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="mname" id="mname" value="<?php echo $eSName; ?>" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty."/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8"> 
                    	<input class="form-control text-capitalize" type="text" name="lname" id="lname" value="<?php echo $eLName; ?>" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address" type="text" name="email" id="email" value="<?php echo $eEmail; ?>" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="addresNo" id="addressNo" value="<?php echo $eAno; ?>" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="lane" id="lane" value="<?php echo $eALane; ?>" pattern="^[a-zA-Z ]+$" title="Should Be Letters. Cannot Be Empty." required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="city" id="city" value="<?php echo $eACity; ?>" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeeContact" class="control-label col-md-3">Contact Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="contact" id="contact" value="<?php echo $eContact; ?>" pattern="^(\d{10})|(^$)$" title="Should Be A Valid Number With 10 Digits."/>
                	</div>
                </div>
                <div class="form-group" style="text-align:center;">
                    <label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Update" id="submit" name="submit" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
                </div>
            </form>
        </div>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
<?php
} else {
	header('Location:../404.php');
}
?>
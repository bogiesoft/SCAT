<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "sysadmin"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>Trains Management</title>
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
            include_once('../ssi/adminLeftPanelTrains.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Add New Trains</u>
            </font>
        </div>
        <div style="padding:10px;"> 
        <?php
			if(isset($_GET['error'])){
				if(!empty($_GET['error'])){
					$error = $_GET['error'];
					if($error == "ef"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Required Fields Cannot Be Empty.</label>
							</div>';
					} else if($error == "wc"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Train Code Should Be Numbers Only.</label>
							</div>';
					} else if($error == "wn"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Train Name Should Be Letters Only.</label>
							</div>';
					} else if($error == "wt"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Invalid Train Type.</label>
							</div>';
					} else if($error == "ae"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Train Code Or Name Already Exists.</label>
							</div>';
					} else if($error == "qf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Add The Train. Please Try Again Later.</label>
							</div>';
					} else if($error == "su"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Train Successfully Added.</label>
							</div>';
					}
				}
			}
			?>
            <form role="form" class="form-horizontal" method="post" action="controller/addTrainsController.php">
            	<div class="form-group">
                    <label for="tCode" class="control-label col-md-3">Train Code <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="tCode" id="tCode" pattern="^\d+$" title="Train Code Should Be Numbers Only" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="tName" class="control-label col-md-3">Name of the Train</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="tName" id="tName" pattern="^[a-zA-Z]+$" title="Train Name Should Be Letters Only."/>
                	</div>
                </div> 
                <div class="form-group">
                    <label for="tName" class="control-label col-md-3">Type of the Train <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<select class="form-control" name="tType" id="tType">
                        <option selected="selected" disabled="disabled">--Select The Train Type--</option>
                        <?php
						$getTypes = "SELECT * FROM train_type";
						$result = mysqli_query($con, $getTypes);
						if(mysqli_num_rows($result) != 0){
							while($row = mysqli_fetch_array($result)){
								$id = $row['type_id'];
								$name = $row['type_name'];
								echo '<option value="'.$id.'">'.$name.'</option>';
							}
						} else {
							echo '<option>No Train Types</option>';
						}
						?> 
                        </select>
                	</div>
                </div> 
                <div class="form-group" style="text-align:center;">
                    <label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
                </div>
                <div class="form-group col-md-11 text-center">
                    <input name="submit" id="submit" type="submit" value="Add" class="btn btn-success" />
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
} else {
	header('Location:../404.php');
}
?>
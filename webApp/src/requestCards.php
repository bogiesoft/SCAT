<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position']) && $_SESSION['position'] == "stationMaster"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>Cards Management</title>
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
            include_once('../ssi/stationMasterLeftPanelCards.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Request Cards</u>
            </font>
        </div>
        <div style="padding:10px;"> 
			<?php
                if(isset($_GET['error'])){
                    $error = $_GET['error'];
                    if($error == "if"){
                        echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
                            <label class="form-control col-md-3">Cannot Be Empty. Should Be Numbers.</label>
                        </div>';
                    } else if($error == "ef"){
                        echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
                            <label class="form-control col-md-3">Above FIelds Cannot Be Empty.</label>
                        </div>';
                    } else if($error == "dm"){
                        echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
                            <label class="form-control col-md-3">Card And Confirm Cards Does Not Match.</label>
                        </div>';
                    } else if($error == "qf"){
                        echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
                            <label class="form-control col-md-3">Could Not Request Cards. Please Try Again Later.</label>
                        </div>';
                    } else if($error == "er"){
                        echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
                            <label class="form-control col-md-3">Please Try Again Later.</label>
                        </div>';
                    } else if($error == "su"){
                        echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
                            <label class="form-control col-md-3 label-success">Successfully Requested New Cards.</label>
                        </div>';
                    }
                }
            ?>
			<form role="form" class="form-horizontal" action="controller/requestCardsController.php" method="post">
            	<div class="form-group">
                    <label for="pass" class="control-label col-md-3">Number Of Cards <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="cards" id="cards" pattern="^\d+$" title="Cannot Be Empty. Should Be Numbers." required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="nPass" class="control-label col-md-3">Confirm Number Of cards <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="cCards" id="cCards" pattern="^\d+$" title="Cannot Be Empty. Should Be Numbers." required="required"/>
                	</div>
                </div>
               	<div class="form-group" style="text-align:center;">
                    <label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" name="submit" id="submit" value="Request" class="btn btn-success" onclick="return confirm('Do You Wish to Request Cards?');return false;"/>
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
<?php
ob_start();
session_start();
ini_set('display_errors','0');
include_once('_lib/connection.php');
include_once('_lib/lib.user.php');

$objUser = new user();

$returnValue = '';

if(isset($_POST['submitUserDetails'])){

	$returnValue = $objUser->insertDetailsToDatabase($_POST);	
	
	
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link href="_resource/_css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" language="javascript" src="_resource/_js/jquery.js"></script>
	<script type="text/javascript" language="javascript">
    	
		function validateUserDetails(){

			var error = 0;
			
			
			if(document.getElementById('userEmail').value == "" ){
				document.getElementById("emailLabel").style.color = "red";
				error = 1;
			}else{
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			var address = document.getElementById('userEmail').value;
				if(reg.test(address) == false) {
					document.getElementById("emailLabel").style.color = "red";
				   error = 1;
				}else{
					document.getElementById("emailLabel").style.color = "black";	
				}
			}
			
			if(document.getElementById('userName').value == "" ){
				document.getElementById("usernameLabel").style.color = "red";	
				error = 1;
			}
			else{
				document.getElementById("usernameLabel").style.color = "black";
			}
			

			if(error == 1){
				return false;	
			}else{
				return true
			}
		}
    
    
    </script>
    
</head>
<body>
	<div id="wrapper">
    	<?php
		if($returnValue == ''){
		?>
    
    	<h1>To apply , fill the application below. (Fields marked * are mandatory)</h1>
        
        <form name="userDetails" id="" action="" method="post" enctype="multipart/form-data" onsubmit="return validateUserDetails();">
        
        <div style="float:left; margin-top:20px;">
        
        	<div style="float:left; height:30px; width:200px;" id="usernameLabel">Name*</div>
            <div style="float:left; height:30px; width:800px;"><input type="text" name="userName" id="userName" value="" /></div>
        
        </div>
        
        <div style="float:left; margin-top:20px;">
        
        	<div style="float:left; height:30px; width:200px;" id="emailLabel">Email*</div>
            <div style="float:left; height:30px; width:800px;"><input type="text" name="userEmail" id="userEmail" value="" /></div>
        
        </div>
        
        <div style="float:left; margin-top:20px;">
        
        	<div style="float:left; height:30px; width:200px;">Nationality</div>
            <div style="float:left; height:30px; width:800px;"><input type="text" name="userNationality" id="userNationality" value="" /></div>
        
        </div>
        
        <div style="float:left; margin-top:20px;">
        
        	<div style="float:left; height:30px; width:200px;">Highest Educational Qualification</div>
            <div style="float:left; height:30px; width:800px;"><input type="text" name="userQualification" id="userQualification" value="" /></div>
        
        </div>
        
        <div style="float:left; margin-top:20px;">
        
        	<div style="float:left; height:30px; width:200px;">Skill Set</div>
            <div style="float:left; height:30px; width:800px;"><textarea name="userSkillSet" id="userSkillSet" ></textarea></div>
        
        </div>
        
        <div style="float:left; margin-top:20px;">
        
        	<div style="float:left; height:30px; width:200px;">Total Experience</div>
            <div style="float:left; height:30px; width:800px;">
            	<select name="userExperience">
                	<option value="0">Please Select</option>
            		<option value="0">0</option>
                    <option value="0.5">0.5</option>
                    <option value="1">1</option>
                    <option value="1.5">1.5</option>
                    <option value="2">2</option>
                    <option value="2.5">2.5</option>
                    <option value="3">3</option>
                    <option value="3.5">3.5</option>
                    <option value="4">4</option>
                    <option value="4.5">4.5</option>
                    <option value="5">5</option>
                    <option value="5.5">5.5</option>
                    <option value="5+">5+</option>
            	</select>
            </div>
        
        </div>
        
        <div style="float:left; margin-top:20px;">
        
        	<div style="float:left; height:30px; width:200px;">Resume</div>
            <div style="float:left; height:30px; width:800px;"><input type="file" name="userResume" id="userResume" value="" /></div>
        
        </div>

		<div style="float:left;">
        	<input type="submit" name="submitUserDetails" id="submitUserDetails" value="Submit" />
        </div>
        
        </form>
        
        <?php
		}else{
		?>
        
        <h1>Thank you for Registering. Your Registration Number is <?php echo $returnValue;?></h1>
        
        
        <?php
		$objUser->sendUserDetails($_POST,$returnValue);
		}
		?>
        
    </div>
</body>
</html>

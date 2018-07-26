<?php
include('class.phpmailer.php');
class user{
	
	function insertDetailsToDatabase($_POST){
		
		$randomNumber = mt_rand();
		
		$userName = mysql_real_escape_string($_POST['userName']);
		$userEmail = mysql_real_escape_string($_POST['userEmail']);
		$userNationality = mysql_real_escape_string($_POST['userNationality']);
		$userQualification = mysql_real_escape_string($_POST['userQualification']);
		$userSkillSet = mysql_real_escape_string($_POST['userSkillSet']);
		$userExperience = mysql_real_escape_string($_POST['userExperience']);
		$returnFileName = '';
		
		if(isset($_FILES['userResume']['name']) && $_FILES['userResume']['name'] != "") {	
			$ext = explode(".",$_FILES['userResume']['name']);
			$img_type = strtolower(end($ext));
			if($img_type != "") {
				if($img_type != "txt" && $img_type != "doc" && $img_type != "docx" && $img_type != "odt" && $img_type != "pdf") {
					$error_i	= "error";
				}else{ 
					$error_i	= "noerror"; 
				}
			} 
		}
		
		if($error_i == "noerror") {					
			$returnFileName = $this->uploadResume('userResume');
		}
		
		$query = "INSERT INTO user_details(user_name,user_email,user_nationality,user_education,user_skil,user_experience,user_resume,user_unique_id) VALUES ('".$userName."','".$userEmail."','".$userNationality."','".$userQualification."','".$userSkillSet."','".$userExperience."','".$returnFileName."','".$randomNumber."')";
		mysql_query($query);
		
		
		return $randomNumber;
		
		
	}
	
	
	function uploadResume($resume) {
 
		$rand = mt_rand();
	    
		
		if($_FILES[$resume]['name'] != ""){
			$fileName = $_FILES[$resume]['name'];
			$ext = substr($fileName, strrpos($fileName, '.') + 1);
			$uploadpath = '_resource/_uploads/';
			$filname = $rand.'.'.$ext;
			
			$uploadpath1 = $uploadpath.$filname;
			
			if(move_uploaded_file($_FILES[$resume]['tmp_name'], $uploadpath1)){
			  @chmod($uploadpath1,0777);	
		    }
	  	
		}
		
		return $filname;
	
	}
	
	
	function sendUserDetails($_POST,$id){
	    $mail = new PHPMailer();	
		$mail->IsSendmail(); // telling the class to use SendMail transport
		$mail->Subject    ='USER DETAILS'; 
		$mail->Encoding   = "base64";
		$email = $_POST['userEmail'];
		$headers .= "From: ".$_POST['userName']." <".$_POST['userEmail']."> \r\n";
		$headers .= "Reply-To:  ".$_POST['userEmail']." \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$body .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $body .= '<html xmlns="http://www.w3.org/1999/xhtml">';
   		$body .= '<head>';
		$body .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
		$body .= '<title>Resume Management</title>';
		$body .= '</head>';
		$body .= '<body>';
		$body .= '<table width="700" border="0" align="center">';
  		$body .= '<tr style="height:auto; width:700px;">';
    	$body .= '<td style="height:auto; width:150px; padding:10px;">A Candidate with reference id '.$id.'  has uploaded his/her resume</td>';
  		$body .= '</tr>';
		$body .= '</table>';
		$body .= '</body>';
		$body .= '</html>';
		
		$mail->AddAddress('varun.khn@gmail.com');	
		
	
	
		if($mail->MailSend($headers,$body)){
		    return true;
		}else {
		   return false;
	  	}
	
	}
	
	
}


?>
<?php
if(isset($_POST['email'])) {
     
    // CHANGE THE TWO LINES BELOW
    $email_to = "support@secam.in, secamsoln@gmail.com";
     
    $email_subject = "Secam support form submissions";
     
     
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['company']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
	!isset($_POST['city']) ||
	!isset($_POST['state']) ||
	!isset($_POST['productname']) ||
	!isset($_POST['modelno']) ||
	!isset($_POST['serialno']) ||
        !isset($_POST['description'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    	$name = $_POST['name']; // required
    	$company = $_POST['company']; // required
	$email_from = $_POST['email']; // required
    	$telephone = $_POST['telephone']; // required
	$city = $_POST['city']; // required
	$state = $_POST['state']; // required
	$productname = $_POST['productname']; // required
	$modelno = $_POST['modelno']; // required
	$serialno = $_POST['serialno']; // required
    	$description = $_POST['description']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$company)) {
    $error_message .= 'The Company Name you entered does not appear to be valid.<br />';
  }
  if(strlen($description) < 2) {
    $error_message .= 'The Description you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Company: ".clean_string($company)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "City: ".clean_string($city)."\n";
    $email_message .= "State: ".clean_string($state)."\n";
    $email_message .= "Product Name: ".clean_string($productname)."\n";
    $email_message .= "Model No: ".clean_string($modelno)."\n";
    $email_message .= "Serial No: ".clean_string($serialno)."\n";
    $email_message .= "Description: ".clean_string($description)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- place your own success html below -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
}
die();
?>
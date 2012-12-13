<?php if(!$_REQUEST) exit;
///////////////////////////////////////////////////////////////////////////
	// Simple Configuration Options
	// Enter the email address that you want to emails to be sent to.
	// Example $address = "joe.doe@yourdomain.com";
	
    $address = $_REQUEST['admin_emailid'];
	
	$contact_address = $_REQUEST['address'];
	$email    = $_REQUEST['email'];
	$name	  = $_REQUEST['fname'].' '.$_REQUEST['lname'];
	$gender	  = $_REQUEST['gender'];
	$person   = $_REQUEST['persons'];
	$phone	  = $_REQUEST['phone'];
	$time	  = $_REQUEST['treatment_day']."/".$_REQUEST['treatment_month']."/".$_REQUEST['treatment_year']." at ".$_REQUEST['time'];
	$treatment = $_REQUEST['treatment'];
	
	$subject  = "New Request for Appoinment from {$name} to the treatment <b>{$treatment}<b/> ";
    $message = $_REQUEST['message'];
		
		if(get_magic_quotes_gpc()) { $comment = stripslashes($comment); }
         // Advanced Configuration Option.
         // i.e. The standard subject will appear as, "You've been contacted by John Doe."
		 
         $subject = 'You\'ve been contacted by ' . $name . '.';

         // Advanced Configuration Option.
		 // You can change this if you feel that you need to.
		 // Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.
					
		 $msg  = "You have received new request for the treatment {$treatment} {$name}\r\n\n";
		 $msg .= "Name 		: {$name}\r\n\n";
 		 $msg .= "Gender 	: {$gender}\r\n\n";
		 $msg .= "Email		: {$email}\r\n\n";
 		 $msg .= "Phone No	: {$phone}\r\n\n";
		 $msg .= "Time 		: {$time}\r\n\n";
		 $msg .= "Treatment : {$treatment}\r\n\n";
		 $msg .= "No., of Person : {$person}\r\n\n";
		 $msg .= "$message\r\n\n";
		 $msg .= "You can contact $name via email, $email.\r\n\n";
		 $msg .= "-------------------------------------------------------------------------------------------\r\n";
		 
		if(@mail($address, $subject, $msg, "From: $email\r\nReturn-Path: $email\r\n")) {
			 echo "<p class='ajax_success'>Thanks for Contact Us.</p>";
		 } else {
			 echo "<p class='ajax_failure'>Sorry, Try again Later.</p>";
		 }?>
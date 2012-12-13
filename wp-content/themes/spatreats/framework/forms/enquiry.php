<?php session_start();
if(!$_POST) exit;
///////////////////////////////////////////////////////////////////////////
	// Simple Configuration Options
	// Enter the email address that you want to emails to be sent to.
	// Example $address = "joe.doe@yourdomain.com";
    $address = $_REQUEST['admin_emailid'];
	$name	  = $_POST['name'];
	$email    = $_POST['email'];
	$subject  = "Enquiry";
    $message = $_POST['message'];
        
		if(get_magic_quotes_gpc()) { $comment = stripslashes($comment); }
         // Advanced Configuration Option.
         // i.e. The standard subject will appear as, "You've been contacted by John Doe."
         $e_subject = 'You\'ve been contacted by ' . $name . '.';
         // Advanced Configuration Option.
		 // You can change this if you feel that you need to.
		 // Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.
		 $msg  = "You have been contacted by $name with regards to $subject.\r\n\n";
		 $msg .= "$message\r\n\n";
		 $msg .= "You can contact $name via email, $email.\r\n\n";
		 $msg .= "-------------------------------------------------------------------------------------------\r\n";
							 		
		if(@mail($address, $e_subject, $msg, "From: $email\r\nReturn-Path: $email\r\n")){
			 echo "<p class='ajax_success'>Thanks for Contact Us.</p>";
		}else{
			 echo "<p class='ajax_failure'>Sorry, Try again Later.</p>";
		 }?>
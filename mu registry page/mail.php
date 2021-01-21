<?php
	echo "<center>We have created a new password for you! Please check your email!</center>";
	$to = 'jwang@monmouth.edu';
	$subject = 'New Password for Monmouth Online Registration System';
	$message = 'Please do not reply!';
	$headers = 'From: Online Registration System';
	mail($to, $subject, $message, $headers);
?>
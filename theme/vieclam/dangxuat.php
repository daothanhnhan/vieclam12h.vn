<?php 
	// var_dump($_SESSION);
	unset($_SESSION['user_id_gbvn']);
	unset($_SESSION['user_email_gbvn']);
	unset($_SESSION['user_name_gbvn']);
	unset($_SESSION['user_type_gbvn']);
	header('location: /');
?>
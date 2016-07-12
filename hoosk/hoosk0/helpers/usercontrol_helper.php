<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Usercontrol_helper{
	 
	 
	 static function is_logged_in($userName)
	 {
		if(($userName=="")):
		$redirect= BASE_URL.'/login';
		header("Location: $redirect");	
		exit;	
		endif;
	 }
 } 
<?php
session_start();
if ( isset($_SESSION['profile_id']))
{
	$id = $_SESSION['profile_id'];
		$connection =  new mysqli('localhost','root','','hms');
		$sql= "UPDATE patient_info SET status='inactive' WHERE id = '$id'";
		$connection -> query($sql);		
        header('location:profile.php');
 }
else
{
    header("location:profile.php");

}









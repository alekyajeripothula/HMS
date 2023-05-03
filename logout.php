<?php
session_start();
print_r($_SESSION);

if ( isset($_SESSION['profile_id']) )
{
    session_destroy();
    header('location:profile.php');


}
else if( isset($_SESSION['employee_id']) )
{
    session_destroy();
    header('location:empl_login.php');


}
else
{
    header('location:index.php');
}


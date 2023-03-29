<?php
//include constants.php file here
include('../config/constants.php');
//get the ID of the admin to be deleted
$id= $_GET['id'];
//create SQL query to Delete Admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";
//Execute query
$res = mysqli_query($conn, $sql);
//check if query executed successfully or not
if($res==true)
{
    //Query Executed successfully and admin deleted
    //echo "Admin Deleted";
    //create session variable to display message
    $_SESSION['delete'] ="<div class='success'>Admin Deleted Successfully</div>";
    //redirect to Manage Admin page
    header('location:'.SITEURL.'admin/manage.admin.php');
}
else{
    //Filed to delete Admin
    //echo "Failed to delete";
    $_SESSION['delete'] ="<div class='error'>Failed to Remove Admin try again later</div>";
    header('location:'.SITEURL.'admin/manage.admin.php');
}
//Redirect to Mnage Admin page with message(success or error)
?>
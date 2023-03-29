 
<?php
//include constants
include('../config/constants.php');
//echo "Delete product page";
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //process to delete
    //get ID and image name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    //Remove image if available
    //check whether image is available and delete only if available
    if($image_name!=="")
    {
        //has image and need to remove from folder
        //get the image part
        $path ="../images/products/".$image_name;
        //remove image file from folder
        $remove=unlink($path);
        //check whether image is removed or not
        if($remove==false)
        {
            //failed to remove
            $_SESSION['upload'] ="<div class='error'>Failed to remove image file.</div>";
            //redirect to manage products
            header('location:'.SITEURL.'admin/manage-products.php');
            die();
        }
    }
    //Delete product from database
    $sql = "DELETE FROM tbl_drug WHERE id=$id";
    //Execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed or not and set the session message respectively
    //redirect to manage product with session message
    if($res==true)
    {
        //Food deleted
        $_SESSION['delete'] = "<div class='success'>Product Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-products.php');
    }
    else
    {
        //Failed to Delete Food
        $_SESSION['delete'] = "<div class='error'>Failed to Delete</div>";
        header('location:'.SITEURL.'admin/manage-products.php');
    }
}
else
{
    //redirect to manage product page
    $_SESSION['unauthorize'] ="<div class='error'>Unauthorized access.</div>";
    header('location:'.SITEURL.'admin/manage-products.php');
}
?>

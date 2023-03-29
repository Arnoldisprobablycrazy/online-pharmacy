<?php include('partialss/menu.php');?>

<?php
//check whether id is set or not
if(isset($_GET['id']))
{
//get all the details
$id =$_GET['id'];

//SQL query to get selected product
$sql2 ="SELECT * FROM tbl_drug WHERE id=$id";
//Execute the Query
$res2 =mysqli_query($conn, $sql2);

//Get the value based on executed query
$row2 =mysqli_fetch_assoc($res2);
//get individual values of selected products
$title =$row2['title'];
$description =$row2['description'];
$price =$row2['price'];
$current_image =$row2['image_name'];
$current_category =$row2['category_id'];
$featured =$row2['featured'];
$active =$row2['active'];

}
else
{
    //redirect to manage product
    header('location:'.SITEURL.'admin/manage-products.php');
}
?>

<div class="main-content">
    <div class="wrapper">
       <h1> Update Products</h1>
       <br><br>

       <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</title>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
</td>
</tr>
<tr>
                <td>Description:</title>
                <td>
                    <textarea  name="description" cols="30" rows="5"><?php echo $description;?></textarea>
</td>
</tr>
<tr>
                <td>Price:</title>
                <td>
                 <input type="number" name="price" value="<?php echo $price;?>">  
</td>
</tr>
<tr>
                <td>Current Image:</title>
                <td>
                <?php
                if($current_image =="")
                {
                    //image not available
                    echo "<div class='error'>Image Unavailable</div>";
                }
                else{
                    //image Available
                    ?>
                    <img src="<?php echo SITEURL;?>images/products/<?php echo $current_image;?>" width="150px">
                    <?php
                }
                ?> 
</td>
</tr>
<tr>
       <td>Select new image</td>
       <td>
        <input type="file" name="image">
</td>
</tr>
<tr>
                <td>Category:</title>
                <td>
                    <select name="category">
                        <?php
                        //Query to get active categories
                        $sql ="SELECT * FROM tbl_category WHERE active='Yes'";
                        //Execute query
                        $res =mysqli_query($conn, $sql);
                        //count rows
                        $count =mysqli_num_rows($res);
                        //check whether category is available or not
                        if($count>0)
                        {
                            //category available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $category_title=$row['title'];
                                $category_id=$row['id'];
                                
                             //echo"<option value='$category_id'>$category_title</option>";
                             ?>
                             <option <?php if($current_category==$category_id) {echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title; ?></option>
                             <?php

                    
                            }
                        }
                        else
                        {
                            //category unavailable
                            echo "<option value='0'>Category Unavailable.</option>";
                        }
                        ?>
                        <option value="0">Test Category</option>
</select>
</td>
</tr>
<tr>
                <td>Featured:</title>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="Yes">No
</td>
</tr>
<tr>
                <td>Active:</title>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";} ?>type="radio" name="active" value="Yes">No
</td>
</tr>
<tr>
    <td>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
        <input type="submit" name="submit" value="update-product" class="btn-secondary">
                    </td>
</tr>

</table>
                    </form>
                    <?php
                    if(isset($_POST['submit']) )
                    {
                        //echo "clicked";
                        //1 Create all details from form
                        $id=$_POST['id'];
                        $title=$_POST['title'];
                        $description=$_POST['description'];
                        $price=$_POST['price'];
                        $current_image=$_POST['current_image'];
                        $category=$_POST['category'];

                        $featured=$_POST['featured'];
                        $active=$_POST['active'];


                        //2 Upload image if selected
                        //check whether button upload is cliked or not
                        if(isset($_FILES['image']['name']))
                        {
                            //upload button clicked
                            $image_name =$_FILES['image']['name'];//New image name
                            //check whether file is available or not
                            if($image_name!="")
                            {
                                //image is available
                                //rename the image
                                $ext= end(explode('.',$image_name));
                                $image_name="Product-name-".rand(0000, 9999).'.'.$ext;//this will be renamed image

                                //Get the src and destination path
                                $src_path= $_FILES['image']['tmp_name'];
                                $dest_path="../images/products/".$image_name;
                                //upload image
                                $upload=move_uploaded_file($src_path, $dest_path);
                                //check whether image is uploaded or not
                                if($upload==false)
                                {
                                    //Failed to upload
                                    $_SESSION['upload'] ="<div class='error'>Failed to upload New Image</div>";
                                    //redirect to manage food
                                    header('location:'.SITEURL.'admin/manage-products.php');
                                    //stop the proccess
                                    die();
                                }
                                
                               // 3 Remove if new image is uploaded
                                //B.Remove current image if available
                                
                                if($current_image!=="")
                                {
                                    //current Image is Available
                                    //Remove image
                                    $remove_path="../images/products/".$current_image;

                                    $remove =unlink($remove_path);

                                    //check whether image is removed or not
                                    if($remove==false)
                                    {
                                        //failed to remove current image
                                        $_SESSION['remove-failed']="<div class='error'>Failed to remove Image</div>";
                                        //redirect to manage food
                                        header('location:'.SITEURL.'admin/manage-products.php');
                                        //stop proccess
                                        die();
                                    }
                                }
                            }
                            else{
                                $image_name=$current_image; 
                            }
                        }
                        else
                        {
                            $image_name=$current_image;
                        }
                        // 4 Update product in database
                        $sql3="UPDATE tbl_drug SET
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id='$category',
                        feature='$featured',
                        active='$active'
                        WHERE id=$id              
                        ";
                        //Execute Sql query
                        $res3 = mysqli_query($conn, $sql3);
                        //check whether query executed or not
                        if($res3==true)
                        {
                            //query executed and product updated
                            $_SESSION['update']="<div class='success'>Product update successfully</div>";
                            header('location:'.SITEURL.'admin/manage-products.php');                           

                        }
                        else
                        {
                            //Failed to update products
                            $_SESSION['update']="<div class='error'>Failed to update Product</div>";
                            header('location:'.SITEURL.'admin/manage-products.php');
                        }

                    }
                    ?>
</div>
</div>
<?php include('partialss/footer.php');?>

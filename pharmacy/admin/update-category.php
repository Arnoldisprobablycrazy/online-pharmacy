<?php include('partialss/menu.php');?>
<div class="main-content">
    <div class="wrapper">
       <h1> Update Category</h1>
       <br><br>
       <?php
       //check whether id is set or not
       if(isset($_GET['id']))
       {
        //get id and all other details
       // echo "getting data";
       $id =$_GET['id'];
       //create Sql Query to get all other details
       $sql ="SELECT * FROM tbl_category WHERE id=$id";
       //execute the query
       $res=mysqli_query($conn, $sql);
       //count the rows to check whether id is valid or not
       $count=mysqli_num_rows($res);
       if($count==1)
       {
        //get all the data
        $row =mysqli_fetch_assoc($res);
        $title=$row['title'];
        $current_image=$row['image_name'];
        $featured=$row['featured'];
        $active=$row['active'];
       }
       else{
        //redirect to manage category with session message
        $_SESSION['no-category-found']="<div class='error'>Category not found</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
       }
       }
       else{
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
       }
       
       ?>
       <form action="" method="POST" enctype="multipart/form-data">
       <table class="tbl-30">
        <tr>
            <td>Title:</td>
            <td>
                    <input type ="text" name="title" value="<?php echo $title?>">
      </td>
     </tr>
     <tr>
        <td>Current image:</td>
        <td>
           <?php
           if($current_image!=="")
           {
            //Display the image
            ?>
            <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
            <?php
           }
           else{
            //display message
            echo "<div class='error'>Image not Added</div>";
           }
           ?>
        </td>
     </tr>
     <tr>
        <td>New Image:</td>
        <td>
            <input type="file" name="image">
</td>
     <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type ="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";}?>type ="radio" name="featured" value="No">No
      </td>
     </tr>
     <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";}?> type ="radio" name="active" value="Yes">Yes

                    <input <?php if($active=="No"){echo "checked";}?> type ="radio" name="active" value="No">No
      </td>
     </tr>
     <tr>
        <td>
            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
           <input type="hidden" name="id" value= "<?php echo $id; ?>">

        <input type ="submit" name="submit" value="Update Category" class="btn-secondary">
</td>
</tr>
</tr>
</table>

</form>
<?php
     if(isset($_POST['submit']))
     {
        //echo "clicked";
        //1.GEt all the value from form
        $id=$_POST['id'];
        $title=$_POST['title'];
        $current_image=$_POST['current_image'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];
        //2. Updating new image if selected
        //check whether image is selected or not
        if(isset($_FILES['image']['name']))
        {
            //get theImage Details
            $image_name = $_FILES['image']['name'];
            //check whether image is available or not
            if($image_name !=="")
            {
                //Image available
                //A. upload new image
                //Auto rename our image 
                //get the extension of our image png,jpeg e.t.c
                $ext = end(explode('.',$image_name));
                //Rename the image
                $image_name="drug_category_".rand(000, 999).'.'.$ext;//e.g drug_category
                
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path ="../images/category/".$image_name;

                //finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);
                //check whether image is uploaded or not
                //And if the image is not uploaded then we will stop process and redirect with error message
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload'] = "<div class='error'.>Failed to upload image.</div>";
                    //Redirect to add category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                    //stop the process
                    die();
                }
                //B. remove current image if available
                if($current_image!="")
                {
                    $remove_path="../images/category/".$current_image;

                    $remove=unlink($remove_path);
                    //check wheteher image is removed or not
                    //if failed to remove then display message and stop process
                    if($remove==false)
                    {
                        //Failed to remove image
                        $_SESSION['failed-remove'] ="<div class='error'>Failed to remove current image</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        die();//stop the process
                    }
                }
                
            }
            else{
                $image_name = $current_image;
            }
        }
        else{
            $image_name = $current_image;
        }

        //3. Update database
        $sql2 ="UPDATE tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        WHERE id=$id
        ";
        //execute query
        $res2 =mysqli_query($conn, $sql2);
        //4. Redirect to manage category with message
        //check whether query executed or not
        if($res2==true)
        {
            //category updated
            $_SESSION['update'] ="<div class='success'>Category updated successfully.</div>";
            header('location:'.SITEURL .'admin/manage-category.php');
        }
        else{
            //failed to update
            $_SESSION['update'] ="<div class='error'>Category update Failed.</div>";
            header('location:'.SITEURL .'admin/manage-category.php');
        }
        
     }
?>
</div>
</div>
<?php include('partialss/footer.php');?>

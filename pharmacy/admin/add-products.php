<?php include('partialss/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add products</h1>
        <br><br>
        <?php 
        
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);
        }
        
        ?>
        <form action =""method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the product">
</td>
</tr>
<tr>
    <td>Description:</td>
    <td>
        <textarea name="description" cols="30" rows="5" placeholder="Product description"></textarea>
</tr>
<tr>
    <td>Price:</td>
    <td>
    <input type="number" name="price" >
</td>
</tr>

<tr>
    <td>Select Image:</td>
    <td>
        <input type="file" name="image">
</td>
</tr>
<tr>
    <td>Category:</td>
    <td>
        <select name="category">

        <?php
        //create php to dsplay categories from database
        //1. Create SQL to get all active categories from database
        $sql ="SELECT *FROM tbl_category WHERE active='Yes'";

        $res =mysqli_query($conn, $sql);

        //count rows to check categoris available
        $count =mysqli_num_rows($res);
        //If count>0 we have categories
        if($count>0)
        {
            //we have categories
         while($row=mysqli_fetch_assoc($res))
         {
            //get the details of category
            $id=$row['id'];
            $title=$row['title'];
            ?>

            <option value="<?php echo $id;?>"><?php echo$title;?></option>

            <?php
           
         }
        }
        else{
            //we do not have caegories
            ?>
            <option value="0">No categories found</option>
            <?php
        }
        //2. Display on dropdown
        ?>
            
</td>
</tr>
<tr>
                <td>Featured:</td>
                <td>
                    <input type ="radio" name="featured" value="Yes">Yes
                    <input type ="radio" name="featured" value="No">No
      </td>
     </tr>
     <tr>
                <td>Active:</td>
                <td>
                    <input type ="radio" name="active" value="Yes">Yes
                    <input type ="radio" name="active" value="No">No
      </td>
     </tr>
     </tr>
     <tr>
        <td colspan="2">
        <input type ="submit" name="submit" value="Add Products" class="btn-secondary">
</td>
</tr>
</table>
</form>
<?php
//check whether the button is clicked or not
if(isset($_POST['submit']))
{
    //add product in database
    // echo "Clicked";

    //1. Get data from form
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];

    //check whether button for featured and active are checked or not
    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];
    }else{
        $featured ="No";//setting the default value
    }
    if(isset($_POST['active']))
    {
        $active=$_POST['active'];
    }else{
        $active ="No";//setting default value
    }
    //2. uload image if selected
    //check whether the selected image is clicked or not and upload if selected
    if(isset($_FILES['image']['name']))
    {
        //Get details of the selected image
        $image_name=$_FILES['image']['name'];
        //checck whether the image is selected or not and upload image if selected
        if($image_name!="")
        {
            //image is selected
            //A. rename the image 
            //get extension of selected image 
            $ext =end(explode('.',$image_name));

            //create new name for image
            $image_name ="Product-Name".rand(0000,9999).".".$ext;//new image name may be product-name

            //B. upload the image
            //get src and destination path
            $src = $_FILES['image']['tmp_name'];
            $dst ="../images/products/".$image_name;
            //finally upload food image
            $upload =move_uploaded_file($src, $dst);


            //check whether image uploaded
            if($upload==false)
            {
                //failed to upload the image
                //redirect to add products page with error message
                $_SESSION['upload'] =">div class='error'>Failed to upload image</div>";
                header('location:'.SITEURL.'admin/add-products.php');
                //stop the proccess
                die();
            }
        }
    }else
    {
        $image_name="";//setting default value as blank
    }
    //3. Insert data into database
    //create query to save or add food
    $sql2 ="INSERT INTO tbl_drug SET
    title='$title',
    description ='$description',
    price=$price,
    image_name='$image_name',
    category_id=$category,
    featured='$featured',
    active='$active'
    ";
    //Execute the query
    $res2 =mysqli_query($conn, $sql2);
    //check whether data is inserted or not
    if($res2== true)
    {
      $_SESSION['add']="<div class='success'>Product Added Successfully.</div>";
      header('location:'.SITEURL.'admin/manage-products.php');
    }
    else{
        //failed to insert data
        $_SESSION['add']="<div class='error'>Failed To Add Product.</div>";
        header('location:'.SITEURL.'admin/manage-products.php');
    }
    
    
    
}
?>
</div>
</div>
<?php include('partialss/footer.php');?>
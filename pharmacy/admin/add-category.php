<?php include('partialss/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add to Category</h1>

        <br><br>
        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <!--Add Category form starts-->
        <form action =""method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type ="text" name="title" placeholder="Category title">
      </td>
     </tr>
     <tr>
        <td>Select image:</td>
        <td>
            <input type="file" name="image">
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
     <tr>
        <td colspan="2">
        <input type ="submit" name="submit" value="Add Category" class="btn-secondary">
</td>
</tr>
</table>
</form><!-- Add Category form Ends -->
<?php 
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //echo "clicked";

    //1. Get the value from category form
    $title =$_POST['title'];

    //For radio input type check whether button is selected or not
    if(isset($_POST['featured']))
    {
        //Get the value from form
        $featured =$_POST['featured'];
    }
    else{
        //set default value
        $featured ="No";
    }
    if(isset($_POST['active']))
    {
        $active =$_POST['active'];
    }
    else{
        $active="No";
    }
    //check whether the image is selected or not and set value for image name
    //print_r($_FILES['image']);
    //die();
    if(isset($_FILES['image']['name']))
    {
        //upload image
        //image name and source and destination path needed to upload image
        $image_name =$_FILES['image']['name'];
        //upload image only if image is selected
        if($image_name !=="")
        {

        
        //Auto rename our image 
        //get the extension of our image png,jpeg e.t.c
        $ext = end(explode('.',$image_name));
        //Rename the image
        $image_name="drug_category_".rand(000, 999).'.'.$ext;//e.g drug_category
        
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path ="../images/category/".$image_name;

        //finally upload the image
        $upload =move_uploaded_file($source_path, $destination_path);
        //check whether image is uploaded or not
        //And if the image is not uploaded then we will stop process and redirect with error message
        if($upload==false)
        {
            //set message
            $_SESSION['upload'] = "<div class='error'.>Failed to upload image.</div>";
            //Redirect to add category page
            header('location:'.SITEURL.'admin/add-category.php');
            //stop the process
            die();
        }
    }
    }
    else{
        //Dont upload image and set the image_name value as blank
        $image_name="";
    }
    //2.create Sql quer to insert category into database
    $sql = "INSERT INTO tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
    ";
    
    //3. execute query and save in database
    $res =mysqli_query($conn, $sql);
    //4. check whether quer executed or not and data added
    if($res==true)
    {
        //Query executed and category added
        $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
        //Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }else{
        //Failed to add category
        $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
        //Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
}
?>

</div>
</div>
<?php include('partialss/footer.php');?>
<?php include('partialss/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add']))//checking whether session is set or not
        {
          echo $_SESSION['add'];//display the session message
          unset($_SESSION['add']);//Remove session message
        }
         ?>
        <form action="" method="POST">
              <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td> <input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
                </tr>
              </table>
        </form>
</div>
</div>

<?php include('partialss/footer.php');?>

<?php
//process value from form and save it in database
//check whether  submit button is clicked 
if(isset($_POST['submit']))
{
  //button clicked
  //echo "Button clicked";
  //get the data from form
    $full_name =$_POST['full_name'];
    $username =$_POST['username'];
    $password =md5($_POST['password']);//password encryption
    //SQL Query to save data into database
    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
  //executing query and save to database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    //check if data is inserted or not and display message
    if($res==TRUE)
    {
        //Data inserted
        //echo "data inserted";
        //create a session variable to display message
        $_SESSION['add'] = "Admin added succesfully";
        //redirect page to manage Admin
        header("location:".SITEURL.'admin/manage.admin.php');
    }else{
        //failed to input data
       // echo "failed to input data";
        //create a session variable to display message
        $_SESSION['add'] = "Failed to add Admin";
        //redirect page to add Admin
        header("location:".SITEURL.'admin/add-admin.php');
    }
}
?>
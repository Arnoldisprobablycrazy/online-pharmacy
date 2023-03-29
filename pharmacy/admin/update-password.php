<?php include('partialss/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br /> <br />
        <?php 
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current password: </td>
                    <td>
                    <input type="password" name="current_password" placeholder="Current password">
                </td>
            </tr>
            <tr>
                <td>New password:</td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                    </td>
           </tr>
           <tr>
                <td>Confirm password:</td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>
           </tr>
           
           <tr>
            <td colspan="2">
            <input type ="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Change password" class="btn-secondary">
            </td>
           </tr>
     </table>
       </form>
     </div>
     </div>
     <?php
     //check whether the submit button is clicked
     if(isset($_POST['submit']))
     {
        //echo "clicked";

        //Get the data from form
         $id=$_POST['id'];
         $current_password= md5($_POST['current_password']);
         $new_password =md5($_POST['new_password']);
         $confirm_password =md5($_POST['confirm_password']);
        //check whether the user with current id and password exists or not
                $sql ="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
                //Execute the query
                $res =mysqli_query($conn, $sql);

                if($res==true)
                {
                    //check whether data is available or not
                    $count=mysqli_num_rows($res);
                    if($count==1)
                    {
                        //user exists and password can be changed
                        //echo "user found";
                        //check whether password match
                        if($new_password==$confirm_password)
                        {
                            //update password
                            //echo "password match";
                            $sql2 ="UPDATE tbl_admin SET
                            password='$new_password'
                            WHERE id=$id
                            ";
                            //Execute query
                            $res2 = mysqli_query($conn, $sql2);
                            //check whether query is executed or not
                            if($res2==true)
                            {
                                //Display success message
                                 //redirect manage admin page with Success message
                                   $_SESSION['change-pwd']="<div class='success'>Password changed successfully.</div>";
                                   header('location:'.SITEURL.'admin/manage.admin.php');
                            }
                            else{
                                //Display error message
                               //redirect manage admin page with error message
                                $_SESSION['change-pwd']="<div class='error'>Failed to change password.</div>";
                               header('location:'.SITEURL.'admin/manage.admin.php');
                            }
                        }else 
                        {
                            //redirect manage admin page with error message
                            $_SESSION['pwd-not-match']="<div class='error'>Password did not match.</div>";
                              header('location:'.SITEURL.'admin/manage.admin.php');
                        }
                    }
                    else{
                        //user does not exist set message and redirect
                        $_SESSION['user-not-found']="<div class='error'>User not found.</div>";
                        header('location:'.SITEURL.'admin/manage.admin.php');
                    }
                }
        //check whether current password and confirm password match or not

        //change password if all above is true 
     }
?>
<?php include('partialss/footer.php');?>
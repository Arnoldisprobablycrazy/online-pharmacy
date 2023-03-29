<?php include('partials-front/menu.php');?>
<?php
//check whether food id is set or not
if(isset($_GET['product_id']))
{
    //Get the product id and details of selected product
    $product_id=$_GET['product_id'];
    //Get the Details of selected Product
    $sql= "SELECT * FROM tbl_drug WHERE id=$product_id";
    //execute the query
    $res =mysqli_query($conn, $sql);
    //Count the rows
    $count =mysqli_num_rows($res);
    //check whether the data is available or not
    if($count==1)
    {
        //Data available
        //GET data from Database
        $row =mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];

    }
    else{
        //product unavailable
        //redirect to home page
        header('location'.SITEURL);
    }
}
else{
    //Redirect to home page
    header('location:'.SITEURL);
}
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="product-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected product</legend>

                    <div class="product-menu-img">
                        <?php
                        //check whether image is available or not
                        if($image_name=="")
                        {
                            //Image Unavailable
                             echo "<div class='error'>Image Unavailable</div>";
                        } 
                        else{
                            //image available
                            ?>
                        <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>

                        
                    </div>
    
                    <div class="product-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type ="hidden" name="drug" value="<?php echo $title;?>">
                        <p class="product-price">ksh<?php echo $price;?></p>
                     <input type="hidden" name="price" value ="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0712345678" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@domain.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, constituency, County" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            //check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //Get all the details from the Form
                $drug= $_POST['drug'];
                $price= $_POST['price'];
                $qty= $_POST['qty'];

                $total=$price *$qty;//total = price* qty
                $order_date =date("Y-m-d-h:i:sa");//order date

                $status="Ordered";//Ordered, On Delivery, Delivered, Cancelled
                $customer_name =$_POST['full-name'];
                $customer_contact =$_POST['contact'];
                $customer_email =$_POST['email'];
                $customer_address =$_POST['address'];             
                        
              //save the order in database
              //create SQL to save the dat
              $sql2= "INSERT INTO tbl_order SET
              drug='$drug',
              price=$price,
              qty='$qty',
              total='$total',
              order_date ='$order_date',
              status='$status',
              customer_name='$customer_name',
              customer_contact='$customer_contact',
              customer_email='$customer_email',
              customer_address='$customer_address'
              "; 
              //echo $sql2;die();
              //EXecute the Query
              $res2=mysqli_query($conn, $sql2);
              
              //cheeck whether query executed successfully or not
              if($res2==true)
              {
                //Query executed and Order saved
                $_SESSION['order'] = "<div class='success text-center'>Order Placed Successfully</div>";
                header('location:'.SITEURL);
              }
              else{
                //failed to save order
                $_SESSION['order'] = "<div class='error text-center'>Failed to place Order</div>";
                header('location:'.SITEURL);
              }

            }
            ?>

        </div>
    </section>
    <!-- product sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>
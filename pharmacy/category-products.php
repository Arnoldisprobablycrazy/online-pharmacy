<?php include('partials-front/menu.php');?>
<?php 
//check whether id paseed or not
if(isset($_GET['category_id']))
{
    //Category id is set and get id
    $category_id= $_GET['category_id'];
    //Get category title based on category id
    $sql="SELECT title FROM tbl_category WHERE id=$category_id";

    //Execute the Query
    $res= mysqli_query($conn, $sql);
    //Get the value from database
    $row=mysqli_fetch_assoc($res);

    //Get the title
    $category_title = $row['title'];
}
else
{
    //category not passed
    //redirect to home page
    header('location'.SITEURL);
}
?>

    <!-- products sEARCH Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            
            <h2>Products on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- products sEARCH Section Ends Here -->



    <!-- products MEnu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">Product Menu</h2>
            <?php 
            //create sql quer to get product based on selected category
            $sql2 ="SELECT * FROM tbl_drug WHERE category_id= $category_id";
            //Execute query
            $res2 =mysqli_query($conn, $sql2);
            //Count rows
            $count2= mysqli_num_rows($res2);
            //check whether product is available or not
            if($count2>0)
            {
                //product is available
                while ($row2=mysqli_fetch_assoc($res2))
                {
             $id=$row2['id'];       
             $title=$row2['title'];
             $price=$row2['price'];
             $description=$row2['description'];
             $image_name =$row2['image_name'];
             ?>
             <div class="product-menu-box">
                <div class="product-menu-img">
                    <?php
                    if($image_name=="")
                    {
                        //Image not Available
                        echo "<div class='error'>Image not Available</div>";
                    }
                    else{
                        //image available
                        ?>
                     <img src="<?php echo SITEURL;?>images/products/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                    
                </div>

                <div class="product-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="product-price"><?php echo $price;?></p>
                    <p class="product-detail">
                        <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?product_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
             <?php

            }

            }
            else{
                //product not available
                echo "<div class='error'>Product not Available</div>";
            }
            ?>

            <div class="clearfix"></div>           

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>
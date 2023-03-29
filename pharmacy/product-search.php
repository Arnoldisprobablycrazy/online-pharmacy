<?php include('partials-front/menu.php');?>

    <!-- product sEARCH Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            <?php 
            //Get the search keyword
            $search=$_POST['search'];
            ?>
            
            <h2>Products on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- product sEARCH Section Ends Here -->



    <!-- product MEnu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">Product Menu</h2>
            <?php           

            //sql query to get product based on search qr
            $sql="SELECT *FROM tbl_drug WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            //execute the Query
            $res =mysqli_query($conn ,$sql);
            //count rows
            $count=mysqli_num_rows($res);
            //Check whether product available or not
            if($count>0)
            {
                //product available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get details
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>
                     <div class="product-menu-box">
                <div class="product-menu-img">
                    <?php
                  //check whether image name is available or not
                  if($image_name=="")
                  {
                    //image not available
                echo "<div class='error'>Image not Available.</div>";
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
                    <h4><?php $title;?></h4>
                    <p class="product-price"><?php echo $price;?></p>
                    <p class="product-detail">
                        <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                    <?php
                }
            }
            else{
                //product not available
                echo "<div class='error'>Product not found</div>";
            }
            ?>

               <div class="clearfix"></div>            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('partials-front/footer.php');?>
    
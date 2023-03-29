<?php include('partials-front/menu.php');?>

    <!-- product sEARCH Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>product-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Products.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- product sEARCH Section Ends Here -->



    <!-- product MEnu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">Product Menu</h2>
            <?php
            //Display products that are active
            $sql ="SELECT *FROM tbl_drug WHERE active='Yes'";
            //Execute The query
            $res=mysqli_query($conn, $sql);

            //Count rows
            $count =mysqli_num_rows($res);

            //check whether products are available or not
            if($count >0)
            {
                //Foods Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the Values
                    $id=$row['id'];
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    ?>
                  <div class="product-menu-box">
                <div class="product-menu-img">
                    <?php 
                    //Check whether image available or not
                    if($image_name=="")
                    {
                      //image not available
                      echo "<div class='error'>Image not Available.</div>";
                    }
                    else{
                    //image available
                    ?>
                   <img src="<?php echo SITEURL;?>images/products/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php

                    }
                    ?>
                    
                </div>

                <div class="product-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="product-price">ksh<?php echo $price;?></p>
                    <p class="product-detail">
                       <?php echo $description;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?product_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>  
                    <?php
                }
            }
            else{
                //products unavailable
                echo "<div class='error'>Product not found</div>";
            }

            ?>                
            <div class="clearfix"></div>           

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>
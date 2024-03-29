<?php include('partials-front/menu.php');?>

    <!-- product sEARCH Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>product-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for product.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- product sEARCH Section Ends Here -->
    <?php
                if(isset($_SESSION['order']))
                {
                    echo $_SESSION['order'];
                    unset($_SESSION['order']);
                }
                ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Products</h2>
            <?php
            //create SQL query to display categories from database
            $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //Execute query
            $res = mysqli_query($conn, $sql);
            if ($res === false) {
                echo "Query execution failed: " . mysqli_error($conn);
            } else {
                $count = mysqli_num_rows($res);
                // rest of the code
            }

            //count rows to check whether category is available or not
            $count =mysqli_num_rows($res);
            if($count>0)
            {
                //Category available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values like title image_name, id
                    $id =$row['id'];
                    $title =$row['title'];
                    $image_name =$row['image_name'];
                    ?>
                <a href="<?php echo SITEURL; ?>category-products.php?category_id=<?php echo $id; ?>">
                <div class="box-3 float-container">
                    <?php
                    //check wehther image is available or not
                    if($image_name=="")
                    {
                        //Display message
                        echo "<div class='error'>Image not Available</div>";
                    } 
                    else{
                        //Image Available
                        ?>
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                    } 
                    ?>
                    

                    <h3 class="float-text text-white"><?php echo $title;?></h3>
                </div>
            </a>

                    <?php
                }
            }
            else{
                //not available
                echo "<div class='error'>Category not Added</div>";
            }
            ?>
        <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- product MEnu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">Products Menu</h2>
            
             <?php 
            //getting foods from database that are active and featured
            //sql query
            $sql2 ="SELECT * FROM tbl_drug WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Execute the query
            $res2 =mysqli_query($conn, $sql2);         
         //count Rows
            $count2 = mysqli_num_rows($res2);
            //check whether product available or not
            if($count2>0)
            {
                //Product available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>
                    <div class="product-menu-box">
                    <div class="product-menu-img">
                        <?php 
                        //check whether image available or not
                        if($image_name=="")
                        {
                            //image not Available
                            echo "<div class='error'>Image not available.</div>";
                        }else
                        {
                            //Image Available
                            ?>
                            
                        <img src="<?php echo SITEURL;?>images/products/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
                //Product not Available
                echo "<div class='error'>Product not available.</div>";
            }

             ?>

         

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="#">See All Products</a>
        </p>
    </section>
    <!-- products Menu Section Ends Here -->
    <?php include('partials-front/footer.php');?>
   
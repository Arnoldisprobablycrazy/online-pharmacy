<?php include('partialss/menu.php');?>
<div class="main-content">
    <div class="wrapper">
       <h1> Manage Products</h1>
       <br /> <br />
        <!--button to add Admin -->
        <a href="<?php echo SITEURL;?>admin/add-products.php"class="btn-primary">Add Product</a>

        <br /> <br /> <br />
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);

        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
            
        }
        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
            
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
            
        }
        ?>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php 
            //create SQL Query to get all products
            $sql ="SELECT * FROM tbl_drug";
            //execute the query 
            $res =mysqli_query($conn, $sql);
            //count rows to check we have products or not
            $count=mysqli_num_rows($res);
            //create serial number and set default as 1
            $sn=1;
            if($count>0)
            {
                //we have product in database
                //Get the products from database and display
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values from individual columns
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                    ?> 
                <tr>
                <td><?php echo $sn++?></td>
                <td><?php echo $title;?></td>
                <td><?php echo $price;?></td>
                <td>
                <?php 
                //check whether we have image or not
                if($image_name=="")
                {
                    //No image display error
                    echo "<div class='error'>Image not Added</div>";
                }
                else{
                    //image available Display image
                    ?> 
                    <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name;?>"width="100px">
                    <?php
                }
                ?>
                </td>
                <td><?php echo $featured;?></td>
                <td><?php echo $active;?></td>
                <td>
                    <a href="<?php echo SITEURL;?>admin/update-product.php?id=<?php echo $id;?>" class="btn-secondary">Update product</a>
                    <a href="<?php echo SITEURL;?>admin/delete-product.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete product</a>
                </td>
            </tr>
                    <?php
                }
            }else{
                //no product added in database
                echo "<tr><td colspan='7'class='error'>Product not Added yet</td></tr>";
            }
            
            
            ?>
            
            
            
        </table>
    </div>
</div>

<?php include('partialss/footer.php');?>
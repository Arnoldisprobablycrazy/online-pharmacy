<?php include('partialss/menu.php');?>
    <div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>
        <?php 
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>
        <div class="col-4 text-center">
        <?php
        //SQL  QUERY
            $sql ="SELECT * FROM tbl_category";
            //Execute query
            $res=mysqli_query($conn, $sql);
            //Count Rows
            $count=mysqli_num_rows($res);
            ?>

            <h1><?php echo $count;?></h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
        <?php
        //SQL  QUERY
            $sql2 ="SELECT * FROM tbl_drug";
            //Execute query
            $res2=mysqli_query($conn, $sql2);
            //Count Rows
            $count2=mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2;?></h1>
            <br/>
            Products
        </div>
        <div class="col-4 text-center">
        
        <?php
        //SQL  QUERY
            $sql3 ="SELECT * FROM tbl_order";
            //Execute query
            $res3=mysqli_query($conn, $sql3);
            //Count Rows
            $count3=mysqli_num_rows($res3);
            ?>

            <h1><?php echo $count3;?></h1>
            <br>
            Total orders
        </div>
        <div class="col-4 text-center">
        <?php
        //SQL  QUERY
        //Aggregate function in Sql

            $sql4 ="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
            //Execute query
            $res4=mysqli_query($conn, $sql4);
            //Get rhe value
            $row4=mysqli_fetch_assoc($res4);
            //get total income
            $total_revenue=$row4['Total'];
              
            ?>
            <h1><?php echo $total_revenue;?></h1>
            <br>
            Total Income
        </div>
        <div class="clearfix"></div>
        </div>
    </div>
     <!--main section starts-->
    <!--main section ends-->
    <?php include('partialss/footer.php');?>

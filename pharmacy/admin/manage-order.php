<?php include('partialss/menu.php');?>
<div class="main-content">
    <div class="wrapper">
       <h1> Manage Order</h1>
       
        <br /> <br /> <br />
        <?php
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order-Date</th>
                <th>Status</th>
                <th>Customer_name</th>
                <th>Customer_contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>

            </tr>
            <?php
            //get all the orders from database
            $sql ="SELECT * FROM tbl_order ORDER BY id DESC";//Display the latest order first
            //Execute Query
            $res=mysqli_query($conn, $sql);
            //Count Rows
            $count =mysqli_num_rows($res);
            $sn=1;//create a serial number and set initial valaue as 1
            if($count>0)
            {
                //order available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get all the order details
                    $id=$row['id'];
                    $drug=$row['drug'];
                    $price=$row['price'];
                    $qty=$row['qty'];
                    $total=$row['total'];
                    $order_date=$row['order_date'];
                    $status=$row['status'];
                    $customer_name=$row['customer_name'];
                    $customer_contact=$row['customer_contact'];
                    $customer_email=$row['customer_email'];
                    $customer_address=$row['customer_address'];

                    ?>
                        <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $drug;?></td>
                        <td><?php echo $price;?></td>
                        <td><?php echo $qty;?></td>
                        <td><?php echo $total;?></td>
                        <td><?php echo $order_date;?></td>
                        <td>
                            <?php echo $status;?>
                        </td>

                        <td><?php echo $customer_name;?></td>
                        <td><?php echo $customer_contact;?></td>
                        <td><?php echo $customer_email;?></td>
                        <td><?php echo $customer_address;?></td>
                        
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id?> " class="btn-secondary">Update Order</a>
                            
                        </td>  
                        </tr>
                    <?php
                    

                }
            }
            else{
                //order unavailable
                echo "<tr><td colspan='12'>class='error'>Orders Unaivailable</td></tr>";
            }
            ?>
                            
        </table>
    </div>
</div>

<?php include('partialss/footer.php');?>
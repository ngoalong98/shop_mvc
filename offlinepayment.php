<?php
	include "inc/header.php";
	// include "inc/slider.php";
?>
<?php
	 if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
        $customer_id = Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delCart = $ct->del_all_data_cart();
        header('Location:success.php');
    }
?>
<style>
    .box-left{
        float: left;
        width: 48%;
        border: 1px solid #ccc;
    }
    .box-right{
        float: right;
        width: 48%;
        border: 1px solid #ccc;
    }
    .submit-order{
        background-color: red;
        padding: 10px 45px;
        border-radius: 15px;
        color: #fff;
        font-size: 17px;
        border: none;
        margin-top: 20px;
    }
    .submit-order:hover{
        background-color: yellowgreen;
        color: #000;
    }
</style>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Offline Payment</h3>
                </div>         
                <div class="clear"></div>
                <div class="box-left">
                    <div class="cartpage">
                        <?php
                            if(isset($update_quantity_cart)){
                                echo $update_quantity_cart;
                            }
                            if(isset($deleteCart)){
                                echo $deleteCart;
                            }
                        ?>
                        <table class="tblone">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">Product Name</th>
                                <th width="35%">Price</th>
                                <th width="5%">Quantity</th>
                                <th width="35%">Total Price</th>
                            </tr>
                            <?php
                                
                                $get_product_cart = $ct->get_product_cart();
                                if($get_product_cart){
                                    $i =0;
                                    $subtotal = 0;
                                    $qty = 0;
                                    while($result = $get_product_cart->fetch_assoc()){
                                        $i ++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><?php echo $fm->format_currency( $result['price'])." "."VNĐ" ?></td>
                                <td><?php echo $result['quantity'] ?></td>
                                <td>
                                    <?php
                                        $total = $result['price'] * $result['quantity'];
                                        echo $fm->format_currency( $total).' '.'VNĐ';
                                    ?>
                                </td>
                            </tr>
                            <?php		
                                        
                                        $subtotal += $total;		
                                        $qty = $qty + $result['quantity'] ;		
                                    }
                                }
                            ?>
                        </table>
                        <?php
                            $check_cart = $ct->check_cart();
                            if($check_cart){
                                
                                
                        ?>
                        <table style="float:right;text-align:left;" width="65%">
                            <tr>
                                <th>Sub Total : </th>
                                <td>
                                    <?php	
                                                    
                                        echo $fm->format_currency( $subtotal).' '.'VNĐ';
                                        Session::set('sum',$subtotal);
                                        Session::set('qty',$qty);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>VAT : </th>
                                <td>10% (<?php echo  $fm->format_currency( $val = $subtotal * 0.1).' '.'VNĐ'; ?>)</td>
                            </tr>
                            <tr>
                                <th>Grand Total :</th>
                                <td>
                                    <?php
                                        $val = $subtotal * 0.1;
                                        $gtotal = $subtotal + $val;
                                        echo $fm->format_currency( $gtotal).' '.'VNĐ';
                                    ?>
                                </td>
                            </tr>
                
                        </table>
                        <?php
                                }else{
                                    echo 'Your Cart is Empty ! Please Shopping Now';
                            }
                        ?>
                    </div>
                            
                </div>
                <div class="box-right">
                    <table class="tblone">
                        <?php
                            $id = Session::get('customer_id');
                            $get_customers = $cs->show_customers($id);
                            if($get_customers){
                                while($result = $get_customers->fetch_assoc()){                    
                        ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $result['name'] ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><?php echo $result['city'] ?></td>
                        </tr>
                        <tr>
                            <td>Zip Code</td>
                            <td>:</td>
                            <td><?php echo $result['zipcode'] ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo $result['address'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $result['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?php echo $result['phone'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><a href="editprofile.php">Update profile</a></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table> 
                </div>
            </div>
            <center style="margin-top: 30px;">
                <a href="?orderid=order" class="submit-order">Order Now</a> 
            </center>
        </div>
    
    </div> 
</form>
<?php
	include "inc/footer.php";
?>


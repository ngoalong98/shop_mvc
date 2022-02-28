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
    .success-order{
       text-align: center;
       color: red !important;
    }
    p{
        text-align: center;
        line-height: 30px;
        font-size: 15px;
    }
  
</style>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success-order">Sucess Order</h2>
                <?php
                    $customer_id = Session::get('customer_id');
                    $get_amount = $ct->getAmountPrice($customer_id);
                    if($get_amount){
                        $amount = 0;
                        while($result = $get_amount->fetch_assoc()){
                            $price = $result['price'];
                            $amount += $price;
                        }
                    }
                ?>
                <p>Total Price You Have Bought From My Website: 
                    <?php $val = $amount * 0.1;
                        $total = $val + $amount;
                        echo  $fm->format_currency($total).' '.'VND'; 
                    ?>
                </p>
                <p>We will contact as soon as possiable. Please see your order details here <a href="orderdetails.php">Click Here</a></p>
               
            </div>
        </div>
    
    </div> 
</form>
<?php
	include "inc/footer.php";
?>


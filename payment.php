<?php
	include "inc/header.php";
	// include "inc/slider.php";
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
       header('Location:login.php');
    }
?>

<style>
    .payment{
        text-align: center;
        width: 500px;
        margin: auto;
        border: 1px solid #ddd;
        line-height: 40px;
        background-color: #ccc;   
        padding: 10px;    
    }
    .payment h3{
        font-size: 19px;
        font-weight: bold;
    }
    .payment a{
        padding: 10px 30px;
        color:greenyellow;
        background-color: orchid;
    }
    .payment a:hover{
        color: red;
    }
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>         
                <div class="clear"></div>
                <div class="payment">
                    <h3>Choose your method payment</h3>
                    <a href="offlinepayment.php">Offline Payment</a>
                    <a href="onlinepayment.php">Online Payment</a></br>
                    <a style="background-color: grey;" href="cart.php"> << Previous</a>
                </div>
                
            </div>  
 		</div>
 	</div>
</div> 
<?php
	include "inc/footer.php";
?>


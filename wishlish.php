<?php
	include "inc/header.php";
	include "inc/slider.php";
?>

<?php
    $customer_id = Session::get('customer_id');
     if(isset($_GET['proid'])){
        $proid = $_GET['proid'];
		$delwlish = $product->delwlish($proid,$customer_id);
    }	
?>
<style>
    .cartpage h2{
        width: 100%;
    }
</style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare Product</h2>
						<table class="tblone">
							<tr>
                                <th width="10%">ID</th>
								<th width="20%">Product Name</th>
								<th width="20%">Image</th>
								<th width="30%">Price</th>
                                <th width="20%">Action</th>
							</tr>
							<?php
								$customer_id = Session::get('customer_id');
								$get_wishlish = $product->get_wishlish($customer_id);
								if($get_wishlish){
                                    $i = 0;
									while($result = $get_wishlish->fetch_assoc()){
										$i ++;
							?>
							<tr>
                                <td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency( $result['price'])." "."VNĐ" ?></td>
								<td>
                                    <a href="?proid=<?php echo $result['productId'] ?>">Remove</a> ||
                                    <a href="details.php?proid=<?php echo $result['productId'] ?>">Buy Now</a>
                                </td>
							</tr>
							<?php			
									}
								}
							?>
						</table>
						
						
					</div>
					<div class="shopping">
						<div class="shopleft" style="float: none;margin:0 auto;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    		</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
	include "inc/footer.php";
?>

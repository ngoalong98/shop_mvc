<?php
	include "inc/header.php";
	// include "inc/slider.php";
?>
<?php
	 if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
        echo "<script>windown.location = '404.php'</script>";
        
    }else{
        $id = $_GET['proid'];
    }

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
		$quantity = $_POST['quantity'];
		$addtoCart = $ct -> add_to_cart($id,$quantity);
	}

	$customer_id = Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare'])){
		$productid = $_POST['productid'];
		$insertCompare = $product -> insertCompare($productid,$customer_id);
	}
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wlish'])){
		$productid = $_POST['productid'];
		$insertWishlish = $product -> insertWishlish($productid,$customer_id);
	}
?>

<div class="main">
    <div class="content">
    	<div class="section group">
			<?php
				$product_details = $product->getproduct_details($id);
				if($product_details){
					while($result_details = $product_details->fetch_assoc()){

			?>
			<div class="cont-desc span_1_of_2">				
				<div class="grid images_3_of_2">
					<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName'] ?> </h2>
					<p><?php echo $result_details['product_desc'] ?></p>					
					<div class="price">
						<p>Price: <span><?php echo $fm->format_currency($result_details['price'])." "."VNĐ" ?></span></p>
						<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
						<p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
							<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
							
						</form>	
						<?php
							if(isset($addtoCart)){
								echo '<span style="color:red;font-size:15px;">Product Already Added</span>';
							}
						?>			
					</div>
					<div class="add-cart">
						
						<form action="" method="post" style="float: left;margin-right:10px;">
							<input type="hidden" class="buysubmit" name="productid" value=" <?php echo $result_details['productId'] ?>"/>
							<?php
								$login_check = Session::get('customer_login');
								if($login_check ){
									echo '<input type="submit" class="buysubmit" name="compare" value="Compare Product"/>'.' ';
								}else{
									echo '';
								}
							?>
							
						</form>
						<form action="" method="post">
							<input type="hidden" class="buysubmit" name="productid" value=" <?php echo $result_details['productId'] ?>"/>
							<?php
								$login_check = Session::get('customer_login');
								if($login_check ){
									echo '<input type="submit" class="buysubmit" name="wlish" value="Save to Wishlish"/>';
								}else{
									echo '';
								}
							?>
							
						</form>
					</div>
					<?php
						if(isset($insertCompare)){
							echo $insertCompare;
						}
						
						if(isset($insertWishlish)){
							echo $insertWishlish;
						}
					?>
				</div>
				<div class="product-desc">
					<h2>Product Details</h2>
					<p><?php echo $result_details['product_desc'] ?></p>	
				</div>
				
			</div>
			<?php
					}
				}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php
						$getall_category = $cat->show_category_fontend();
						if($getall_category){
							while($result_allcat = $getall_category->fetch_assoc()){						
					?>
					<li><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a></li>
					<?php
							}
						}
					?>
				</ul>

			</div>
 		</div>
 	</div>
</div> 
<?php
	include "inc/footer.php";
?>


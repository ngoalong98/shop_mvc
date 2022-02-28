<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getLastesDell = $product->getLastesDell();
					if($getLastesDell){
						while($result_dell= $getLastesDell->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result_dell['productId'] ?>"> <img src="admin/uploads/<?php echo $result_dell['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Dell</h2>
						<p><?php echo $result_dell['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_dell['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php			   
						}
					}
			   ?>
			   <?php
					$getLastesSamsung = $product->getLastesSamsung();
					if($getLastesSamsung){
						while($result_samsung= $getLastesSamsung->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $result_samsung['productId'] ?>"><img src="admin/uploads/<?php echo $result_samsung['image'] ?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p><?php echo $result_samsung['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $result_samsung['productId'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php			   
						}
					}
				?>
			</div>
			
			<div class="section group">
				<?php
					$getLastesApple = $product->getLastesApple();
					if($getLastesApple){
						while($result_apple= $getLastesApple->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result_apple['productId'] ?>"> <img src="admin/uploads/<?php echo $result_apple['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Apple</h2>
						<p><?php echo $result_apple['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_apple['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php			   
						}
					}
			   ?>
			   <?php
					$getLastesCanon = $product->getLastesCanon();
					if($getLastesCanon){
						while($result_canon= $getLastesCanon->fetch_assoc()){
				?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $result_canon['productId'] ?>"><img src="admin/uploads/<?php echo $result_canon['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Canon</h2>
						  <p><?php echo $result_canon['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $result_canon['productId'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php			   
						}
					}
			   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php 
							$get_slider = $product->show_slider();
							if($get_slider){
								while($result_slider = $get_slider->fetch_assoc()){

						?>
						<li><img src="admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt="<?php echo $result_slider['sliderName'] ?>"/></li>
						<?php
								}
							}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	